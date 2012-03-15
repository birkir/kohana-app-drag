<?php defined('SYSPATH')or die('No direct script access.');

class Model_Competition_Round_Competitor extends ORM {

	protected $_belongs_to = array(
		'class' => array(
			'model' => 'competition_class'
		)
	);

}
