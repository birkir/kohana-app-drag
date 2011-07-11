<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Competition extends Controller_Template {

	public $secure_actions = array(
		'add' => array('admin'),
		'edit' => array('admin'),
		'delete' => array('admin'),
		'class_add' => array('admin'),
		'class_edit' => array('admin'),
		'class_delete' => array('admin'),
		'round_add' => array('admin'),
		'round_edit' => array('admin'),
		'round_delete' => array('admin'),
		'competitor_add' => array('admin'),
		'competitor_edit' => array('admin'),
		'competitor_delete' => array('admin')
	);

	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$view = View::factory('competition/list')
		->set('competitions', ORM::factory('competition')->find_all());

		$this->block('Competitions', $view);
	}

	public function action_add()
	{
		$view = View::factory('competition/fieldset');

		if ($_POST)
		{
			try
			{
				$competition = ORM::factory('competition')
					->values($_POST)
					->save();

				$this->request->redirect('/competition#msg,success,'.__('Successfully added competition'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Add competition', $view);
	}

	public function action_edit($id = 0)
	{
		$competition = ORM::factory('competition', $id);
		$view = View::factory('competition/fieldset')
		->set('item', $competition);

		if ($_POST)
		{
			try
			{
				$competition
					->values($_POST)
					->save();

				$this->request->redirect('/competition#msg,success,'.__('Successfully edited competition'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Edit competition', $view);
	}

	public function action_delete($id = 0)
	{
		$this->auto_render = FALSE;

		$competition = ORM::factory('competition', $id);

		if ($competition->delete())
		{
			$body = json_encode(array(
				'status' => 200,
				'message' => __('Competition deleted successfully.')
			));
		}
		else
		{
			$body = json_encode(array(
				'status' => 500,
				'message' => __('Competition was not deleted.')
			));
		}

		$this->response->body($body);
	}

	public function action_classes($competition_id = 0)
	{
		$view = View::factory('competition/class/list')
		->set('classes', ORM::factory('competition', $competition_id)->classes->find_all());

		$this->block('Classes', $view);
	}

	public function action_class_add($competition_id = 0)
	{
		$view = View::factory('competition/class/fieldset')
		->set('competitions', ORM::factory('competition')->find_all()->as_array('id', 'name'));

		if ($_POST)
		{
			try
			{
				$round = ORM::factory('competition_class')
					->values($_POST)
					->save();

				$this->request->redirect('/competition/classes/'.$competition_id.'#msg,success,'.__('Successfully added class'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Add class', $view);
	}

	public function action_class_edit($competition_id = 0, $class_id = 0)
	{
		$class = ORM::factory('competition_class', $class_id);

		$view = View::factory('competition/class/fieldset')
		->set('competitions', ORM::factory('competition')->find_all()->as_array('id', 'name'))
		->set('item', $class);

		if ($_POST)
		{
			try
			{
				$class
					->values($_POST)
					->save();

				$this->request->redirect('/competition/classes/'.$competition_id.'#msg,success,'.__('Successfully edited class'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Edit class', $view);
	}

	public function action_class_delete($competition_id = 0, $class_id = 0)
	{
		$this->auto_render = FALSE;

		$round = ORM::factory('competition_class', $class_id);

		if ($round->delete())
		{
			$body = json_encode(array(
				'status' => 200,
				'message' => __('Class deleted successfully.')
			));
		}
		else
		{
			$body = json_encode(array(
				'status' => 500,
				'message' => __('Class was not deleted.')
			));
		}

		$this->response->body($body);
	}

	public function action_rounds($competition_id = 0)
	{
		$view = View::factory('competition/round/list')
		->set('rounds', ORM::factory('competition', $competition_id)->rounds->find_all());

		$this->block('Rounds', $view);
	}

	public function action_round($competition_id = 0, $round_id = 0)
	{
		$this->block('Best times', 'Bestu tímar dagsins', 'floatl');
		$this->block('Best competitors', 'Fljótustu keppendurnir', 'floatr');
		$this->block('Track info', 'Information of track', 'floatl');
		$this->block('weather info', 'Average weather', 'floatr');
	}

	public function action_round_add($competition_id = 0)
	{
		$view = View::factory('competition/round/fieldset')
		->set('competitions', ORM::factory('competition')->find_all()->as_array('id', 'name'))
		->set('tracks', ORM::factory('track')->find_all()->as_array('id', 'name'));

		if ($_POST)
		{
			try
			{
				$round = ORM::factory('competition_round')
					->values($_POST)
					->save();

				$this->request->redirect('/competition/rounds/'.$competition_id.'#msg,success,'.__('Successfully added round'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Add round', $view);
	}
	public function action_round_edit($competition_id = 0, $round_id = 0)
	{
		$round = ORM::factory('competition_round', $round_id);

		$view = View::factory('competition/round/fieldset')
		->set('competitions', ORM::factory('competition')->find_all()->as_array('id', 'name'))
		->set('tracks', ORM::factory('track')->find_all()->as_array('id', 'name'))
		->set('item', $round);

		if ($_POST)
		{
			try
			{
				$round
					->values($_POST)
					->save();

				$this->request->redirect('/competition/rounds/'.$competition_id.'#msg,success,'.__('Successfully edited round'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Edit round', $view);
	}
	public function action_round_delete($competition_id = 0, $round_id = 0)
	{
		$this->auto_render = FALSE;

		$round = ORM::factory('competition_round', $round_id);

		if ($round->delete())
		{
			$body = json_encode(array(
				'status' => 200,
				'message' => __('Round deleted successfully.')
			));
		}
		else
		{
			$body = json_encode(array(
				'status' => 500,
				'message' => __('Round was not deleted.')
			));
		}

		$this->response->body($body);
	}

	public function action_competitors($round_id = 0)
	{
		$view = View::factory('competition/round/competitor/list')
		->set('competitors', ORM::factory('competition_round', $round_id)->competitors->order_by('identity', 'ASC')->find_all());

		$this->block('Competitors', $view);
	}

	public function action_competitor($competitor_id = 0, $competition_id = 0)
	{
		$competitor = ORM::factory('competition_round_competitor', $competitor_id);

		$matches = ORM::factory('competition_round_match')
		->where('competitor_a', '=', $competitor_id)
		->or_where('competitor_b', '=', $competitor_id)
		->find_all();

		View::set_global('id', $competitor->round->id);

		$view = View::factory('competition/round/competitor/graph')
		->set('matches', $matches)
		->set('competitor_id', $competitor_id);

		$this->block('Graph', $view);

		$view = View::factory('competition/round/competitor/times')
		->set('matches', $matches)
		->set('competitor_id', $competitor_id);

		$this->block('Timeslips', $view);
	}

	public function action_competitor_add($round_id = 0, $competition_id = 0)
	{
		$competition = ORM::factory('competition', $competition_id);

		$view = View::factory('competition/round/competitor/fieldset')
		->set('rounds', $competition->rounds->find_all()->as_array('id', 'name'))
		->set('classes', $competition->classes->find_all()->as_array('id', 'name'));

		if ($_POST)
		{
			try
			{
				$round = ORM::factory('competition_round_competitor')
					->values($_POST)
					->save();

				$this->request->redirect('/competition/competitors/'.$round_id.'/'.$competition_id.'#msg,success,'.__('Successfully added competitor'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Add competitor', $view);
	}

	public function action_competitor_edit($competitor_id = 0, $round_id = 0)
	{
		$round = ORM::factory('competition_round', $round_id);
		$competitor = ORM::factory('competition_round_competitor', $competitor_id);

		$view = View::factory('competition/round/competitor/fieldset')
		->set('rounds', $round->competition->rounds->find_all()->as_array('id', 'name'))
		->set('classes', $round->competition->classes->find_all()->as_array('id', 'name'))
		->set('item', $competitor);

		View::set_global('id', $round_id);
		View::set_global('parent', $round->competition->id);

		if ($_POST)
		{
			try
			{
				$competitor
					->values($_POST)
					->save();

				$this->request->redirect('/competition/competitors/'.$round_id.'/'.$round->competition->id.'#msg,success,'.__('Successfully edited competitor'));
			}
			catch (ORM_Validation_Exception $e)
			{
				$view->set('errors', $e->errors());
			}
		}

		$this->block('Edit competitor', $view);
	}

	public function action_competitor_delete($competitor_id = 0, $round_id = 0)
	{
		$this->auto_render = FALSE;

		$competitor = ORM::factory('competition_round_competitor', $competitor_id);

		if ($competitor->delete())
		{
			$body = json_encode(array(
				'status' => 200,
				'message' => __('Competitor deleted successfully.')
			));
		}
		else
		{
			$body = json_encode(array(
				'status' => 500,
				'message' => __('Competitor was not deleted.')
			));
		}

		$this->response->body($body);
	}

	public function action_matches($id = 0)
	{
		$view = View::factory('competition/match/list')
		->set('matches', ORM::factory('competition_round', $id)->matches->find_all());

		$this->block('Matches', $view);
	}

	public function action_match($match_id = 0)
	{
		$match = ORM::factory('competition_round_match', $match_id);

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
