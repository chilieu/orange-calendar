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
        $this->load->model('Room_model');
        $this->load->model('Event_model');
        $events = array();
        $events = $this->Event_model->getAll();

        $rooms = array();
        $rooms = $this->Room_model->getAllOnSite();

        $this->viewData['_body'] = $this->load->view( $this->APP . '/home/index', array('events' => $events, 'rooms' => $rooms), true);

		$this->render( 'layout-calendar' );
	}

	public function data()
	{
		exit;
        $this->load->library('csvreader');
		$this->load->model('Event_model');
		$this->load->model('Room_model');
		$this->load->model('Contact_model');

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
        		$event = array();
	        	//get contact id
	        	$data['contact_id'] = $this->Contact_model->insertIfNotExists( $contact );

	        	//get room id
	        	$data['room_id'] = $this->Room_model->insertIfNotExists( $room );

        		$value['DATE'] = $value['DATE'] ." ". strtolower($month) . " noon";
        		$d = strtotime($value['DATE']);
        		echo $value['DATE'] . "<br>";
        		echo $d . "<br>";

        		$value['DATETIME'] = date("F j, Y", $d);

        		$time = explode("-", $value['TIME']);
        		//print_r($time);
        		if( is_array($time) && count($time) > 1 ) {
    	    		$tmp1 = strtotime($value['DATETIME'] ." ". trim($time[0]) );
	        		$tmp2 = strtotime($value['DATETIME'] ." ". trim($time[1]) );
        		} else {
        			$tmp1 = $tmp2 = $d;
        			$event['notes'] = $value['TIME'];
        		}

        		$event['event'] = $value['EVENTS'];
        		$event['date'] = $d;
        		$event['time_from'] = $tmp1;
        		$event['time_to'] = $tmp2;
        		$event['room_id'] = $data['room_id'];
        		$event['contact_id'] = $data['contact_id'];
        		//$this->Event_model->insert($event);
        		//print_r($value);
        		//print_r($event);

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
