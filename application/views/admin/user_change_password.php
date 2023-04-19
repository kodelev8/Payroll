

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Users </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Users</a></li>
				<li class="active">User Password Change</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						<h3 class="box-title">User Password Change</h3>
						</div><!-- /.box-header -->

						<?= form_open_multipart('user/change_password/', array('id' => 'index', 'class'=>'form-horizontal')); ?>
							<div class="box-body"> 
								<?php 
									//echo bs_inputfield_hidden  ('user_no', 				element('user_no',		$record), true);
									echo bs_inputfield_password('Old Password: ',		'user_old_password', 		element('user_old_pasword',		$record), true);
									echo bs_inputfield_password('Password: ',			'user_password', 			element('user_password',		$record), true);
									echo bs_inputfield_password('Confirm Password: ',	'user_confirm_password', 	element('user_confirm_password',$record), true);
								?> 
							</div><!-- /.box-body -->

							<div class="box-footer"> 
								<div class="form-actions">
									<div class="col-sm-2 "></div>
									<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
									<a href="<?=base_url('user');?>" class="btn btn-primary">Cancel</a>
								</div> 
							</div>
						<?= form_close();?>	
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

