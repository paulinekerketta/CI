<?php 

class Login extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('Admin');
		$this->load->model('admin/Login_model');
		date_default_timezone_set('asia/kolkata');
		
	}
	//working
	public function index(){
		$this->load->view('admin/login');
    }
    //working
	public function adminLogin()
	{
		if($this->session->userdata('is_login')){
			$this->session->set_flashdata('error','You Must Login For That Page.');
			redirect(base_url().'dashboard', 'refresh');
		}

		if(!empty($this->input->post())){	
			if(empty($this->input->post('email')) ||  empty($this->input->post('password'))){
				 $this->session->set_flashdata('error','Please Enter valid Email and Password');
			 redirect(base_url().'admin_login', 'refresh'); 
			}
		}
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == true){
           $user_exits = $this->Login_model->cheak_login($this->input->post('email'),$this->input->post('password'));
			if($user_exits){
                $set_session = array('is_login'=> true,
				                      'user_id'=> $user_exits['user_id'],
									  'email_id'=> $user_exits['email_id'],
									);
				$this->session->set_userdata($set_session);
				$this->session->set_flashdata('success', 'Login successfuly!!');
				redirect(base_url().'dashboard', 'refresh');
				
			}else{
				$this->session->set_flashdata('error','Email and Password Mismatch');
				redirect(base_url().'admin_login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}else{
		    $this->session->set_flashdata('error','Please Enter Valid Email and Password');
		    redirect(base_url().'admin_login', 'refresh');
		}
	}


    public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success','Logout Successfuly');
		redirect(base_url().'admin/login');
	}



	public function admin_forgot_password()
	{
		$this->load->library('email');
        $admin_email=$_POST['email'];		
        $from_email='mahendra.dollop@gmail.com';       
        $token = mt_rand(100000, 999999);
        $token =md5($token);
        $url=base_url().'resetPassword/'.$token;
        $select='id';
        $where=array('email_id'=>$admin_email,'is_active'=>1);
        //check admin is exist or is active
        $varifyAdminEmail = $this->Login_model->getDataWhere('hb_users',$where,$select);
        if (!empty($varifyAdminEmail)) {

        		$this->email->from($from_email, 'Dragon'); 
		        $this->email->to($admin_email);
		        $this->email->subject('Forgote password mail'); 
		        $this->email->message('Please click on url to create new password '. $url);
		        if($this->email->send()) {
					$data=array('token'=>$token);
					$where=array('id'=>$varifyAdminEmail['id']);
					$res = $this->Login_model->updateData('hb_users',$data,$where);					
					if ($res) {
						$this->session->set_flashdata('success', 'mail sent successfuly!! Please check your mail');
					} else {
						$this->session->set_flashdata('error','failed');
					}	
		        }else{
		         	$this->session->set_flashdata('error','mail failed');
		        }
		}else{
			$this->session->set_flashdata('error','You Entered Wrong Email.');
		}
 		redirect(base_url().'admin_login');
	}



	public function get_password(){

		$this->load->view('admin/forgotPassword');

	}



	public function change_forgeted_password(){
		$new_password= md5($_POST['new_password']);
		$token 		 =$_POST['token'];
		$checkToken = $this->Login_model->checkToken($token);
		if (!empty($checkToken)) {
			$user_id=$checkToken['id']; 
			$res = $this->Login_model->change_password($user_id,$new_password);
			if ($res) {
				$this->session->set_flashdata('success', 'password change successfuly! please Login. ');
				redirect(base_url().'admin/login');
			} else {
				$this->session->set_flashdata('error','failed');				
			}					

		}else{
			$this->session->set_flashdata('error','you are not authority to change admin password');
		}		
		redirect(base_url().'resetPassword');	
	}

	

}

?>