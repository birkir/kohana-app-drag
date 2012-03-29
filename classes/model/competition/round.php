<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Competition/Round model
 * 
 * @package     Drag
 * @category    Model
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Model_Competition_Round extends ORM {

	/**
	 * Has many relationships
	 */
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

	/**
	 * Belongs to relationships
	 */
	protected $_belongs_to = array(
		'track' => array()
	);
}