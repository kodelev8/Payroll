

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Daily Task </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Daily Task</a></li>
				<li class="active">Update Daily Task</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Update Daily Task</h3>
						</div><!-- /.box-header -->
						
						<?= form_open('daily_task/update_daily_task/'.encode($dt_id), array('id' => 'index', 'class'=>'form-horizontal')); ?>
							<div class="box-body">
								<?= bs_inputfield('Employee No: ',	'dt_emp_name',			element('dt_emp_name', 	$record), true,true,'readonly');?> 
								<?= bs_inputfield('Date: ',			'dt_date',				element('dt_date', 		$record), true);?> 
								<?= bs_inputfield('Time In: ',		'dt_time_in',			element('dt_time_in', 	$record), true);?> 
								<?= bs_inputfield('Time Out: ',		'dt_time_out',			element('dt_time_out', 	$record), true);?> 
								<?= bs_inputfield('Remarks: ',		'dt_remarks',			element('dt_remarks', 	$record), true);?> 
								<?= bs_inputfield_hidden('dt_emp_no',element('dt_emp_no', 	$record), true)?>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<div class="form-actions">
									<div class="col-sm-2 "></div>
									<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
									<a href="<?=base_url('daily_task');?>" class="btn btn-primary">Cancel</a>
								</div>
							</div>
						<?= form_close();?>	
						
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

