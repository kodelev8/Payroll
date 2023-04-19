<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?= lang('page_title');?></title>
		<link rel="icon" href="<?=base_url('images/logo.ico'); ?>" type="image/x-icon">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- Bootstrap 3.3.2 -->
		<link href="<?=base_url('css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
		<!-- Font Awesome Icons -->
		<link href="<?=base_url('css/font-awesome.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />  
		<!-- Ionicons 2.0.0 -->
		<link href="<?=base_url('css/ionicons.css');?>" rel="stylesheet" type="text/css" />  
		<!-- DATA TABLES -->
		<link href="<?=base_url('css/plugins/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('css/plugins/datatables/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
		<!--datetimepicker -->
		<link href="<?=base_url('css/bootstrap-datetimepicker.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="<?=base_url('css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from the css/skins 
		folder instead of downloading all of them to reduce the load. -->
		<link href="<?=base_url('css/skins/_all-skins.min.css');?>" rel="stylesheet" type="text/css" />
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
		<div class="wrapper">

			<header class="main-header">
				<!-- Logo -->
					
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<div class="col-md-1"></div>
					<div class="col-md-1">
					<a href="#" data-toggle="offcanvas"> 
						<img src="<?=base_url().'images/icon.png';?>" style="width:350px;height:100px;"/>
					</a>
					</div>
					<!-- Sidebar toggle button-->
<!-- 					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> -->
<!-- 						<span class="sr-only">Toggle navigation</span> -->

<!-- 						<span class="icon-bar"></span> -->
<!-- 						<span class="icon-bar"></span> -->
<!-- 						<span class="icon-bar"></span> -->
<!-- 					</a> -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav" style="margin-top:-10px;">
						<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu" style="padding-top:60px;">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?=base_url().'images/'.$user_picture;?>" class="user-image" alt="User Image"/>
									<span class="hidden-xs"><?=$user_fname.' ' .$user_lname;?></span>
								</a>
								<ul class="dropdown-menu">
								<!-- User image -->
									<li class="user-header" style="background-color:#1E3F74;">
										<img src="<?=base_url().'images/'.$user_picture;?>" class="img-circle" alt="User Image" />
										<p>
											<?=$user_fname.' ' .$user_lname ;?>
											<br>
											<?= $user_position; ?>
<!-- 											<small>Member since Nov. 2012</small> -->
										</p>
									</li> 
									<li class="user-footer">
										<div class="pull-left">
											<a href="<?=base_url('user/change_password/');?>" class="btn btn-default btn-flat">Change Password</a>
										</div>
										<div class="pull-right">
											<a href="<?=base_url('admin/logout');?>" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>

			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<p><p><p><p>
					</div>
					<p><p><p><p>
					<!-- search form -->
<!-- 					<form action="#" method="get" class="sidebar-form"> -->
<!-- 						<div class="input-group"> -->
<!-- 							<input type="text" name="q" class="form-control" placeholder="Search..."/> -->
<!-- 							<span class="input-group-btn"> -->
<!-- 								<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button> -->
<!-- 							</span> -->
<!-- 						</div> -->
<!-- 					</form> -->
					<!-- /.search form -->
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu" style="padding-top:19px;">
					  
						<li class="header">MAIN NAVIGATION</li>
						<li class="<?=$get_treeview->treeview_main;?> treeview">
							<a href="#">
								<i class="fa fa-dashboard"></i> <span>Main</span> <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url('dtr/index');?>"><i class="fa fa-circle-o"></i> Main DTR</a></li> 
							</ul>
						</li>
						<li class="<?=$get_treeview->treeview_user;?> treeview">
							<a href="#">
								<i class="ion ion-android-calendar"></i>
									<span>Users</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">   
									<li><a href="<?=base_url('user');?>"><i class="fa fa-eye"></i> View  Users</a></li>   
									<li><a href="<?=base_url('user/add_user');?>"><i class="fa fa-plus"></i> Add Users</a></li>           
								</ul>
						</li>
						<li class="<?=$get_treeview->treeview_employee;?> treeview">
							<a href="#">
								<i class="fa fa-users"></i>
									<span>Employees</span>
								<i class="fa fa-angle-left pull-right"></i>
							<!-- <span class="label label-primary pull-right">4</span> -->
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url('employee');?>"><i class="fa fa-eye"></i> View Employees</a></li>
								<li><a href="<?=base_url('employee/add_employee');?>"><i class="fa fa-plus"></i> Add Employees</a></li>
							</ul>
						</li>
						
						
<!-- 						<li class=" "> treeview"> -->
<!-- 							<a href="#"> -->
<!-- 								<i class="ion ion-android-calendar"></i> -->
<!-- 									<span>Daily Time Record</span> -->
<!-- 								<i class="fa fa-angle-left pull-right"></i> -->
<!-- 							</a> -->
<!-- 								<ul class="treeview-menu">    -->
<!-- 									<li><a href=""><i class="fa fa-eye"></i> Print DTR Summary</a></li>         -->
<!-- 									<li><a href=""><i class="fa fa-eye"></i> View Daily Time Record</a></li> -->
<!-- 									<li><a href=""><i class="fa fa-plus"></i> Add Daily Time Record</a></li> -->
<!-- 								</ul> -->
<!-- 						</li> -->
						<li class="<?=$get_treeview->treeview_wages;?> treeview">
							<a href="#">
								<i class="fa fa-money"></i>
									<span>Employee Wages</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">   
									<li><a href="<?=base_url('wages');?>"><i class="fa fa-eye"></i> View Wages</a></li>        
									<li><a href="<?=base_url('wages/add_wages');?>"><i class="fa fa-plus"></i> Add Wages</a></li>
								</ul>
						</li>
						<li class="<?=$get_treeview->treeview_allowance;?> treeview">
							<a href="#">
								<i class="fa fa-money"></i>
									<span>Employee Allowance</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">   
									<li><a href="<?=base_url('allowance');?>"><i class="fa fa-eye"></i> View Allowance</a></li>        
									<li><a href="<?=base_url('allowance/add_allowance');?>"><i class="fa fa-plus"></i> Add Allowance</a></li>
								</ul>
						</li>
						<li class="<?=$get_treeview->treeview_deduction;?> treeview">
							<a href="#">
								<i class="ion ion-android-calendar"></i>
									<span>Employee Deduction</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">   
									<li><a href="<?=base_url('deduction');?>"><i class="fa fa-eye"></i> View Employee Deduction</a></li>        
									<li><a href="<?=base_url('deduction/add_deduction');?>"><i class="fa fa-plus"></i> Add Employee Deduction</a></li>
								</ul>
						</li>
						 
						<li class="<?=$get_treeview->treeview_payslips;?> treeview">
							<a href="#">
								<i class="ion ion-android-calendar"></i>
									<span>Employee Payslips</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">   
									<li><a href="<?=base_url('payslips');?>"><i class="fa fa-eye"></i> View Employee Payslips</a></li>   
									<li><a href="<?=base_url('payslips/add_payslip');?>"><i class="fa fa-plus"></i> Add Employee Payslips</a></li>           
								</ul>
						</li>
						
							<li class="<?=$get_treeview->treeview_reports;?> treeview">
							<a href="#">
								<i class="ion ion-android-calendar"></i>
									<span>Reports</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">   
									<li><a href="<?=base_url('report');?>"><i class="fa fa-eye"></i> Generate Reports</a></li>   
								 </ul>
						</li>
						
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
