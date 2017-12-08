<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin {

    var $CI;

    public function __construct($params = array())

    {

        $this->CI =& get_instance();

        $this->CI->load->helper('string');

		$this->CI->load->helper('admin');

        $this->CI->load->database();

    }

    

    public function is_login(){

      $session = false; 

      if($this->CI->session->userdata()){

         $session = $this->CI->session->userdata('is_login');        

      } 

      return $session ? true : false;

    }

   

}   