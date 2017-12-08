<?php include ('include/header.php') ?>
<div class="main-content">
   <div class="main-content-inner">
      <div class="breadcrumbs ace-save-state" id="breadcrumbs">
         <ul class="breadcrumb">
            <li>
               <i class="ace-icon fa fa-home home-icon"></i>
               <a href="dashboard">Home</a>
            </li>
            <li class="active">Dashboard</li>
         </ul><!-- /.breadcrumb -->         
      </div>
      <div class="page-content">
         <div class="page-header">
            <h1>
               Dashboard
               <small>
               <i class="ace-icon fa fa-angle-double-right"></i>
               overview &amp; stats
               </small>
            </h1>
         </div>
         <!-- /.page-header -->
         <div class="row">
            <div class="col-xs-12">
               <div class="fade_out">
                  <?php if($this->session->flashdata('success')){ ?>
                  <div class="alert alert-block alert-success">
                     <button type="button" class="close" data-dismiss="alert">
                     <i class="ace-icon fa fa-times"></i>
                     </button>
                     <?php echo $this->session->flashdata('success'); ?>
                  </div>
                  <?php } ?>	
                  <?php if($this->session->flashdata('error')){ ?>
                  <div class="alert alert-block alert-danger">
                     <button type="button" class="close" data-dismiss="alert">
                     <i class="ace-icon fa fa-times"></i>
                     </button>
                     <?php echo $this->session->flashdata('error'); ?>
                  </div>
                  <?php } ?>	
               </div>
               <div class="row">
                  <div class="space-xl-6"></div>
                  <!-- <div class="infobox infobox-blue">
                     <div class="infobox-icon">
                        <i class="ace-icon fa fa-users"></i>
                     </div>
                     <div class="infobox-data">
                        <span class="infobox-data-number"><?php echo 1; ?></span>
                        <div class="infobox-content"> Total Users</div>
                     </div>
                  </div> -->
                  <div class="infobox infobox-pink">
                     <div class="infobox-icon">
                        <i class="ace-icon fa fa-user-plus"></i>
                     </div>
                     <div class="infobox-data">
                        <span class="infobox-data-number"><?php echo ($users!=0)?count($users):0; ?></span>
                        <div class="infobox-content">Total Users</div>
                     </div>
                  </div>
                  <div class="vspace-12-sm"></div>
               </div>
            </div>           
         </div>
      </div>
   </div>
</div>
</div><!-- /.main-content -->
<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script>
   $(function($) {
              setTimeout(function() {
   			$('.fade_out').fadeOut('fast');
   		}, 3000);
   	});
</script>	
<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.colVis.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>
<script>
   function myfunction(){
   
   			swal({
   
   				title: "Confirmation",
   
   				text: "Are you sure to delete Agency? if agency deleted it's caregiver will auto deactivated",
   
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
   
   							var agency_id=$('#hidden_agency_id').val();
   
   							$.ajax({
   
   
   
   								url: '<?php echo base_url();  ?>deleteAgency',
   
   								data: ({agency_id: agency_id}),
   
   								dataType: 'text', 
   
   								type: "post",
   
   								success: function(data){  
   
   												if (data==1) {
   
   													swal('Deleted!','Your file has been deleted.','success')
   
   													location.reload();
   
   												}else{
   
   													swal('failed!','Your file has not been deleted.','failed')
   
   												}
   
   										} 
   
   							});
   
   						} 
   
   				});
   
   }
   
   
   
   
   
     setTimeout(function(){ $(".alert").fadeOut(); }, 2000);
   
   
</script>
<script>
   function searchFilter(page_num) {
       page_num = page_num?page_num:0;
       var keywords = $('#keywords').val();
       var sortBy = $('#sortBy').val();
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url(); ?>admin/Dashboard/ajaxPaginationData/'+page_num,
           data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
           beforeSend: function () {
               $('.loading').show();
           },
           success: function (html) {
               $('#userList').html(html);
               $('.loading').fadeOut("slow");
           }
       });
   }
</script>
<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/loader.js"></script>
<?php include ('include/footer.php') ?>	
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
   height: 32px;
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
<script type="text/javascript">
   $('.agencyStatus').on('click',function(){
   	var Status=$(this).val();
   	var user_report_id=$(this).attr('id');
   	var self1=this;
   	$.ajax({
           url: '<?php echo base_url(); ?>update_user_report_Status',
           data: ({ user_report_id: user_report_id,Status: Status}),
           dataType: 'text', 
           type: 'post',
           success: function(data) {	        	
           	if (data==1) {	        		
           		if(Status==1){Status=0;}else{Status=1;}
   	        	$(self1).val(Status);
           	}
           }             
       });
   
   });
   
</script>