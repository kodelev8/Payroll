<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?= lang('page_title');?></title>
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
 
			<div class="content-wrapper"> 
				<header class="main-header"> 
					<nav class="navbar navbar-static-top" role="navigation">
						<div class="col-md-1"></div>
						<div class="col-md-1">
							<a href="#" data-toggle="offcanvas"> 
								<img src="<?=base_url().'images/icon.png';?>" style="width:350px;height:100px;"/>
							</a>
						</div>  
					</nav>
				</header>  
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
						<div class="box-header"> 
						<p></p>
						</div><!-- /.box-header -->
							<div class="box-body">
								<div class="row">
									<div class="login-box">
										<div class="login-logo">
											<a href=""><b>P. Liwanag Construction Company</b></a>
										</div><!-- /.login-logo -->
										<div class="login-box-body">
											<p class="login-box-msg">Sign in to start your session</p>
											<?= form_open('admin/login', array('id' => 'frm_login')); ?>
												<div class="form-group has-feedback">
													<input type="text" name="log_email" class="form-control" placeholder="Email" required/>
													<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
												</div>
												<div class="form-group has-feedback">
													<input type="password" name="log_password" class="form-control" placeholder="Password" required/>
													<span class="glyphicon glyphicon-lock form-control-feedback"></span>
												</div>
												<?php if($error_msg==1):?>
													<div class="alert alert-danger alert-dismissible fade in" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															x
														</button>
														Invalid Username or Password
													</div>
												<?php endif;?>
												<div class="row">
													<div class="col-xs-8">     
														<div class="col-xs-6">
															<button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
														</div><!-- /.col -->
													</div>
					 							</div>
											<?= form_close();?>
										</div><!-- /.login-box-body -->
									</div><!-- /.login-box -->
								</div>
							</div>
						</div>
					</div>
				</div> 
					<footer class="main-footer" style="border-top:0px !important;">
					<p><p><p>
			        </footer> 
			</div> 	
	 
		<!-- jQuery 2.1.3 -->
		<script src="<?=base_url('js/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="<?=base_url('js/bootstrap.min.js');?>" type="text/javascript"></script>
		<!-- iCheck -->
		<script src="<?=base_url('js/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
		<script>
			$(function () {
			$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
			});
			});
		</script>
	</body>
</html>