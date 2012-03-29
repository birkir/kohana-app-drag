<?php defined('SYSPATH')or die('No direct script access.');

/**
 * Competitor class and functions.
 * 
 * @package     Drag
 * @category    Controller
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Controller_Competition_Round_Competitor extends Controller_Template {

	public $competition,
	       $round,
	       $competitor;

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
		->query('current', 'competitors')
		->execute();

		$this->title = $this->competition->name . ' ' . date('Y', strtotime($this->round->datetime)).': '.$this->round->name;
	}

	public function action_list()
	{
		$list = View::factory('competition/round/competitor/list')
		->set('items', $this->round->competitors->find_all());

		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			$list
		);
	}

	public function action_details()
	{
		// competitor details
		// competitor matches
		// competitor times

		$competitor = ORM::factory('competition_round_competitor', $this->request->param('competitor'));

		$times = View::factory('competition/round/time/list')
		->set('items', $competitor->times->find_all());

		// build base statistics
		$keys = array('rt', '60ft', '660ft', '660mph', '1320ft', '1320mph');
		$statistics = array();
		foreach ($keys as $k)
		{
			$statistics[$k] = array('min' => 999.000, 'max' => 0.000, 'avg' => NULL);
		}

		// loop through times
		foreach ($competitor->times->find_all() as $time)
		{
			foreach ($keys as $k)
			{
				$m = $statistics[$k];

				if ($m['min'] > $time->{$k})
				{
					$statistics[$k]['min'] = $time->{$k};
				}

				if ($m['max'] < $time->{$k})
				{
					$statistics[$k]['max'] = $time->{$k};
				}

				$statistics[$k]['avg'] = ($m['avg'] == NULL ? $time->{$k} : ($m['avg'] + $time->{$k}) / 2);
			}
		}

		$details = View::factory('competition/round/competitor/details')
		->set('item', $competitor);

		$statistics = View::factory('competition/round/competitor/statistics')
		->set('item', $statistics);

		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			'<h2>'.$competitor->driver.'</h2>',
			Utilities::grid($details, $statistics),
			$times
		);
	}
}
