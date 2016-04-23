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
        $this->load->model('Event_date_model');

        $rooms = array();
        $rooms = $this->Room_model->getAll();

        $events = $this->Event_date_model->getAllApproved();

        $this->viewData['_body'] = $this->load->view( $this->APP . '/index', array('rooms' => $rooms, 'events' => $events), true);
        $this->render( $this->layout );

	}


	public function table()
	{

        $this->load->model('Event_model');
        $events = $this->Event_model->getAll();

        $this->viewData['_body'] = $this->load->view( $this->APP . '/table', array('events' => $events), true);
        $this->render( $this->layout );

	}

    public function eventDetail($id)
    {
        $this->load->model('Room_model');
        $rooms = $this->Room_model->getAllOnSite();
        $offsite_rooms = $this->Room_model->getAllOffSite();

        $this->load->model('Event_model');
        $event = $this->Event_model->getById($id);

        $this->load->model('Event_date_model');
        $event_date = $this->Event_date_model->getAllByEventID($id);

        $this->viewData['_body'] = $this->load->view( $this->APP . '/event-detail', array( 'offsite_rooms' => $offsite_rooms, "rooms" => $rooms, "event" => $event, 'event_date' => $event_date), true);
        $this->render( $this->layout );

    }

}