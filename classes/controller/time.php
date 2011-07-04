<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Time extends Controller_Template {

	public function action_index()
	{
		$times = ORM::factory('time')->find_all();
		
		$view = View::factory('time/list')
		->set('times', $times);
		
		$this->block('Times', $view);
	}

} // End Time