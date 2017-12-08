<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Human Behaviour Admin</title>
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ui.jqgrid.min.css" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.cleditor.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-rtl.min.css" />
		<script src="<?php echo base_url()?>assets/js/ace-extra.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-clockpicker.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.fileupload.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.css" type="text/css">
		<link rel="icon" href="<?php echo base_url();?>assets/images/logo_new_2.png" type="image/png" sizes="16x16">
		<style type="text/css">
		.logo-img{
			width: 30px;
			height: 30px;
		}
		</style>
	</head>
	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state jp-nav">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- <div class="navbar-header pull-left">
					<a href="<?php echo base_url()?>index" class="navbar-brand">
						<small>
							<img class="logo-img"src="<?php echo base_url('assets/images/logo_new_2.png')?>" >
							Human Behaviour
						</small>
					</a>
				</div> -->
				<div class="navbar-buttons navbar-header pull-right jp-header-nav" role="navigation">
					<?php if ($this->session->userdata('is_human_user_login')) { ?>
					<ul class="nav ace-nav">	
						<li class="light-blue dropdown-modal">
							<a onclick="myFunctionLogout()" data-toggle="dropdown" href="#" class="dropdown-toggle">
								<?php if (!$this->session->userdata('profile_pic')) { ?>
								 <img class="nav-user-photo" src="<?php echo base_url()?>assets/images/avatars/user.jpg" alt="Jason's Photo" /> 
								<?php } else { ?>
								<img class="nav-user-photo" src="<?php echo base_url()?>uploads/profile_pic/<?php echo $this->session->userdata('profile_pic') ?>" alt="" />
								<?php } ?>
								<span class="user-info">
									<small>Welcome,</small>									
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo(base_url()) ?>">
										Home
									</a>
								</li>
								<li>
									<a href="<?php echo(base_url()) ?>Profile">
										Profile
									</a>
								</li>
								<li>
									<a href="<?php echo(base_url()) ?>Analysis">
										Analysis
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo base_url();?>Logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<?php } else { ?>
					<ul class="nav ace-nav jp-loginSignup">	
						<li class="light-blue">
							<a href="Login">Login</a>							
						</li>
						<li class="light-blue">
							<a href="Signup">Signup</a>							
						</li>
					</ul>
					<?php } ?>
				</div>
			</div><!-- /.navbar-container -->
		</div>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
<input type="hidden" id="checkClick" value="0">
<script type="text/javascript">
	function myFunctionLogout() {
		var checkClick=$('#checkClick').val();
		if (checkClick==0) {
			$('#checkClick').val('1');
		}else{
			$('#checkClick').val('0');
		}
		checkClick=$('#checkClick').val();
		if (checkClick!=0) {
			$('.light-blue').addClass('open');			
		}else{
			$('.light-blue').removeClass('open');
		}
	}
</script>
<!-- end -->