
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
								<?= form_open('timesheets/timesheets_process/', array('id' => 'frm_ts', 'class'=>'form-horizontal')); ?>
									
									<div class="col-xs-6 col-md-3">
										<div id="example1_length" class="dataTables_length">
											<label class="control-label col-sm-4" for="">Date From: </label>
												<input name="ts_date_from"  id='ts_date_from' placeholder="yyyy-mm-dd" required="required" >
	
										</div>
									</div>
									<div class="col-xs-6 col-md-3">
										<div id="example1_length" class="dataTables_length">
											<label class="control-label col-sm-4" for="">Date To: </label>
												<input name="ts_date_to"  id='ts_date_to' placeholder="yyyy-mm-dd" required="required" >
	
										</div>
									</div>
									<div class="col-xs-6 col-md-3">
									<?php if($check_ts_record==1):?>
										<div class="form-group has-error">
										   <label class="control-label" for="inputError3">No Records Available</label>
										</div>
									<?php endif;?>
									</div>
								
<!-- 									<input type="hidden" name="hid_dtr_search" id="hid_dtr_search"> -->
								<?//=form_close(); ?>
<!-- 								<div class="col-xs-6 col-md-3"> -->
<!-- 									<div id="example1_filter" class="dataTables_filter"> -->
<!-- 										<label> -->
<!-- 										Search: <input type="text" name="dtr_search" id="dtr_search" aria-controls="example1"> -->
<!-- 										</label> -->
<!-- 									</div> -->
<!-- 								</div> -->
							</div>		
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
									<div class="dataTables_filter" style="margin-top:5px;">
										<button type="submit" id='btn_ts_process' class="btn btn-primary" name="btn-process" value="add">Process</button>	
									</div>
								</div>
								<?=form_close(); ?> 
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
