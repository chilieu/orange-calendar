<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leader extends Admin_Controller
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
        $areas = array();
        $areas = $this->Area_model->getAll();

        $this->load->model('Leader_model');
        $leaders = array();
        $leaders = $this->Leader_model->getAll();

        $this->viewData['_body'] = $this->load->view( $this->APP . '/leader', array('areas' => $areas, 'leaders' => $leaders), true);
        $this->render( $this->layout );
    }

    public function test()
    {
        echo "testset";
    }

    public function addLeader()
    {
        //$this->output->enable_profiler();
        $leader = $this->input->post('leader');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('leader[firstname]', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('leader[lastname]', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('leader[email]', 'Email', 'trim|required|valid_email|is_unique[leader.email]');

        if ($this->form_validation->run() == FALSE)
        {
            //fail
            //$error = $this->form_validation->error_array();
            $error = validation_errors();
            return $this->ajaxResponse(1, $error);
        } else {
            //success
            //print_r($leader);
            if( isset($leader['area']) && is_array($leader['area']) ) $leader['area'] = implode(",", $leader['area']);

            $this->load->model('Leader_model');
            $res = $this->Leader_model->insert($leader);

            return $this->ajaxResponse(0,"Success");
        }

    }


    public function getList()
    {
        date_default_timezone_set('America/Los_Angeles');
        $numRows = isset($_GET['iDisplayLength']) ? intval($_GET['iDisplayLength']) : 25;
        $offset = isset($_GET['iDisplayStart']) ? intval($_GET['iDisplayStart']) : 0;
        $sortCol = isset($_GET['iSortCol_0']) ? intval($_GET['iSortCol_0']) : false;
        $sortDir = isset($_GET['sSortDir_0']) && strtolower($_GET['sSortDir_0']) == 'desc' ? 'DESC' : 'ASC';
        $search = isset($_GET['sSearch']) && !empty($_GET['sSearch']) ? preg_replace("/[^a-zA-Z0-9 @]/", "", $_GET['sSearch']) : null;
        $this->db->select("*")->from('leader');
        if (!empty($search)) {
            $this->db->where("(firstname LIKE '$search%' OR lastname LIKE '$search%' OR phone LIKE '$search%' OR email LIKE '$search%')");
        }
        $totalRows = $this->db->count_all_results();
        $this->db->select("*")->from('leader');
        if (!empty($search)) {
            $this->db->where("(firstname LIKE '$search%' OR lastname LIKE '$search%' OR phone LIKE '$search%' OR email LIKE '$search%')");
        }
        if ($numRows != -1) {
            $this->db->limit($numRows, $offset);
        }
        $this->db->order_by('id DESC');
        $rows = $this->db->get()->result();
        $result = array();

        $action = '<a href="" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';

        foreach ($rows as $r) {
            $result[] = array(
                $r->id,
                $r->firstname . " " . $r->lastname,
                $r->email,
                $r->phone,
                $r->area,
                $action
            );
        }
        echo json_encode(array(
            'iTotalRecords' => $totalRows,
            'iTotalDisplayRecords' => $totalRows,
            'aaData' => $result
        ));
        return;
    }

}