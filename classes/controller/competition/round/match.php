<?php defined('SYSPATH')or die('No direct script access.');

class Controller_Competition_Round_Match extends Controller_Template {

	public $competition,
	       $round,
	       $match;

	public function before()
	{
		parent::before();

		$this->competition = ORM::factory('competition', array(
			'slug' => $this->request->param('competition')
		));

		$this->round = $this->competition->rounds
		->where('id', '=', $this->request->param('round'))
		->find();

		// assign menu to template
		$this->template->navigation = Request::factory('competition/get/navigation')
		->query('title', $this->competition->name)
		->execute();

		// navigation title
		$this->template->navigation .= Request::factory('competition/get/round/get/navigation')
		->query('title', $this->round->name)
		->query('current', 'matches')
		->execute();

		$this->title = $this->competition->name . ' ' . date('Y', strtotime($this->round->datetime)).': '.$this->round->name;
	}

	public function action_list()
	{
		$list = View::factory('competition/round/match/list')
		->set('items', $this->round->matches->find_all());

		$this->template->content = array(
			'<h1>'.$this->title.'</h1>',
			$list
		);
	}

}
