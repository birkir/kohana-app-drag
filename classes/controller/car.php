<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Car extends Controller_Template {

	public $secure_actions = array(
		'edit' => array('login'),
		'add' => array('login'),
		'garage' => array('login')
	);

	public function action_index()
	{
		$view = View::factory('car/list');

		$view->cars = ORM::factory('car')->find_all();

		$this->block('Cars', $view);
	}
	
	public function action_add()
	{
		$this->block('Add car', View::factory('car/fieldset'));
	}

	public function action_edit($id = 0)
	{
		$view = View::factory('car/fieldset');
		$view->car = ORM::factory('car', $id);

		if ($view->car->user->id != Auth::instance()->get_user()->id)
		{
			Request::current()->redirect('/car');
		}
		
		if ($_POST)
		{
			try
			{
				$view->car->values($_POST)->check()->save();
				$view->message = 'Updated values';
			}
			catch(Kohana_Validate_Exception $e)
			{
				$view->errors = $e->errors();
			}
		}

		$this->block('Edit car', $view);
	}

	public function action_details($id = 0)
	{
		$this->block('Details', 'Car details, add mods, set parameters etc.');
	}

	public function action_garage()
	{
		$cars = ORM::factory('car')->where('user_id', '=', Auth::instance()->get_user()->id)->find_all();

		$this->block('Garage', View::factory('car/list')->set('cars', $cars));
	}

} // End Car