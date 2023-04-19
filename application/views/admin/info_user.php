	<?php 
		$view_identify == '1' ? $user_pic = $user_pic: $user_pic = $info_user[0]->user_picture; 
// 		$user_action == 'Delete' ? $get_l = '': $get_l= encode($info_user[0]->user_user_id);
// 		$user_action == 'Delete' ? $get_r = encode($info_user[0]->user_user_id) : $get_r= '';
	?>

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Users </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Users</a></li>
				<li class="active">Updated User</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">User <?=$user_action; ?></h3>
						</div><!-- /.box-header -->


						<div class="box-body">
							<div class="row">
							<div class="col-md-1"> </div><!-- /.col -->
								<div class="col-md-2">
									<p class="text-center"><strong> </strong></p>
									<p class="text-center"><strong> </strong></p>
									<div class="progress-group">
										<img class="img-thumbnail" alt="User Image" src="<?=base_url('images/Pictures/thumb_'.substr($user_pic,11));?>">
									</div><!-- /.progress-group -->
								</div><!-- /.col -->
								<div class="col-md-6">
									<table class="table ">
										<tr>
										  <td></td>
										  <td>User No:</td>
										  <td><?=$info_user[0]->user_no; ?></td>
										</tr>
										<tr>
										  <td></td>
										  <td>Name</td>
										  <td><?=$info_user[0]->user_first_name .' ' .$info_user[0]->user_mid_name .' ' .$info_user[0]->user_last_name .' '.$info_user[0]->user_suffix_name; ?></td>
										</tr>
										<tr>
										  <td></td>
										  <td>Position:</td>
										 <td><?=$info_user[0]->user_position; ?></td>
										</tr>
										<tr>
										  <td></td>
										  <td>Contact Number:</td>
										  <td><?=$info_user[0]->user_contact; ?></td>
										</tr>
										<tr>
										  <td></td>
										  <td>Email:</td>
										  <td><?=$info_user[0]->user_email; ?></td>
										</tr>
									</table>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->

						<div class="box-footer">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-2">
									<a href="<?=base_url($btn_l);?>"class="btn btn-block btn-primary"><?=$btn_l_name?></a>
								</div>
								<div class="col-md-2">
									<a href="<?=base_url($btn_r);?>"class="btn btn-block btn-primary"><?=$btn_r_name; ?></a>
								</div>
							</div>
						</div>
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

