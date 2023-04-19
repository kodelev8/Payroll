
			<div class="row">
				<div class="register-logo">
					<a href="<?=base_url('dtrms');?>">
					<b>DTRMS </b>Prechart Software Inc.
					</a>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="box box-solid bg-light-blue-gradient">
					<div class="box-header with-border">
						<i class="fa fa-calendar"></i>
						<h3 class="box-title">Employee Daily Task</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-widget="collapse"data-original-title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
							<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-toggle="tooltip"  data-original-title="Summary" onclick="location.href='<?=base_url('dtrms/index_summary/') ;?>';">
								<i class="icon ion-log-in"></i>
							</button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body" id="summary_tbl">
						<div class="row">
						<?php echo date("d-m-Y", strtotime($dt_from));?>
							<?=form_open('dtrms/main_daily_task', array('class' => 'form-horizontal', 'id'=> 'frm_summary'));?>
								<div class="col-md-3">
									<input class="form-control"  type="text" name="dt_emp_name" value="<?=$record['dt_emp_name'];?>" readonly>
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
								<?= bs_inputfield_hidden('dt_emp_no', element('dt_emp_no', $record))?>
								<?= bs_inputfield_hidden('dt_from', element('dt_from', $record))?>
								<?= bs_inputfield_hidden('dt_to', element('dt_to', $record))?>
							<?=form_close();?>
							
							<?=form_open('daily_task_excel', array('class' => 'form-horizontal', 'id'=> 'frm_daily_task'));?>
								<div class="col-md-1" id="icon-dtr">
									<a href="javascript:;" id="prn-dtr"  name="prn-dtr" onclick="document.forms['frm_daily_task'].submit();" >
										<i class="fa fa-file-excel-o"></i> 
									</a>
								</div>
								<div class="col-md-2">
									<a href="<?=base_url().'dtrms/add_daily_task/'.encode($dt_emp_no).'/'.encode($dt_from);?>" id="add-dt" class="btn btn-block btn-primary">
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
						<div class="row">
							<p></p>
							<div class="col-md-2"></div>
							<div class="col-md-12">
								<table id="example2" class="table table-bordered table-striped" style="color: #333333;">
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
													<td><?= date("d-m-Y", strtotime($dt->dt_date));?></td>
													<td><?=$dt->dt_in;?></td>
													<td><?=$dt->dt_out;?></td>
													<td><?=$dt->dt_remarks;?></td>
													<td><?=$dt->dt_total_log;?></td>
													<td>
														<a href="<?=base_url('dtrms/update_daily_task/'.encode($dt->dt_id));?>">
															<i class="fa fa-fw fa-edit"></i>
														</a> |
														<a id="link_delete" href="<?=base_url('dtrms/delete_daily_task/'.encode($dt->dt_id).'/'.encode($dt_from));?>">
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
							</div>
							<div class="col-md-2"></div>
						</div><!-- /.row -->
					</div><!-- ./box-body -->
					<div class="box-footer bg-light-blue-gradient">
						<div class="row">
							<p></p>
						</div><!-- /.row -->
					</div><!-- /.box-footer -->
					</div><!-- /.box -->

				</div>
				<!-- /.col -->
				<div class="col-md-1"></div>
			</div>
				<div class="example-modal">
					<div id="myModal" class="modal modal-info">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"><?=$dt_modal_title;?></h4>
								</div>
								<div class="modal-body">
									<p><?=$dt_modal_body;?></p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div><!-- /.example-modal -->
				<div class="example-modal">
					<div id="modal_delete" class="modal modal-info">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Delete Daily Task</h4>
								</div>
								<div class="modal-body">
									<p>Are you sure to delete this records?</p>
								</div>
								<div class="modal-footer">
									<a href="#" class="delete-url btn btn-outline pull-right" id="delete_yes">Yes</a>
									<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div><!-- /.example-modal -->
				<!-- /.row (main row) -->
