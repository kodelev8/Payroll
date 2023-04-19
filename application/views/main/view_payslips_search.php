
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Employee Payslips </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employee Payslips</a></li>
				<li class="active">View Employee Payslips</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">View Employee Payslips</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body">   
							<div class="row">
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label> 
											<?php if(count($payslips_num_rows)>10):?>
												<?= form_open('user_payslips/view_payslip_search/', array('id' => 'frm_payslip_view', 'class'=>'form-horizontal')); ?>
													<select name="payslip_per_page" id="payslip_per_page" size="1" aria-controls="example1">
														<?php foreach ($payslips_num_rows as $numrows):?>
															<option value="<?=$numrows->NumRows;?>" <?= $numrows->Active== 1 ? 'selected="selected"': '';?>><?=$numrows->NumRows;?></option>
														<?php endforeach;?>	
													</select>
													records per page
												<?= form_close();?>	 
											<?php endif;?>	
										</label>
									</div>
								</div> 
								<?= form_open('user_payslips/view_payslip_search/', array('id' => 'frm_payslip_search', 'class'=>'form-horizontal')); ?>
									<input type=hidden name="hid_payslip_search" id="hid_payslip_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="payslip_search" id="payslip_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div>	  	
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Emp_Name');?>" class="a_sort">Emp Name</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Base_Pay');?>" class="a_sort">Base Pay</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_OT_Pay');?>" class="a_sort">OT Pay</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Night_OT_Pay');?>" class="a_sort">Night OT Pay</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Total_Pay');?>" class="a_sort">Total Pay</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Sub');?>" class="a_sort">Sub</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Add');?>" class="a_sort">Add</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Date_From');?>" class="a_sort">Date From</a></th>
										<th><a href="<?=base_url('user_payslips/view_payslip_search/0/Ps_Date_To');?>" class="a_sort">Date To</a></th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php if(count($payslips)>0):?>
										<?php foreach ($payslips as $ps):?>
											<tr>
												<td><?=$ps->Ps_Emp_Name;?></td>
												<td><?=round($ps->Ps_Base_Pay,2);?></td>
												<td><?=round($ps->Ps_OT_Pay,2);?></td>
												<td><?=round($ps->Ps_Night_OT_Pay,2);?></td>
												<td><?=round($ps->Ps_Total_Pay,2);?></td>
												<td><?=round($ps->Ps_Sub,2);?></td>
												<td><?=round($ps->Ps_Add,2);?></td>
												<td><?=date('d-m-Y',strtotime($ps->Ps_Date_From));?></td>
												<td><?=date('d-m-Y',strtotime($ps->Ps_Date_To));?></td>
												<td>
													<a href="<?=base_url('user_payslips/print_payslips/'.$ps->Ps_Id);?>" target="_blank"><i class="fa fa-fw fa-print"></i></a>
												</td>
											</tr>
										<?php endforeach;?>
									<?php else:?>
										<tr><td>No record found!</td></tr>
									<?php endif;?>
									
								</tbody>
								<tfoot>
									<tr>
										<th>Emp Name</th>
										<th>Base Pay</th>
										<th>OT Pay</th>
										<th>Night OT Pay</th>
										<th>Total Pay</th>
										<th>Sub</th>
										<th>Add</th>
										<th>Date From</th>
										<th>Date To</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
							<div class="row">
								<div class="col-xs-4">
								<p></p>
								
								</div>
								<div class="col-xs-8">
									<div class="dataTables_paginate paging_bootstrap">
										<ul class="pagination">
											<?=$links;?>	
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

