

			<!-- Right side column. Contains the navbar and content of the page -->
			<div class="content-wrapper"> 
				<!-- Content Header (Page header) -->
				<section class="content-header">
				<h1> Daily Time Record </h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Daily Time Record</a></li>
						<li class="active">Print Daily Time Records Summary</li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
							<div class="box-header">
							<h3 class="box-title">Print Daily Time Records Summary</h3>

							</div><!-- /.box-header -->
								<?=form_open('dtr/dtr_print_summary', array('class' => 'form-horizontal', 'id'=> 'frm_summary'));?>
									<div class="box-body">
										<div class="row">

											<div class="col-md-2">
												<select class="form-control" id="month_summary" name="sel_month"> </select>
											</div>
											<div class="col-md-2">
												<select class="form-control" id="year_summary" name="sel_year"> </select>
											</div>
											<div class="col-md-1" id="icon-dtr">
												<a href="javascript:;" id="prn-dtr"  name="prn-dtr" >
													<i class="fa fa-fw fa-print"></i>  <!--onclick="document.forms['frm_summary'].submit();" -->
												</a>
											</div>

										</div>
										<p></p>
										<p></p>
										<table id="example2" class="table table-bordered table-striped">
											<thead>
												<tr>
												<th><input id="checkall" class="checkall" type="checkbox" value="<??>" name="checkall"/></th>
												<th>Emp#</th>
												<th>Last Name</th>
												<th>First Name</th>
												<th>Position</th>
												<th>Email Address</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($dtr_employee as $dtr_emp):?>
													<tr>
														<td>
															<input type="checkbox"  name="users[]" class="all" id="checkbox" value="<?php echo $dtr_emp->emp_first_name.' '.$dtr_emp->emp_last_name; ?>" />
														</td>
														<td><?= $dtr_emp->emp_no;?></td>
														<td><?= $dtr_emp->emp_last_name;?></td>
														<td><?= $dtr_emp->emp_first_name;?></td>
														<td><?= $dtr_emp->emp_position;?></td>
														<td><?= $dtr_emp->emp_email;?></td> 
													</tr>
											<?php endforeach;?>
											</tbody>
											<tfoot>
												<tr>
													<th></th>
													<th>Emp#</th>
													<th>Last Name</th>
													<th>First Name</th>
													<th>Position</th>
													<th>Email Address</th>
												</tr>
											</tfoot>
										</table>
									</div><!-- /.box-body -->
								<?=form_close();?>
							</div><!-- /.box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<div class="modal fade" id= "alert_modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Print Summary</h4>
						</div>
						<div class="modal-body">
						<p>Please select atleast 1 checkbox!</p>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
	