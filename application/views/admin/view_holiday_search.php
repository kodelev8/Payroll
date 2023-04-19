
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1> Holidays </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Holidays</a></li>
				<li class="active">View Holidays</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Holidays</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label>
											<?php if($holiday_count>10):?>
												<?= form_open('holiday/view_holiday_searched/', array('id' => 'frm_holiday_searched', 'class'=>'form-horizontal')); ?>
													<select name="holiday_per_page_search" id="holiday_per_page_search" size="1" aria-controls="example1">
														<?php foreach ($holiday_num_rows as $numrows):?>
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
								<?= form_open('holiday/view_holiday_searched/', array('id' => 'frm_holiday_search', 'class'=>'form-horizontal')); ?>
									<input type="hidden" name="hid_holiday_search" id="hid_holiday_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="holiday_search" id="holiday_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div> 
							<table id="" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Holiday Name</th>
										<th>Holiday Type</th>
										<th>Date of Holiday</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if (count($holiday) > 0 ): ?>
										<?php foreach ($holiday as $hday):?>
											<tr>
												<td><?= $hday->hday_remarks;?><?php echo substr_count("'''''", "'")?></td> 
												<td><?= $hday->hday_type;?></td> 
												<td><?= date("d-m-Y", strtotime($hday->hday_date));?></td> 
												<?php $hday_id = $hday->hday_id;?>				
												<td>
													<a href="<?=base_url('holiday/update_holiday/'.encode($hday_id));?>"><i class="fa fa-fw fa-edit"></i></a>|
													<a href="<?=base_url('holiday/delete_holiday/'.encode($hday_id));?>"><i class="fa fa-fw fa-trash-o"></i></a>
												</td>
											</tr>
										<?php endforeach;?>
									<?php else:?>
											<tr>
												<td colspan="5">
													No Record Found!
												<td>
											</tr>
									<?php endif;?>
								</tbody>
								<tfoot>
									<tr>
										<th>Holiday Name</th>
										<th>Holiday Type</th>
										<th>Date of Holiday</th>
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
