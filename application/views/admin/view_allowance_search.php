
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>  Employees allowance </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employees allowance</a></li>
				<li class="active">View Employees allowance</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">View Employees allowance</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label>
											<?php if($allowance_count>10):?>
												<?= form_open('allowance/view_allowance_scan/', array('id' => 'frm_allowance_view', 'class'=>'form-horizontal')); ?>
													<select name="allowance_per_page" id="allowance_per_page" size="1" aria-controls="example1">
														<?php foreach ($allowance_num_rows as $numrows):?>
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
								<?= form_open('allowance/view_allowance_searched/', array('id' => 'frm_allowance_search', 'class'=>'form-horizontal')); ?>
									<input type="hidden" name="hid_allowance_search" id="hid_allowance_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="allowance_search" id="allowance_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div> 
							<table id="" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Employee Name</th>
										<th>Allowance Amount</th>
										<th>Date of Allowance</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(count($allowance)>0):?>
											<?php foreach ($allowance as $allowance):?>
												<tr>
													<td><?= $allowance->Allowance_Emp_Name;?></td> 
													<td><?= $allowance->Allowance_Amount;?></td> 
													<td><?= date("d-m-Y", strtotime($allowance->Allowance_Date));?></td> 			
													<td>
														<a href="<?=base_url('allowance/update_allowance/'.encode($allowance->Allowance_ID));?>"><i class="fa fa-fw fa-edit"></i></a>|
														<a href="<?=base_url('allowance/delete_allowance/'.encode($allowance->Allowance_ID));?>"><i class="fa fa-fw fa-trash-o"></i></a>
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
									<th>Allowance Amount</th>
									<th>Date of Allowance</th>
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
