<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Template {

	public function action_index()
	{
		$this->block('Welcome', '<p style="font-size:15px;">Velkomin á míluna</p>');
		$times1 = ORM::factory('time')
		->where('1320ft', '>', '0')
		->where('1320mph', '>', 0)
		->order_by('1320ft', 'ASC')
		->group_by('identity')
		->limit(10)
		->find_all();

		$this->block('Best 1320ft', View::factory('time/list')
		->set('times', $times1), 'floatl');

		$times2 = ORM::factory('time')
		->where('660ft', '>', 1.0)
		->where('60ft', '>', 1.0)
		->order_by('660ft', 'ASC')
		->group_by('identity')
		->limit(10)
		->find_all();

		$this->block('Best 660ft', View::factory('time/list')
		->set('times', $times2), 'floatr');
	}

} // End Home
