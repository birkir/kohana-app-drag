<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Template extends Kohana_Controller_Template {

	public $template = 'template';

	public $auth_required = FALSE;

	public $secure_actions = NULL;

	/**
	 * Prepare the template for other classes
	 *
	 * @return  void
	 */
	public function before()
	{
		parent::before();

		// Initialize session
		$this->session = Session::instance();

		// Get action name
		$this->action = Request::current()->action();

		// Check for parameters
		if (($this->auth_required !== FALSE AND Auth::instance()->logged_in($this->auth_required) === FALSE) OR (is_array($this->secure_actions) AND array_key_exists($this->action, $this->secure_actions) AND Auth::instance()->logged_in($this->secure_actions[$this->action]) === FALSE))
		{
			if (Auth::instance()->logged_in())
			{
				// Redirect user to noaccess page if already logged in
				Request::current()->redirect('user/noaccess');
			}
			else
			{
				// Redirect user to login page
				Request::current()->redirect('user/login');
			}
		}

		// Check for auto render
		if ($this->auto_render)
		{
			// Initialize empty values
			$this->template->title   = '';
			$this->template->view = '';
			$this->template->styles = array();
			$this->template->scripts = array();    
		}
	}

	/**
	 * Finalize the template before output
	 *
	 * @return  void
	 */
	public function after()
	{
		if ($this->auto_render)
		{
			$styles = array(
				'css/style.screen.css' => 'screen',
				'css/jquery-ui-1.8.7.css' => 'screen'
			);

			$scripts = array(
				'js/jquery-1.6.1.min.js',
				'js/jquery-ui-1.8.7.min.js',
				'js/drag.js'
			);

			$this->template->styles = array_merge($this->template->styles, $styles);
			$this->template->scripts = array_merge($this->template->scripts, $scripts);
		}

		parent::after();
	}

} // End Template