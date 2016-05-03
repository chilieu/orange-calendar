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


    public function deleteEventDate() {
        $id = $this->input->post('id');
        $this->load->model('Event_date_model');
        $this->Event_date_model->delete($id);
        return $this->ajaxResponse(0, "Event has been updated.");
    }

    public function addEventDate() {
        $data = $this->input->post();
        $this->load->model('Event_date_model');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('date', 'date', 'trim|required');
        $this->form_validation->set_rules('start', 'start time', 'trim|required');
        $this->form_validation->set_rules('end', 'end time', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
            return $this->ajaxResponse(1, $error);
        }

        $time_start = $data['date'] . " " . $data['start'];
        $time_end = $data['date'] . " " . $data['end'];

        $time_start = strtotime($time_start);
        $time_start = date("Y-m-d H:i:s", $time_start);

        $time_end = strtotime($time_end);
        $time_end = date("Y-m-d H:i:s", $time_end);


        //TODO: check if room availabloe here!
        $available = $this->Event_date_model->checkAvailable($data['room_id'], $time_start, $time_end);
        $approval = 'approved';

        if( count($available['start']) || count($available['end']) || count($available['current_between'])  ){
            $temp = array_merge($available['start'], $available['end'], $available['current_between']);
            $unique_arr = array_filter($temp);
            $unique_arr = array_unique($unique_arr);
            $text = "";
            foreach($unique_arr as $key => $val){
                $e = $this->Event_model->getById($val['event_id']);
                $e = $e->result_array()[0];
                $text .= $e['event'] . "<br>";
            }

            return $this->ajaxResponse(1, "Changing date is conflicted with another event(s):<br>{$text}", $unique_arr);
        }


        $event_date = array();
        $event_date['event_id']     = $data['event_id'];
        $event_date['room_id']      = $data['room_id'];
        $event_date['date_from']    = $time_start;
        $event_date['date_to']      = $time_end;
        $event_date['approval']      = $approval;
        $event_date_id = $this->Event_date_model->insert($event_date);

        return $this->ajaxResponse(0, "New date has been added.", $data);
    }

    public function updateEventDate() {
        $data = $this->input->post();
        $this->load->model('Event_date_model');
        $this->load->model('Event_model');

        $time_start = strtotime($data['date'] ." ". $data['start']);
        $time_start = date("Y-m-d H:i:s", $time_start);

        $time_end = strtotime($data['date'] ." ". $data['end']);
        $time_end = date("Y-m-d H:i:s", $time_end);

        $available = $this->Event_date_model->checkAvailable($data['room'], $time_start, $time_end, $data['id']);

        if( count($available['start']) || count($available['end']) || count($available['current_between'])  ){
            $temp = array_merge($available['start'], $available['end'], $available['current_between']);
            $unique_arr = array_filter($temp);
            $unique_arr = array_unique($unique_arr);
            $text = "";
            foreach($unique_arr as $key => $val){
                $e = $this->Event_model->getById($val['event_id']);
                $e = $e->result_array()[0];
                $text .= $e['event'] . "<br>";
            }

            return $this->ajaxResponse(1, "Changing date is conflicted with another event(s):<br>{$text}", $unique_arr);
        }

        $d['event_id'] = $data['event_id'];
        $d['room_id'] = $data['room'];
        $d['date_from'] = $time_start;
        $d['date_to'] = $time_end;
        $d['approval'] = 'approved';
        $this->Event_date_model->update($data['id'], $d);

        return $this->ajaxResponse(0, "Event has been updated.");
    }

    public function updateEvent() {
        $data = $this->input->post();

        if( empty($data['event']) )
            return $this->ajaxResponse(1, "Please enter event.");
        /*
        if( empty($data['description']) )
            return $this->ajaxResponse(1, "Please enter event description.");*/

        $d['event'] = $data['event'];
        $d['description'] = $data['description'];

        $this->load->model('Event_model');
        $this->Event_model->update($data['id'], $d);
        return $this->ajaxResponse(0, "Your event has been updated");
    }

}