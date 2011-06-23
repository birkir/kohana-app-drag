<?php defined('SYSPATH') or die('No direct script access.');

class Model_Competition_Round_Competitor extends ORM {

	protected $_belongs_to = array(
		'class' => array(
			'model' => 'competition_Class',
			'foreign_key' => 'competition_class_id'
		),
		'round' => array(
			'model' => 'competition_Round',
			'foreign_key' => 'competition_round_id'
		),
		'user' => array(
			'model' => 'user',
			'foreign_key' => 'user_id'
		),
		'car' => array(
			'model' => 'car',
			'foreign_key' => 'car_id'
		)
	);

} // End Competition Round Competitor