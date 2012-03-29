<?php defined('SYSPATH')or die('No direct script access.');

/**
 * Competition/Round/Competitor model
 * 
 * @package     Drag
 * @category    Model
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Model_Competition_Round_Competitor extends ORM {

	/**
	 * Belongs to relationships
	 */
	protected $_belongs_to = array(
		'class' => array(
			'model' => 'competition_class'
		)
	);

	protected $_has_many = array(
		'times' => array(
			'model' => 'time',
			'foreign_key' => 'competitor_id',
			'far_key' => 'id'
		)
	);
}