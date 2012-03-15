<?php defined('SYSPATH') or die('No direct script access.');

class Utilities {

	public static function nocache()
	{
		return (isset($_GET['nocache']) ? '?nocache' : NULL);
	}

	/**
	 * Build grid
	 */
	public static function grid($item0 = NULL, $item1 = NULL)
	{
		$output = '';

		if ($item0 != NULL)
		{
			$output .= '<div class="grid'.($item1 != NULL ? 2 : 4).' first">';
			$output .= $item0;
			$output .= '</div>';
		}

		if ($item1 != NULL)
		{
			$output .= '<div class="grid2">';
			$output .= $item1;
			$output .= '</div>';
		}

		$output .= '<div class="clearfix"></div>';

		return $output;
	}

	/**
	 *  Box
	 */
	public static function box($item = NULL)
	{
		return '<div class="box">'.$item.'</div>';
	}

	/**
	 * Get weather information from datamarket
	 * 
	 * @param string 	$when 		Date
	 * @param string 	$station 	Station ID
	 * @param mixed		$average	Boolean / Array
	 */
	public static function weather($when = NULL, $station = NULL, $average = FALSE)
	{
		$d = date('d. M. Y', strtotime($when));
		$url = 'http://vedur.datamarket.net/vedurtorg/timeseries.csv?freq=hour&fromdate='.urlencode($d).'&todate='.urlencode($d).'&st='.$station.'&attr=t&attr=rh&attr=ps&attr=r&attr=d&attr=f&attr=fg&orderby=-time';
		$csv = file_get_contents($url);

		$rows = str_getcsv($csv, "\n");
		$cols = array();

		$items = array();

		foreach ($rows as $i => $row)
		{
			$columns = str_getcsv($row, ",");

			if ($i == 0){ $cols = $columns; continue; }

			$items[] = array_combine($cols, $columns);
		}

		if ($average == TRUE)
		{
			$tmp = array(
				'heat' => 0,
				'wind' => 0,
				'ghust' => 0,
				'direction' => 0,
				'rain' => 0,
				'humidity' => 0,
				'pressure' => 0
			);

			// calculate average weather info
			foreach ($items as $item)
			{
				// for hours 13 - 21
				if ($item['klukkustund'] >= 13 && $item['klukkustund'] <= 21)
				{
					$tmp['heat'] = ($tmp['heat'] + $item['lofthiti']) / 2;
					$tmp['wind'] = ($tmp['wind'] + $item['10 mín. meðalvindhraði']) / 2;
					$tmp['ghust'] = ($tmp['ghust'] + $item['mesta hviða']) / 2;
					$tmp['direction'] = ($tmp['direction'] + $item['vindátt']) / 2;
					$tmp['rain'] = ($tmp['rain'] + $item['úrkoma']) / 2;
					$tmp['humidity'] = ($tmp['humidity'] + $item['rakastig']) / 2;
					$tmp['pressure'] = ($tmp['pressure'] + $item['leiðréttur loftþrýstingur í stöðvarhæð']) / 2;
				}
			}

			$items = $tmp;
		}
		else
		{
			foreach ($items as $item)
			{
				if ($item['klukkustund'] == date('H', strtotime($when)))
				{
					$items = array(
						'heat' => $item['lofthiti'],
						'wind' => $item['10 mín. meðalvindhraði'],
						'ghust' => $item['mesta hviða'],
						'direction' => $item['vindátt'],
						'rain' => 0 + $item['úrkoma'],
						'humidity' => $item['rakastig'],
						'pressure' => $item['leiðréttur loftþrýstingur í stöðvarhæð']
					);
				}
			}
		}

		return $items;
	}

}