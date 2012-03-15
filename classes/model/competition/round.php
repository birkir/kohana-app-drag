<?php defined('SYSPATH') or die('No direct script access.');

class Model_Competition_Round extends ORM {

	protected $_has_many = array(
		'matches' => array(
			'model' => 'competition_round_match',
			'foreign_key' => 'round_id'
		),
		'times' => array(
			'model' => 'time',
			'foreign_key' => 'round_id'
		),
		'competitors' => array(
			'model' => 'competition_round_competitor',
			'foreign_key' => 'round_id'
		)
	);

	protected $_belongs_to = array(
		'track' => array()
	);

}
