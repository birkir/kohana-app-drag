<?php defined('SYSPATH') or die('No direct script access.');

class Model_Activity extends ORM {

	protected $_belongs_to = array(
		'user' => array(
			'foreign_key' => 'user_id',
		),
		'ref_user' => array(
			'foreign_key' => 'ref_user_id',
		)
	);

} // End Car