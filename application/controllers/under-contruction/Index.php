<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Front_Controller
{
	private $layout;
	public function __construct()
	{
		parent::__construct();
		$this->layout = 'under-contruction';
	}
	public function index()
	{
		$this->render( $this->layout );
	}


	public function sub()
	{
		$name = $_POST['name'];
		$email = $_POST['email'];

		// Enter the email where you want to receive the notification when someone submit form
		$recipient = "chi.lieu@cloudberrysoft.com, quan.luu@cloudberrysoft.com, binlieu777@yahoo.com";
		$subject = "See Soon! Contact Form";
		$formcontent="Name: $name\n\nEmail: $email\n";

		$this->load->helper('email');
		$success = send_email($recipient, $subject, $formcontent);

		if ($success == true){
			echo 	'<script language="javascript" type="text/javascript">
						alert(\'Thank you for you e-mail. We will contact you shortly.\');
						window.location = "/";
					</script>';
		} else {
			echo 	'<script language="javascript" type="text/javascript">
						alert(\'Message not sent.\');
						window.location = "/";
    				</script>';
		}
		exit();
	}

}
