<?php defined('SYSPATH') or die('No direct script access.');

class Model_Competition_Round extends ORM {

	protected $_belongs_to = array(
		'competition' => array(),
		'track' => array()
	);

	protected $_has_many = array(
		'competitors' => array(
			'model' => 'competition_round_competitor'
		),
		'matches' => array(
			'model' => 'competition_round_match',
			'foreign_key' => 'competition_round_id'
		)
	);

} // End Competition Round