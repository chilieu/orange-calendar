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
        $this->load->library('csvreader');

        $result = $this->csvreader->parse_file('./public/Test2016VACMasterCalendar.csv');//path to csv file

        //echo ">>>> " . strtotime('Fri 1 Jan, 2016');
        //echo date('F', strtotime('Fri 1 2016'));

        echo "<pre>";
        foreach ($result as $key => $value) {


        	if( $value['MONTH'] == 'JAN.2016' ) $tmp = " Jan, 2016";
        	if( $value['MONTH'] == 'FEB.2016' ) $tmp = " Feb, 2016";

        	if(  empty($value['EVENTS']) ) continue;

        	if( !empty($value['DATE']) && empty($value['MONTH']) ){
        		$value['DATE'] = $value['DATE'] . $tmp;
        		$d = strtotime($value['DATE']);
        		$value['DATETIME'] = date("F j, Y", $d);
        	}

        	print_r($value);
        }
        echo "</pre>";
        //$this->load->view('view_csv', $data);

		//$this->render( $this->layout );
	}


	public function sub()
	{

	}

}
