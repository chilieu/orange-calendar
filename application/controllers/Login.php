<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends Login_Controller
{
    private $layout;
    public function __construct()
    {
        parent::__construct();
        $this->layout = 'layout';
    }

    public function index()
    {

        //$this->viewData['_body'] = $this->load->view( $this->APP . '/index', array(), true);
        //$this->render( $this->layout );

    }

    public function leader()
    {

        $this->viewData['_body'] = $this->load->view( $this->APP . '/leader', array(), true);
        $this->render( $this->layout );

    }

    public function leaderLogin()
    {
        $login = $this->input->post("login");

        if( $login['username'] == "@dmin" && $login['password'] == "2130NGrandAve" ) {
            return $this->ajaxResponse(0,"Success");
        } else {
            return $this->ajaxResponse(1,"Login fails", $login);
        }
    }

    public function admin()
    {
        $this->viewData['_body'] = $this->load->view( $this->APP . '/admin', array(), true);
        $this->render( $this->layout );
    }

    public function adminLogin()
    {
        $login = $this->input->post("login");

        if( $login['username'] == "@dmin" && $login['password'] == "2130NGrandAve" ) {
            $administrator = array('logged_in' => TRUE);
            $this->session->set_userdata('administrator', $administrator);
            return $this->ajaxResponse(0,"Success");
        } else {
            return $this->ajaxResponse(1,"Login fails", $login);
        }
    }


    public function adminLogout()
    {
        $this->session->unset_userdata('administrator');
        $this->load->helper('url');
        redirect('/administrator-login/', 'refresh');
    }

}