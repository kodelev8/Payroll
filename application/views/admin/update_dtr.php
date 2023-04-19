


			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1> Employee Daily Time Record</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Employee Daily Time Record</a></li>
						<li class="active">Update Employee DTR</li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Update Employee DTR</h3>
								</div><!-- /.box-header -->
								<?= form_open('dtr/update_dtr/'.encode($dtr_id), array('id' => 'index', 'class'=>'form-horizontal')); ?>
									<div class="box-body">
										
											<?php 
												echo bs_inputfield('Employee Name: ', 	'dtr_full_name', element('dtr_full_name',	$record),true,true,'readonly');
											?>
											<div class="form-group">
												<label class="control-label col-sm-2" for="">Remarks: </label>
												<div class="col-sm-3 ">
													<select name="dtr_option" id="leave_type" class="form-control" >
														<option value="1" <?= $dtr_option == 1 ? 'selected="selected"': ''; ?>>Log - IN</option>
														<option value="3" <?= $dtr_option == 3 ? 'selected="selected"': ''; ?>>Lunch Break - OUT</option>
														<option value="4" <?= $dtr_option == 4 ? 'selected="selected"': ''; ?>>Lunch Break - IN</option>
														<option value="2" <?= $dtr_option == 2 ? 'selected="selected"': ''; ?>>Log - Out</option>
													</select>
												</div>
											</div>
											<?php 
												echo bs_inputfield('Date: ', 	'dtr_date', element('dtr_date',	$record),true);
											?>

									</div><!-- /.box-body -->

									<div class="box-footer"> 
										<div class="form-actions">
											<div class="col-sm-2 "></div>
											<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
											<a href="<?=base_url('dtr/view_dtr/');?>" class="btn btn-primary">Cancel</a>
										</div> 
									</div>
								<?= form_close();?>	
							</div><!-- /.box ---->
						</div>
					</div>   <!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

