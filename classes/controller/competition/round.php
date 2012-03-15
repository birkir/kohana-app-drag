<?php defined('SYSPATH')or die('No direct script access.');

class Controller_Competition_Round extends Controller_Template {

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
			->execute();
		}
	}

	public function action_navigation()
	{
		// check if request is not initial
		if ( ! $this->request->is_initial())
		{
			// get initial request
			$initial = Request::initial();

			// build base url
			$baseurl = '/competition/'.$initial->param('competition')
		         . '/round/'.$initial->param('round');

		    // menu items
			$menu = array(
				'details' => array(
					'title'   => 'Details',
					'url'     => $baseurl
				),
				'competitors' => array(
					'title'   => 'Competitors',
					'url'     => $baseurl.'/competitors'
				),
				'matches' => array(
					'title'   => 'Matches',
					'url'     => $baseurl.'/matches'
				),
				'times' => array(
					'title'   => 'Times',
					'url'     => $baseurl.'/times'
				),
				'photos' => array(
					'title'   => 'Photos',
					'url'     => $baseurl.'/photos'
				)
			);

			// set current menu item
			if (isset($menu[$this->request->query('current')]))
			{
				$menu[$this->request->query('current')]['current'] = TRUE;
			}

			// assign template variables
			$this->template = View::factory('misc/navigation')
			->set('title', $this->request->query('title'))
			->set('items', $menu);
		}
	}

	public function action_details()
	{
		// find round
		$this->round = $this->competition->rounds
		->where('id', '=', $this->request->param('round'))
		->find();

		// navigation title
		$this->template->navigation .= Request::factory('competition/get/round/get/navigation')
		->query('title', $this->round->name)
		->query('current', 'details')
		->execute();

		// get lane usage
		$lr = array(
			'lv' => $this->round->times->where('lane', '=', 'l')->count_all(),
			'rv' => $this->round->times->where('lane', '=', 'r')->count_all()
		);

		// calculate percentage
		$lr['lp'] = ($lr['lv'] > 0 ? intval($lr['lv'] / ($lr['lv'] + $lr['rv']) * 100) : 0);
		$lr['rp'] = ($lr['rv'] > 0 ? intval($lr['rv'] / ($lr['lv'] + $lr['rv']) * 100) : 0);

		// set statistics view
		$statistics = View::factory('competition/round/statistics')
		->set('competition', $this->competition)
		->set('round', $this->round)
		->set('lr', $lr);

		// get weather information
		$weather = Utilities::weather($this->round->datetime, $this->round->track->weather_station_id, TRUE);

		// attach weather info
		$weather = View::factory('competition/round/weather')
		->set('weather', $weather);

		// set page title
		$this->title = $this->competition->name . ' ' . date('Y', strtotime($this->round->datetime)).': '.$this->round->name;

		// set page contents
		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			Utilities::grid($statistics, $weather),
			Utilities::grid(Utilities::box('<h3>Best times</h3>'), Utilities::box('<h3>Event photos</h3>'))
		);
	}

}
