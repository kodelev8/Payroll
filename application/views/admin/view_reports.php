
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1> Reports </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#"> Reports </a></li>
				<li class="active">Generate  Reports</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
						<h3 class="box-title">Generate  Reports</h3> 
						</div><!-- /.box-header -->
						<div class="box-body"> 
							<?= form_open('report/', array('id' => 'frm_emp_search', 'class'=>'form-horizontal')); ?>
								<div class="row"> 
									<div class="col-xs-6 col-sm-3"></div>
									<div class="col-xs-6 col-sm-3">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name="option" value="employee_no" id="employee_no">
											</span>
											<select name="report_emp_no" id="report_emp_no" size="1" aria-controls="example1" style="height:40px;width:80%;"> 												 
												<?php foreach ($list_emp_no as $report_empno):?>
													<option value="<?=$report_empno->emp_no;?>" ><?=$report_empno->emp_name;?></option>
												<?php endforeach;?>	
											</select>
										</div> 
									</div>
									<div class="col-xs-6 col-sm-3">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name="option" value="employee_position" id="employee_position">
											</span>
											<select name="report_emp_position" id="report_emp_position" size="1" aria-controls="example1" style="height:40px;width:80%;"> 
												<?php foreach ($list_emp_position as $report_position):?>
													<option value="<?=$report_position->position_no;?>" ><?=$report_position->position;?></option>
												<?php endforeach;?>	 
											</select>
										</div> 
									</div>
									<div class="col-xs-6 col-sm-3"> </div> 
								
								</div>
								<div class="row" style="margin-top:50px; ">
									<div class="col-xs-6 col-sm-3"> </div>
									<div class="col-xs-6 col-sm-3">
										<input class="form-control" name="startdate" style="height:40px;width:82%;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" value="" required>
									</div>
									<div class="col-xs-6 col-sm-3">
										<input class="form-control" name="enddate" style="height:40px;width:82%;" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" value="" required>
									</div>
									<div class="col-xs-6 col-sm-3"> </div>
								</div>
								<div class="row" style="margin-top:50px;">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<center>
											<button type="submit"  class="btn btn-primary" name="btn-report" value="add">Generate Report</button>
										</center>	
									</div>
									<div class="col-md-4"> </div>
								</div>
								
							<?=form_close(); ?>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
