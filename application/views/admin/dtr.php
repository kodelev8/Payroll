

			<!-- Right side column. Contains the navbar and content of the page -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
					<!--             <small>advanced tables</small> -->
					</h1>
					<ol class="breadcrumb">
						<!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->
						<!-- <li><a href="#">Employees</a></li> -->
						<!-- <li class="active">View Employees</li> -->
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-solid bg-blue-biscay">
								<div class="box-header with-border">
									<i class="fa fa-calendar"></i>
									<h3 class="box-title">Daily Time Record Monitoring</h3>
									<div class="box-tools pull-right">
										<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-toggle="tooltip" data-widget="collapse" data-original-title="Collapse">
											<i class="fa fa-minus"></i>
										</button>
										<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-toggle="tooltip"  data-original-title="Summary" onclick="location.href='<?=base_url('dtr/summary');?>';">
											<i class="ion-android-list"></i>
										</button>
										
									</div>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-3">
											<p class="text-center"><strong> </strong></p>
											<p class="text-center"><strong> </strong></p>
											<div class="progress-group">
												<img class="img-thumbnail" alt="User Image" src="<?=base_url().'images/Pictures/thumb_'.substr($dtr_emp_pic,11);?>">
											</div><!-- /.progress-group -->
										</div><!-- /.col -->
										<div class="col-md-3">
											<h3 class="text-center"><div class="text-center" id="date"> </div></h3>
											<?= form_open('dtr/dtr_log', array('class' => 'form-horizontal')); ?>
												<input class="text-center input-lg" id="emp_id" name="dtr_emp_id" maxlength="3" type="text" disabled="disabled"  required>
												<p></p>
												<input class="btn btn-login-form btn-lg"  type="submit" value="OK" name="btn-add" id="btn_ok" class="btn-success btn-lg"  disabled="disabled">
												<p class="text-center" id="lbl_option"></p>
												<input type="hidden" name="dtr_txt_option" class="txt_option" />
												<input type="hidden" name="dtr_txt_option_name" class="txt_option_name" />
											<?=form_close();?>
										</div><!-- /.col -->
										<div class="col-md-4">
											<p class="text-center">
												<h4 class="text-center">Employee Information</h4>
											</p>
											<table class="table ">
												<tr>
												  <td></td>
												  <td>Name:</td>
												  <td><?=$dtr_full_name;?></td>
												</tr>
												<tr>
												  <td></td>
												  <td>Position:</td>
												 <td><?=$dtr_emp_position;?></td>
												</tr>
												<tr>
												  <td></td>
												  <td>Email:</td>
												  <td><?=$dtr_emp_email;?></td>
												</tr>
												<tr>
												  <td></td>
												  <td>Time:</td>
												  <td><?=$dtr_date;?></td>
												</tr>
												<tr>
												  <td></td>
												  <td>Remarks:</td>
												  <td><?=$dtr_option_name;?></td>
												</tr>
											</table>
										</div><!-- /.col -->
									</div><!-- /.row -->
								</div><!-- ./box-body -->
								<div class="box-footer bg-blue-biscay">
									<div class="row">
										<div class="col-sm-3 col-xs-6 ">
											<div class="description-block">
												<button class="btn btn-block btn-login-form	 btn-lg" name="log-in" id="btn_login"><i class="icon ion-log-in"></i> Log-In</button>
											</div><!-- /.description-block -->
										</div><!-- /.col -->
										<div class="col-sm-3 col-xs-6">
											<div class="description-block">
												<button class="btn btn-block btn-login-form	 btn-lg" name="lunch-out" id="btn_lunchout"><i class="icon ion-android-restaurant"></i> Lunch-Out</button>
											</div><!-- /.description-block -->
										</div><!-- /.col -->
										<div class="col-sm-3 col-xs-6">
											<div class="description-block">
												<button class="btn btn-block btn-login-form	 btn-lg" name="lunch-in" id="btn_lunchin"><i class="icon ion-android-restaurant"></i> Lunch-In</button>
											</div><!-- /.description-block -->
										</div><!-- /.col -->
										<div class="col-sm-3 col-xs-6">
											<div class="description-block">
												<button class="btn btn-block btn-login-form	 btn-lg" name="logout" id="btn_logout"><i class="icon ion-log-out"></i> Log-Out</button>
											</div><!-- /.description-block -->
										</div>
									</div><!-- /.row -->
								</div><!-- /.box-footer -->
							</div><!-- /.box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->


		<div  class="example-modal">
			<div id="myModal" class="modal modal-info">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Oops dual <?=$chk_dtr_option_name;?>!!!</h4>
						</div>
						<div class="modal-body">
							<p>You have already <?=$chk_dtr_option_name;?> at <?=$chk_dtr_date;?>.  </p>
							<p>Do you want replace your <?=$chk_dtr_option_name;?>?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
							<?=form_open('dtr/update_dtr_log', array('class' => 'form-horizontal'));?>
								<input type="hidden" name="dtr_update_emp_no" value="<?=$dtr_update_emp_no;?>">
								<input type="hidden" name="dtr_update_id" value="<?=$dtr_update_id;?>">
								<input type="hidden" name="dtr_option_name" value="<?=$chk_dtr_option_name;?>">
								<button type="submit" class="btn btn-outline">Save changes</button>
							<?=form_close();?>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div><!-- /.example-modal -->

