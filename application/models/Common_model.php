<?php

Class Common_model extends CI_Model {
	

	 /**
	 * Index Page for this Model.
	 * This is a simple Code Create by Verma
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this Model is set as the default Model in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */ 

	public function __construct()
	 {
	  parent::__construct();

	  $this->load->database();
	  $this->load->library('email');
	  $path="assets/images/";
	 }

	public function insertData($table,$data)
	{
		$query = $this->db->insert($table,$data);
		if ($query)
		{
			return $this->db->insert_id();
		}
		else
		{
			return "0";
		}

	}

	public function getAllData($table)
	{
		$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function get($table)
	{
		$query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return 0;
		}
	}

	//mkr
	public function getDataWhere($table,$select,$where)
	{
		$query = $this->db->select($select)->from($table)->where($where)->get();
		return ($query->num_rows() > 0) ? $query->row_array() : 0;
	}

	//mkr
	public function getAllDataWhere($table,$select,$where)
	{
		$query = $this->db->select($select)->from($table)->where($where)->get();
		return ($query->num_rows() > 0) ? $query->result_array() : 0;
	}





	public function getAllDataByCondition($table,$cond)
	{
		$query = $this->db->get_where($table,$cond);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return 0;
		}
	}

	public function upload_image($image_data,$num,$path1)
	{
           $image = md5(date("d-m-y:h:i s"))."_".$num;
            if(is_array($image_data)) 
            {
                   $file_name = pathinfo(@$image_data['name'], PATHINFO_FILENAME);
                   $extension = pathinfo(@$image_data['name'], PATHINFO_EXTENSION);     
                   if(move_uploaded_file(@$image_data['tmp_name'], $path1.''. $image.'.'.$extension)){
                    $image = $image.'.'.$extension;
                   
                   }else{
                    $image = Null;
                   }
                   
            }
           return $image;
	}

	public function updateData($table, $cond, $data)
    {
		$this->db->where($cond);
		$res=$this->db->update($table, $data); 

		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function deleteDataByCondition($table, $id)
	{
		$query = $this->db->delete($table,$id);
		if ($query)
		{
			return "1";
		}
		else
		{
			return "0";
		}
	}

	public function deleteDataWithImg($table, $id, $image)
	{
		if($image!='')
		{
			unlink($path.$image);
		}
		$query = $this->db->delete($table,$id);
		if ($query)
		{
			return "1";
		}
		else
		{
			return "0";
		}
	}
	public function getById($table,$where)
	 {
	  $query = $this->db->get_where($table,$where);
	  return ($query->num_rows() > 0)?$query->row_array():false;
	 }

	public function send_mail($sender, $reciever, $mail_message, $mail_subject ) 
	{ 
         $this->email->from($sender); 
         $this->email->to($reciever);
         $this->email->subject($mail_subject); 
         $this->email->message($mail_message); 
   
         //Send mail 
         if($this->email->send()) 
        	return 1; 
         else 
        	 return 0; 
    }
    public function sendOtp($otp, $mobile_no)
	{
	 

	  $ch = curl_init('https://www.smsgatewayhub.com/api/mt/SendSMS?');


	      $apikey = "74ad9d21-d3cd-4cbb-be5f-3a77af4dc810";
	     $apisender = "TESTIN";
	     $msg =$otp." is your login OTP. Treat this as confidential.";
	     $num = $mobile_no;    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
	   
	     $ms = rawurlencode($msg);   //This for encode your message content                   
	   
	   $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
	                       
	   //echo $url;
	   $ch=curl_init($url);
	   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	   curl_setopt($ch,CURLOPT_POST,1);
	   curl_setopt($ch,CURLOPT_POSTFIELDS,"");
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
	   $data = curl_exec($ch);
		$result = json_decode($data);
	   //print_r($result);
	   if($result->ErrorMessage =="Success")
	   {
	    return 1;
	   }
	   else
	   {
	    return 0;
	   }

	}
	public function getOtp($contact_no)
	{
		$six_digit_otp = mt_rand(100000, 999999);
	    $query = $this->db->get_where("users",array("phone"=>$contact_no));
	    if($query->num_rows() > 0)
	    {
        	$data = array();
        	if($six_digit_otp!="")
        		$data['otp'] = $six_digit_otp;
        	if($contact_no!="")
        		$data['phone'] = $contact_no;
        	$data['otp_issued_date'] = date("Y-m-d h:i:s");

        	$this->db->where(array("phone"=>$contact_no));
			$this->db->update("users", $data);
        	if($this->db->affected_rows() > 0)
	    	{
	    		$otp_query = $this->db->get_where("users",array("phone"=>$contact_no));
				if($otp_query->num_rows() > 0)
				{    
					return $otp_query->result_array()[0]['otp']; //return OTP.....
				}
				else
				{	
					return "1"; //OTP don't send......
				}
	    	}	
	    	else
	    	{
	    		return "2"; //Something is wrong......
	    	}
		    		
	    }
	    else
	    {
	    	return "0";
	    }
	} 	

	public function matchToken($token)
	{
		$query = $this->db->get_where("user_token",array("token"=>$token));
		if ($query->num_rows() > 0)
		{
					return $query->result_array()[0]['user_id'];
		}
		else
		{
			return "0";
		}
		
	}	
	public function matchOtp($contact_no,$otp)
	{
		/*print_r($contact_no);
		print_r($otp);*/
    	$user_data= $this->getAllDataByCondition("users",array("phone"=>$contact_no,"otp"=>$otp));
		if($user_data!=0)
		{
			$user_id= $user_data[0]['user_id'];
			$ts1 = strtotime(date('Y-m-d h:i:s'));
			$ts2 = strtotime($user_data[0]['otp_issued_date']);
			$diff = abs($ts1 - $ts2) / 60;
			if($diff <= 10 )
			{
				$update_otp = mt_rand(100000, 999999);
				$where = array("user_id"=>$user_id); 
				$change_data = $this->updateData("users",$where,array('otp'=>$update_otp));
				if($change_data!=0)
				{
					$token = md5(date("Y-m-d h:i:s").uniqid(rand(100000, 999999)));
					$data = array(
			    					'user_id' => $user_id,
			    					'token' => $token,
			    				 );		
					
			    	$token_query = $this->db->get_where("user_token",array("user_id"=>$user_id));
					if ($token_query->num_rows()==0)
					{
						$query = $this->db->insert("user_token",$data);
						if ($query)
						{
							$id = $this->db->insert_id();
							$data_res = $this->db->get_where("user_token",array("user_token_id"=>$id));
							return $data_res->result_array()[0]['token'];
						}
						else
						{
							return "1"; //failed
						}
					}
					else
					{
						
						$data = array();
						if($token!="")
			        		$data['token'] = $token;
			        		$data['token_issued_datetime'] = date("Y-m-d h:i:s");

						$this->db->where(array("user_id"=>$user_id));
						$this->db->update("user_token", $data);
						if($this->db->affected_rows() > 0)
						{
							$query = $this->db->get_where("user_token",array("user_id"=>$user_id));
							return $query->result_array()[0]['token'];
						}
						else
						{
							return "2"; //token not update
						}
					}
				}
				else
				{
					return "3"; // otp not update
				}
			}
			else
			{
				return "4"; // otp expired
			}
		}
		else
		{
			return "0"; //mobile no. not matched
		}
		
	}

	//mkr
	public function checkCaregiverAuthority($user_id){
				$this->db->select('*');
				$this->db->from('user_roles UR');
				$this->db->join('authority AU', 'AU.authority_id = UR.authority_id','left');
				$this->db->where('UR.user_id',$user_id);
		$query=	$this->db->get();

		if ($query->num_rows()>0) {
			$user_roles=$query->row_array();
			// print_r($user_roles);
	  //       	die();
			if ($user_roles['authority']=="ROLE_CAREGIVER") {
				return true;
			} else {
				return false;
			}			
		} else {
			return false;
		}	
	}

	//mkr
	public function getAuthority($user_id)
	{
				$this->db->select('*');
				$this->db->from('user_roles UR');
				$this->db->join('authority AU', 'AU.authority_id = UR.authority_id','left');
				$this->db->where('UR.user_id',$user_id);
		$query=	$this->db->get();
		return ($query->num_rows()>0) ? $query->row_array() : 0;
	}

	public function getUserIdByToken($token)
	{
		$query = $this->db->get_where("user_token",array("token"=>$token));
		if ($query->num_rows() > 0)
		{
				/*$this->db->where(array("token"=>$token));
				$this->db->update("user_token", array("token_issued_datetime"=>date("Y-m-d h:i:s")));
				if($this->db->affected_rows() > 0)
				{*/
					$user_id = $query->result_array()[0]['user_id'];
					$getAuthority_id = $this->db->get_where("user_roles",array("user_id"=>$user_id));
					if($getAuthority_id->num_rows() >0)
					{	
						$authority_id = $getAuthority_id->result_array()[0]['authority_id'];
						if($authority_id==1)
						{
							return $this->getAllDataByCondition("client",array("user_id"=>$user_id))[0]["client_id"];
						}
						else if($authority_id==2)
						{
							return $this->getAllDataByCondition("caregiver",array("user_id"=>$user_id))[0]['caregiver_id'];
						}
						else if($authority_id==4)
						{
							return $this->getAllDataByCondition("agency",array("user_id"=>$user_id))[0]["agency_id"];
						}
						else
						{
							return "0";
						}
					}
					else
					{
						return "0";
					}
				/*}
				else
				{
					return "0";
				}*/
		}
		else
		{
			return "0";
		}
	}

	public function distance($lat1, $lon1, $lat2, $lon2, $unit) 
    {
	      $theta = $lon1 -$lon2;
	      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	      $dist = acos($dist);
	      $dist = rad2deg($dist);
	      $miles = $dist * 60 * 1.1515;
	      $unit = strtoupper($unit);

	      if ($unit == "K") 
	      {
	          return ($miles * 1.609344);
	      }
	      else if ($unit == "N") 
	      {
	          return ($miles * 0.8684);
	      }
	      else
	      {
	          return $miles;
	      }
    }
    /*public function getJoindData($table1, $table2, $id1, $id2)
    {

	    $this->db->select("*");
	    $this->db->from($table1);
	    $this->db->join($table, '$table1.$id1 = $table2.$id2'); 
	    $query = $this->db->get();
	    if($query->num_rows() >0)
		{
	    	return $query->result();
	    }
	    else
	    {
	    	return "0";
	    }

    }*/	

    // push notification 
    public function push_notification($message,$sender,$fcm_reg_id,$user_type,$action)
	{

	    $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';
 
        // notification title
        
        $title = 'Care App';
         
                  
        // push type - single user / topic
        //$push_type = "this is test";//isset($_GET['push_type']) ? $_GET['push_type'] : '';
         
        // whether to include to image or not
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;

 		$this->push->setUsertype($user_type);
 		$this->push->setAction($action);
        $this->push->setTitle($title);
        $this->push->setMessage($message);
        $this->push->setSender($sender);
      

        if ($include_image) {
            $this->push->setImage('http://api.androidhive.info/images/minion.jpg');
        } else {
            $this->push->setImage('');
        }
        $this->push->setIsBackground(FALSE);
        $this->push->setPayload($payload);

        $json = '';
        $response = '';
 
            $json = $this->push->getPush();
            $regId = $fcm_reg_id;
      
            $response = $this->firebase->send($regId, $json);
           	print_r($response);
       
	}

	public function getCaregiverType($user_id)
	{
		$caregiver_data =  $this->Common_model->getById("caregiver",array("user_id"=>$user_id));			
		$service =  $this->Common_model->getById("service",array("service_id"=>$caregiver_data['service_id']));
		return ($service['type']==1)?'caregiver':(($service['type']==2)?'ambulance':'');
	}

	//solve null problem for single array like array("abc"=>1)
	public function getRowArray($array)
	{ 
	  $localArray=array();
	  foreach ($array as $key => $value) {
	   if ($value=="") {
	    $localArray[$key]="";
	   }else{
	    $localArray[$key]=$value;
	   }
	  }
	  return $localArray;
	}

	//solve null problem for multidimentional array 
	public function getResultArray($array)
	{
	  $globleArray=array();
	  foreach ($array as $key => $value) {
	   $localArray=$this->getRowArray($value);
	   array_push($globleArray, $localArray);
	  }
	  return $globleArray;
	}

} ?>