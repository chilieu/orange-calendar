<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Admin_Controller
{
	private $layout;
	public function __construct()
	{
		parent::__construct();
		$this->layout = 'layout';
	}

	public function index()
	{
		$this->load->model('Event_model');
		$events = array();
		$events = $this->Event_model->getAll();

		$this->viewData['_body'] = $this->load->view( $this->APP . '/index', array('events' => $events), true);
		$this->render( 'layout-calendar' );
	}


}