

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Employees Wages
		<!--             <small>Preview</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Employees Wages</a></li>
			<li class="active">Update Employees Wages</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Update Employees Wages</h3>
				</div><!-- /.box-header -->


				<div class="box-body">

					<?= form_open('wages/update_wages/'.encode($wages_id), array('id' => 'index', 'class'=>'form-horizontal')); ?>
					<?= bs_inputfield('Employee Name: ',		'wages_emp_name',				element('wages_emp_name', $record), true,true,'readonly');?> 
					<?= bs_inputfield('Wages Amount: ',			'wages_amount_per_hour',				element('wages_amount_per_hour', $record), true);?> 

				</div><!-- /.box-body -->

					<div class="box-footer">

						<div class="form-actions">
							<div class="col-sm-2 "></div>
							<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
							<a href="<?=base_url('wages');?>" class="btn btn-primary">Cancel</a>
						</div>
						
					</div>
					<?= form_close();?>	
				</div><!-- /.box ---->
			</div>
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

