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

    public function admin()
    {

        $this->viewData['_body'] = $this->load->view( $this->APP . '/admin', array(), true);
        $this->render( $this->layout );

    }

}