
			<div class="main-content">                
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li>
								<a href="#">Users Manager</a>
							</li>
							<li class="active">Users</li>
						</ul><!-- /.breadcrumb -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->
					</div>
				     <div class="page-content">
						<div class="page-header">
							<h1>
							  Users Manager
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i> Users List
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
						<div class="row mkr">

							<div class="col-xs-12">

								<!-- PAGE CONTENT BEGINS -->

								<div class="row">

									<div class="col-xs-12">
                                       <div id="fade_out">
										<?php if ($this->session->flashdata('message')) { ?>
											<div class="alert alert-success">
											  <?php echo $this->session->flashdata('message'); ?>										
											</div>
										<?php	}  ?>
                                        <?php if ($this->session->flashdata('success')) { ?>
											<div class="alert alert-success">
											  <?php echo $this->session->flashdata('success'); ?>										
											</div>
										<?php	}  ?>
                                        <?php if ($this->session->flashdata('error')) { ?>
											<div class="alert alert-danger">
											  <?php echo $this->session->flashdata('error'); ?>										
											</div>
										<?php	}  ?>
                                     </div>


										<div class="table-header">
											 Users List 
										</div>
										<div class="post-search-panel">
										    	<div class="">
												  <input type="text"  id="keywords"  placeholder="Enter Item Name" onkeyup="searchFilter()"/>

													<select id="sortBy"  onchange="searchFilter()">
														<option value="">Sort By Price</option>
														<option value="asc">Ascending</option>
														<option value="desc">Descending</option>
													</select>

												</div>
											</div>


	<div id="Item_table">
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
	</div>

									</div>

								</div>

								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->

						</div><!-- /.row -->

			     	</div>	

			    </div>

		    </div>


<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script>
setTimeout(function(){ $(".alert").fadeOut(); }, 2000);
setTimeout(function(){ $("#fade_out").fadeOut(); }, 2000);
</script>

<style type="text/css">
    .dataRequired ,.error{
        color: red;
    }
</style>
<!-- style for pagignation -->
<style>
    .row{position: relative;}
    .post-list{ 
        margin-bottom:20px;
    }
    div.list-item {
        border-left: 4px solid #7ad03a;
        margin: 5px 15px 2px;
        padding: 1px 12px;
        background-color:#F1F1F1;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        height: 60px;
    }
    div.list-item p {
        margin: .5em 0;
        padding: 2px;
        font-size: 13px;
        line-height: 1.5;
    }
    .list-item a {
        text-decoration: none;
        padding-bottom: 2px;
        color: #0074a2;
        -webkit-transition-property: border,background,color;
        transition-property: border,background,color;-webkit-transition-duration: .05s;
        transition-duration: .05s;
        -webkit-transition-timing-function: ease-in-out;
        transition-timing-function: ease-in-out;
    }
    .list-item a:hover{text-decoration:underline;}
    .list-item h2{font-size:25px; font-weight:bold;text-align: left;}

    /* search & filter */
    .post-search-panel input[type="text"]{
        width: 220px;
        height: 28px;
        color: #333;
        font-size: 16px;
    }
    .post-search-panel select{
        height: 34px;
        color: #333;
        font-size: 16px;
    }

    /* Pagination */
    div.pagination {
        font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
        padding:2px;
        margin: 20px 10px;
        float: right;
    }

    div.pagination a {
        margin: 2px;
        padding: 0.5em 0.64em 0.43em 0.64em;
        background-color: #FD1C5B;
        text-decoration: none; /* no underline */
        color: #fff;
    }
    div.pagination a:hover, div.pagination a:active {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #FD1C5B;
        color: #fff;
    }
    div.pagination span.current {
            padding: 0.5em 0.64em 0.43em 0.64em;
            margin: 2px;
            background-color: #f6efcc;
            color: #6d643c;
        }
    div.pagination span.disabled {
            display:none;
        }
    .pagination ul li{display: inline-block;}
    .pagination ul li a.active{opacity: .5;}

    /* loading */
    .loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
    .loading .content {
        position: absolute;
        transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        top: 50%;
        left: 0;
        right: 0;
        text-align: center;
        color: #555;
    }
</style>	

<script>
    function searchFilter(page_num) {
        page_num = page_num?page_num:0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/Users_Manager/ajax_Users/'+page_num,
            data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
            beforeSend: function () {
                $('.loading').show();
            },
            success: function (html) {
                $('#Item_table').html(html);
                $('.loading').fadeOut("slow");
            }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".productDescription").hide();
        $(".show_hide").show();
        $('.show_hide').click(function(){
        $(".productDescription").slideToggle();
        return false;
        });
    });
</script>
 

 <script src="<?php echo base_url() ?>assets/mkr_js/jquery.validate.js"></script>
<script type="text/javascript">
    $("#myForm").validate({
        rules: {
            service_name: "required",  
        },
        messages: {
            service_name: "Please provide Service Name",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script> 

<script type="text/javascript">
    // change item status
    $(document).on('click','.changeStatus',function(){
        var status=$(this).val();
        var id=$(this).attr('id');
        var self1=this;
        $.ajax({
            url: '<?php echo base_url(); ?>change_status_users',
            data: ({ id: id,status: status}),
            dataType: 'text', 
            type: 'post',
            success: function(data) {
                if (data==1) {                  
                    if(status==1){status=0;}else{status=1;}
                    $(self1).val(status);
                }
            }             
        });
    }); 
    setTimeout(function(){ $(".alert").fadeOut(); }, 2000);

    

</script>
<script type="text/javascript">
    function myfunction2(cc,value,tt){
                swal({

                    title: "Confirmation",

                    text: "Are you sure to delete ?",

                    type: "warning",

                    showCancelButton: true,

                    confirmButtonColor: "#DD6B55",

                    confirmButtonText: "Confirm ",

                    cancelButtonText: "Cancel",

                    closeOnConfirm: false,

                    closeOnCancel: true

                    },
                function(isConfirm){

                            if (isConfirm) {

                                $.ajax({

                                    url: '<?php echo base_url();  ?>delete_Users',

                                    data: ({cc: cc,value: value,tt: tt}),

                                    dataType: 'text', 

                                    type: "post",

                                    success: function(data){  
                                            
                                                    if (data==1) {

                                                        swal('Deleted!','Your file has been deleted.','success')

                                                        location.reload();

                                                    }else{
                                                        swal('Your file has not been deleted.')

                                                    }

                                            } 

                                });

                            } 

                    });

    }
</script>

