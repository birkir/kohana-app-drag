<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Template {

	public $secure_actions = array(
		'profile' => array(
			'login'
		));

	/**
	 * Register user by using the Auth method
	 *
	 * @return  void
	 */
	public function action_register()
	{
		// Check if user already logged in
		if (Auth::instance()->logged_in() != 0)
		{
			// Redirect to user profile
			Request::current()->redirect('user/profile');
		}

		// Set register view
		$view = View::factory('user/register');

		// Captcha
		$captcha = new Recaptcha;
		$view->captcha = $captcha->get_html();

		// Check for post data
		if ($_POST)
		{
			if ( ! $captcha->check())
			{
				$view->errors = array('captcha' => 'Captcha code incorrect. Please try again.');

				return FALSE;
			}

			try
			{
				// Attempt to create user
				$user = ORM::factory('user')->create_user($_POST, array(
					'username',
					'password',
					'email',
				));
				$user->created = date('Y-m-d H:i:s');
				$user->save();

				// Add login role to user
				$user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());

				ORM::factory('activity')->values(array(
					'user_id' => $user->id,
					'message' => ':user regiestered'
				))->save();

				// Redirect to user profile
				Request::currenct()->redirect('user/profile');
			}
			catch (ORM_Validation_Exception $e)
			{
				// Attach creation errors to view
				$view->errors = $e->errors('register');
			}
		}

		$this->block('Register', $view);
	}

	public function action_list()
	{
		$view = View::factory('user/list')
		->set('users', ORM::factory('user')->find_all());

		$this->block('User list', $view);
	}

	/**
	 * Attempt to log in a user by using Auth method
	 *
	 * @return  void
	 */
	public function action_login()
	{
		// Check if user already logged in
		if (Auth::instance()->logged_in() != 0)
		{
			// Redirect to user profile
			Request::current()->redirect('user/profile');
		}

		// Set login view
		$view = View::factory('user/login');

		// Check for post data
		if ($_POST)
		{
			// Attempt to log in
			if (Auth::instance()->login($_POST['username'], $_POST['password'], isset($_POST['remember']) ? TRUE : FALSE))
			{
				$u = Auth::instance()->get_user();
				$u = ORM::factory('user', $u->id);
				$u->logins++;
				$u->last_login = time();
				$u->ip = inet_pton(self::get_ip());
				$u->save();

				ORM::factory('activity')->values(array(
					'user_id' => $u->id,
					'message' => ':user logged in'.(isset($_POST['remember']) ? ' with remember me' : NULL)
				))->save();

				// Redirect to user profile
				Request::current()->redirect('user/profile');
			}
			else
			{
				$view->errors = array('Incorrect login credentials');
			}
		}

		$this->block('Login', $view);
	}

	/**
	 * Attempt to log out a user
	 *
	 * @return  void
	 */
	public function action_logout()
	{
		$id = Auth::instance()->get_user()->id;
			
		if (Auth::instance()->logout())
		{
			ORM::factory('activity')->values(array(
				'user_id' => $id,
				'message' => ':user logged out'
			))->save();

			Request::current()->redirect('home');
		}
		else
		{
			$this->template->view = __('Could not logout.');
		}
	}

	/**
	 * Send new password to email if password is lost
	 *
	 * @param   string  Reset password hash
	 * @return  void
	 */
	public function action_lostpassword($hash = NULL)
	{
		// Check if user already logged in
		if (Auth::instance()->logged_in() != 0)
		{
			// Redirect to user profile
			Request::current()->redirect('user/profile');
		}
		
		$this->block('Lost password', View::factory('user/lostpassword'));
	}

	/**
	 * Display user profile
	 *
	 * @return  void
	 */
	public function action_profile($action = NULL)
	{
		$fb = FB::instance();
		$facebook = View::factory('user/profile/facebook')
		->set('facebook', $fb);

		$user = Auth::instance()->get_user();
		$account = View::factory('user/profile/account')
		->set('account', $user);

		if ($action != NULL)
		{
			$this->auto_render = FALSE;

			switch ($action)
			{
				case "change":
					$body = View::factory('user/profile/change-account')
					->set('account', $user);
					break;
				
				case "save":
					if ($_POST['email'] != $user->email AND ($_POST['email'] != $_POST['email_confirm'] OR ! Valid::email($_POST['email'])))
					{
						$_POST['email'] = $user->email;
					}

					$user = ORM::factory('user', $user->id)->values($_POST)->save();
					$account->set('account', $user);

					ORM::factory('activity')->values(array(
						'user_id' => $user->id,
						'message' => ':user updated his profile'
					))->save();
					
				case "view":
					$body = $account;
					break;
			}

			$this->response->body($body);
		}

		$activity = View::factory('user/profile/activity')
		->set('items', ORM::factory('activity')
			->where('user_id', '=', $user->id)
			->or_where_open()
				->and_where('ref_type', '=', 'user')
				->and_where('ref_id', '=', $user->id)
			->or_where_close()
			->order_by('date', 'DESC')
			->find_all());

		$this->block('Facebook', $facebook, 'floatl');
		$this->block('Profile', $account, 'floatr');
		$this->block('Recent activity', $activity);
	}

	public static function get_ip()
	{
		$ip = NULL;

		$keys = array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR');

		foreach ($keys as $key)
		{
			if ( ! empty($_SERVER[$key]))
			{
				$ip = $_SERVER[$key];
				break;
			}
		}

		if ($comma = strrpos($ip, ',') !== FALSE)
		{
			$ip = substr($ip, $comma + 1);
		}

		return $ip;
	}

} // End User
