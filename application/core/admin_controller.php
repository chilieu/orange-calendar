<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_Controller extends Global_Controller
{
	protected $APP = 'admin';
	public function __construct($theme=null)
	{
		if (empty($theme)) {
			$theme = 'admin';
		}
		parent::__construct($theme);

        //check if admin is logged in
        $administrator = $this->session->userdata('administrator');
        if( $administrator['logged_in'] != TRUE ) {
            $this->load->helper('url');
            redirect('/administrator-login/', 'refresh');
        }

	}
}