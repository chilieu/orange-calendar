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
	}
}