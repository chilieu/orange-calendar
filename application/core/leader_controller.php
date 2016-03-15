<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leader_Controller extends Global_Controller
{
    protected $APP = 'leader';
    public function __construct($theme=null)
    {
        if (empty($theme)) {
            $theme = 'leader';
        }
        parent::__construct($theme);

        //check if admin is logged in
        $leader = $this->session->userdata('leader');
        if( $leader['logged_in'] != TRUE ) {
            $this->load->helper('url');
            redirect('/leader-login/', 'refresh');
        }

    }
}