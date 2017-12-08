<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Profile_model extends CI_Model

{

    public function check_admin_password($user_id,$old_password){

        $this->db->select('* ');

        $this->db->from('hb_users');

        $this->db->where('user_id',$user_id);

        $this->db->where('password',$old_password);

        $query=$this->db->get();

        return $query->num_rows() > 0 ? true : false;

    }



    public function change_admin_password($user_id,$new_password){

        $this->db->where('user_id',$user_id);  

        $query=$this->db->update('hb_users',array('password'=>$new_password)); 

        return ($query) ? true : false;

    }



    public function getDataWhere($table,$where,$select){

        $this->db->select($select);

        $this->db->from($table);

        $this->db->where($where);

        $query=$this->db->get();

        return $query->num_rows() === 1 ? $query->row_array() : false;

    }



    public function updateData($table,$data,$where){

        $this->db->where($where);

        $query=$this->db->update($table,$data);

        return $query ? true : false;

    }





}     



