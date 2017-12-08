	<div class="footer">
		<div class="footer-inner">
			<div class="footer-content">
				<span class="bigger-120">
					<span class="blue bolder">Human Behaviour</span>
					Application &copy; 2017-2018
				</span>
				&nbsp; &nbsp;
			</div>
		</div>
	</div>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
       	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
       	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap_second.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-clockpicker.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/select_by_search.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/buttons.colVis.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.select.min.js"></script>
		<!-- ==================================================== -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.index.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js"></script>
 		

		<script type="text/javascript">
	       jQuery(document).ready(function(){
	         jQuery('.nav li').click(function(){
	             var num=jQuery(this).index( ".nav-list >li" );
	            if(num >=0){
	             jQuery.cookie("example", num);
	            }
	         });
	             var open=jQuery.cookie("example");
	             var show=parseInt(open)+parseInt(1);
	             jQuery('.nav-list> li:nth-child('+show+')').attr({"class":"open"});
	       });
		</script>

		<script>
    // function myfunction(cc,value,tt){
    //             swal({

    //                 title: "Confirmation",

    //                 text: "Are you sure to delete ?",

    //                 type: "warning",

    //                 showCancelButton: true,

    //                 confirmButtonColor: "#DD6B55",

    //                 confirmButtonText: "Confirm ",

    //                 cancelButtonText: "Cancel",

    //                 closeOnConfirm: false,

    //                 closeOnCancel: true

    //                 },
    //             function(isConfirm){

    //                         if (isConfirm) {

    //                             $.ajax({

    //                                 url: '<?php echo base_url();  ?>delete_Sports',

    //                                 data: ({cc: cc,value: value,tt: tt}),

    //                                 dataType: 'text', 

    //                                 type: "post",

    //                                 success: function(data){  

    //                                                 if (data==1) {

    //                                                     swal('Deleted!','Your file has been deleted.','success')

    //                                                     location.reload();

    //                                                 }else{

    //                                                     swal('failed!','Your file has not been deleted.','failed')

    //                                                 }

    //                                         } 

    //                             });

    //                         } 

    //                 });

    // }
  setTimeout(function(){ $(".alert").fadeOut(); }, 2000);
</script>
	</body>
</html>

