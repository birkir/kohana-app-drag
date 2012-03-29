<?php defined('SYSPATH')or die('No direct script access.');

/**
 * Competition/Round/Match model
 * 
 * @package     Drag
 * @category    Model
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Model_Competition_Round_Match extends ORM {

	/**
	 * Belongs to relationships
	 */
	protected $_belongs_to = array(
		'round' => array(
			'model' => 'competition_round'
		)
	);

	/**
	 * Has many relationships
	 */
	protected $_has_many = array(
		'times' => array(
			'model' => 'time',
			'foreign_key' => 'match_id',
			'far_key' => 'id'
		)
	);
}