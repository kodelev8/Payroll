
			<div class="row">
				<div class="register-logo">
					<a href="<?=base_url();?>">
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
							<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-toggle="tooltip"  data-original-title="Summary" onclick="location.href='<?=base_url('dtrms/index_summary/');?>';">
								<i class="icon ion-log-in"></i>
							</button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body" id="summary_tbl">
	
						<div class="row">
							<p></p>
							<div class="col-md-2"></div>
							<div class="col-md-12">
														
								<?= form_open('dtrms/add_daily_task/'.encode($record['dt_emp_no']).'/'.encode($record['dt_date']), array('id' => 'index', 'class'=>'form-horizontal')); ?>
								<div class="box-body" style="color:#333;">
								<?= bs_inputfield('Employee Name: ',	'dt_emp_name',			element('dt_emp_name', 		$record), true,true,'readonly');?> 
									<?= bs_inputfield('Date: ',			'dt_date',				element('dt_date', 			$record), true);?> 
									<?= bs_inputfield('Time In: ',		'dt_time_in',			element('dt_time_in', 		$record), true);?> 
									<?= bs_inputfield('Time Out: ',		'dt_time_out',			element('dt_time_out', 		$record), true);?> 
									<?= bs_inputfield('Remarks: ',		'dt_remarks',			element('dt_remarks', 		$record), true);?> 
									<?= bs_inputfield_hidden('dt_emp_no',element('dt_emp_no', 	$record), true)?>
								</div><!-- /.box-body -->
								
								<div class="box-footer">
								
									<div class="form-actions" style="color:#333;">
										<div class="col-sm-2 "></div>
										<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Add Daily Task</button>
										<a href="<?=base_url('dtrms/index_summary');?>" class="btn btn-primary">Cancel</a>
									</div>
								</div>
								
								<?= form_close();?>			                  
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
			