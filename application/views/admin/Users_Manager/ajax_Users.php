<table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Profile Pic</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Phone</th>
                    <th>Address</th>
                    <th>Created Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($Users_list)){
                  $i=1;
                  foreach ($Users_list as $User_list) {

                    $src=($User_list['profile_pic']=="")?'assets/images/logo_new_2.png':'uploads/profile_pic/'.$User_list['profile_pic'];
                   ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><img width="50px" height="50px" class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="<?php echo base_url().$src; ?>" /> </td>
                    <td><?php echo $User_list['user_name'] ;?> </td>
                    <td><?php echo $User_list['email_id'] ;?> </td>
                    <td><?php echo $User_list['phone'] ;?> </td>
                    <td><?php echo $User_list['address'] ;?> </td>                    
                    <td><?php  echo date('d-M-Y',strtotime($User_list['created_date']) ) ; ?></td>
                    <td>
                        <a class="green" href="<?php echo base_url().'UserAnalysis/'.$User_list['user_id']; ?>"><button class="btn btn-primary">Analysis</button></a>&nbsp
                        <a class="green" href="<?php echo base_url().'edit_Users/'.$User_list['user_id']; ?>"><i class="ace-icon fa fa-pencil bigger-130"></i></a>&nbsp
                        <a class="red" href="#" onclick="myfunction2('user_id',<?php echo $User_list['user_id']; ?>,'hb_users')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                    </td>
                </tr>

            <?php  } }else{ ?>
                <tr>
                    <td colspan="10"><center><strong>No Data Found for this Request</strong></center></td>
               </tr>

                <?php } ?>

            </tbody>

        </table>
    <?php echo $this->ajax_pagination->create_links(); ?>	