
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			Employees
			<!-- <small>Preview</small> -->
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employees</a></li>
				<li class="active">Add Employee</li>
			</ol>
		</section>
	
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						<h3 class="box-title">Add Employee</h3>
						</div><!-- /.box-header -->
						<div class="row">
							<div class="col-md-6">
								<?= form_open_multipart('employee/add_employee', array('id' => 'index', 'class'=>'form-horizontal')); ?>
								<div class="box-body">
									<?php 
						
										echo bs_inputfield_id('Employee Number: ', 			'emp_no', 					element('emp_no', 				$record), true,true,'readonly');
						
									?>
										<div class="form-group" id="add_emp_form">
											<label class="control-label col-sm-2" for="">Picture: </label>
											<div class="col-sm-3">
												<input type="file" name="userfile" id="add_emp_input"/>
											</div>
										</div>
									<?php 
										echo bs_inputfield_id('First Name: ', 		'emp_first_name', 			element('emp_first_name',		$record), true);
										echo bs_inputfield_id('Middle Name: ', 		'emp_mid_name', 			element('emp_mid_name',			$record), true);
										echo bs_inputfield_id('Last Name: ', 		'emp_last_name', 			element('emp_last_name',		$record), true);
										echo bs_inputfield_id('Suffix Name: ', 		'emp_suffix_name', 			element('emp_suffix_name',		$record), true);
									?>
										<div class="form-group" id="add_emp_form">
											<label class="control-label col-sm-2" for="">Position: </label>
											<div class="col-sm-3 ">
												<select name="emp_position" id="emp_position" class="form-control" onchange="get_last_empno();">
												<?php foreach($get_emp_position as $emp):?>
													<option value="<?=$emp->position_no ;?>" <?= $emp->position_no==$emp_position_no ? 'selected="selected"': '';?>><?=$emp->position;?></option>
												<?php endforeach; ?>  	
												</select>
											</div>
										</div>
									<?php 
										echo bs_inputfield_id('Contact Number: ',				'emp_contact', 				element('emp_contact',			$record), true);
										echo bs_inputfield_id('Address: ',						'emp_address', 				element('emp_address',			$record), true);
										echo bs_inputfield_id('Email Address: ',				'emp_email', 				element('emp_email',			$record), true);
										echo bs_inputfield_id('Wages per Day: ',				'emp_wages', 				element('emp_wages',			$record), true);
									?>
						
								</div><!-- /.box-body -->
						
							</div>
							<div class="col-md-4">
								<div class="box box-primary">
									<div class="box-body box-profile">
										<center>
											<img class="profile-user-img img-responsive img-circle" id="image_emp" src="<?=base_url('images').'/pictures/thumb_default.png';?>" alt="User profile picture">
										</center>   
									</div> 
								</div> 
							</div>
						</div>		
						

						<div class="box-footer"> 
							<div class="form-actions">
								<div class="col-sm-2 "></div>
								<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
								<a href="<?=base_url('employee');?>" class="btn btn-primary">Cancel</a>
							</div>
						</div>
						<?= form_close();?>	
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

