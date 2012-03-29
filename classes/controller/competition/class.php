<?php defined('SYSPATH')or die('No direct script access.');

class Controller_Competition_Class extends Controller_Template {

	public $competition,
	       $round;

	/**
	 * before action runs
	**/
	public function before()
	{
		parent::before();

		if ($this->request->is_initial())
		{
			// get current competition
			$this->competition = ORM::factory('competition')
			->where('slug', '=', $this->request->param('competition'))
			->find();

			// assign menu to template
			$this->template->navigation = Request::factory('competition/get/navigation')
			->query('title', $this->competition->name)
			->query('current', 'classes')
			->execute();
		}
	}

	public function action_details()
	{
		$class = ORM::factory('competition_class')
		->where('name', '=', $this->request->param('class'))
		->find();

		// set page contents
		$this->template->content = array(
			'<h1>'.$this->competition->name.'</h1>',
			View::factory('competition/class/details')
			->bind('item', $class)
		);
	}

}
