<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('allowed_action')){
   function allowed_action($id){
     $CI =& get_instance();
     $user_id = $CI->session->userdata('user_id');
     $allow_linked = $CI->db->select('*')->from('role_permissions')->where('role_id',$user_id)->order_by('module','asc')->get()->result_array();
      foreach($allow_linked as $module){
         if($module['module']== '*'){
            return $module;
         }
     }
     foreach($allow_linked as $module){
         if($module['module']== $id){
            return $module;
         }
     }
  } 
   
  function allowed_link(){
     $CI =& get_instance();
     $user_id = $CI->session->userdata('user_id');
    return $link_data=$CI->db->select('*')->from('role_permissions')->where('role_id',$user_id)->order_by('module','asc')->get()->result_array();
     // echo "<pre>";
     // print_r( $link_data);
     // die();
  }


}