<?php defined('SYSPATH')or die('No direct script access.');

class Controller_Competition_Round_Time extends Controller_Template {

	public $competition,
	       $round,
	       $time;

	public function before()
	{
		parent::before();

		$this->competition = ORM::factory('competition', array(
			'slug' => $this->request->param('competition')
		));

		$this->round = $this->competition->rounds
		->where('id', '=', $this->request->param('round'))
		->find();

		// assign menu to template
		$this->template->navigation = Request::factory('competition/get/navigation')
		->query('title', $this->competition->name)
		->execute();

		// navigation title
		$this->template->navigation .= Request::factory('competition/get/round/get/navigation')
		->query('title', $this->round->name)
		->query('current', 'times')
		->execute();

		$this->title = $this->competition->name . ' ' . date('Y', strtotime($this->round->datetime)).': '.$this->round->name;
	}

	public function action_list()
	{
		$list = View::factory('competition/round/time/list')
		->set('items', $this->round->times->find_all());

		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			$list
		);
	}

	public function action_details()
	{
		$this->time = ORM::factory('time', $this->request->param('time'));

		$time = View::factory('competition/round/time/details')
		->set('item', $this->time);

		// attach weather info
		$weather = View::factory('competition/round/weather')
		->set('weather', Utilities::weather($this->time->date, $this->time->track->weather_station_id, FALSE));

		$competitor = View::factory('competition/round/competitor/details')
		->set('item', $this->time->competitor);

		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			Utilities::grid($time, $weather.$competitor)
		);
	}

}
