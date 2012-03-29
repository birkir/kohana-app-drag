<?php defined('SYSPATH')or die('No direct script access.');

/**
 * Time class and functions.
 * 
 * @package     Drag
 * @category    Controller
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Controller_Competition_Round_Time extends Controller_Template {

	public $competition,
	       $round,
	       $time;

	public function before()
	{
		parent::before();

		// find current competition
		$this->competition = ORM::factory('competition', array(
			'slug' => $this->request->param('competition')
		));

		// find current round
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

		// set page title
		$this->title = $this->competition->name . ' ' . date('Y', strtotime($this->round->datetime)).': '.$this->round->name;
	}

	/**
	 * List available times in round
	 */
	public function action_list()
	{
		// find all times
		$list = View::factory('competition/round/time/list')
		->set('items', $this->round->times->find_all());

		// assign title and times view
		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			$list
		);
	}

	/**
	 * Time details
	 */
	public function action_details()
	{
		// get current time selected
		$this->time = ORM::factory('time', $this->request->param('time'));

		// set view for time details
		$time = View::factory('competition/round/time/details')
		->set('item', $this->time);

		// attach weather info
		$weather = View::factory('competition/round/weather')
		->set('weather', Utilities::weather($this->time->date, $this->time->track->weather_station_id, FALSE));

		// get competitor info
		$competitor = View::factory('competition/round/competitor/details')
		->set('item', $this->time->competitor);

		// assign title, weather and competitor
		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			Utilities::grid($time, $weather.$competitor)
		);
	}

}
