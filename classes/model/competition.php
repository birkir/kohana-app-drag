<?php defined('SYSPATH') or die('No direct script access.');

class Model_Competition extends ORM {

	protected $_has_many = array(
		'rounds' => array(
			'model' => 'competition_round'
		),
		'classes' => array(
			'model' => 'competition_class'
		)
	);

}
