<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('randomString')){
    function randomString(){ 
       return random_string('md5', 16);
    }
}

