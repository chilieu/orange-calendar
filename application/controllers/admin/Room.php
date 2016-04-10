<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Room extends Admin_Controller
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

        $this->viewData['_body'] = $this->load->view( $this->APP . '/room', array('rooms' => $rooms), true);
        $this->render( $this->layout );
    }


    public function addRoom() {
    	$this->load->model('Room_model');
		$this->load->library('form_validation');

		$room = $this->input->post('room');

		$this->form_validation->set_rules('room[room]', 'Room', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
            return $this->ajaxResponse(1, $error);
        }

        $id = $this->Room_model->insert($room);
		return $this->ajaxResponse(0,"Success");

    }

    public function deleteRoom() {
    	$this->load->model('Room_model');

    	$id = $this->input->post('id');

        $id = $this->Room_model->delete($id);
		return $this->ajaxResponse(0,"Room has been deleted");

    }

    public function updateRoom() {
    	$this->load->model('Room_model');

    	$id = $this->input->post('id');

    	$data['room'] = $this->input->post('room');
    	$data['onsite'] = $this->input->post('onsite');

        $id = $this->Room_model->update($id, $data);
		return $this->ajaxResponse(0,"Room has been updated");

    }

    public function orderRoom() {
    	$this->load->model('Room_model');
    	$order = $this->input->post('order');
		$data = array();
		$appendix = 10;
		foreach($order as $key => $val){
		    //$data[$key]["id"] = $val;
		    //$data[$key]["order"] = ($key + 1) * $appendix;
		    //Use MySQL Query to update sorting field from here
			$this->Room_model->update($val, array("order" =>  ($key + 1) * $appendix ));
		}
    	return $this->ajaxResponse(0,"Sorting succeed");
    }

}