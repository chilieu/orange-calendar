<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_Controller extends Global_Controller
{
    protected $APP = 'login';
    public function __construct($theme=null)
    {
        if (empty($theme)) {
            $theme = 'login';
        }
        parent::__construct($theme);
    }
}