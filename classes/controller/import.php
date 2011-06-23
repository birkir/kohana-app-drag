<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Import extends Controller_Template {

	public $secure_actions = array(
		'index' => array('login')
	);

	public function action_index()
	{
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
					continue;
				}

				$columns = array_combine($cols, str_getcsv($row, ";"));

				$time = array(
					'car_id' => NULL,
					'track_id' => 1,
					'lane' => NULL,
					'won' => intval($columns['Win']),
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

				if ($last['Time'] == $columns['Time'])
				{
					$competition_round_match = array(
						'time_a' => $last['TimeID'],
						'time_b' => $time_id,
						'competitor_a' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', $last['CarNumber'])->where('competition_round_id', '=', 1),
						'competitor_b' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', $columns['CarNumber'])->where('competition_round_id', '=', 1),
						'carnumber_a' => $last['CarNumber'],
						'carnumber_b' => $columns['CarNumber'],
						'won' => ($last['Win'] == 1 ? 'a' : 'b')
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