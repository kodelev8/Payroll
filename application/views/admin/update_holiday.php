

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Holidays</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Holidays</a></li>
				<li class="active">Add Holidays</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Add Holidays</h3>
						</div><!-- /.box-header --> 
						<?= form_open('holiday/update_holiday/'.encode($holiday_id), array('id' => 'index', 'class'=>'form-horizontal')); ?>
							<div class="box-body"> 
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Holiday Type: </label>
									<div class="col-sm-3 ">
										<select name="holiday_type" id="holiday_type" class="form-control" >
											<?php foreach($holiday_type as $hday):?>
												<option value="<?=$hday->hday_type;?>" <?= $hday->hday_type==$hday_type_id ? 'selected="selected"': '';?>><?= $hday->hday_name;?></option>
											<?php endforeach; ?>  	
										</select>
									</div>
								</div> 
								<?= bs_inputfield('Holiday Name: ',	'holiday_name',		element('holiday_name', $record), true);?> 
								<?= bs_inputfield('Holiday Date: ',	'holiday_date',		element('holiday_date', $record), true);?>
							</div><!-- /.box-body --> 
							<div class="box-footer"> 
								<div class="form-actions">
									<div class="col-sm-2 "></div>
									<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
									<a href="<?=base_url('holiday');?>" class="btn btn-primary">Cancel</a>
								</div> 
							</div>
						<?= form_close();?>	
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

