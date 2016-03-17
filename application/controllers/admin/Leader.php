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

    public function reservation()
    {

        $this->viewData['_body'] = $this->load->view( $this->APP . '/reservation', array(), true);
        $this->render( $this->layout );
    }

    public function newLeader()
    {

        $this->load->model('Area_model');
        $areas = array();
        $areas = $this->Area_model->getAll();

        return $this->load->view('admin/partials/add-leader', array("areas" =>$areas));
    }

    public function detailLeader()
    {
        $id = $this->input->post('id');
        if( !$id ) return $this->ajaxResponse(1,"ID empty");

        $this->load->model('Area_model');
        $areas = array();
        $areas = $this->Area_model->getAll();

        $this->load->model('Leader_model');
        $leader = $this->Leader_model->getById($id)->result_array();
        $leader = $leader[0];
        $leader['area'] = explode( ",", $leader['area'] );
        return $this->load->view('admin/partials/add-leader', array("areas" =>$areas, "leader" => $leader ));
    }

    public function addLeader()
    {
        //$this->output->enable_profiler();
        $leader = $this->input->post('leader');
        $this->load->model('Leader_model');
        $this->load->library('form_validation');
        $this->load->library('hashids');

        $this->form_validation->set_rules('leader[firstname]', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('leader[lastname]', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('leader[area]', 'Areas', 'trim|required');
        $this->form_validation->set_rules('password_confirm', 'password confirmation', 'trim');

        if(isset($leader['id'])) {


            $old_leader = $this->Leader_model->getById( $leader['id'] )->result_array();
            $old_leader = $old_leader[0];

            if( $old_leader['email'] !== $leader['email'] ) {
                $this->form_validation->set_rules('leader[email]', 'Email', 'trim|required|valid_email|is_unique[leader.email]');
            }
            $this->form_validation->set_rules('leader[password]', 'Password', 'trim|matches[password_confirm]');

        } else {
            $this->form_validation->set_rules('leader[email]', 'Email', 'trim|required|valid_email|is_unique[leader.email]');
            $this->form_validation->set_rules('leader[password]', 'Password', 'trim|required|matches[password_confirm]');
        }

        if ($this->form_validation->run() == FALSE)
        {
            //fail
            //$error = $this->form_validation->error_array();
            $error = validation_errors();
            return $this->ajaxResponse(1, $error);
        } else {
            //success
            if( isset($leader['area']) && is_array($leader['area']) ) $leader['area'] = implode(",", $leader['area']);

            if(isset($leader['id'])) {
                $leader['password'] = $this->hashids->encrypt($leader['password']);
                $res = $this->Leader_model->update($leader['id'], $leader);
            } else {
                $leader['password'] = $this->hashids->encrypt($leader['password']);
                $res = $this->Leader_model->insert($leader);
            }

            return $this->ajaxResponse(0,"Success");
        }

    }

    /* this is hard delete */
    public function deleteLeader()
    {
        $id = $this->input->post('id');
        if( !$id ) return $this->ajaxResponse(1,"ID empty");
        $this->load->model('Leader_model');
        $res = $this->Leader_model->delete($id);

        if( !$res ) {
            return $this->ajaxResponse(1,"System error");
        } else {
            return $this->ajaxResponse(0,"the leader has been deleted");
        }
    }

    /* this is soft delete */
    public function banLeader()
    {
        $id = $this->input->post('id');
        if( !$id ) return $this->ajaxResponse(1,"ID empty");
        $this->load->model('Leader_model');
        $res = $this->Leader_model->softDelete($id);

        if( !$res ) {
            return $this->ajaxResponse(1,"System error");
        } else {
            return $this->ajaxResponse(0,"the leader has been banned");
        }
    }

    /* this is soft delete */
    public function unbanLeader()
    {
        $id = $this->input->post('id');
        if( !$id ) return $this->ajaxResponse(1,"ID empty");
        $this->load->model('Leader_model');
        $res = $this->Leader_model->unSoftDelete($id);

        if( !$res ) {
            return $this->ajaxResponse(1,"System error");
        } else {
            return $this->ajaxResponse(0,"the leader has been re-activated");
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

        foreach ($rows as $r) {
            $disable = ($r->deleted == 1) ? "disabled" : "";

            $edit = '&nbsp<a ' .$disable. ' href="#" class="btn btn-primary edit" data-id="' .$r->id. '" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>&nbsp';
            $ban = '&nbsp<a href="#" class="btn btn-warning ban" data-id="' .$r->id. '" ><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>&nbsp';
            $unban = '&nbsp<a href="#" class="btn btn-success unban" data-id="' .$r->id. '" ><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>&nbsp';
            $delete = '&nbsp<a href="#" class="btn btn-danger delete" data-id="' .$r->id. '" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>&nbsp';

            if($r->deleted == 1) {
                $action = $edit . $unban . $delete ;
            } else {
                $action = $edit . $ban . $delete ;
            }


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

    public function is_unique_email($email, $id=0)
    {

    }

}