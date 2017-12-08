<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 $route['default_controller'] = 'Welcome';


 //========================== WELCOME ===========================================

$route['Signup'] 		       = 'Welcome/Signup';

$route['UserSignup'] 		   = 'Welcome/UserSignup';

$route['index'] 		       = 'Welcome/index';

$route['Login'] 		       = 'Welcome/Login';

$route['UserLogin'] 		   = 'Welcome/UserLogin';

$route['Logout'] 		   	   = 'Welcome/logout';

$route['Profile'] 		   	   = 'Welcome/Profile';

$route['edit_User_detail'] 	   = 'Welcome/edit_User_detail';

$route['update_profile'] 	   = 'Welcome/update_profile';

$route['Analysis'] 		   	   = 'Welcome/Analysis';

$route['Detail/(:any)'] 	   = 'Welcome/Analysis2';




 

//========================== Admin ===========================================

 $route['dashboard'] 			   = 'admin/dashboard';

 $route['admin_login'] 		       = 'admin/Login/index'; 	

 $route['admin'] 		       = 'admin/Login/index'; 	

 $route['adminLogin'] 			   = 'admin/login/adminLogin';				 

 $route['adminLogout'] 			   = 'admin/Login/logout';

 $route['admin_change_password']  = 'admin/Profile/change_password';	

 $route['update_password'] 		 = 'admin/Profile/update_password';

 $route['admin_change_email']     = 'admin/Profile/change_email';		

 $route['update_email'] 		     = 'admin/Profile/update_email';	

$route['admin_forgot_password']	   = 'admin/Login/admin_forgot_password'; 

$route['resetPassword/(:any)']	   = 'admin/Login/get_password';		

$route['resetPassword']			   = 'admin/Login/get_password';		

$route['reset_password']		   = 'admin/Login/change_forgeted_password';

//sport manager

$route['Category']                = 'admin/Category_Manager/Category';     

$route['add_Category']            = 'admin/Category_Manager/add_Category';  

$route['delete_Category']           = 'admin/Category_Manager/delete_Category';  

$route['edit_Category/(:any)']       = 'admin/Category_Manager/edit_Category'; 

$route['update_Categorys']            = 'admin/Category_Manager/update_Categorys'; 

$route['change_status']          = 'admin/Category_Manager/change_status'; 



$route['Users']                = 'admin/Users_Manager/Users';     

$route['change_status_users']            = 'admin/Users_Manager/change_status_users';   

$route['edit_Users/(:any)']       = 'admin/Users_Manager/edit_Users'; 

$route['update_Users']            = 'admin/Users_Manager/update_Users'; 

$route['delete_Users']           = 'admin/Users_Manager/delete_Users';

$route['UserAnalysis/(:any)']  = 'admin/Users_Manager/UserAnalysis';

$route['AnalysisDetail/(:any)'] 	   = 'admin/Users_Manager/AnalysisDetail';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
