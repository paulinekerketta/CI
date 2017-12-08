   <div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					</div>
					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
					</div>
				</div><!-- /.sidebar-shortcuts -->
				<ul class="nav nav-list">
				<!--Dashboard tab-->
					<li class="active">
						<a href="<?php echo base_url(); ?>dashboard">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa  fa-bars"></i>
							<span class="menu-text">Category Manager </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a  href="<?php echo base_url();?>Category">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Category
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user "></i>
							<span class="menu-text">  User Manager  </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url();?>Users">
									<i class="menu-icon fa fa-caret-right"></i>
									Users
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>