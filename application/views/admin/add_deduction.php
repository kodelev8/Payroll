

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Employees Deduction
		<!--             <small>Preview</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Employees Deduction</a></li>
			<li class="active">Add Employees Deduction</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
				<div class="box-header">
				<h3 class="box-title">Add Employees Deduction</h3>
				</div><!-- /.box-header -->


				<div class="box-body">

					<?= form_open('deduction/add_deduction', array('id' => 'index', 'class'=>'form-horizontal')); ?>
					<div class="form-group">
						<label class="control-label col-sm-2" for="">Employee Name: </label>
						<div class="col-sm-3 ">
							<select name="deduction_emp_no" id="emp_name" class="form-control" >
								<?php foreach($get_emp_info as $user):?>
									<option value="<?=$user->emp_no;?>"<?= $user->emp_no == $deduction_emp_no ? 'selected="selected"': ''; ?>><?= $user->emp_last_name .', ' .$user->emp_first_name .' ' .$user->emp_mid_name?></option>
								<?php endforeach; ?>  	
							</select>
						</div>
					</div>
					<?= bs_inputfield('Deduction Amount: ',			'deduction_amount',				element('deduction_amount', $record), true);?> 
					<?= bs_inputfield('Deduction Description: ',	'deduction_description',		element('deduction_description', $record), true);?> 
					<?= bs_inputfield('Deduction Date: ',			'deduction_date',				element('deduction_date', $record), true);?> 


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

