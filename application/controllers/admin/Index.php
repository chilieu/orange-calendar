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
		$this->load->model('Room_model');
		$this->load->model('Event_model');
		$events = array();
		$events = $this->Event_model->getAll();

		$rooms = array();
		$rooms = $this->Room_model->getAll();

		$this->viewData['_body'] = $this->load->view( $this->APP . '/index', array('events' => $events, 'rooms' => $rooms), true);
		$this->render( 'layout-calendar' );
	}


	public function table()
	{

		$this->load->model('Event_model');
		$events = array();
		$events = $this->Event_model->getAll();

		$this->viewData['_body'] = $this->load->view( $this->APP . '/table', array('events' => $events), true);
		$this->render( 'layout' );
	}

}