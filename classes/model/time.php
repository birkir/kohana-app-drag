<?php defined('SYSPATH')or die('No direct script access.');

class Model_Time extends ORM {

	protected $_belongs_to = array(
		'track' => array()
	);

	protected $_has_one = array(
		'competitor' => array(
			'model' => 'competition_round_competitor',
			'foreign_key' => 'id',
			'far_key' => 'competitor_id'
		)
	);

}
