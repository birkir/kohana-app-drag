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
		$view .= Form::label('date', 'Date:');
		$view .= Form::input('date');
		$view .= Form::select('round', ORM::factory('competition_round')->order_by('competition_id', 'ASC')->find_all()->as_array('id', 'name'));
		$view .= Form::file('file');
		$view .= Form::submit(NULL, 'Process');
		$view .= Form::close();

		if (isset($_FILES['file']['tmp_name']))
		{
			$round = $_POST['round'];
			
			$filename = $_FILES['file']['tmp_name'];

			$d = ORM::factory('competition_round_match')->where('competition_round_id', '=', $round)->find_all();
			foreach ($d as $dd)
			{
				DB::delete('times')->where('id', '=', $dd->time_a)->execute();
				DB::delete('times')->where('id', '=', $dd->time_b)->execute();
				$dd->delete();
			}

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
					'identity' => trim($columns['CarNumber']),
					'lane' => NULL,
					'won' => intval(isset($columns['Win']) ? $columns['Win'] : 0),
					'index' => (double) self::parse_time($columns['DialIn'], 3),
					'rt' => (double) self::parse_time($columns['RT'], 3),
					'60ft' => (double) self::parse_time($columns['60Foot'], 3),
					'660ft' => (double) self::parse_time($columns['660Foot'], 3),
					'660mph' => (double) self::parse_time($columns['Mph1'], 2),
					'1320ft' => (double) self::parse_time($columns['1320Foot'], 3),
					'1320mph' => (double) self::parse_time($columns['Mph2'], 2),
					'date' => date('Y-m-d H:i:s', strtotime(isset($columns['Time']) ? $columns['Time'] : $_POST['date']))
				);

				list($time_id, $r) = DB::insert('times')
				->columns(array_keys($time))
				->values($time)
				->execute();
				
				$columns['TimeID'] = $time_id;

				if ($i == 1){ $last = $columns; continue; }

				if (isset($columns['Time']) AND $last['Time'] == $columns['Time'])
				{
					$competition_round_match = array(
						'competition_round_id' => $round,
						'time_a' => $last['TimeID'],
						'time_b' => $time_id,
						'competitor_a' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', UTF8::trim($last['CarNumber']))->where('competition_round_id', '=', $round),
						'competitor_b' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', UTF8::trim($columns['CarNumber']))->where('competition_round_id', '=', $round),
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

	public function action_biladagar()
	{
		$view = Form::open('/import/biladagar', array('enctype' => 'multipart/form-data'));
		$view .= Form::label('date', 'Date:');
		$view .= Form::input('date');
		$view .= Form::select('round', ORM::factory('competition_round')->order_by('competition_id', 'ASC')->find_all()->as_array('id', 'name'));
		$view .= Form::file('file');
		$view .= Form::submit(NULL, 'Process');
		$view .= Form::close();

		if (isset($_FILES['file']['tmp_name']))
		{
			$round = $_POST['round'];
			
			$filename = $_FILES['file']['tmp_name'];

			$d = ORM::factory('competition_round_match')->where('competition_round_id', '=', $round)->find_all();
			foreach ($d as $dd)
			{
				DB::delete('times')->where('id', '=', $dd->time_a)->execute();
				DB::delete('times')->where('id', '=', $dd->time_b)->execute();
				$dd->delete();
			}

			$rows = str_getcsv(file_get_contents($filename), "\n");

			foreach ($rows as $i => $row)
			{
				if ($i == 0)
				{
					$cols = str_getcsv($row, ",");
					foreach ($cols as $x => $col)
					{
						$cols[$x] = UTF8::trim($col);
					}
					continue;
				}

				$columns = array_combine($cols, str_getcsv($row, ","));

				$time = array(
					'car_id' => NULL,
					'track_id' => 2,
					'identity' => trim($columns['identity']),
					'lane' => NULL,
					'won' => (trim($columns['win']) == 'W' ? 1 : 0),
					'rt' => (double) $columns['rt'],
					'60ft' => (double) $columns['60ft'],
					'660ft' => (double) $columns['660ft'],
					'660mph' => (double) $columns['660mph'],
					'date' => date('Y-m-d H:i:s', strtotime($_POST['date']))
				);

				list($time_id, $r) = DB::insert('times')
				->columns(array_keys($time))
				->values($time)
				->execute();

				$columns['TimeID'] = $time_id;

				if ($i == 1){ $last = $columns; continue; }

				if (($i % 2 == 1) AND $last['id'] == $columns['id']-1)
				{
					$competition_round_match = array(
						'competition_round_id' => $round,
						'time_a' => $last['TimeID'],
						'time_b' => $time_id,
						'competitor_a' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', UTF8::trim($last['identity']))->where('competition_round_id', '=', $round),
						'competitor_b' => DB::select('id')->from('competition_round_competitors')->where('identity', '=', UTF8::trim($columns['identity']))->where('competition_round_id', '=', $round),
						'carnumber_a' => UTF8::trim($last['identity']),
						'carnumber_b' => UTF8::trim($columns['identity']),
						'won' => (isset($last['win']) ? ($last['win'] == 'W' ? 'a' : 'b') : NULL)
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