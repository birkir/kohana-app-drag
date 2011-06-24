<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Import extends Controller_Template {

	public $secure_actions = array(
		'index' => array('login')
	);

	public function action_index()
	{
	}

	public function action_fix_round($id = 0)
	{
		$matches = ORM::factory('competition_round_match')
		->where('competition_round_id', '=', $id)
		->find_all();

		foreach ($matches as $match)
		{
			$car_a = $match->carnumber_a;
			$car_b = $match->carnumber_b;

			$comp_a = ORM::factory('competition_round_competitor')
			->where('competition_round_id', '=', $id)
			->where('identity', '=', $car_a)
			->find();

			$comp_b = ORM::factory('competition_round_competitor')
			->where('competition_round_id', '=', $id)
			->where('identity', '=', $car_b)
			->find();

			if ($comp_a->loaded()) {
				$m_a = ORM::factory('competition_round_match', $match->id);
				$m_a->competitor_a = $comp_a->id;
				$m_a->save();
			}

			if ($comp_b->loaded()) {
				$m_b = ORM::factory('competition_round_match', $match->id);
				$m_b->competitor_a = $comp_b->id;
				$m_b->save();
			}
		}
	}

	public function action_times()
	{
		$view = Form::open('/import/times', array('enctype' => 'multipart/form-data'));
		$view .= Form::file('file');
		$view .= Form::submit(NULL, 'Process');
		$view .= Form::close();

		if (isset($_FILES['file']['tmp_name']))
		{
			$filename = $_FILES['file']['tmp_name'];

			$rows = str_getcsv(file_get_contents($filename), "\n");

			foreach ($rows as $i => $row)
			{
				if ($i == 0)
				{
					$cols = str_getcsv($row, ";");
					foreach ($cols as $x => $col)
					{
						$cols[$x] = UTF8::trim($col);
					}
					continue;
				}

				$columns = array_combine($cols, str_getcsv($row, ";"));

				$time = array(
					'car_id' => NULL,
					'track_id' => 1,
					'lane' => NULL,
					'won' => intval(isset($columns['Win']) ? $columns['Win'] : 0),
					'rt' => (double) self::parse_time($columns['RT'], 3),
					'60ft' => (double) self::parse_time($columns['60Foot'], 3),
					'660ft' => (double) self::parse_time($columns['660Foot'], 3),
					'660mph' => (double) self::parse_time($columns['Mph1'], 2),
					'1320ft' => (double) self::parse_time($columns['1320Foot'], 3),
					'1320mph' => (double) self::parse_time($columns['Mph2'], 2),
					'date' => date('Y-m-d H:i:s', strtotime($columns['Time']))
				);

				list($time_id, $r) = DB::insert('times')
				->columns(array_keys($time))
				->values($time)
				->execute();
				
				$columns['TimeID'] = $time_id;

				if ($i == 1){ $last = $columns; continue; }

				if ($i % 2 == 1)
				{
					$competition_round_match = array(
						'competition_round_id' => 5,
						'time_a' => $last['TimeID'],
						'time_b' => $time_id,
						'competitor_a' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', UTF8::trim($last['CarNumber']))->where('competition_round_id', '=', 5),
						'competitor_b' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', UTF8::trim($columns['CarNumber']))->where('competition_round_id', '=', 5),
						'carnumber_a' => UTF8::trim($last['CarNumber']),
						'carnumber_b' => UTF8::trim($columns['CarNumber']),
						'won' => (isset($last['Win']) ? ($last['Win'] == 1 ? 'a' : 'b') : NULL)
					);
					DB::insert('competition_round_matches')
					->columns(array_keys($competition_round_match))
					->values($competition_round_match)
					->execute();
				}

				$last = $columns;
			}
		}

		$this->block('Upload file', $view);
	}

	private function parse_time($time = 0, $comma = 0)
	{
		if (strlen($time) <= $comma)
		{
			$add = intval("1".str_repeat(0, $comma));
			$time += $add;
		}

		$time2 = substr($time, -$comma);
		$time1 = substr($time, 0, strlen($time)-$comma);

		$time = (isset($add) ? $time1-1 : $time1).'.'.$time2;

		return $time;
	}

} // End Import