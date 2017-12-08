
<div class="main-content">                
	<div class="main-content-inner">	

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-success">
          <?php echo $this->session->flashdata('message'); ?>       
        </div>
    <?php }  ?>

    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger">
          <?php echo $this->session->flashdata('error'); ?>       
        </div>
    <?php }  ?>		     
            
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
                      <a href="edit_User_detail" class="btn btn-light active" style="float: right;">Edit</a>

                      <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                          <div class="profile-info-name"> User Name </div>

                          <div class="profile-info-value">
                            <span class="editable editable-click" id="username"><?php echo $userData['user_name']; ?></span>
                          </div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name"> Email </div>

                          <div class="profile-info-value">
                            
                            <span class="editable editable-click" id="country"><?php echo $userData['email_id']; ?></span>
                            
                          </div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name">Phone </div>

                          <div class="profile-info-value">
                            <span class="editable editable-click" id="signup"><?php echo $userData['phone']; ?></span>
                          </div>
                        </div>

                        <div class="profile-info-row">
                          <div class="profile-info-name">Address </div>

                          <div class="profile-info-value">
                            <span class="editable editable-click" id="signup"><?php echo $userData['address']; ?></span>
                          </div>
                        </div>


                        
                      </div>
                      
                      <div class="space-20"></div>
                    </div>
                  </div>
                </div>
                <!-- PAGE CONTENT ENDS -->

			</div>

     	</div>	

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">


    function mySearch(argument) {
        $.ajax({
      url: '<?php echo 'http://activegrowthinc.com/careApp';  ?>/save_feeling.php',
      data: ({argument: argument}),
      dataType: 'text', 
      type: "post",
      success: function(data){  
              //alert(data);
          } 
    });
        
    }   
 setTimeout(function(){ $(".alert").fadeOut(); }, 2000);
</script>

