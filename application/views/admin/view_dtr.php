
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
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label>
											<?= form_open('dtr/view_dtr_scan/', array('id' => 'frm_dtr_view', 'class'=>'form-horizontal')); ?>
												<select name="dtr_per_page" id="dtr_per_page" size="1" aria-controls="example1">
													<?php foreach ($dtr_num_rows as $numrows):?>
														<option value="<?=$numrows->NumRows;?>" <?= $numrows->Active== 1 ? 'selected="selected"': '';?>><?=$numrows->NumRows;?></option>
													<?php endforeach;?>	
												</select>
												records per page
											<?= form_close();?>	
										</label>
									</div>
								</div>
								<?= form_open('dtr/view_dtr_searched/', array('id' => 'frm_dtr_search', 'class'=>'form-horizontal')); ?>
									<input type="hidden" name="hid_dtr_search" id="hid_dtr_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="dtr_search" id="dtr_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div>
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Emp #</th>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Option Name</th>
										<th>Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(count($dailytimerecord)>0):?>
										<?php foreach ($dailytimerecord as $dtr):?>
											<tr>
												<td><?= $dtr->row;?></td> 
												<td><?= $dtr->ts_last_name;?></td> 
												<td><?= $dtr->ts_first_name;?></td> 
												<td><?= $dtr->ts_mid_name;?></td>
												<td><?= $dtr->ts_option_name;?></td>
												<td><?= $dtr->ts_time;?></td>
												<td>
													<a href="<?= base_url('/dtr/update_dtr/'.encode($dtr->ts_id));?>">
														<i class="fa fa-fw fa-edit"></i>
													</a>|
													<a href="<?= base_url('/dtr/delete_dtr/'.encode($dtr->ts_id));?>">
														<i class="fa fa-fw fa-trash-o"></i>
													</a>
												</td>
											</tr>
										<?php endforeach;?>
									<?php else:?>
										<tr><td>No record found!</td></tr>
									<?php endif;?>
								</tbody>
								<tfoot>
									<tr>
										<th>Emp #</th>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Position</th>
										<th>Email Address</th>
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
