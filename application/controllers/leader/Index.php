<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Leader_Controller
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
        $rooms = $this->Room_model->getAllOnSite();
        $offsite_rooms = $this->Room_model->getAllOffSite();
        $this->viewData['_body'] = $this->load->view( $this->APP . '/index', array('rooms' => $rooms, 'offsite_rooms' => $offsite_rooms), true);
        $this->render( $this->layout );

    }

    public function contactAdmin()
    {

        $this->viewData['_body'] = $this->load->view( $this->APP . '/contact-admin', array(), true);
        $this->render( $this->layout );

    }

    public function profile()
    {
        $this->load->model('Area_model');
        $areas = array();
        $areas = $this->Area_model->getAll();

        $session_leader = $this->session->userdata('leader');
        $id = $session_leader['leader_id'];

        $this->load->model('Leader_model');
        $leader = $this->Leader_model->getById( $id )->result_array();
        $leader = $leader[0];
        $leader['area'] = explode( ",", $leader['area'] );

        $this->viewData['_body'] = $this->load->view( $this->APP . '/profile', array("areas" =>$areas, "leader" => $leader ), true);
        $this->render( $this->layout );

    }


    public function editProfile()
    {
        $leader = $this->input->post('leader');
        $this->load->model('Leader_model');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('leader[firstname]', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('leader[lastname]', 'Lastname', 'trim|required');
        //$this->form_validation->set_rules('leader[area]', 'Areas', 'trim|required');
        $this->form_validation->set_rules('leader[phone]', 'Phone', 'trim|min_length[9]|max_length[15]');
        $this->form_validation->set_rules('password_confirm', 'password confirmation', 'trim');

        $old_leader = $this->Leader_model->getById( $leader['id'] )->result_array();
        $old_leader = $old_leader[0];

        if( $old_leader['email'] !== $leader['email'] ) {
            $this->form_validation->set_rules('leader[email]', 'Email', 'trim|required|valid_email|is_unique[leader.email]');
        }
        $this->form_validation->set_rules('leader[password]', 'Password', 'trim|matches[password_confirm]');

        if ($this->form_validation->run() == FALSE)
        {
            //fail
            //$error = $this->form_validation->error_array();
            $error = validation_errors();
            return $this->ajaxResponse(1, $error);

        } else {
            //success
            if( isset($leader['area']) && is_array($leader['area']) ) $leader['area'] = implode(",", $leader['area']);

            if( empty($leader['password']) ) unset( $leader['password'] );

            if(isset($leader['id'])) {
                $res = $this->Leader_model->update($leader['id'], $leader);
            } else {
                $res = $this->Leader_model->insert($leader);
            }

            return $this->ajaxResponse(0,"Success");
        }

    }

    public function postReserve() {

        $this->load->model('Event_model');
        $this->load->model('Event_date_model');

        //$test = $this->Event_date_model->checkAvailable(34, '2016-01-04 21:35:00', '2016-01-04 23:35:00');
        //return $this->ajaxResponse(0, print_r($test, true));

        $session_leader = $this->session->userdata('leader');
        $leader_id = $session_leader['leader_id'];
        $this->load->library('form_validation');

        $schedule = $this->input->post('schedule');
        $reserve = $this->input->post('reserve');
        $this->form_validation->set_rules('reserve[event]', 'Event', 'trim|min_length[8]|required');

        if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
            return $this->ajaxResponse(1, $error);
        }

        switch( $schedule ) {
            case 1://one time only
                $start = $reserve['onetime-start'];
                $end = $reserve['onetime-end'];

                $days = array(
                            array("start" => $start, 'end' => $end)
                    );
                break;

            case 2://every week
                $weekday = $reserve['everyweek-on'];
                $days = Util\weekdayOnEveryWeek($weekday);
                break;

            case 3://once every 2 weeks
                $weekday = $reserve['every2weeks-on'];
                $days = Util\weekdayOnEvery2Weeks($weekday);
                break;

            case 4://once month
                $weekday = $reserve['everymonth-on'];
                $days = Util\dayOnEveryMonth($weekday);
                break;

            default:
                return $this->ajaxResponse(1, "Please select time range");
                break;
        }

        $event = array();
        $event['event']     = $reserve['event'];
        $event['notes']     = $reserve['notes'];
        $event['leader_id'] = $leader_id;
        $event_id = $this->Event_model->insert($event);

        $reserve["time-start"] = !empty( $reserve["time-start"] ) ? $reserve["time-start"] : date("g:i a");
        $reserve["time-end"] = !empty( $reserve["time-end"] ) ? $reserve["time-end"] : date("g:i a");

        $test = array();
        foreach($days as $k => $d) {

            if( $schedule == 1 ) {
                $time_start = $d['start'];
                $time_end = $d['end'];
            } else {
                $time_start = $d ." ". $reserve["time-start"];
                $time_end = $d ." ". $reserve["time-end"];
            }

            $time_start = strtotime($time_start);
            $time_start = date("Y-m-d H:i:s", $time_start);

            $time_end = strtotime($time_end);
            $time_end = date("Y-m-d H:i:s", $time_end);


            $test[] = array("start" => $time_start, "end" => $time_end);
            //TODO: check if room availabloe here!
            $available = $this->Event_date_model->checkAvailable($reserve['room_id'], $time_start, $time_end);
            $approval = 'approved';
            if( count($available['start']) || count($available['end']) || count($available['current_between'])  ) $approval = 'rejected';

            $event_date = array();
            $event_date['event_id']     = $event_id;
            $event_date['room_id']      = $reserve['room_id'];
            $event_date['date_from']    = $time_start;
            $event_date['date_to']      = $time_end;
            $event_date['approval']      = $approval;
            $event_date_id = $this->Event_date_model->insert($event_date);
        }

        //return $this->ajaxResponse(0, "Your event has been marked, we will contact you shortly.");
        return $this->ajaxResponse(0, print_r($test, true));
    }


}