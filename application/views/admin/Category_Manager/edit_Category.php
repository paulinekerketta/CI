
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url(); ?>dashboard">Home</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>add_item">Category Manager</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>add_item">Add Category</a>
							</li>
							<li class="active">Edit item</li>

						</ul><!-- /.breadcrumb -->					

					</div>



					<div class="page-content">
						<div class="page-header">
							<h1>
								Edit Category Detail
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
														Category Detail
													</a>
												</li>												
											</ul>
											<div class="tab-content no-border padding-24">
												<div id="home" class="tab-pane in active">
													<div class="row">
														

														<div class="col-xs-12 col-sm-9">

<form  id="myForm" action="<?php echo base_url(); ?>update_Categorys" enctype="multipart/form-data" method="POST">
	<div class="profile-user-info">
		<div class="profile-info-row">
			

			<div class="profile-info-name"> Category Name </div>
				<div class="profile-info-value">														<span>
						<input type="text" name="category_name" id="category_name" value="<?php echo $Category_Data['category_name']; ?>" >
					</span>
				</div>
			</div>
			
			<div class="profile-info-row">
				<div class="profile-info-name"> Category Word </div>
					<div class="profile-info-value">
						<span>
							<textarea name="search_word"  id="search_word" ><?php echo trim($Category_Data['search_word'],",") ; ?></textarea>
						</span>
					</div>
				</div>
			</div>

		</div>
		<br>
		<input type="hidden" id="category_id" name="category_id" value="<?php echo $Category_Data['category_id']; ?>">
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
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/mkr_js/additional-methods.js"></script> -->

<style type="text/css">

	.error{

		color: red;
		font-family: initial;

	}

</style>


<!-- style for category dropdown -->
<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
    .addInput {
        border: 1px solid #000;
        padding: 0px 4px!important;
        margin-top: 5px;
    }
    i.btn.btn-primary.addbtnspec.btn-spical {
        padding: 4px 10px;
    }
    i.btn.btn-primary.btn-spical.minisbtn {
        padding: 4px 10px;
    }
    .addData{
        margin-top: 10px;
    }
    .addData input {
        padding: 4px 25px;
    }
</style>


<script>
	$(document).ready(function() {
		//for open a dropdown
		$( ".profile-info-row .editDropdown" ).click(function() {
		 	if ($(this).attr('class') == 'dropdown editDropdown open') {		 		
				$(this).removeAttr('class');
			 	$( this ).attr( "class","dropdown editDropdown" );
		 	}else{
		 		$(this).removeAttr('class');
			 	$( this ).attr( "class","dropdown editDropdown open" );
		 	}
		});
		
		//to slide menu and sub menu
	    $( '.dropdown5' ).hover(
	        function(){
	            $(this).children('.sub-menu5').slideDown(200);
	        },
	        function(){
	            $(this).children('.sub-menu5').slideUp(200);
	        }
	    );

	    // set hidden category id and cate
	    $('.dropdown-menu li a').on('click',function(){
            var $this = $(this);
            var parent_ids=$(this).attr('parent_ids');  
            $('#category_id').val(parent_ids);
            $('#category_name').val($this.text());

        })

        $('.top-parent').click(function(){
          $('#category_name').val('Parent');
        });
	}); 
</script>



<script type="text/javascript">
    $("#myForm").validate({
        rules: {
            item_name: "required",            
            unit_name: "required",
            item_description: "required",
            item_price:{
                    required: true,
                    number:true,
                    },
        },
        messages: {
            item_name: "Please provide item name",
            item_price:{
                    required: "Please provide item price",
                    number:"Please provide valid amount"
                    },
            unit_name: "Please provide unit name",
            item_description: "Please provide item description",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script> 



