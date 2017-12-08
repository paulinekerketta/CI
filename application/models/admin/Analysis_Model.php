<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analysis_Model extends CI_Model
{

    public function Analysis($params = array()){

              $query =   $this->db->select('*,UF.created_date as feeling_created,count(UF.caregory_id) as total')
                        ->from('hb_user_feelings UF')
                        ->join('hb_users US','US.user_id=UF.user_id')
                        ->join('hb_category CT','CT.category_id=UF.caregory_id');
        if(!empty($params['search']['keywords'])){
            $this->db->like('CT.category_name',$params['search']['keywords']);
        }
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('CT.category_name',$params['search']['sortBy']);
        }else{
            $this->db->order_by('UF.feeling_id','desc');
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        if(array_key_exists("user_id",$params)){
            $this->db->where('UF.user_id',$params['user_id']);
            $this->db->group_by('UF.caregory_id');
        }
        $query = $this->db->get();
        return $query ? $query->result_array() : false;
    }

    public function Analysis2($params = array()){

              $query =   $this->db->select('*,UF.created_date as feeling_created')
                        ->from('hb_user_feelings UF')
                        ->join('hb_users US','US.user_id=UF.user_id')
                        ->join('hb_category CT','CT.category_id=UF.caregory_id');
        if(!empty($params['search']['keywords'])){
            $this->db->like('CT.category_name',$params['search']['keywords']);
        }
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('CT.category_name',$params['search']['sortBy']);
        }else{
            $this->db->order_by('UF.feeling_id','desc');
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        if(array_key_exists("user_id",$params)){
            $this->db->where('UF.user_id',$params['user_id']);
        }
        if(array_key_exists("caregory_id",$params)){
            $this->db->where('UF.caregory_id',$params['caregory_id']);
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