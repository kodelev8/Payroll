

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Employees Leave
		<!--             <small>Preview</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Employees Leave</a></li>
			<li class="active">Add Employees Leave</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Add Employees Leave</h3>
				</div><!-- /.box-header -->


				<div class="box-body">

					<?= form_open('leave/add_leave', array('id' => 'index', 'class'=>'form-horizontal')); ?>
					<div class="form-group">
						<label class="control-label col-sm-2" for="">Employee Name: </label>
						<div class="col-sm-3 ">
							<select name="leave_emp_no" id="emp_name" class="form-control" >
								<?php foreach($get_emp_info as $user):?>
									<option value="<?=$user->emp_no;?>"<?= $user->emp_no == $leave_emp_no ? 'selected="selected"': ''; ?>><?= $user->emp_last_name .', ' .$user->emp_first_name .' ' .$user->emp_mid_name?></option>
								<?php endforeach; ?>  	
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="">Leave Type: </label>
						<div class="col-sm-3 ">
							<select name="leave_type" id="leave_type" class="form-control" >
								<?php foreach($get_leave_type as $leave):?>
									<option value="<?= $leave->leave_type;?>" <?= $leave->leave_type==$leave_type ? 'selected="selected"': '';?>><?= $leave->leave_type;?></option>
								<?php endforeach; ?>  	
							</select>
						</div>
					</div>
					<?= bs_inputfield('Leave Date: ',	'leave_date',		element('leave_date', $record), true);?> 
					<?= bs_inputfield('Reason: ',	'leave_reason',		element('leave_reason', $record), true);?> 


				</div><!-- /.box-body -->

					<div class="box-footer">

						<div class="form-actions">
							<div class="col-sm-2 "></div>
							<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
							<a href="<?=base_url('leave');?>" class="btn btn-primary">Cancel</a>
						</div>
						
					</div>
					<?= form_close();?>	
				</div><!-- /.box ---->
			</div>
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

