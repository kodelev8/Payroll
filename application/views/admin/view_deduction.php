
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>  Employees Deduction </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employees Deduction</a></li>
				<li class="active">View Employees Deduction</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">View Employees Deduction</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label>
											<?php if($deduction_count>10):?>
												<?= form_open('Deduction/view_Deduction_scan/', array('id' => 'frm_Deduction_view', 'class'=>'form-horizontal')); ?>
													<select name="Deduction_per_page" id="Deduction_per_page" size="1" aria-controls="example1">
														<?php foreach ($deduction_num_rows as $numrows):?>
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
								<?= form_open('Deduction/view_Deduction_searched/', array('id' => 'frm_Deduction_search', 'class'=>'form-horizontal')); ?>
									<input type="hidden" name="hid_Deduction_search" id="hid_Deduction_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="Deduction_search" id="Deduction_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div> 
							<table id="" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Employee Name</th>
										<th>Deduction Amount</th>
										<th>Date of Deduction</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(count($deduction)>0):?>
											<?php foreach ($deduction as $deduction):?>
												<tr>
													<td><?= $deduction->Deduction_Emp_Name;?></td> 
													<td><?= $deduction->Deduction_Amount;?></td> 
													<td><?= date("d-m-Y", strtotime($deduction->Deduction_Date));?></td> 			
													<td>
														<a href="<?=base_url('Deduction/update_Deduction/'.encode($deduction->Deduction_ID));?>" title="edit"><i class="fa fa-fw fa-edit"></i></a>|
														<a href="<?=base_url('Deduction/delete_Deduction/'.encode($deduction->Deduction_ID));?>" title="delete"><i class="fa fa-fw fa-trash-o"></i></a>
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
									<th>Deduction Amount</th>
									<th>Date of Deduction</th>
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
