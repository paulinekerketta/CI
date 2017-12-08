<?php 
class Users_Manager extends CI_Controller 
{	
	function __construct(){
		parent::__construct();		
		$this->load->helper('url');
		$this->load->database();
		date_default_timezone_set("Asia/Kolkata");
        $this->load->model('admin/Users_Manager_Model');
        $this->load->model('admin/Analysis_Model');        
        $this->load->model('Common_model');
		$this->load->library('session');
		$this->load->library('Ajax_pagination');
        $this->perPage = 10;
        if(!$this->session->userdata('is_login')){
			$this->session->set_flashdata('error','You Must Login First.');
			redirect(base_url().'admin/login', 'refresh');
		}
	}

    public function Users(){
       	$totalRec = count($this->Users_Manager_Model->get_Users_list());
        $config['target']      = '#Item_table';
        $config['base_url']    = base_url().'Users_Manager/ajax_Users';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
    	$data['Users_list']=$this->Users_Manager_Model->get_Users_list(array('limit'=>$this->perPage));
        $this->load->view('admin/include/header.php');
		$this->load->view('admin/Users_Manager/Users',$data);
		$this->load->view('admin/include/footer.php');
    }

    public function ajax_Users(){
        $conditions = array();
        $page = $this->input->post('page');
        $offset =(!$page)?0:$page;
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $Users_id = $this->input->post('Users_id');
        if(!empty($keywords) && $keywords != 'undefined'){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy) && $sortBy != 'undefined' ){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($Users_id) && $Users_id != 'undefined' ){
            $conditions['search']['Users_id'] = $Users_id;
        }
        $totalRec = count($this->Users_Manager_Model->get_Users_list($conditions));
        $config['target']      = '#Item_table';
        $config['base_url']    = base_url().'Users_Manager/ajax_Users';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';       
        $this->ajax_pagination->initialize($config);
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $data['Users_list']=$this->Users_Manager_Model->get_Users_list($conditions);
        $this->load->view('admin/Users_Manager/ajax_Users', $data);
    }     


    public function change_status_users()
    {
        $status  =$_POST['status'];
        $where=array('user_id'=>$_POST['id']);
        $data=array('is_active' =>!$status);
        $res=$this->Common_model->updateData('Users',$where,$data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function edit_Users()
    {
        $conditions['user_id'] = $this->uri->segment(2);
        if (!empty($conditions['user_id'])) {
            $Users_Data=$this->Users_Manager_Model->get_Users_list($conditions);
            if (!empty($Users_Data)) {
                $data['Users_Data']=$Users_Data[0];
                $this->load->view('admin/include/header.php');
                $this->load->view('admin/Users_Manager/edit_Users',$data);
                $this->load->view('admin/include/footer.php');
            }else{
                redirect(base_url().'Users');
            } 
        }else{
            redirect(base_url().'Users');
        }        
    }

    public function update_Users()
    {
       if(isset($_POST) && !empty($_POST) && $_POST['user_id']!=""){
            $email_id=$_POST['email_id'];
            $phone=$_POST['phone'];
            $user_id=$_POST['user_id'];
            //check not same email is exist 
            $where=" user_id ".'!='."'$user_id' && email_id='$email_id'";
            $check_email=$this->Users_Manager_Model->getDataWhere('hb_users',$where);
            if (!empty($check_email)) {
                $this->session->set_flashdata('error','Update Fail !. Email Already Exist');
                redirect(base_url().'Users');
            }
            //check not same phone number is exist 
            $where=" user_id ".'!='."'$user_id' && phone='$phone'";
            $check_phone=$this->Common_model->getDataWhere('hb_users','user_id',$where);
            if (!empty($check_phone)) {
                $this->session->set_flashdata('error','Update Fail !. Phone Number Already Exist');
                redirect(base_url().'Users');
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
                if ($_POST['hidden_image']!="") {
                    unlink($path.$_POST['hidden_image']);
                }
            }
            
            $where=array('user_id'=>$_POST['user_id']);
            $save = $this->Common_model->updateData('hb_users',$where,$data);         
            if($save){
                $this->session->set_flashdata('success','update Successfully');
                redirect(base_url().'Users');
            }else{
                $this->session->set_flashdata('error','Some Thing Not Right');
                redirect(base_url().'Users');
            }   
        }else{
            $this->session->set_flashdata('error','Failed. please select category');
            redirect(base_url().'Users');
        }   
    }

    
    

    public function delete_Users(){ //tt for table name
        if(isset($_POST)){
            $where=array($_POST['cc']=>$_POST['value']);
            $delete = $this->Common_model->deleteDataByCondition($_POST['tt'],$where);
            echo $success = $delete ? '1' : '0';
        }else{
            echo "0";
        }
    }

    public function UserAnalysis(){

        $data = array();
        $user_id=$this->uri->segment(2);
        $set_session = array('admins_user_id'=> $user_id);
        $this->session->set_userdata($set_session);
        $condition['user_id']=$user_id;
        $totalRec = count($this->Analysis_Model->Analysis($condition));
        //pagination configuration
        $config['target']      = '#transaction_div';
        $config['base_url']    = base_url().'Users_Manager/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        $data['Analysis']=$this->Analysis_Model->Analysis(array('limit'=>$this->perPage,'user_id'=>$user_id));
        $this->load->view('admin/include/header');
        $this->load->view('admin/Users_Manager/user_analysis',$data);
        $this->load->view('admin/include/footer');
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
        $user_id=$this->session->userdata('admins_user_id');

        $conditions['user_id']=$user_id;
        $totalRec = count($this->Analysis_Model->Analysis($conditions));
        //pagination configuration
        $config['target']      = '#transaction_div';
        $config['base_url']    = base_url().'Users_Manager/ajaxPaginationData';
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


    public function AnalysisDetail(){

        $data = array();
        $user_id=$this->session->userdata('admins_user_id');
        $condition['user_id']=$user_id;
        $caregory_id=$this->uri->segment(2);
        $condition['caregory_id']=$caregory_id;
        $set_session = array('caregory_id'=> $caregory_id);
        $this->session->set_userdata($set_session);
        $totalRec = count($this->Analysis_Model->Analysis2($condition));
        //pagination configuration
        $config['target']      = '#transaction_div';
        $config['base_url']    = base_url().'Users_Manager/ajaxPaginationData2';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        $data['Analysis']=$this->Analysis_Model->Analysis2(array('limit'=>$this->perPage,'user_id'=>$user_id,'caregory_id'=>$caregory_id));

        $this->load->view('admin/include/header');
        $this->load->view('admin/Users_Manager/user_analysis_2',$data);
        $this->load->view('admin/include/footer');
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
        $user_id=$this->session->userdata('admins_user_id');
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

    
    
} ?>