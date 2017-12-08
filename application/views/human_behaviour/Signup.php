<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta charset="utf-8" />
      <title>Signup - Human Behaviour </title>
      <meta name="description" content="User login page" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
      <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-part2.min.css" />
      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
       <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css" />
      <link rel="icon" href="<?php echo base_url();?>assets/images/logo_new_2.png" type="image/png" sizes="16x16">
      <style type="text/css">
         .error{
            color: red;
         }
         .formError{
            color: red;
         }
      </style>
   </head>
   <body class="login-layout" id="login-human">
      <div class="main-container">
         <div class="main-content">
            <div class="row">
               <div class="col-sm-10 col-sm-offset-1">
                  <div class="login-container">
                     <div class="center">
                        <h4 class="blue" id="id-company-text">
                        </h4>
                     </div>
                     <div class="space-6"></div>
                     <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                           <div class="widget-body">
                              <div class="widget-main">
                                 <h4 class="header blue lighter bigger">
                                    <i class="ace-icon fa fa-coffee green"></i>
                                     Signup
                                     <span class="pull-right"><i class="ace-icon fa fa-home green"></i> <a href="<?php echo base_url(); ?>" class="btn btn-primary btn-xs">Home</a></span>
                                 </h4>
                                 <div class="fade_out">
                                    <?php if($this->session->flashdata('success')){?>
                                    <div class="alert alert-success">
                                       <?php echo $this->session->flashdata('success'); ?>
                                    </div>
                                    <?php }if($this->session->flashdata('error')){?>
                                    <div class="alert alert-danger">
                                       <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                    <?php  } ?>
                                 </div>
                                 <div class="space-6"></div>
                                 <form method="post" id="myForm" action="<?php echo base_url();?>UserSignup">

                                    <fieldset>
                                       <label class="block clearfix">
                                       <span class="block input-icon input-icon-right">User Name : 
                                       <input type="text" class="form-control"  name="user_name" id="user_name"  placeholder="Username" /><span class="formError"><?php echo form_error('user_name'); ?></span>
                                       </span>
                                       </label>
                                       <label class="block clearfix">
                                       <span class="block input-icon input-icon-right">Email :
                                       <input type="text" class="form-control"  name="email_id" id="email_id" placeholder="Emain ID" /><span class="formError"><?php echo form_error('email_id'); ?></span>
                                       </span>
                                       </label>
                                        <label class="block clearfix">
                                       <span class="block input-icon input-icon-right">Phone No :
                                       <input type="text" class="form-control"  name="phone" id="phone" placeholder="Phone No" /><span class="formError"><?php echo form_error('phone'); ?></span>
                                       </span>
                                       </label>
                                       <label class="block clearfix">
                                       <span class="block input-icon input-icon-right">Password :
                                       <input type="password" class="form-control"  name="password" id="password" placeholder="Password" /><span class="formError"><?php echo form_error('phone'); ?></span>
                                       </span>
                                       </label>
                                       <label class="block clearfix">
                                       <span class="block input-icon input-icon-right">Confirm Password :
                                       <input type="password" class="form-control"  name="cpassword" id="cpassword" placeholder="Confirm Password" /><span class="formError"><?php echo form_error('cpassword'); ?></span>
                                       </span>
                                       </label>
                                       <div class="space"></div>
                                       <div class="clearfix">
                                          <button type="submit" class="width-35 pull-left btn btn-sm btn-primary">
                                          <i class="ace-icon fa fa-key"></i>
                                          <span class="bigger-110">Submit</span>
                                          </button>
                                          <label class="inline">
                                             I have already an account <a href="<?php echo base_url('Login'); ?>">Login</a>
                                          </label>
                                       </div>
                                       <div class="space-4"></div>
                                    </fieldset>
                                 </form>
                              </div>
                              <!-- /.widget-main -->
                              <div class="toolbar clearfix">
                                 <div>
                                    <!-- <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    I forgot my password
                                    </a> -->
                                 </div>
                              </div>
                           </div>
                           <!-- /.widget-body -->
                        </div>
                        <!-- /.login-box -->
                        <div id="forgot-box" class="forgot-box widget-box no-border">
                           <div class="widget-body">
                              <div class="widget-main">
                                 <h4 class="header red lighter bigger">
                                    <i class="ace-icon fa fa-key"></i>
                                    Retrieve Password
                                 </h4>
                                 <div class="space-6"></div>
                                 <p>
                                    Enter your email and to receive instructions
                                 </p>
                                 <form method="post" action="<?php echo base_url();?>_forgot_password">
                                    <fieldset>
                                       <label class="block clearfix">
                                       <span class="block input-icon input-icon-right">
                                       <input type="email" name="email" class="form-control" placeholder="Email" required/>
                                       <i class="ace-icon fa fa-envelope"></i>
                                       </span>
                                       </label>
                                       <div class="clearfix">
                                          <button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
                                          <i class="ace-icon fa fa-lightbulb-o"></i>
                                          <span class="bigger-110">Send Me!</span>
                                          </button>
                                       </div>
                                    </fieldset>
                                 </form>
                              </div>
                              <!-- /.widget-main -->
                              <div class="toolbar center">
                                 <a href="#" data-target="#login-box" class="back-to-login-link">
                                 Back to login
                                 <i class="ace-icon fa fa-arrow-right"></i>
                                 </a>
                              </div>
                           </div>
                           <!-- /.widget-body -->
                        </div>
                        <!-- /.forgot-box -->
                     </div>
                     <!-- /.position-relative -->
                  </div>
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </div>
         <!-- /.main-content -->
      </div>
      <!-- /.main-container -->
      <!-- basic scripts -->
      <!--[if !IE]> -->
      <script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
      <!-- <![endif]-->
      <!--[if IE]>
      <script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
      <![endif]-->
      <script type="text/javascript">
         if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
         
      </script>
      <!-- inline scripts related to this page -->
      <script type="text/javascript">
         jQuery(function($) {
         
          $(document).on('click', '.toolbar a[data-target]', function(e) {
         
         	e.preventDefault();
         
         	var target = $(this).data('target');
         
         	$('.widget-box.visible').removeClass('visible');//hide others
         
         	$(target).addClass('visible');//show target
         
          });
         
         });
         
         	jQuery(function($) {
         
                   setTimeout(function() {
         
         		$('.fade_out').fadeOut('fast');
         
         	}, 5000);
         
         });
         
         
         
         
         
         //you don't need this, just used for changing background
         
         jQuery(function($) {
         
          $('#btn-login-dark').on('click', function(e) {
         
         	$('body').attr('class', 'login-layout');
         
         	$('#id-text2').attr('class', 'white');
         
         	$('#id-company-text').attr('class', 'blue');
         
         	
         
         	e.preventDefault();
         
          });
         
          $('#btn-login-light').on('click', function(e) {
         
         	$('body').attr('class', 'login-layout light-login');
         
         	$('#id-text2').attr('class', 'grey');
         
         	$('#id-company-text').attr('class', 'blue');
         
         	
         
         	e.preventDefault();
         
          });
         
          $('#btn-login-blur').on('click', function(e) {
         
         	$('body').attr('class', 'login-layout blur-login');
         
         	$('#id-text2').attr('class', 'white');
         
         	$('#id-company-text').attr('class', 'light-blue');
         
         	
         
         	e.preventDefault();
         
          });
         
          
         
         });
         
      </script>
   </body>
</html>

<script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/jquery.validate.js"></script>

<script type="text/javascript">
    $("#myForm").validate({
        rules: {
            user_name: "required",            
            email_id: {
                    required: true,
                    email: true
                    },
            password: {
                    required: true,
                    minlength: 6,
                    },
             phone: {
                    required: true,
                    minlength: 10,
                    },
            cpassword:{
                    required: true,
                    minlength: 6,
                    equalTo: "#password"                    
                    },
        },
        messages: {
            user_name: "Please provide User Name",
            email_id:{
                    required: "Please provide Email ID",
                    email: "Please provide valid Email ID"
                    },
            password: {
                    required: "Please provide password",
                    minlength: "Minmum length of password is 6 digits",
                    },
            phone: {
                    required: "Please provide Phone Number",
                    minlength: "Phone number must be 10 digit",
                    },
            cpassword: {
                    required: "Please provide confirm password",
                    minlength: "Min length of password is 6 digits",
                    equalTo: "password and confirm password does't match"                    
                    },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script> 