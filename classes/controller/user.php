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
		$this->template->view = View::factory('user/register');

		// Captcha
		$captcha = new Recaptcha;
		$this->template->view->captcha = $captcha->get_html();

		// Check for post data
		if ($_POST)
		{
			if ( ! $captcha->check())
			{
				$this->template->view->errors = array('captcha' => 'Captcha code incorrect. Please try again.');

				return FALSE;
			}

			try
			{
				// Attempt to create user
				$user = ORM::factory('user')->create_user($_POST, array(
					'username',
					'password',
					'email'
				));

				// Add login role to user
				$user->add('roles', ORM::factory('role')->where('name', '=', 'login')->find());
			}
			catch (ORM_Validation_Exception $e)
			{
				// Attach creation errors to view
				$this->template->view->errors = $e->errors('register');
			}
		}
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
		$this->template->view = View::factory('user/login');

		// Check for post data
		if ($_POST)
		{
			// Attempt to log in
			if (Auth::instance()->login($_POST['username'], $_POST['password'], isset($_POST['remember']) ? TRUE : FALSE))
			{
				// Redirect to user profile
				Request::current()->redirect('user/profile');
			}
			else
			{
				$this->template->view->errors = array('Incorrect login credentials');
			}
		}
	}

	/**
	 * Attempt to log out a user
	 *
	 * @return  void
	 */
	public function action_logout()
	{
		if (Auth::instance()->logout())
		{
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
	}

	/**
	 * Display user profile
	 *
	 * @return  void
	 */
	public function action_profile()
	{
		$this->template->view = "User PROFILE";
	}

} // End User
