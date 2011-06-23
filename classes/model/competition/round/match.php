<?php defined('SYSPATH') or die('No direct script access.');

class Model_Competition_Round_Match extends ORM {

	protected $_belongs_to = array(
		'a_competitor' => array(
			'model' => 'competition_round_competitor',
			'foreign_key' => 'competitor_a'
		),
		'b_competitor' => array(
			'model' => 'competition_round_competitor',
			'foreign_key' => 'competitor_b'
		),
		'a_time' => array(
			'model' => 'time',
			'foreign_key' => 'time_a'
		),
		'b_time' => array(
			'model' => 'time',
			'foreign_key' => 'time_b'
		),
		'round' => array(
			'model' => 'competition_round',
			'foreign_key' => 'competition_round_id'
		)
	);

} // End Competition Round Competitor