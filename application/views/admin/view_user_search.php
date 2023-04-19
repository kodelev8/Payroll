
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1> Users </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Users</a></li>
				<li class="active">View Users</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
						<h3 class="box-title">View Users</h3> 
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div id="example1_length" class="dataTables_length">
										<label>
											<?php if($user_count>10):?>
												<?= form_open('user/view_user_searched/', array('id' => 'frm_user_searched', 'class'=>'form-horizontal')); ?>
													<select name="user_per_page_search" id="user_per_page_search" size="1" aria-controls="example1">
														<?php foreach ($user_num_rows as $numrows):?>
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
								<?= form_open('user/view_user_searched/', array('id' => 'frm_user_search', 'class'=>'form-horizontal')); ?>
									<input type="hidden" name="hid_user_search" id="hid_user_search">
								<?=form_close(); ?>
								<div class="col-xs-6">
									<div id="example1_filter" class="dataTables_filter">
										<label>
										Search: <input type="text" name="user_search" id="user_search" aria-controls="example1">
										</label>
									</div>
								</div>
							</div> 
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>User #</th>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Suffix Name</th>
										<th>Position</th>
										<th>Email Address</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(count($user>0)):?>
										<?php foreach ($user as $user):?>
											<tr>
												<td><?= $user->user_no;?></td>
												<td><?= $user->user_last_name;?></td>
												<td><?= $user->user_first_name;?></td>
												<td><?= $user->user_suffix_name;?></td>
												<td><?= $user->user_position;?></td>
												<td><?= $user->user_email;?></td>
												<td>
													<a href="<?=base_url('user/update_user/'.encode($user->user_id)); ?>">
														<i class="fa fa-fw fa-edit"></i>
													</a>|
													<a href="<?=base_url('user/delete_user/'.encode($user->user_id)); ?>">
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
										<th>User #</th>
										<th>Last Name</th>
										<th>First Name</th>
										<th>Suffix Name</th>
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
