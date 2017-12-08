
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li>
								<a href="#">Change Password</a>
							</li>
						</ul><!-- /.breadcrumb -->

						
					</div>
				     <div class="page-content">
						<div class="page-header">
							<h1>
							  Admin
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i> Change Password
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
						<?php
										if ($this->session->flashdata('message')) { ?>
											<div class="alert alert-success">
											  <?php echo $this->session->flashdata('message'); ?>										
											</div>
										<?php	}  ?>
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
									<form class="form-horizontal" role="form" action="update_password" method="POST" id="myForm">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Old Password </label>

											<div class="col-sm-9">
												<input id="form-field-1" placeholder="Old Password" name="old_password" class="col-xs-10 col-sm-5" type="password">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> New Password </label>

											<div class="col-sm-9">
												<input id="new_password_id" name="new_password" placeholder="New Password" class="col-xs-10 col-sm-5" type="password">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Confirm Password </label>

											<div class="col-sm-9">
												<input id="form-field-2" name="confirm_password" placeholder="Confirm Password" class="col-xs-10 col-sm-5" type="password">
											</div>
										</div>

										<input type="submit" name="submit" value="Submit" class="btn btn-success" style="margin-left: 26%">

										
																				
									</form>
								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div>
								
						
			     	</div>	
			    </div>
		    </div>

<script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/additional-methods.js"></script>
<style type="text/css">
	.error{
		color: red;
	}
</style>
<script type="text/javascript">

setTimeout(function(){ $(".alert").fadeOut(); }, 2000);		
	jQuery(function ($) {

	    $('#myForm').validate({
	        rules: {
	            old_password: {
	                required: true,
	                minlength: 6
	            },
	            new_password: {
	                required: true,
	                minlength: 6
	            },
	            confirm_password: {
	                required: true,
	                minlength: 6,
	                equalTo: "#new_password_id"
	            },

	        },
	        messages: {
	            
	                
	                 old_password: {
		               	required: "Please enter old password ",
	                	minlength: "password should be greater then 6 characters",
		            },
		            new_password: {
		                required: "Please enter new password",
	                	minlength: "password should be greater then 6 characters",
		            },
		            confirm_password: {
		                required: "Please enter confirm password",
	                	minlength: "password should be greater then 6 characters",
	                	equalTo: "new password and confirm Password password are not matched",

		            },
	            
	        },
	    });
	});

	</script>

