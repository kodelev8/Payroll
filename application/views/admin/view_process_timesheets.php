
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Daily Time Records </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Daily Time Records</a></li>
				<li class="active">View Daily Time Records</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">View Daily Time Records</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body">  	
							<div class="row">
								<?= form_open('timesheets/getTimesheets/', array('id' => 'frm_ts', 'class'=>'form-horizontal')); ?>
									
									<div class="col-md-6">
										<div id="example1_length" class="dataTables_length">
											<label class="control-label col-sm-2" for="">Date From: </label>
												<input name="ts_date"  id='ts_date_from' placeholder="yyyy-mm-dd" value="<?=$ts_date;?>" required="required" >
												<button type="submit" id='btn_ts_process' class="btn btn-primary" name="btn-process" value="add">Get Timesheets</button>	
										</div>
									</div>
								
								<?=form_close(); ?>
								<div class="col-xs-6 col-md-3">
									
								</div>
							</div>	
							<p></p>	
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Emp No</th>
										<th>Hours In</th>
										<th>Hours Out</th>
										<th>Total Hours Log</th>
										<th>Total OT</th>
										<th>Total Normal OT</th>
										<th>Total Night OT</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
								<?php if(count($timesheets)>0):?>
										<?php foreach ($timesheets as $timesheets):?>
											<tr>
												<td><?=$timesheets->TS_Emp_No;?></td>
												<td><?=date('d-m-Y h:m ',strtotime($timesheets->TS_Hours_In));?></td>
												<td><?=date('d-m-Y h:m ',strtotime($timesheets->TS_Hours_Out));?></td>
												<td><?=$timesheets->TS_Total_Hours_Log;?></td>
												<td><?=gmdate('H:i', floor($timesheets->TS_Total_OT * 3600));?></td>
												<td><?=gmdate('H:i', floor($timesheets->TS_Total_Normal_OT * 3600));?></td>
												<td><?=gmdate('H:i', floor($timesheets->TS_Total_Night_OT * 3600));?></td>
												<td><?=date('d-m-Y h:m ',strtotime($timesheets->TS_Date));?></td>
											</tr>
										<?php endforeach;?>
									<?php else:?>
										<tr><td>No record found!</td></tr>
									<?php endif;?>
									
								</tbody>
								<tfoot>
									<tr>
										<th>Emp No</th>
										<th>Hours In</th>
										<th>Hours Out</th>
										<th>Total Hours Log</th>
										<th>Total OT</th>
										<th>Total Normal OT</th>
										<th>Total Night OT</th>
										<th>Date</th>
									</tr>
								</tfoot>
							</table>
							<div class="row">
								<div class="col-xs-4">
								<p></p>
								<?= form_open('timesheets/getTimesheets/', array('id' => 'frm_ts', 'class'=>'form-horizontal')); ?>
									<div class="dataTables_filter" style="margin-top:5px;">
										<input type="hidden" name="ts_date_process"  id='ts_date_from' placeholder="yyyy-mm-dd" required="required" value="<?=$ts_date_process?>" >
										<?php if($ts_proc_btn ==1): ?>
											<button type="submit" id='btn_process' class="btn btn-primary" name="btn_process" value="add">Process</button>	
										<?php endif;?>	
									</div>
								<?= form_close();?>	
								</div>
								<div class="col-xs-8">
									<div class="dataTables_paginate paging_bootstrap">
										<ul class="pagination">
											<?= $links;?>	
										</ul>
									</div>
								</div>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
