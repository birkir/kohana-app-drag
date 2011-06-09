<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Car extends Controller_Template {

	public $secure_actions = array(
		'add' => array('login'),
		'garage' => array('login')
	);

	public function action_index()
	{
		$this->template->view = View::factory('car/list');
		
		$cars = ORM::factory('car')->find_all();
		
		$this->template->view->cars = $cars;
	}
	
	public function action_add()
	{
		$this->template->view = View::factory('car/fieldset');
	}

	public function action_edit($id = 0)
	{
		$this->template->view = View::factory('car/fieldset');
		$this->template->view->car = ORM::factory('car', $id);

		if ($this->template->view->car->user->id != Auth::instance()->get_user()->id)
		{
			$this->template->view->errors = array(
				'No write access!'
			);
		}
		else
		{
			if ($_POST)
			{
				try
				{
					$this->template->view->car->values($_POST)->check()->save();
					$this->template->view->message = __('Updated values');
				}
				catch(Kohana_Validate_Exception $e)
				{
					$this->template->view->errors = $e->errors();
				}
			}
		}
	}

	public function action_garage()
	{
		
	}

} // End Car