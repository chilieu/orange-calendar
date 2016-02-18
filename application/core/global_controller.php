<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Global Controler
*
*/

class Global_Controller extends CI_Controller
{

	protected $viewData = array(
		'_pageTitle' => null,
		'_metaKeywords' => null,
		'_metaDescription' => null,
		'_jsArr' => array(),
		'_cssArr' => array()
	);

	protected $_theme;
	protected $_uri;
	protected $_uriArr;
	protected $_assetsVersion = '9';

	public function __construct($theme)
	{
		parent::__construct();

		if ($this->input->get('ciProfile')) {
			$this->output->enable_profiler(TRUE);
		}

		$this->_theme = $theme;

		$this->load->helper('Util');

		$this->_uri = strtolower(strtok($_SERVER['REQUEST_URI'], '?'));
		$this->_uriArr = explode('/', trim($this->_uri, '/'));

	}

	protected function render($layout, $dataArr=array(), $returnData=false)
	{
		if (is_array($dataArr) && count($dataArr) > 0) {
			$this->viewData = array_merge($this->viewData, $dataArr);
		}
		if ($returnData) {
			ob_start();
			$this->loadLayout($layout);
			return ob_get_clean();
		} else {
			$this->loadLayout($layout);
		}
	}

	private function loadLayout($layout)
	{
		$this->load->view($this->_theme . DS . $layout . EXT, $this->viewData);
	}

	public function addJS($jsSrc)
	{
		$this->viewData['_jsArr'][] = $this->config->item('base_url') . $jsSrc . '?v=' . $this->_assetsVersion;
	}

	public function addCSS($cssSrc)
	{
		$this->viewData['_cssArr'][] = $this->config->item('base_url') . $cssSrc . '?v=' . $this->_assetsVersion;
	}

	protected function ajaxResponse($statusId, $message=null, $dataArr=array())
	{
		echo json_encode(array(
			'status' => $statusId,
			'message' => $message,
			'data' => $dataArr
		));
	}

}