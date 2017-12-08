

			<div class="main-content">

				<div class="main-content-inner">

					

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="">
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div class="space-12"></div>
											<div>
												<?php 
												  $src=($userData['profile_pic']=="")?'assets/images/logo_new_2.png':'uploads/profile_pic/'.$userData['profile_pic'];

												 ?>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Alex's Avatar" src="<?php echo base_url().$src; ?>"></img>
												</span>

												<div class="space-4"></div>

												
											</div>

											<div class="space-6"></div>

											

											<div class="hr hr12 dotted"></div>

										</div>

										<div class="col-xs-12 col-sm-9">
											<a href="Profile" class="btn btn-light active" style="float: right;">Back to Profile Detail</a>
<form  id="myForm" action="<?php echo base_url(); ?>update_profile" enctype="multipart/form-data" method="POST">
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> User Name </div>

													<div class="profile-info-value">
														<span class="editable editable-click" id="username">
												<input type="text" name="user_name" id="user_name" value="<?php echo $userData['user_name']; ?>" >
                                                <input type="hidden" name="hidden_image" value="<?php echo $userData['profile_pic']; ?>">
                                               
                                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $userData['user_id']; ?>">
														</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> User Email </div>

													<div class="profile-info-value">
														
														<span class="editable editable-click" id="country"><input type="text" name="email_id" id="email_id" value="<?php echo $userData['email_id']; ?>" ></span>
														
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> User Phone </div>

													<div class="profile-info-value">
														<span class="editable editable-click" id="age"><input type="text" name="phone" id="phone" value="<?php echo $userData['phone']; ?>" ></span>
													</div>
												</div>

												

												<div class="profile-info-row">
													<div class="profile-info-name">Change Profile  </div>

													<div class="profile-info-value">
														<span class="editable editable-click" id="signup"><input type="file" name="profile_pic" id="profile_pic"  /></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">User Address </div>

													<div class="profile-info-value">
														<span class="editable editable-click" id="signup"><input type="text" name="address" id="address" value="<?php echo $userData['address']; ?>" ></span>
													</div>
												</div>

												
												<input type="submit" class="btn btn-primary" value="Update">

</div>												
											</div>
											
											<div class="space-20"></div>
										</div>
									</div>
								</div>
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
   $("#myForm").validate({
       rules: {
           user_name: "required",            
           email_id: {
	         required: true,
	         email: true
       },
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

<!-- 
<script> 
   var placeSearch, autocomplete;
   
   function initAutocomplete() {     
   	    
   autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')));        
     autocomplete.addListener('place_changed', fillInAddress);
   }
   
   function fillInAddress() {
   
   	$('#latitude').val(autocomplete.getPlace().geometry.location.lat());
   	$('#latitude').val(autocomplete.getPlace().geometry.location.lng());       
   }
   
   
</script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCyEPGzdFnhc-PEEKM0toI9IPTxULu9S8 &libraries=places&callback=initAutocomplete"
   async defer></script> -->
