<div class="content-wrapper">
	<div class="row">
		<div class="register-logo"> 
		</div>
		<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="box box-solid bg-blue-biscay">
					<div class="box-header with-border">
						<i class="fa fa-calendar"></i>
						<h3 class="box-title">Daily Time Record Monitoring</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-widget="collapse" data-original-title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
							<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-toggle="tooltip"  data-original-title="Summary" onclick="location.href='<?=base_url('dtrms/index_summary');?>';">
								<i class="ion-android-list"></i>
							</button>
							<button class="btn btn-primary btn-sm pull-right" style="margin-right: 5px;" data-toggle="tooltip"  data-original-title="Main-DTR" onclick="location.href='<?=base_url('dtrms/');?>';">
								<i class="ion-clock"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-1"> </div>
								<div class="col-md-3">
									<p class="text-center"><strong> </strong></p>
									<p class="text-center"><strong> </strong></p>
									<div class="progress-group">
										<img class="img-thumbnail" alt="User Image" src="<?=base_url().'images/Pictures/thumb_'.substr($dtr_emp_pic,11);?>">
									</div>
								</div>
							<div class="col-md-3">
								<h3 class="text-center"><div class="text-center" id="date" style="width:250px !important;"> </div></h3>
								<?= form_open('dtrms/dtr_log_manual', array('class' => 'form-horizontal')); ?>
									<input class="text-center input-lg" id="dtr_time_manual" name="dtr_time_manual" disabled="disabled" autocomplete="off" required>
									<input class="text-center input-lg" id="emp_id_manual" name="dtr_emp_id_manual" type="text" disabled="disabled" autocomplete="off" required>
									<p></p>
									<input class="btn btn-login-form btn-lg"  type="submit" value="OK" name="btn-add" id="btn_ok" class="btn-success btn-lg"  disabled="disabled" style="width:250px !important;">
									<p class="text-center" id="lbl_option" style="width:250px !important;"></p>
									<input type="hidden" name="dtr_txt_option" class="txt_option" />
									<input type="hidden" name="dtr_txt_option_name" class="txt_option_name" />
								<?=form_close();?>
							</div>
							<div class="col-md-4">
								<p class="text-center">
									<h4 class="text-center">Employee Information</h4>
								</p>
								<table class="table">
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
							</div>
						</div>
					</div>
					<div class="box-footer bg-blue-biscay">
						<div class="row">
							<div class="col-sm-3 col-xs-6 ">
								<div class="description-block"> 
								<button class="btn btn-block btn-login-form btn-lg" name="log-in" id="btn_login"><i class="icon ion-log-in"></i> Log-In</button> 
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="description-block">
									<button class="btn btn-block btn-login-form btn-lg" name="lunch-out" id="btn_lunchout"><i class="icon ion-android-restaurant"></i> Lunch-Out</button>  
								</div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="description-block">
									<button class="btn btn-block btn-login-form btn-lg" name="lunch-in" id="btn_lunchin"><i class="icon ion-android-restaurant"></i> Lunch-In</button>  
								  </div>
							</div>
							<div class="col-sm-3 col-xs-6">
								<div class="description-block">
									<button class="btn btn-block btn-login-form	 btn-lg" name="logout" id="btn_logout"><i class="icon ion-log-out"></i> Log-Out</button> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-1"></div>
	</div>
	
	
	<div  class="example-modal">
		<div id="myModal" class="modal modal-info">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Oops dual <?= isset($chk_dtr_option_name) ? $chk_dtr_option_name : '';?>!!!</h4>
					</div>
					<div class="modal-body">
						<p>You have already <?=isset($chk_dtr_option_name) ? $chk_dtr_option_name : '';?> at <?=isset($chk_dtr_date) ? $chk_dtr_date : '';?>.  </p>
						<p>Do you want replace your <?=isset($chk_dtr_option_name) ? $chk_dtr_option_name : '';?>?</p>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
					<?=form_open('dtrms/update_dtr_log', array('class' => 'form-horizontal'));?>
						<input type="hidden" name="dtr_update_emp_no" value="<?=isset($dtr_update_emp_no) ? $dtr_update_emp_no : '';?>">
						<input type="hidden" name="dtr_update_id" value="<?=isset($dtr_update_id) ? $dtr_update_id : '';?>">
						<input type="hidden" name="dtr_option_name" value="<?=isset($chk_dtr_option_name) ? $chk_dtr_option_name : '';?>">
						<button type="submit" class="btn btn-outline">Save changes</button>
					<?=form_close();?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div  class="example-modal">
		<div id="dtrmodal_no_log" class="modal modal-info">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Oops You dont have Log - IN!!!</h4>
					</div>
					<div class="modal-body">
						<p>Please Log - In First!</p>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				
					</div>
				</div>
			</div>
		</div>
	</div>
		

</div>