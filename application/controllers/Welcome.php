<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->model('Common_model');
		$this->load->model('admin/Login_model');
		$this->load->model('admin/Analysis_Model');
		$this->perPage=10;
		$this->load->library('Ajax_pagination');
	}

	public function index()
	{	

		$this->load->view('human_behaviour/include/header');
		$data=array();
		$this->load->view('human_behaviour/welcome',$data);
		$this->load->view('human_behaviour/include/footer');//sidebar
	}

	

	public function Login()
	{	
		if($this->session->userdata('is_human_user_login')){
			redirect(base_url());
		}

		if(!empty($this->input->post())){	
			if(empty($this->input->post('email')) ||  empty($this->input->post('password'))){
				$this->session->set_flashdata('error','Please Enter valid Email and Password');
			 	redirect(base_url(),'Login','refresh'); 
			}

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == true){
	           $user_exits = $this->Login_model->cheak_user_login($this->input->post('email'),$this->input->post('password'));

				if($user_exits){
	                $set_session = array('is_human_user_login'=> true,
					                      'my_user_id'=> $user_exits['user_id'],
										  'my_email_id'=> $user_exits['email_id'],
										  'profile_pic'=> $user_exits['profile_pic'],
										);
					$this->session->set_userdata($set_session);
					$this->session->set_flashdata('success', 'Login successfuly!!');
					redirect(base_url());
					
				}else{
					$this->session->set_flashdata('error','Email and Password Mismatch');
					redirect(base_url().'Login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			}else{
			    $this->session->set_flashdata('error','Please Enter Valid Email and Password');
			    redirect(base_url().'Login', 'refresh');
			}
		}else{
			$this->load->view('human_behaviour/Login');
		}
		

	}

	public function Signup()
	{	
		$this->load->view('human_behaviour/Signup');
	}

	public function UserSignup()
	{	
		//|is_unique[users.mobile_no]');
		$this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('email_id', 'Email', 'required|valid_email|is_unique[hb_users.email_id]');
		$this->form_validation->set_rules('phone', 'Phone', 'required|is_unique[hb_users.phone]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		if ($this->form_validation->run() == true){
           $data=array(
           		'user_name'=>$this->input->post('user_name'),
           		'email_id'=>$this->input->post('email_id'),
           		'phone'=>$this->input->post('phone'),
           		'password'=>md5($this->input->post('password')),
           		'user_type'=>'User',
           );
           $res=$this->Common_model->insertData('hb_users',$data);
           if ($res) {
           		$this->session->set_flashdata('success','Registration Successfuly');
				redirect(base_url().'Login', 'refresh');
           } else {
           		$this->session->set_flashdata('error','Registration Failed');
				redirect(base_url().'Signup', 'refresh');
           }
           
		}else{
		    $this->load->view('human_behaviour/Signup');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success','Logout Successfuly');
		redirect(base_url());
	}

	public function Profile()
	{	
		$user_id=$this->session->userdata('my_user_id');
        $cond = array('user_id' => $user_id);
        $userData=$this->Common_model->getAllDataByCondition('hb_users',$cond); 
        if (!empty($userData)) {
         	$data['userData']=$userData[0];
			$this->load->view('human_behaviour/include/header');
			$this->load->view('human_behaviour/Profile',$data);
			$this->load->view('human_behaviour/include/footer');
         } else {
         	redirect(base_url());
         }
	}

	public function edit_User_detail(){
        
        $user_id=$this->session->userdata('my_user_id');
        $cond = array('user_id' => $user_id);
        $userData=$this->Common_model->getAllDataByCondition('hb_users',$cond); 
        if (!empty($userData)) {
         	$data['userData']=$userData[0];
         	$this->load->view('human_behaviour/include/header');
			$this->load->view('human_behaviour/edit_profile',$data);
			$this->load->view('human_behaviour/include/footer');
         } else {
         	redirect(base_url());
         }
  	}

  	public function update_profile()
    {

       if(isset($_POST) && !empty($_POST) && $_POST['user_id']!=""){

            $redirect='Profile';

            $email_id=$_POST['email_id'];
            $phone=$_POST['phone'];
            $phone=$_POST['phone'];
            $address=$_POST['address'];

            $user_id=$_POST['user_id'];
            //check not same email is exist 
            $where=" user_id ".'!='."'$user_id' && email_id='$email_id'";
            $check_email=$this->Common_model->getAllDataByCondition('hb_users',$where);
            if (!empty($check_email)) {
                $this->session->set_flashdata('error','Update Fail !. Email Already Exist');
                redirect(base_url().$redirect);
            }
            //check not same phone number is exist 
            $where=" user_id ".'!='."'$user_id' && phone='$phone'";
            $check_phone=$this->Common_model->getAllDataByCondition('hb_users','user_id',$where);
            if (!empty($check_phone)) {
                $this->session->set_flashdata('error','Update Fail !. Phone Number Already Exist');
                redirect(base_url().$redirect);
            }
            $data = array(
                        'user_name'     => $_POST['user_name'],
                        'email_id'      =>$_POST['email_id'],
                        'address'       =>$_POST['address'],
                        'phone'         =>$_POST['phone'],
                       );
            if (isset($_FILES) && !empty($_FILES['profile_pic']['name'])) {
                $image_data=$_FILES['profile_pic'];
                $path='uploads/profile_pic/';
                $data['profile_pic']=$this->Common_model->upload_image($image_data,4,$path);
                $set_session = array('profile_pic'=> $data['profile_pic']);
                $this->session->set_userdata($set_session);
                if ($_POST['hidden_image']!="") {
                    unlink($path.$_POST['hidden_image']);
                }
            }
            
            $where=array('user_id'=>$_POST['user_id']);
            $save = $this->Common_model->updateData('hb_users',$where,$data);         
            if($save){
                $this->session->set_flashdata('success','update Successfully');
                redirect(base_url().$redirect);
            }else{
                $this->session->set_flashdata('error','Some Thing Not Right');
                redirect(base_url().$redirect);
            }   
        }else{
            $this->session->set_flashdata('error','Failed. please select category');
            redirect(base_url().$redirect);
        }   
    }

    /****************************** Analysis ******************************************/

    public function Analysis(){

    	$data = array();
    	$user_id=$this->session->userdata('my_user_id');
    	$condition['user_id']=$user_id;
        $totalRec = count($this->Analysis_Model->Analysis($condition));
        //pagination configuration
        $config['target']      = '#transaction_div';
        $config['base_url']    = base_url().'Welcome/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
    	$data['Analysis']=$this->Analysis_Model->Analysis(array('limit'=>$this->perPage,'user_id'=>$user_id));

    	/*echo "<pre>";
    	print_r($data['Analysis']);
    	die();*/
     	$this->load->view('human_behaviour/include/header');
		$this->load->view('human_behaviour/user_analysis',$data);
		$this->load->view('human_behaviour/include/footer');
  	}

  	public function ajaxPaginationData(){

        $conditions = array();
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords) && $keywords != 'undefined'){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy) && $sortBy != 'undefined' ){
            $conditions['search']['sortBy'] = $sortBy;
        }
        //total rows count
        $user_id=$this->session->userdata('my_user_id');
    	$conditions['user_id']=$user_id;
        $totalRec = count($this->Analysis_Model->Analysis($conditions));
        //pagination configuration
        $config['target']      = '#transaction_div';
        $config['base_url']    = base_url().'Welcome/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $data['Analysis']=$this->Analysis_Model->Analysis($conditions);
        $this->load->view('human_behaviour/ajax_analysis', $data);
    }



    public function Analysis2(){

    	$data = array();
    	$user_id=$this->session->userdata('my_user_id');
    	$condition['user_id']=$user_id;
    	$caregory_id=$this->uri->segment(2);
    	$condition['caregory_id']=$caregory_id;
    	$set_session = array('caregory_id'=> $caregory_id);
        $this->session->set_userdata($set_session);
        $totalRec = count($this->Analysis_Model->Analysis2($condition));
        //pagination configuration
        $config['target']      = '#transaction_div';
        $config['base_url']    = base_url().'Welcome/ajaxPaginationData2';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
    	$data['Analysis']=$this->Analysis_Model->Analysis2(array('limit'=>$this->perPage,'user_id'=>$user_id,'caregory_id'=>$caregory_id));
     	$this->load->view('human_behaviour/include/header');
		$this->load->view('human_behaviour/user_analysis2',$data);
		$this->load->view('human_behaviour/include/footer');
  	}



  	public function ajaxPaginationData2(){

        $conditions = array();
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords) && $keywords != 'undefined'){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy) && $sortBy != 'undefined' ){
            $conditions['search']['sortBy'] = $sortBy;
        }
        //total rows count
        $user_id=$this->session->userdata('my_user_id');
    	$conditions['user_id']=$user_id;
    	$caregory_id=$this->session->userdata('caregory_id');
    	$conditions['caregory_id']=$caregory_id;
        $totalRec = count($this->Analysis_Model->Analysis2($conditions));
        //pagination configuration
        $config['target']      = '#transaction_div';
        $config['base_url']    = base_url().'Welcome/ajaxPaginationData2';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $data['Analysis']=$this->Analysis_Model->Analysis2($conditions);
        $this->load->view('human_behaviour/ajax_analysis2', $data);
    }

  	

    /*public function save_feeling(){

		$argument=$_POST['argument'];
		if ($argument=="") {
		    echo "0";
		}else{
	    
	    	$dataArray=explode(" ", $argument);
	    	$user_id=1;
	   		 $cat_ids=array();
		    foreach ($dataArray as $key => $value) {
		        
		        if ($value!="") {
		          $value= ",".$value.",";
		          $cat_id= matchWord($value);
		          if ($cat_id!="" && !in_array($cat_id, $cat_ids)) {

		              array_push($cat_ids, $cat_id);
		          }
		        }
		    }
	    	$res=$this->insertCat($user_id,$cat_ids);
	    	echo $res;
	  	}
  	}

  	function insertCat($user_id,$cat_ids)
	{

	    $sql = "";
	    foreach ($cat_ids as $key => $cat_id) {
	        $sql .= "INSERT INTO hb_user_feelings (user_id, caregory_id) VALUES ('$user_id', '$cat_id');";
	    }

	    if ($conn->multi_query($sql) === TRUE) {
	          return 1;
	    } else {
	          return 0;
	   }
	}

	function matchWord($word)
  	{
      	$sql = "SELECT * FROM hb_category where search_word like '%$word%'";
      	$result = $conn->query($sql);
      	$cat_id="";

      	if ($result->num_rows > 0) {        
            $row = $result->fetch_assoc();
              $cat_id = $row['category_id'];
         
      	}
      	return $cat_id;
  	}*/
		
} ?>