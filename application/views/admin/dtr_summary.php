
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
	<!--             Data Tables -->
	<!--             <small>advanced tables</small> -->
	</h1>
	<ol class="breadcrumb">
	<!--             <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->
	<!--             <li><a href="#">Employees</a></li> -->
	<!--             <li class="active">View Employees</li> -->
	</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid bg-light-blue-gradient">
					<div class="box-header with-border">
						<i class="fa fa-calendar"></i>
						<h3 class="box-title">Daily Time Record Monitoring</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-primary btn-sm pull-right"style="margin-right: 5px;" data-widget="collapse" data-original-title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
							<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-toggle="tooltip"  data-original-title="Main" onclick="location.href='<?=base_url().'index.php/dtr/' ;?>';">
								<i class="icon ion-log-in"></i>
							</button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body" id="summary_tbl">
						<div class="row">
							<p></p>
							<?=form_open('dtr/summary', array('class' => 'form-horizontal', 'id'=> 'frm_summary'));?>
							<div class="col-md-3">
								<select class="form-control" name="sel_name" id="sel_name">
									<?php foreach($dtr_get_emp_info as $emp_info):?>
									<?php $emp_name = $emp_info->emp_first_name .' '.$emp_info->emp_last_name; ?>
									<option value="<?=$emp_name;?>"><?=$emp_name;?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" id="month_summary" name="sel_month"> </select>
							</div>
							<div class="col-md-2">
								<select class="form-control" id="year_summary" name="sel_year"> </select>
							</div>
							<?=form_close();?>
							<?=form_open('dtr_pdf', array('class' => 'form-horizontal', 'id'=> 'frm_summarys'));?>
							<div class="col-md-2">
								<button class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="document.forms['frm_summarys'].submit();">
									<i class="fa fa-download"></i>
									Generate PDF
								</button>

								<?php echo bs_inputfield_hidden('hid_sel_name', element('hid_sel_name', $record))?>
								<?php echo bs_inputfield_hidden('hid_sel_month', element('hid_sel_month', $record))?>
								<?php echo bs_inputfield_hidden('hid_sel_year', element('hid_sel_year', $record))?>
							</div>
							<?=form_close();?>
							<div class="col-md-2">
								<button class="btn btn-block btn-primary" onclick="$('#myModal').modal('show');">
									Deduct Leave
								</button>
							</div>
							<?=form_open('dtr/view_post_dtr/', array('method'=>'get','class' => 'form-horizontal', 'id'=> 'frm_dtr_post'));?>
							<div class="col-md-1">							
								<button class="btn btn-block btn-primary <?= ($check_post == 0 or $check_last_post == 1 )? 'disabled': '';?>" onclick="document.forms['frm_dtr_post'].submit();">
									Post
								</button>
								<input type="hidden" name="post_sel_name" value="<?=encode($record['post_sel_name']);?>">
								<input type="hidden" name="post_sel_month" value="<?=encode($record['post_sel_month']);?>">
								<input type="hidden" name="post_sel_year" value="<?=encode($record['post_sel_year']);?>">								
							</div>
							<?=form_close();?>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p></p>
								<table class="table table-bordered table-hover" style="color: #333333;">
									<tr>
										<th>Date</th>
										<th>Log In</th>
										<th>Log Out</th>
										<th>Total Log</th>
										<th>Lunch-Out</th>
										<th>Lunch-In</th>
										<th>Total Lunch</th>
										<th>Total Worked</th>
										<th>Remarks</th>
									</tr>
									<?php foreach($dtr_emp_rec as $rec):?>
									<tr>
										<td><?= $rec['DATE'];?></td>
										<td><?= $rec['LOG IN'];?></td>
										<td><?= $rec['LOG OUT'];?></td>
										<td><?= $rec['TOTAL HRS LOG'];?></td>
										<td><?= $rec['LUNCH BREAK - OUT'];?></td>
										<td><?= $rec['LUNCH BREAK - IN'];?></td>
										<td><?= $rec['TOTAL HRS BREAK'];?></td>
										<td><?= $rec['TOTAL HRS WORKED'];?></td>
										<td><?= $rec['REMARKS']; ?></td>
									</tr>
									<?php endforeach;?>
								</table>
							</div>
						</div> <!-- /.row -->
					</div> <!-- ./box-body -->
					<div class="box-footer bg-light-blue-gradient">
						<div class="row">
							<p></p>
						</div> <!-- /.row -->
					</div> <!-- /.box-footer -->
				</div> <!-- /.box -->
			</div> <!-- /.col -->
			<!-- right col (We are only adding the ID to make the widgets sortable)-->
			<section class="col-lg-6 connectedSortable">
	
				<div class="box box-solid bg-light-blue-gradient">
					<div class="box-header">
						<!-- tools box -->
						<div class="pull-right box-tools">
							<button class="btn btn-primary btn-sm pull-right" data-widget='collapse' style="margin-right: 5px;">
							<i class="fa fa-minus"></i>
							</button>
						</div>
						<!-- /. tools -->
	
						<i class="fa fa-keyboard-o"></i>
						<h3 class="box-title">Computation of Target Days &amp; Hrs</h3>
					</div>
					<div class="box-body" id="summary_tbl">
						<table class="table table-bordered table-hover" style="color: #333333;">
							<tr>
								<td>Total No of Days</td>
								<td class="right"><?=$dtr_emp_header[0]['Total No of Days'];?></td>
							</tr>
							<tr>
								<td><i>less</i></td>
								<td></td>
							</tr>
							<tr>
								<td>- Total No of Day Off</td>
								<td class="right"><?=$dtr_emp_header[0]['Total No of Day Off'];?></td>
							</tr>
							<tr>
								<td>- Total No of Holidays</td>
								<td><?=$dtr_emp_header[0]['Total No of Holidays'];?></td>
							</tr>
							<tr>
								<td>Total No of Target Days</td>
								<td class="right"><?=$dtr_emp_header[0]['Total No of Target Days'];?></td>
							</tr>
							<tr>
								<td><i>multiply by</i></td>
								<td class="right"></td>
							</tr>
							<tr>
								<td>* Total No of Working Hrs/Day</td>
								<td class="right"><?=$dtr_emp_header[0]['Working Hrs Per Day'];?></td>
							</tr>
							<tr>
								<td>Total No of Target Hrs</td>
								<td class="right"><?=$dtr_emp_header[0]['Total No of Target Hrs'];?></td>
							</tr>
						</table>
					</div>
					<!-- /.box-body-->
					<div class="box-footer bg-light-blue-gradient">
						<div class="row">
							<p></p>
						</div>
						<!-- /.row -->
					</div>
				</div>
				<!-- /.box -->
	
				<div class="box box-solid bg-light-blue-gradient">
					<div class="box-header">
						<!-- tools box -->
						<div class="pull-right box-tools">
							<button class="btn btn-primary btn-sm pull-right" data-widget='collapse' style="margin-right: 5px;">
								<i class="fa fa-minus"></i>
							</button>
						</div>
						<!-- /. tools -->
	
						<i class="fa fa fa-keyboard-o"></i>
						<h3 class="box-title">Computation Available Leave</h3>
					</div>
					<div class="box-body" id="summary_tbl">
						<table class="table table-bordered table-hover" style="color: #333333;">
							<tr>
								<td>Total Leave Awarded</td>
								<td class="right"><?= $dtr_emp_getleave[0]['LEAVE AWARDED'] ;?></td>
							</tr>
							<tr>
								<td>add</td>
								<td></td>
							</tr>
							<tr>
								<td>+ Last Year Leave Available</td>
								<td class="right"><?= $dtr_emp_getleave[0]['LAST YEAR LEAVE'] ;?></td>
							</tr>
							<tr>
								<td><i>less</i></td>
								<td></td>
							</tr>
							<tr>
								<td>- Total Leave Taken</td>
								<td class="right"><?= $dtr_emp_getleave[0]['LEAVE TAKEN'] ;?></td>
							</tr>
							<tr>
								<td>- Over/Under Time in Days</td>
								<td class="right"><?= $dtr_emp_getleave[0]['THIS MONTH LEAVE'] ;?></td>
							</tr>
							<tr>
								<td>Total Leave Available</td>
								<td class="right"><?= $dtr_emp_getleave[0]['LEAVE AVAILABLE'] ;?></td>
							</tr>
						</table>
					</div>
					<!-- /.box-body-->
					<div class="box-footer bg-light-blue-gradient">
						<div class="row">
							<p></p>
						</div>
					</div><!-- /.row -->
				</div>
				<!-- /.box -->
	
			</section>		
			<section class="col-lg-6 connectedSortable">
	
				<div class="box box-solid bg-light-blue-gradient">
					<div class="box-header">
						<!-- tools box -->
						<div class="pull-right box-tools">
							<button class="btn btn-primary btn-sm pull-right"
								data-widget='collapse'
								style="margin-right: 5px;">
								<i class="fa fa-minus"></i>
							</button>
						</div>
						<!-- /. tools -->
	
						<i class="fa fa-keyboard-o"></i>
						<h3 class="box-title">Computation Hrs Worked</h3>
					</div>
					<div class="box-body" id="summary_tbl">
						<table class="table table-bordered table-hover" style="color: #333333;">
							<tr>
								<td>Total Hrs Log</td>
								<td class="right"><?=$dtr_emp_header[0]['Total Hrs Log'];?></td>
							</tr>
							<tr>
								<td><i>less</i></td>
								<td></td>
							</tr>
							<tr>
								<td>- Total Hrs Lunch</td>
								<td class="right"><?=$dtr_emp_header[0]['Total Hrs Lunch'];?></td>
							</tr>
							<tr>
								<td>Total Hrs Worked</td>
								<td class="right"><?=$dtr_emp_header[0]['Total Hrs Worked'];?></td>
							</tr>
						</table>
					</div>
					<!-- /.box-body-->
					<div class="box-footer bg-light-blue-gradient">
						<div class="row">
							<p></p>
						</div>
						<!-- /.row -->
					</div>
				</div>
	
				<div class="box box-solid bg-light-blue-gradient">
					<div class="box-header">
						<!-- tools box -->
						<div class="pull-right box-tools">
							<button class="btn btn-primary btn-sm pull-right"
								data-widget='collapse'
								style="margin-right: 5px;">
								<i class="fa fa-minus"></i>
							</button>
						</div>
						<!-- /. tools -->
	
						<i class="fa fa-keyboard-o"></i>
						<h3 class="box-title">Computation of Over/Under Time in Hrs &amp; Days
						</h3>
					</div>
					<div class="box-body" id="summary_tbl">
						<table class="table table-bordered table-hover" style="color: #333333;">
							<tr>
								<td>Total Hrs Worked</td>
								<td class="right"><?=$dtr_emp_header[0]['Total Hrs Worked'];?></td>
							</tr>
							<tr>
								<td id="data" style="font-style: italic; width: 250px;">less</td>
								<td></td>
							</tr>
							<tr>
								<td>- Total No of Target Hrs</td>
								<td class="right"><?=$dtr_emp_header[0]['Total No of Target Hrs'];?></td>
							</tr>
							<tr>
								<td>Over/Under Time in Hrs</td>
								<td class="right"><?=$dtr_emp_header[0]['Total Leave This Month in Hrs'];?></td>
							</tr>
							<tr>
								<td id="data" style="font-style: italic; width: 250px;">divide by</td>
								<td></td>
							</tr>
							<tr>
								<td>&divide; Total No of Working Hrs/Day</td>
								<td class="left"><?=$dtr_emp_header[0]['Working Hrs Per Day'];?></td>
							</tr>
							<tr>
								<td>Over/Under Time in Days</td>
								<td class="left"><?=$dtr_emp_header[0]['Total Leave This Month in Days'];?></td>
							</tr>
						</table>
					</div>
					<!-- /.box-body-->
					<div class="box-footer bg-light-blue-gradient">
						<div class="row">
							<p></p>
						</div>
						<!-- /.row -->
					</div>
				</div>
				<!-- /.box -->
			</section>
			<!-- /.Left col -->
		</div>		
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div  class="example-modal">
	<div id="myModal" class="modal modal-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Leave Deduction</h4>
				</div>
				<div class="modal-body">
					<p></p>
					<p></p>
					<p></p>
					<table>
						<tr width="800px">
							<td width="800px">
								<div class="form-group">
									<label class="control-label col-sm-3" for="">No of Leaves:</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" for="" id="dt_deduct" name="dt_deduct" maxlength="2"/>
									</div>
								</div> 

							</td>
						</tr>
					</table>
					
					<p></p>

					<p></p>					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<?=form_open('dtr/summary_leave_deducted', array('class' => 'form-horizontal'));?>
						<button type="submit" class="btn btn-outline">Save changes</button>
						<?php echo bs_inputfield_hidden('deduct_month', element('deduct_month', $record))?>
						<?php echo bs_inputfield_hidden('deduct_name', element('deduct_name', $record))?>
						<?php echo bs_inputfield_hidden('deduct_year', element('deduct_year', $record))?>
						<?php echo bs_inputfield_hidden('deduct_leave', element('deduct_leave', $record))?>
					<?=form_close();?>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div><!-- /.example-modal -->
