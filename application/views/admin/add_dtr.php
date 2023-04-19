
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
					Employee Daily Time Record
					<!--  <small>Preview</small> -->
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">Employee Daily Time Record</a></li>
						<li class="active">Add Employee Daily Time Record</li>
					</ol>
				</section>
			
				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Add Employee Daily Time Record</h3>
								</div><!-- /.box-header -->
							
							
								<div class="box-body">
							
								<?= form_open('dtr/add_dtr', array('id' => 'index', 'class'=>'form-horizontal')); ?>
							
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Employee Name: </label>
									<div class="col-sm-3 ">
										<select name="dtr_emp_no" id="emp_name" class="form-control" >
											<?php foreach($get_emp_info as $user):?>
												<option value="<?=$user->emp_no;?>"<?= $user->emp_no == $dtr_emp_no ? 'selected="selected"': ''; ?>><?= $user->emp_last_name .', ' .$user->emp_first_name .' ' .$user->emp_mid_name?></option>
											<?php endforeach; ?>  	
										</select>
									</div>
								</div>
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
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Date: </label>
										<div class="col-sm-3 ">
											<input class="form-control" name="dtr_date"  id='dtr_date' placeholder="dd-mm-yyyy hh:mm:ss" required="required" >
										</div>
								</div>
							
								</div><!-- /.box-body -->
							
								<div class="box-footer">
									<div class="form-actions">
										<div class="col-sm-2 "></div>
										<button type="submit"  class="btn btn-primary" name="btn-add" value="add">Save</button>
										<a href="<?=base_url('index.php/dtr/view_dtr');?>" class="btn btn-primary">Cancel</a>
									</div>
								</div>
								
								<?= form_close();?>	
							
							</div><!-- /.box ---->
						</div>
					</div>   <!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

