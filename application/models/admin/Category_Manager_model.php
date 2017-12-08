<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_Manager_model extends CI_Model
{

    public function get_Category_list($params = array()){
              $query =   $this->db->select('*')
                        ->from('hb_category');
        if(!empty($params['search']['keywords'])){
            $this->db->like('hb_category.category_name',$params['search']['keywords']);
        }
        if(!empty($params['search']['sport_id'])){
            $this->db->where('hb_category.category_id',$params['search']['category_id']);
        }
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('hb_category.category_id',$params['search']['sortBy']);
        }else{
            $this->db->order_by('hb_category.category_id','desc');
        }
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        if(array_key_exists("category_id",$params)){
            $this->db->where('hb_category.category_id',$params['category_id']);
        }
        $query = $this->db->get();
        return $query ? $query->result_array() : false;
    }

    
}