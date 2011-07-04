<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Competition extends Controller_Template {

	public $secure_actions = array(
	);

	public $competition;

	public function before()
	{
		if (isset($_GET['id']))
		{
			$this->competition = ORM::factory('competition', $_GET['id']);
		}

		parent::before();
	}

	public function action_index()
	{
		$view = View::factory('competition/list')
		->set('competitions', ORM::factory('competition')->find_all());

		$this->block('Competitions', $view);
	}

	public function action_classes($id = 0)
	{
		$view = View::factory('competition/class/list')
		->set('classes', $this->competition->classes->find_all());

		$this->block('Classes', $view);
	}

	public function action_rounds($id = 0)
	{
		$view = View::factory('competition/round/list')
		->set('rounds', $this->competition->rounds->find_all());

		$this->block('Rounds', $view);
	}

	public function action_competitors($id = 0)
	{
		$view = View::factory('competition/round/competitor/list')
		->set('competitors', ORM::factory('competition_round', $id)->competitors->order_by('identity', 'ASC')->find_all());

		$this->block('Competitors', $view);
	}

	public function action_competitor($id = 0)
	{
		$competitor = ORM::factory('competition_round_competitor', $id);

		$matches = ORM::factory('competition_round_match')
		->where('competitor_a', '=', $id)
		->or_where('competitor_b', '=', $id)
		->find_all();

		View::set_global('id', $competitor->round->id);
		$_GET['id'] = $competitor->round->competition->id;

		$view = View::factory('competition/round/competitor/graph')
		->set('matches', $matches)
		->set('competitor_id', $id);

		$this->block('Graph', $view);

		$view = View::factory('competition/round/competitor/times')
		->set('matches', $matches)
		->set('competitor_id', $id);

		$this->block('Timeslips', $view);
	}

	public function action_matches($id = 0)
	{
		$view = View::factory('competition/match/list')
		->set('matches', ORM::factory('competition_round', $id)->matches->find_all());

		$this->block('Matches', $view);
	}

	public function action_match($id = 0)
	{
		$match = ORM::factory('competition_round_match', $id);

		$details = View::factory('competition/match/details')
		->set('weather', self::weather($match->a_time->date));

		$this->block('Details', $details);

		$view1 = View::factory('competition/match/time')
		->set('identity', $match->carnumber_a)
		->set('competitor', $match->a_competitor)
		->set('time', $match->a_time);

		$view2 = View::factory('competition/match/time')
		->set('identity', $match->carnumber_b)
		->set('competitor', $match->b_competitor)
		->set('time', $match->b_time);

		View::set_global('id', $match->round->id);

		$this->block('Left lane', $view1, 'floatl');
		$this->block('Right lane', $view2, 'floatr');
	}

	private function weather($date = NULL)
	{
		$d = date('d. M. Y', strtotime($date));
		$url = 'http://vedur.datamarket.net/vedurtorg/timeseries.csv?freq=hour&fromdate='.urlencode($d).'&todate='.urlencode($d).'&st=1473&attr=t&attr=rh&attr=ps&attr=r&attr=d&attr=f&attr=fg&orderby=-time';
		$csv = file_get_contents($url);

		$rows = str_getcsv($csv, "\n");
		$cols = array();

		foreach ($rows as $i => $row)
		{
			$columns = str_getcsv($row, ",");

			if ($i == 0){ $cols = $columns; continue; }

			$columns = array_combine($cols, $columns);

			if ($columns['klukkustund'] == date('H', strtotime($date)))
			{
				return $columns;
			}
		}

		return false;
	}

} // End Competition