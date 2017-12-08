<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard_model extends CI_Model

{

    

    public function count($table,$where)
    {
      return $res=$this->db->get_where($table,$where);

    }



    public function user_report($params = array()){

                $this->db->select('
                    client.full_name as clt_first_name,
                    client.last_name as clt_last_name,
                    client.phone as clt_phone,
                    client.gender as clt_gender,
                    caregiver.full_name as cg_first_name,
                    caregiver.last_name as cg_last_name,
                    caregiver.phone as cg_phone,
                    caregiver.gender as cg_gender,
                    user_report.user_report_id ,
                    user_report.hour_reported ,
                    user_report.hour_actual_work ,
                    user_report.reason_discrepancy ,
                    user_report.report_register_date ,
                    user_report.is_fixed ,
                    ');
                $this->db->from('user_report');
                $this->db->join('client', 'client.client_id = user_report.client_id');
                $this->db->join('caregiver', 'caregiver.caregiver_id = user_report.caregiver_id');
                //filter data by searched keywords
                if(!empty($params['search']['keywords'])){
                    $this->db->like('client.full_name',$params['search']['keywords']);
                }
                //sort data by ascending or desceding order
                if(!empty($params['search']['sortBy'])){
                    $this->db->order_by('client.full_name',$params['search']['sortBy']);
                }else{
                    $this->db->order_by('client.client_id','desc');
                }
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
        $query=$this->db->get();
        return $query->num_rows() > 0 ? $query->result_array() : false;

    }


  public function get_data_for_bar_chart()
  {
      $return_array= array();
      $today = date('Y-m-d');
      //===========================================================================================
      $four_week_before = date("Y-m-d" ,strtotime('-4 week',strtotime($today)));
       $client    = $this->db->query('SELECT count(*) as client_count
                                                   FROM client as CL
                                                   where DATE(CL.registration_date) Between"'.$four_week_before.'"and"'. $today.'"');
       $caregiver = $this->db->query('SELECT count(*) as  caregiver_count
                                                   FROM  caregiver as CG
                                                   where DATE(CG.registration_date) Between"'.$four_week_before.'"and"'. $today.'"');
       $agency = $this->db->query( 'SELECT count(*) as agency_count
                                                   FROM  agency as AG
                                                   where DATE(AG.agency_created) Between"'.$four_week_before.'"and"'. $today.'"');
                  array_push($return_array,array('id' =>4,
                                                 'duration'  => '4 Week',
                                                 'client'    => $client->row_array()['client_count'],
                                                 'caregiver' => $caregiver->row_array()['caregiver_count'],
                                                  'agency'   =>  $agency->row_array()['agency_count'] ));

       //===========================================================================
      $eight_week_before = date("Y-m-d" ,strtotime('-8 week',strtotime($today)));
            $client = $this->db->query('SELECT count(*) as client_count
                                                     FROM client as CL
                                                     where DATE(CL.registration_date) Between"'.$eight_week_before.'"and"'. $today.'"');
            $caregiver = $this->db->query('SELECT count(*) as  caregiver_count
                                                      FROM  caregiver as CG
                                                      where DATE(CG.registration_date) Between"'.$eight_week_before.'"and"'. $today.'"');
           $agency = $this->db->query('SELECT count(*) as agency_count
                                                  FROM  agency as AG
                                                   where DATE(AG.agency_created) Between"'.$eight_week_before.'"and"'. $today.'"');
          array_push($return_array,array('id' =>3,
                                        'duration' => '8 Week',
                                        'client'   => $client->row_array()['client_count'],
                                        'caregiver'=> $caregiver->row_array()['caregiver_count'],
                                        'agency'   => $agency->row_array()['agency_count'] ));
       //===========================================================================================
      $six_month_before = date("Y-m-d" ,strtotime('-6 month',strtotime($today)));
             $client = $this->db->query('SELECT count(*) as client_count
                                                     FROM client as CL
                                                     where DATE(CL.registration_date) Between"'.$six_month_before.'"and"'. $today.'"');
            $caregiver = $this->db->query('SELECT count(*) as  caregiver_count
                                                      FROM  caregiver as CG
                                                      where DATE(CG.registration_date) Between"'.$six_month_before.'"and"'. $today.'"');
           $agency = $this->db->query('SELECT count(*) as agency_count
                                                  FROM  agency as AG
                                                   where DATE(AG.agency_created) Between"'.$six_month_before.'"and"'. $today.'"');
          array_push($return_array,array('id' =>3,
                                        'duration' => '6 Month',
                                        'client'   => $client->row_array()['client_count'],
                                        'caregiver'=> $caregiver->row_array()['caregiver_count'],
                                        'agency'   => $agency->row_array()['agency_count'] ));
       //===========================================================================================
      $one_year_before = date("Y-m-d" ,strtotime('-1 year',strtotime($today)));
           $client = $this->db->query('SELECT count(*) as client_count
                                                     FROM client as CL
                                                     where DATE(CL.registration_date) Between"'.$one_year_before.'"and"'. $today.'"');
           $caregiver = $this->db->query('SELECT count(*) as  caregiver_count
                                                      FROM  caregiver as CG
                                                      where DATE(CG.registration_date) Between"'.$one_year_before.'"and"'. $today.'"');
           $agency = $this->db->query('SELECT count(*) as agency_count
                                                      FROM  agency as AG
                                                      where DATE(AG.agency_created) Between"'.$one_year_before.'"and"'. $today.'"');
          array_push($return_array,array('id' =>3,
                                        'duration' => '1 Year',
                                        'client'   => $client->row_array()['client_count'],
                                        'caregiver'=> $caregiver->row_array()['caregiver_count'],
                                        'agency'   => $agency->row_array()['agency_count'] ));
      // ===========================================================================
      return !empty($return_array)? $return_array : false;
   }


}     



