<?php 

class Dashboard extends CI_Controller 

{	

	function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admin/Dashboard_model');
		$this->load->model('Common_model');
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}

    public function index()
 	{          
	    if(!$this->admin->is_login()){
			$this->session->set_flashdata('error','You must be an administrator to view this page.');
			redirect(base_url().'admin/login', 'refresh');
		}
        $data=array();
        $cond="user_type!='Admin'";
        $data['users']=$this->Common_model->getAllDataByCondition('hb_users',$cond);
		$this->load->view('admin/dashboard',$data);
	}

}?>