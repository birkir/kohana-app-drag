<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Competition model
 * 
 * @package     Drag
 * @category    Model
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Model_Competition extends ORM {

	/**
	 * Has many relationships
	 */
	protected $_has_many = array(
		'rounds' => array(
			'model' => 'competition_round'
		),
		'classes' => array(
			'model' => 'competition_class'
		)
	);
}