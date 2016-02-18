<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Front_Controller extends Global_Controller
{
	protected $APP = 'front';
	public function __construct($theme=null)
	{
		if (empty($theme)) {
			$theme = 'front';
		}
		parent::__construct($theme);
	}
}