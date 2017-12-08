
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li>
								<a href="#">Change Email</a>
							</li>
						</ul><!-- /.breadcrumb -->

						
					</div>
				     <div class="page-content">
						<div class="page-header">
							<h1>
							  Admin
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i> Change Email
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
									<form class="form-horizontal" role="form" action="update_email" method="POST" id="myForm">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Enter Email </label>

											<div class="col-sm-9">
												<input id="form-field-1" required="required" placeholder="Admin Email" name="admin_email" class="col-xs-10 col-sm-5" type="email" value="<?php echo $admin_email['email_id']; ?>">
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
	            admin_email: {
	                required: true,
	                email: true
	            },

	        },
	        messages: {
	            
		               	required: "Please Enter Email ",
	                	email: "please Enter valid Email",
	        },
	    });
	});

	</script>

