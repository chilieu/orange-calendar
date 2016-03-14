<?php
class MY_Form_validation extends CI_Form_validation{
     function __construct($config = array()){
          parent::__construct($config);
     }

     function callback_is_unique_email($email, $id = 0){

     }
}