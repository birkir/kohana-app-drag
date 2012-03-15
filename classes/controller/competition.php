<?php defined('SYSPATH') or die('No direct file access.');

/**
 * Competition class and functions.
 * 
 * @package     Drag
 * @category    Controller
 * @author      Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright   (c) 2012 SOLID
 */
class Controller_Competition extends Controller_Template {

	public $competition;

	public function before()
	{
		parent::before();

		if ($this->request->is_initial())
		{
			$initial = Request::initial();

			// get current competition
			$this->competition = ORM::factory('competition')
			->where('slug', '=', $initial->param('competition'))
			->find();

			if ($initial->action() != 'list')
			{
				// assign menu to template
				$this->template->navigation = Request::factory('competition/'.$initial->param('competition').'/navigation')
				->query('title', $this->competition->name)
				->query('current', $initial->action())
				->execute();
			}
		}
	}

	public function action_navigation()
	{
		// check if request is not initial
		if ( ! $this->request->is_initial())
		{
			// get initial request
			$initial = Request::initial();

			// build base url
			$baseurl = '/competition/'.$initial->param('competition');

			// menu items
			$menu = array(
				'details' => array(
					'title'   => 'Details',
					'url'     => $baseurl
				),
				'classes' => array(
					'title'   => 'Classes',
					'url'     => $baseurl.'/classes'
				),
				'rounds' => array(
					'title'   => 'Rounds',
					'url'     => $baseurl.'/rounds'
				)
			);

			// set current menu item
			if (isset($menu[$this->request->query('current')]))
			{
				$menu[$this->request->query('current')]['current'] = TRUE;
			}
			// assign template variables
			$this->template = View::factory('misc/navigation')
			->set('title', $this->request->query('title'))
			->set('items', $menu);
		}
	}

	public function action_list()
	{
		// find all competitions
		$this->template->content = View::factory('competition/list')
		->set('items', ORM::factory('competition')->find_all());
	}

	public function action_details()
	{
		// get rounds
		$rounds = View::factory('competition/round/list')
		->set('items', $this->competition->rounds->order_by('datetime', 'ASC')->find_all());

		// get classes
		$classes = View::factory('competition/class/list')
		->set('items', $this->competition->classes->order_by('name', 'ASC')->find_all());

		// set the content
		$this->template->content = array(
			'<h1>'.$this->competition->name.'</h1>',
			Utilities::grid($rounds, $classes)
		);
	}

	public function action_create()
	{
	}

	public function action_update()
	{
	}

	public function action_delete()
	{
	}

	public function action_rounds()
	{
		$this->template->content = array(
			'<h1>'.$this->competition->name.'</h1>',
			View::factory('competition/round/list')
			->set('detailed', TRUE)
			->set('items', $this->competition->rounds->order_by('datetime', 'ASC')->find_all())
		);
	}

	public function action_classes()
	{
		$this->template->content = array(
			'<h1>'.$this->competition->name.'</h1>',
			View::factory('competition/class/list')
			->set('detailed', TRUE)
			->set('items', $this->competition->classes->order_by('name', 'ASC')->find_all())
		);
	}

}
