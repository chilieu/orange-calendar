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
        $rooms = $this->Room_model->getAll();
        $this->viewData['_body'] = $this->load->view( $this->APP . '/index', array('rooms' => $rooms), true);
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

        $session_leader = $this->session->userdata('leader');
        $leader_id = $session_leader['leader_id'];

        $schedule = $this->input->post('schedule');
        $reserve = $this->input->post('reserve');

        switch( $schedule ) {
            case 1://one time only
                $start = $reserve['onetime-start'];
                $end = $reserve['onetime-end'];
                $start = Util\convert2Timestamp( $reserve['onetime-start'] );
                $end = Util\convert2Timestamp( $reserve['onetime-end'] );
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

        $this->load->model('Event_model');
        $event_id = $this->Event_model->insert($event);

        $event_date = array();
        $event_date['event_id']     = $event_id;
        $event_date['room_id']      = $reserve['room_id'];
        $event_date['date_from']    = $date_from;
        $event_date['date_to']      = $date_to;

        return $this->ajaxResponse(0, "Success" . print_r($days, true));
    }


}