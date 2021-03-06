<?php defined('SYSPATH') or die('No direct script access.');

class FB {
	protected static $_instance;

	protected $_facebook;

	protected $_session;

	protected $_me;

	protected function __construct()
	{
		require_once Kohana::find_file('vendor', 'facebook/src/facebook');

		// Do class setup
		$this->_facebook = new Facebook(
			array(
				'appId'  => Kohana::config('facebook')->app_id,
				'secret' => Kohana::config('facebook')->secret,
				'cookie' => true, // enable optional cookie support
			)
		);

		try
		{
			$this->_me = $this->_facebook->api('/me');
		}
		catch (FacebookApiException $e)
		{
			// Do nothing.
		}
	}

	public static function instance()
	{
		if ( ! isset(self::$_instance))
			FB::$_instance = new FB;

		return FB::$_instance;
	}

	public function app_id()
	{
		return $this->_facebook->getAppId();
	}

	public function logged_in()
	{
		return $this->_me != NULL;
	}

	public function user_id()
	{
		return $this->_facebook->getUser();
	}

	public function session()
	{
		return $this->_session;
	}

	public function account()
	{
		return $this->_me;
	}

	public function facebook()
	{
		return $this->_facebook;
	}
}
