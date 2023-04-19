

			<!-- Right side column. Contains the navbar and content of the page -->
			<div class="content-wrapper">

				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Daily Task
					<!-- <small>advanced tables</small> -->
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Daily Task</a></li>
						<li class="active">View Daily Task</li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">View Daily Task</h3>

								</div><!-- /.box-header -->
								<div class="box-body">
									<div class="row">
										<?=form_open('daily_task', array('class' => 'form-horizontal', 'id'=> 'frm_summary'));?>
											<div class="col-md-3">
												<select class="form-control" id="get_emp_info" name="dt_emp_no">
													<?php foreach ($get_emp_info as $emp):?>
														<option value="<?=$emp->emp_no ?>" <?= $emp->emp_no == $dt_emp_no ? 'selected="selected"': ''; ?>><?=$emp->emp_last_name . ' '.$emp->emp_first_name ;?></option>
													<?php endforeach;?>
												</select>
											</div>
		
											<div class="col-md-2">
												<select class="form-control" id="dt_year" name="dt_year"> </select>
											</div>

											<div class="col-md-2">
												<select class="form-control" id="dt_week" name="dt_week">
													<?php foreach ($getWeekNumbers as $gwn):?>
														<option value="<?=$gwn->weekyear ?>" <?= $gwn->weekyear == $dt_week ? 'selected="selected"': ''; ?>><?=$gwn->weekyear;?></option>
													<?php endforeach;?>
												</select>
											</div>
										<?=form_close();?>
										<?=form_open('daily_task_excel', array('class' => 'form-horizontal', 'id'=> 'frm_daily_task'));?>

											<div class="col-md-1" id="icon-dtr">
												<a href="javascript:;" id="prn-dtr"  name="prn-dtr" onclick="document.forms['frm_daily_task'].submit();" >
													<i class="fa fa-file-excel-o"></i> 
												</a>
											</div>
											<div class="col-md-2">
												<a href="<?=base_url().'daily_task/add_daily_task/'.encode($dt_emp_no);?>" id="add-dt" class="btn btn-block btn-primary">
													<i class="fa fa-fw fa-plus"></i>
													Add Task
												</a>
											</div>
											<input type="hidden" name="hid_dt_emp_no" value="<?=$dt_emp_no;?>">
											<input type="hidden" name="hid_dt_from" value="<?=$dt_from;?>">
											<input type="hidden" name="hid_dt_to" value="<?=$dt_to;?>">
											<input type="hidden" name="hid_dt_week" value="<?=$dt_week;?>">
										
										<?= form_close();?>

									</div>
									<p></p>
									<p></p>
										<table id="example2" class="table table-bordered table-striped">
											<thead>
												<tr> 
													<th>Date</th>
													<th>In</th>
													<th>Out</th>
													<th>Remarks</th>
													<th>Log</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if (count($daily_task)>0):?>
													<?php foreach ($daily_task as $dt):?>
													<tr>
														<td><?=  date("d-m-Y", strtotime($dt->dt_date));?></td>
														<td><?= $dt->dt_in;?></td>
														<td><?= $dt->dt_out;?></td>
														<td><?= $dt->dt_remarks;?></td>
														<td><?= $dt->dt_total_log;?></td>
														<td>
															<a href="<?=base_url('daily_task/update_daily_task/'.encode($dt->dt_id)); ?>">
																<i class="fa fa-fw fa-edit"></i>
															</a>|
															<a href="<?=base_url('daily_task/delete_daily_task/'.encode($dt->dt_id)); ?>">
																<i class="fa fa-fw fa-trash-o"></i>
															</a>
														</td>
													</tr>
												<?php endforeach;?>
												<?php else:?>
													<tr>
														<td colspan="6"> No Record Found!</td >
													</tr>
												<?php endif;?>
											</tbody>
											<tfoot>
												<tr>
													<th>Date</th>
													<th>In</th>
													<th>Out</th>
													<th>Remarks</th>
													<th>Log</th>
													<th>Action</th>
												</tr>
											</tfoot>
										</table>                  
								</div><!-- /.box-body -->

							</div><!-- /.box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
				<div  class="example-modal">
					<div id="myModal" class="modal modal-info">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">No Daily Task Records</h4>
								</div>
								<div class="modal-body">
									<p>Unable to download excel file. </p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div><!-- /.example-modal -->

 	