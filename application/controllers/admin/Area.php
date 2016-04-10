<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Area extends Admin_Controller
{
    private $layout;
    public function __construct()
    {
        parent::__construct();
        $this->layout = 'layout';
    }

    public function index()
    {
		$this->load->model('Area_model');
		$area = $this->Area_model->getAll();

        $this->viewData['_body'] = $this->load->view( $this->APP . '/area', array('area' => $area), true);
        $this->render( $this->layout );
    }

    public function addArea() {
    	$this->load->model('Area_model');
		$this->load->library('form_validation');

		$area = $this->input->post('area');

		$this->form_validation->set_rules('area[title]', 'Title', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
            return $this->ajaxResponse(1, $error);
        }

        $id = $this->Area_model->insert($area);
		return $this->ajaxResponse(0,"Success");

    }

    public function deleteArea() {
    	$this->load->model('Area_model');

    	$id = $this->input->post('id');

        $id = $this->Area_model->delete($id);
		return $this->ajaxResponse(0,"Title has been deleted");

    }

    public function updateArea() {
    	$this->load->model('Area_model');

    	$id = $this->input->post('id');

    	$data['title'] = $this->input->post('title');

        $id = $this->Area_model->update($id, $data);
		return $this->ajaxResponse(0,"Title has been updated");

    }

}