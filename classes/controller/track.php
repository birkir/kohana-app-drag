<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Track extends Controller_Template {

	public function action_index()
	{
		$this->block('Tracks', 'Work in progress');
	}

} // End Track