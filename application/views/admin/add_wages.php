

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
			<li class="active">Add Employees Wages</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Add Employees Wages</h3>
				</div><!-- /.box-header -->


				<div class="box-body">

					<?= form_open('wages/add_wages', array('id' => 'index', 'class'=>'form-horizontal')); ?>
					<div class="form-group">
						<label class="control-label col-sm-2" for="">Employee Name: </label>
						<div class="col-sm-3 ">
							<select name="wages_emp_no" id="wages_emp_no" class="form-control" >
								<?php foreach($get_emp_info as $user):?>
									<option value="<?=$user->emp_no;?>"<?= $user->emp_no == $wages_emp_no ? 'selected="selected"': ''; ?>><?= $user->emp_last_name .', ' .$user->emp_first_name .' ' .$user->emp_mid_name?></option>
								<?php endforeach; ?>  	
							</select>
						</div>
					</div>
					<?= bs_inputfield('Wages Amount Per Hour: ',			'wages_amount_per_hour',	element('wages_amount_per_hour', $record), true);?> 
				
				</div><!-- /.box-body -->

					<div class="box-footer">

						<div class="form-actions">
							<div class="col-sm-2 "></div>
							<button type="submit"  class="btn btn-primary" name="btn-add" id="emp_wages_add" value="add">Save</button>
							<a href="<?=base_url('wages');?>" class="btn btn-primary">Cancel</a>
						</div>
						
					</div>
					<?= form_close();?>	
				</div><!-- /.box ---->
			</div>
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

