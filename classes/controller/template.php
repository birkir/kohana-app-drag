<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller class for base template used by other
 * controllers.
 * 
 * @package     Drag
 * @category    Controller
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Controller_Template extends Kohana_Controller_Template {

	/**
	 * @var  Config   Project config
	 */
	public $config;

	/**
	 * Loads the template [View] object.
	**/
	public function before()
	{
		parent::before();

		// set config to class and view
		$this->config = Kohana::$config->load('base');
		View::set_global('config', $this->config);

		// set title and content
		$this->template->title = NULL;
		$this->template->content = NULL;

		// set uri params
		View::set_global('param', Request::initial()->param());

		// find top level uri
		list($toplevel) = explode('/', $this->request->uri());

		if (empty($toplevel))
		{
			$toplevel = 'dashboard';
		}

		// set toplevel as singular
		View::set_global('toplevel', Inflector::singular($toplevel));
	}

	/**
	 * Assigns the template [View] as the request response.
	**/
	public function after()
	{
		return parent::after();
	}
}
