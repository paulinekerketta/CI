<?php 

class Profile extends CI_Controller 

{	

	//public $isLogin = TRUE;

	function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admin/Profile_model');
        if(!$this->session->userdata('is_login')){
			$this->session->set_flashdata('error','You Must Login First.');
			redirect(base_url().'admin/login', 'refresh');
		}
	}

	public function change_password()
	{
	   	$this->load->view('admin/include/header');
		$this->load->view('admin/profile/change_password');
		$this->load->view('admin/include/footer');
	}

	public function update_password()
	{
	   	if (!$this->session->userdata('user_id')) {
	   		redirect(base_url().'admin/login');
	   	}

	   	$user_id=$this->session->userdata('user_id');

	   	$old_password=md5($_POST['old_password']);

	   	$new_password=md5($_POST['new_password']);

	   	$res=$this->Profile_model->check_admin_password($user_id,$old_password);

	   	if ($res) {

	   		$res2=$this->Profile_model->change_admin_password($user_id,$new_password);

	   		if ($res2) {

	   			$this->session->set_flashdata('message', 'password change successfully');	   		

		   	} else {

		   		$this->session->set_flashdata('message', 'failed');

		   	}



	   	} else {

	   		$this->session->set_flashdata('message', 'Password not match');

	   	}



	   	redirect(base_url().'admin_change_password');

	}


	//working
	public function change_email()
	{
		if (!$this->session->userdata('user_id')) {
	   		redirect(base_url().'admin/login');
	   	}

	   	$user_id=$this->session->userdata('user_id');
	   	$select='email_id';
        $where=array('user_id'=>$user_id);
        $data['admin_email']= $this->Profile_model->getDataWhere('hb_users',$where,$select);
	   	$this->load->view('admin/include/header');
		$this->load->view('admin/profile/change_email',$data);
		$this->load->view('admin/include/footer');		
	}


	//working
	public function update_email()
	{
	   	if (!$this->session->userdata('user_id')) {
	   		redirect(base_url().'admin/login');
	   	}
	   	$user_id=$this->session->userdata('user_id');
	   	$admin_email=$_POST['admin_email'];
	   	$data=array('email_id'=>$admin_email);
		$where=array('user_id'=>$user_id);
	   	$res=$this->Profile_model->updateData('hb_users',$data,$where); 
   		if ($res) {
   			$this->session->set_flashdata('message', 'Email Change Successfully');
	   	} else {
	   		$this->session->set_flashdata('message', 'failed');
	   	}
	   	redirect(base_url().'admin_change_email');
	}









}?>