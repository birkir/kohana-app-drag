<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Time extends Controller_Template {

	public function action_index()
	{
		$this->block('In progress', "Still in progress");
	}

} // End Time