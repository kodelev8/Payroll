<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?=lang('page_title');?></title>
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
						<a href="<?=base_url('dtrms/main_index');?>">
							<img src="<?=base_url().'images/icon.png';?>" style="width:350px;height:100px;"/>
						</a>
					</div> 
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav" style="margin-top:-10px;">
						<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu" style="padding-top:60px;">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?=base_url().'images'.$user_picture;?>" class="user-image" alt="User Image"/>
									<span class="hidden-xs"><?=$user_fname.' ' .$user_lname;?></span>
								</a>
								<ul class="dropdown-menu">
								<!-- User image -->
									<li class="user-header" style="background-color:#1E3F74;">
										<img src="<?=base_url().'images'.$user_picture;?>" class="img-circle" alt="User Image" />
										<p>
											<?=$user_fname.' ' .$user_lname ;?>
											<br>
											<?= $user_position; ?>
<!-- 											<small>Member since Nov. 2012</small> -->
										</p>
									</li> 
									<li class="user-footer">
										<div class="pull-left">
											<a href="#" class="btn btn-default btn-flat">Profile</a>
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