<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//print_r($this->db->last_query());



class Login_model extends CI_Model
{
    public function get($table){
     return $this->db->get($table)->result_array();
    }
    //working
    public function cheak_login($email_id,$password){
          $query = $this->db->select('email_id, user_id')
                        ->from('hb_users')
                        ->where('email_id',$email_id)
                        ->where('password',md5($password))
                        ->where('user_type','Admin')
                        ->get();

        return $query->num_rows() === 1 ? $query->row_array() : false;
    }


    public function checkToken($token){
        $query = $this->db->select('*')
                            ->where('token',$token)
                            ->limit(1)
                            ->get('hb_users');
        return $query->num_rows() === 1 ? $query->row_array() : false;
    }

    /*********************** Users *********************************************/



    public function cheak_user_login($email_id,$password){
            $query = $this->db->select('email_id, user_id,profile_pic')
                        ->from('hb_users')
                        ->where('email_id',$email_id)
                        ->where('password',md5($password))
                        ->where('user_type','User')
                        ->get();

        return $query->num_rows() === 1 ? $query->row_array() : false;
    }




    public function change_password($user_id,$new_password){
        $this->db->where('id',$user_id);
        $query =$this->db->update('hb_users',array('password'=>$new_password));
        return ($query) ? true : false;
    }



    public function getDataWhere($table,$where,$select){

        $this->db->select($select);

        $this->db->from($table);

        $this->db->where($where);

        $query=$this->db->get();

        return $query->num_rows() === 1 ? $query->row_array() : false;

    }



    public function insertData($table,$data){        

        $query=$this->db->insert($table,$data);

        return $query ? $this->db->insert_id() : false;

    }



    public function updateData($table,$data,$where){

        $this->db->where($where);

        $query=$this->db->update($table,$data);

        return $query ? true : false;

    }





}     



