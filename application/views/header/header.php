<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?= lang('page_title');?></title>
		<link rel="icon" href="<?= base_url('images/logo.ico'); ?>" type="image/x-icon">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- Bootstrap 3.3.2 -->
		<link href="<?= base_url().'css/bootstrap.min.css';?>" rel="stylesheet" type="text/css" />    
		<!-- FontAwesome 4.3.0 -->
		<link href="<?=base_url().'css/font-awesome.css';?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url().'css/font-awesome.min.css';?>" rel="stylesheet" type="text/css" />  
		<!-- Ionicons 2.0.0 -->
		<link href="<?=base_url().'css/ionicons.css';?>" rel="stylesheet" type="text/css" />   

		<!-- Theme style -->
		<link href="<?= base_url().'css/AdminLTE.min.css';?>" rel="stylesheet" type="text/css" />
		<!-- AdminLTE Skins. Choose a skin from t
		he css/skins 
		 folder instead of downloading all of them to reduce the load. -->
		<link href="<?= base_url().'css/skins/_all-skins.min.css';?>" rel="stylesheet" type="text/css" />
		<!-- iCheck -->
		<link href="<?= base_url().'css/plugins/iCheck/flat/blue.css';?>" rel="stylesheet" type="text/css" />
		<!-- Morris chart -->
		<link href="<?= base_url().'css/plugins/morris/morris.css';?>" rel="stylesheet" type="text/css" />
		<!-- jvectormap -->
		<link href="<?= base_url().'css/plugins/jvectormap/jquery-jvectormap-1.2.2.css';?>" rel="stylesheet" type="text/css" />
		<!-- Date Picker -->
		<link href="<?= base_url().'css/plugins/datepicker/datepicker3.css';?>" rel="stylesheet" type="text/css" />
		<!-- Daterange picker -->
		<link href="<?= base_url().'css/plugins/daterangepicker/daterangepicker-bs3.css';?>" rel="stylesheet" type="text/css" />
		<!-- bootstrap wysihtml5 - text editor -->
		<link href="<?= base_url().'css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css';?>" rel="stylesheet" type="text/css" />
		<style>
			.example-modal .modal {
			position: relative;
			top: auto;
			bottom: auto;
			right: auto;
			left: auto;
			display: block;
			z-index: 1;
			}
			.example-modal .modal {
			background: transparent!important;
			}
		</style>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="skin-blue">
		<div class="wrapper">

			<header class="main-header">
				<!-- Logo -->
				<a href="<?=base_url().'index.php/welcome/'?>" class="logo">DTRMS</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>

						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?=base_url().'images'.$user_picture;?>" class="user-image" alt="User Image"/>
									<span class="hidden-xs"><?=$user_fname.' ' .$user_lname;?></span>
								</a>
								<ul class="dropdown-menu">
								<!-- User image -->
									<li class="user-header">
										<img src="<?=base_url().'images'.$user_picture;?>" class="img-circle" alt="User Image" />
										<p>
											<?=$user_fname.' ' .$user_lname ;?>
											<br>
											<?= $user_position; ?>
											<small>Member since Nov. 2012</small>
										</p>
									</li>
									<!-- Menu Body -->
									<li class="user-body">
										<div class="col-xs-4 text-center">
											<a href="#">Followers</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Sales</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Friends</a>
										</div>
									</li>
								<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?=base_url().'index.php/admin/logout'?>" class="btn btn-default btn-flat">Sign out</a>
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
						<div class="pull-left image">
							<img src="<?=base_url().'images'.$user_picture;?>" class="img-circle" alt="User Image" />
						</div>
						<div class="pull-left info">
							<p><?=$user_fname.' ' .$user_lname;?></p>

							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
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
					<ul class="sidebar-menu">
						<li class="header">MAIN NAVIGATION</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
								<li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-users"></i>
									<span>Employees</span>
								<i class="fa fa-angle-left pull-right"></i>
							<!-- <span class="label label-primary pull-right">4</span> -->
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url().'index.php/employee';?>"><i class="fa fa-eye"></i> View Employees</a></li>
								<li><a href="<?=base_url().'index.php/employee/add_employee';?>"><i class="fa fa-plus"></i> Add Employees</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar"></i>
									<span>Employees Leave</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url().'index.php/leave';?>"><i class="fa fa-eye"></i> View Employees Leave</a></li>
								<li><a href="<?=base_url().'index.php/leave/add_leave';?>"><i class="fa fa-plus"></i> Add Employees Leave</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="ion ion-android-calendar"></i>
									<span>Holidays</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url().'index.php/holiday';?>"><i class="fa fa-eye"></i> View Holidays</a></li>
								<li><a href="<?=base_url().'index.php/holiday/add_holiday/';?>"><i class="fa fa-plus"></i> Add Holidays</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="ion ion-android-calendar"></i>
									<span>Daily Time Record</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">
									<li><a href="<?=base_url().'index.php/dtr/';?>"><i class="fa fa-plus"></i>Daily Time Record</a></li>              
									<li><a href="<?=base_url().'index.php/dtr/view_dtr';?>"><i class="fa fa-eye"></i> View Daily Time Record</a></li>
									<li><a href="<?=base_url().'index.php/dtr/add_dtr/';?>"><i class="fa fa-plus"></i> Add Daily Time Record</a></li>
								</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="ion ion-android-calendar"></i>
									<span>Daily Task</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
								<ul class="treeview-menu">
									<li><a href="<?=base_url().'index.php/daily_task/';?>"><i class="fa fa-plus"></i>View Daily Task</a></li>              
									<li><a href="<?=base_url().'index.php/daily_task/add_daily_task/';?>"><i class="fa fa-plus"></i> Add Daily Daily Task</a></li>
								</ul>
						</li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
