<?php defined('SYSPATH')or die('No direct script access.');

/**
 * Time model
 * 
 * @package     Drag
 * @category    Model
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Model_Time extends ORM {

	/**
	 * Belongs to relationships
	 */
	protected $_belongs_to = array(
		'track' => array()
	);

	/**
	 * Has one relationships
	 */
	protected $_has_one = array(
		'competitor' => array(
			'model' => 'competition_round_competitor',
			'foreign_key' => 'id',
			'far_key' => 'competitor_id'
		)
	);
}