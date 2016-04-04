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

        $this->viewData['_body'] = $this->load->view( $this->APP . '/index', array(), true);
        $this->render( $this->layout );

    }

    public function contactAdmin()
    {

        $this->viewData['_body'] = $this->load->view( $this->APP . '/contact-admin', array(), true);
        $this->render( $this->layout );

    }

    public function profile()
    {

        $this->viewData['_body'] = $this->load->view( $this->APP . '/profile', array(), true);
        $this->render( $this->layout );

    }


    public function editProfile()
    {


    }


}