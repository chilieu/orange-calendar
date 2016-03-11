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
    }
}