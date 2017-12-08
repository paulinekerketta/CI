<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Manager_Model extends CI_Model
{

    public function get_Users_list($params = array()){
        $where="user_type!='Admin'";
              $query =   $this->db->select('*')
                        ->from('hb_users')
                        ->where($where);
        if(!empty($params['search']['keywords'])){
            $this->db->like('hb_users.user_name',$params['search']['keywords']);
        }
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('hb_users.user_id',$params['search']['sortBy']);
        }else{
            $this->db->order_by('hb_users.user_id','desc');
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        if(array_key_exists("user_id",$params)){
            $this->db->where('hb_users.user_id',$params['user_id']);
        }
        $query = $this->db->get();
        return $query ? $query->result_array() : false;
    }

    public function getDataWhere($table,$where)
    {
                $this->db->select('*');
                $this->db->from($table);
                $this->db->where($where);
        $query =$this->db->get();
        return ($query->num_rows() > 0) ? $query->row_array() : 0;
    }


    

    
}