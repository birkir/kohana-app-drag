<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller {

	public $template = 'template';

	public $menu = array(
		array(
			'title'      => 'Dashboard',
			'controller' => 'dashboard'
		),
		array(
			'title'      => 'Users',
			'controller' => 'users'
		),
		array(
			'title'      => 'Cars',
			'controller' => 'cars'
		),
		array(
			'title'      => 'Tracks',
			'controller' => 'tracks'
		),
		array(
			'title'      => 'Competitions',
			'controller' => 'competitions'
		),
		array(
			'title'      => 'Events',
			'controller' => 'events'
		)
	);

	public function before()
	{
		$this->template = new View($this->template);
		$this->template->menu = $this->menu;

		return parent::before();
	}

	public function after()
	{
		$this->response->body($this->template->render());

		return parent::after();
	}
}
