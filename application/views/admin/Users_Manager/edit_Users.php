
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url(); ?>dashboard">Home</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>add_item">Users Manager</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>add_item">Users</a>
							</li>
							<li class="active">Edit User</li>

						</ul><!-- /.breadcrumb -->					

					</div>



					<div class="page-content">
						<div class="page-header">
							<h1>
								Edit Users Detail
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<div>
									<div id="user-profile-2" class="user-profile">
										<div class="tabbable">
											<ul class="nav nav-tabs padding-18">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														User Detail
													</a>
												</li>												
											</ul>
											<div class="tab-content no-border padding-24">
												<div id="home" class="tab-pane in active">
													<div class="row">
														<div class="col-xs-12 col-sm-3 center">
															<span class="profile-picture">

															<?php 
															 $src=($Users_Data['profile_pic']=="")?'assets/images/logo_new_2.png':'uploads/profile_pic/'.$Users_Data['profile_pic'];

															 ?>
																<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="<?php echo base_url().$src; ?>" />
															</span>

														</div>

														<div class="col-xs-12 col-sm-9">

<form  id="myForm" action="<?php echo base_url(); ?>update_Users" enctype="multipart/form-data" method="POST">
	<div class="profile-user-info">
		<div class="profile-info-row">

			<div class="profile-info-name"> User Name </div>
				<div class="profile-info-value">														<span>
						<input type="text" name="user_name" id="user_name" value="<?php echo $Users_Data['user_name']; ?>" >
						<input type="hidden" name="hidden_image" value="<?php echo $Users_Data['profile_pic']; ?>">
					</span>
				</div>
			</div>

			<div class="profile-info-name"> User Email </div>
				<div class="profile-info-value">														<span>
						<input type="text" name="email_id" id="email_id" value="<?php echo $Users_Data['email_id']; ?>" >
					</span>
				</div>
			</div>
			<div class="profile-info-name"> User Phone </div>
				<div class="profile-info-value">														<span>
						<input type="text" name="phone" id="phone" value="<?php echo $Users_Data['phone']; ?>" >
					</span>
				</div>
			</div>
			<div class="profile-info-name"><!--  User City --> </div>
				<!-- <div class="profile-info-value">														<span>

						<select name="city_id" id="city_id" required="required">
							<option value="">Select City</option>
							<?php foreach ($Cities as $City) { ?>
							<option value="<?php echo $City['city_id']; ?>" 
								<?php echo $City['city_id']==$Users_Data['city_id']?'selected':'';  ?> ><?php echo $City['city_name']; ?></option>
						<?php 	}?>
						</select>

					</span>
				</div> -->
			</div>

			<div class="profile-info-name"> Change Profile  </div>
				<div class="profile-info-value">														<span>
						<input type="file" name="profile_pic" id="profile_pic"  />
					</span>
				</div>
			</div>
			<div class="profile-info-name"> User Address </div>
				<div class="profile-info-value">														<span>
						<textarea name="address" id="address"><?php echo $Users_Data['address']; ?></textarea>
					</span>
				</div>
			</div>
			
		</div>
		<br>
		<input type="hidden" id="user_id" name="user_id" value="<?php echo $Users_Data['user_id']; ?>">
		<button type="submit" class="btn btn-primary" name="update">Update</button>
	</form>
														</div><!-- /.col -->

													</div><!-- /.row -->



												</div><!-- /#home -->



												


												
												

													
											</div>

										</div>

									</div>

								</div>





								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->

						</div><!-- /.row -->

					</div><!-- /.page-content -->

				</div>

			</div><!-- /.main-content -->


<script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/jquery.validate.js"></script>

<style type="text/css">
	.error{
		color: red;
		font-family: initial;
	}
</style>

<script type="text/javascript">
    $("#myForm").validate({
        rules: {
            user_name: "required",            
            email_id: {
				      required: true,
				      email: true
				    },
            city_id: "required",
            address: "required",
            phone:{
                    required: true,
                    number:true,
                    maxlength: 15,
                    minlength: 10,
                    },
        },
        messages: {
            user_name: "Please provide User name",
            email_id:{
                    required: "Please provide email id",
                    email:"Please provide valid email"
                    },
            city_id: "Please select city name",
            address: "Please provide address",
            phone:{
                    required: 'Please provide phone number"',
                    number:"Please provide valid number",
                    maxlength: 'Maximum length 15 digits allowed',
                    minlength: 'Minimum length 10 digits required',
                    },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script> 



