
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>  Employees Leave </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employees Leave</a></li>
				<li class="active">View Employees Leave</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">View Employees Leave</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label>
											<?php if($leave_count>10):?>
												<?= form_open('leave/view_leave_scan/', array('id' => 'frm_leave_view', 'class'=>'form-horizontal')); ?>
													<select name="leave_per_page" id="leave_per_page" size="1" aria-controls="example1">
														<?php foreach ($leave_num_rows as $numrows):?>
															<option value="<?=$numrows->NumRows;?>" <?= $numrows->Active== 1 ? 'selected="selected"': '';?>><?=$numrows->NumRows;?></option>
														<?php endforeach;?>	
													</select>
													records per page
												<?= form_close();?>	
											<?php else:?>
											<?php endif;?>	
										</label>
									</div>
								</div>
								<?= form_open('leave/view_leave_searched/', array('id' => 'frm_leave_search', 'class'=>'form-horizontal')); ?>
									<input type="hidden" name="hid_leave_search" id="hid_leave_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="leave_search" id="leave_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div> 
							<table id="" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Employee Name</th>
										<th>Date of Leave</th>
										<th>Leave Type</th>
										<th>Reason</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php if(count($leave)>0):?>
									<?php foreach ($leave as $emp_leave):?>
										<tr>
											<td><?= $emp_leave->leave_emp_name;?></td> 
											<td><?= date("d-m-Y", strtotime($emp_leave->leave_date));?></td> 
											<td><?= $emp_leave->leave_type;?></td> 
											<td><?= $emp_leave->leave_reason;?></td>
											<?php $leave_id = $emp_leave->leave_id;?>				
											<td>
												<a href="<?=base_url('leave/update_leave/'.encode($leave_id));?>"><i class="fa fa-fw fa-edit"></i></a>|
												<a href="<?=base_url('leave/delete_leave/'.encode($leave_id));?>"><i class="fa fa-fw fa-trash-o"></i></a>
											</td>
										</tr>
									<?php endforeach;?>
								<?php else:?>
										<tr>
											<td>No Record Found!</td>
										</tr>
								<?php endif;?>
								</tbody>
								<tfoot>
									<tr>
									<th>Employee Name</th>
									<th>Date of Leave</th>
									<th>Leave Type</th>
									<th>Reason</th>
									<th>Action</th>
									</tr>
								</tfoot>
							</table>
							<div class="row">
								<div class="col-xs-4"></div>
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
