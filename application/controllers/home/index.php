<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends Front_Controller
{
	private $layout;
	public function __construct()
	{
		parent::__construct();
		$this->layout = 'layout';
	}

	public function index()
	{
		$this->render( $this->layout );
	}

	public function data()
	{
        $this->load->library('csvreader');
		$this->load->model('Events_model');
		$this->load->model('Rooms_model');
		$this->load->model('Contacts_model');

        $result = $this->csvreader->parse_file('./public/Test2016VACMasterCalendar.csv');//path to csv file

        //echo ">>>> " . strtotime('Fri 1 Jan, 2016');
        //echo date('F', strtotime('Fri 1 2016'));

        echo "<pre>";
        foreach ($result as $key => $value) {
			//print_r($value);

        	//$month = "jan, 2016";
        	$value['MONTH'] = trim($value['MONTH']);
        	//echo " ----{$value['MONTH']}-----<br>";
        	if( $value['MONTH'] != "" ){

        		$tmp = strtolower( trim($value['MONTH']) );
        		switch ($tmp) {
        			case 'off-site':
        				# code...
        				break;
        			case 'on-site':
        				# code...
        				break;

        			default:
        				# code...
        			//str_replace(search, replace, subject)
        				$month = str_replace(".", ", ", $value['MONTH']);
        				break;
        		}
        		//echo "----";print_r($month);echo "<br>";
        	}


        	$contact['name'] = trim($value['Contact']);
	       	$room['room'] = trim($value['PLACE / Room(s) use']);

        	if(  empty($value['EVENTS']) ) continue;
        	//print_r($month);echo "<br>";
        	if( !empty($value['DATE']) && !empty($value['EVENTS']) ){
	        	//get contact id
	        	$data['contact_id'] = $this->Contacts_model->insertIfNotExists( $contact );

	        	//get room id
	        	$data['room_id'] = $this->Rooms_model->insertIfNotExists( $room );

        		$value['DATE'] = $value['DATE'] ." ". strtolower($month);
        		$d = strtotime($value['DATE']);

        		$value['DATETIME'] = date("F j, Y", $d);
        		$event = array();
        		$event['event'] = $value['EVENTS'];
        		$event['date'] = $d;
        		$event['time_from'] = $d;
        		$event['time_to'] = $d;
        		$event['room_id'] = $data['room_id'];
        		$event['contact_id'] = $data['contact_id'];
        		//$this->Events_model->insert($event);
        		print_r($value);
        		print_r($event);

        	}

        }
        echo "</pre>";
        //$this->load->view('view_csv', $data);

		//$this->render( $this->layout );
	}


	public function sub()
	{

	}

}
