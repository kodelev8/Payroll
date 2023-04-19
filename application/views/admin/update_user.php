

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Users </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Users</a></li>
				<li class="active">Update Users</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						<h3 class="box-title">Update Users</h3>
						</div><!-- /.box-header -->

						<?= form_open_multipart('user/update_user/'.encode($user_id), array('id' => 'index', 'class'=>'form-horizontal')); ?>
							<div class="box-body"> 
								<?php  
									echo bs_inputfield('User Number: ', 			'user_no', 					element('user_no', 				$record), true,true,'readonly');
								?>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Picture: </label>
									<div class="col-sm-3 ">
										<input type="file" name="userfile" />
									</div>
								</div>
								<?php 
									echo bs_inputfield('First Name: ', 					'user_first_name', 			element('user_first_name',		$record), true);
									echo bs_inputfield('Middle Name: ', 				'user_mid_name', 			element('user_mid_name',			$record), true);
									echo bs_inputfield('Last Name: ', 					'user_last_name', 			element('user_last_name',		$record), true);
									echo bs_inputfield('Suffix Name: ', 				'user_suffix_name', 		element('user_suffix_name',		$record), true);
									echo bs_inputfield('Position: ', 					'user_position', 			element('user_position',			$record), true);
									echo bs_inputfield('Contact Number: ',				'user_contact', 			element('user_contact',			$record), true);
									echo bs_inputfield('Email Address: ',				'user_email', 				element('user_email',			$record), true);
// 									echo bs_inputfield('Password: ',					'user_password', 			element('user_password',			$record), true);
// 									echo bs_inputfield('Confirm Password: ',			'user_email', 				element('user_password',			$record), true);
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

