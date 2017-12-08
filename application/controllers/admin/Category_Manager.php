<?php 
class Category_Manager extends CI_Controller 
{	
	function __construct(){
		parent::__construct();		
		$this->load->helper('url');
		$this->load->database();
		date_default_timezone_set("Asia/Kolkata");
        $this->load->model('admin/Category_Manager_model');
        $this->load->model('Common_model');
		$this->load->library('session');
		$this->load->library('Ajax_pagination');
        $this->perPage = 10;
        if(!$this->session->userdata('is_login')){
			$this->session->set_flashdata('error','You Must Login First.');
			redirect(base_url().'admin/login', 'refresh');
		}
	}
    //working
    public function Category(){
       	$totalRec = count($this->Category_Manager_model->get_Category_list());
        $config['target']      = '#Category_table';
        $config['base_url']    = base_url().'Category_Manager/ajax_Category';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
    	$data['Category_list']=$this->Category_Manager_model->get_Category_list(array('limit'=>$this->perPage));
        $this->load->view('admin/include/header.php');
		$this->load->view('admin/Category_Manager/Category',$data);
		$this->load->view('admin/include/footer.php');
    }

    //working
    public function ajax_Category(){
         $conditions = array();
        $page = $this->input->post('page');
        $offset =(!$page)?0:$page;
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $category_id = $this->input->post('category_id');
        if(!empty($keywords) && $keywords != 'undefined'){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy) && $sortBy != 'undefined' ){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($category_id) && $category_id != 'undefined' ){
            $conditions['search']['category_id'] = $category_id;
        }
        
        //total rows count
        $totalRec = count($this->Category_Manager_model->get_Category_list($conditions));
        //pagination configuration
        $config['target']      = '#Category_table';
        $config['base_url']    = base_url().'Category_Manager/ajax_Category';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
       
        $this->ajax_pagination->initialize($config);
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        //get posts data
        $data['Category_list']=$this->Category_Manager_model->get_Category_list($conditions);
        //load the view
        $this->load->view('admin/Category_Manager/ajax_Category', $data);
    }     


    //working
    public function add_Category(){
        if(isset($_POST) && !empty($_POST) && $_POST['submit']=="Save"){
            
            $data = array(
                        'category_name'       => $_POST['category_name'],
                        'search_word'      =>",".$_POST['search_word'].",",
                       );
            $save = $this->Common_model->insertData('hb_category',$data);         
            if($save){
                $this->session->set_flashdata('success','Add Successfully');
                redirect(base_url().'Category');
            }else{
                $this->session->set_flashdata('error','Some Thing Not Right');
                redirect(base_url().'Category');
            }   
        }else{
            $this->session->set_flashdata('error','Failed. please select category');
            redirect(base_url().'Category');
        }   
    }
   

    public function edit_Category()
    {
        $conditions['category_id'] = $this->uri->segment(2);
        if (!empty($conditions['category_id'])) {
            $Category_Data=$this->Category_Manager_model->get_Category_list($conditions);
            if (!empty($Category_Data)) {
                $data['Category_Data']=$Category_Data[0];
                $this->load->view('admin/include/header.php');
                $this->load->view('admin/Category_Manager/edit_Category',$data);
                $this->load->view('admin/include/footer.php');
            }else{
                redirect(base_url().'Category');
            } 
        }else{
            redirect(base_url().'Category');
        }        
    }

    public function update_Categorys()
    {
       if(isset($_POST) && !empty($_POST) && $_POST['category_id']!=""){
            
            $data = array(
                        'category_name'       => $_POST['category_name'],
                        'search_word'      =>$_POST['search_word'],
                       );
            
            $where=array('category_id'=>$_POST['category_id']);
            $save = $this->Common_model->updateData('hb_category',$where,$data);         
            if($save){
                $this->session->set_flashdata('success','update Successfully');
                redirect(base_url().'Category');
            }else{
                $this->session->set_flashdata('error','Some Thing Not Right');
                redirect(base_url().'Category');
            }   
        }else{
            $this->session->set_flashdata('error','Failed. please select category');
            redirect(base_url().'Category');
        }   
    }

    public function delete_Category(){ //tt for table name
        if(isset($_POST)){

            $where=array($_POST['cc']=>$_POST['value']);
            $delete = $this->Common_model->deleteDataByCondition($_POST['tt'],$where);            
            echo $success = $delete ? '1' : '0';
        }else{
            echo "0";
        }
    }

    
} ?>