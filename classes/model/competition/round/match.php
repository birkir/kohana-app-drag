<?php defined('SYSPATH')or die('No direct script access.');

class Model_Competition_Round_Match extends ORM {

	protected $_belongs_to = array(
		'round' => array(
			'model' => 'competition_round'
		)
	);

	protected $_has_many = array(
		'times' => array(
			'model' => 'time',
			'foreign_key' => 'match_id',
			'far_key' => 'id'
		)
	);

}
