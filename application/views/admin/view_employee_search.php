
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1> Employees </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employees</a></li>
				<li class="active">View Employees</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
						<h3 class="box-title">View Employees</h3> 
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label>
											<?php if($employee_count>10):?>
												<?= form_open('employee/view_employee_searched/', array('id' => 'frm_emp_searched', 'class'=>'form-horizontal')); ?>
													<select name="emp_per_page_search" id="emp_per_page_search" size="1" aria-controls="example1">
														<?php foreach ($emp_num_rows as $numrows):?>
															<option value="<?=$numrows->Numrows;?>" <?= $numrows->Active== 1 ? 'selected="selected"': '';?>><?=$numrows->Numrows;?></option>
														<?php endforeach;?>	
													</select>
													records per page
												<?= form_close();?>	
											<?php else:?>
											<?php endif;?>	
										</label>
									</div> 
								</div>
								<?= form_open('employee/view_employee_searched/', array('id' => 'frm_emp_search', 'class'=>'form-horizontal')); ?>
									<input type="hidden" name="hid_emp_search" id="hid_emp_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="emp_search" id="emp_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div> 
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Emp#</th>
										<th>Name</th> 
										<th>Position</th>
										<th>Basic Pay</th> 
										<th>Contact No</th> 
										<th>Address</th> 
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(count($employee>0)):?>
										<?php foreach ($employee as $emp):?>
											<tr>
												<td><?= $emp->emp_no;?></td>
												<td><?= $emp->emp_last_name. ', '.$emp->emp_first_name.' '.$emp->emp_suffix_name;?></td>
												<td><?= $emp->emp_position;?></td>
												<td><?= $emp->emp_wages*8;?></td> 
												<td><?= $emp->emp_contact;?></td>
												<td><?= $emp->emp_address;?></td>
												<td>
													<a href="<?=base_url('employee/update_employee/'.encode($emp->emp_user_id)); ?>">
														<i class="fa fa-fw fa-edit"></i>
													</a>|
													<a href="<?=base_url('employee/delete_employee/'.encode($emp->emp_user_id)); ?>">
														<i class="fa fa-fw fa-trash-o"></i>
													</a>
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
										<th>Emp#</th>
										<th>Name</th> 
										<th>Position</th>
										<th>Basic Pay</th> 
										<th>Contact No</th> 
										<th>Address</th>
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
