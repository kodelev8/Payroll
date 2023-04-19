
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			Employees
			<!-- <small>Preview</small> -->
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employees</a></li>
				<li class="active">Add Employee</li>
			</ol>
		</section>
	
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						<h3 class="box-title">Add Employee</h3>
						</div><!-- /.box-header -->
 
							<div class="box-body">
								<div class="row">
									<div class="col-md-1" style="width:150px;">
										<label for="">Employee Name: </label>
									</div>
									<div class="col-md-2">
										<select name="emp_no" id="emp_name" class="form-control" onchange="show_emp_info()">
											<?php foreach($get_employees as $user):?>
												<option value="<?=$user->emp_no;?>"<?= $user->emp_no == $emp_no ? 'selected="selected"': ''; ?>><?= $user->emp_name;?></option>
											<?php endforeach; ?>  	
										</select>
									</div>
									<div>
										<label class="col-md-1" for="">Payroll Date: </label>
									</div>
									<div class="col-md-2">
										<input class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" id="wk_start_date" value="<?=$StartDate;?>">
									</div>
									<div class="col-md-2">
											<input class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" id="wk_end_date" value="<?=$EndDate;?>"> 
										</div>
									<div class="col-md-2">
										<button type="submit"  class="btn btn-primary" name="btn-add" value="add" onclick="add_date()">Add Dates</button>	
									</div>
									
								</div><p>
								<div class="row" id="tbl_emp_info">
									<div class="col-md-8" >
										<div class="row" id="div_deduction">
											<div class="col-sm-2" style="width:150px;">
												<label for="">Deduction Amount:</label><br>
												<input type="text" name="deduct_amount" id="deduct_amount" class="form-control" style="width:100px;"> 
											</div>
											<div class="col-sm-2" style="width:400px;">
												<label for="">Description</label><br>
												<input type="text" name="deduct_desc" id="deduct_desc" class="form-control" required="required"> 
											</div>
											<div class="col-sm-2" style="width:150px;margin-top:5px"> <br>
												<button  class="btn btn-primary" name="btn-add-deduct" id="MyButton" value="add" onclick="add_deduction()">Add Deduction</button>	
											</div>
											<div class="col-sm-2" style="width:100px;">
												<label for="">Total</label><br>
												<input type="text" name="total_deduct" id="total_deduct" class="form-control" style="width:80px;" disabled> 
											</div>
								</div><br> 
									
									</div>
				 					<div class="col-md-3" >
				 						<div class="box box-primary">
											<div class="box-body box-profile">
												<center>
													<img class="profile-user-img img-responsive img-circle" src="<?=base_url('images').'/pictures/thumb_dsffdsfdsfdssddsad63.jpg';?>" alt="User profile picture">
												</center>
												<h3 id="emp_name_1" class="profile-username text-center"> </h3>
										
												<p id="emp_position" class="text-muted text-center"></p>
										
												<ul class="list-group list-group-unbordered">
													<li class="list-group-item">
														<b>Contact Number</b> <b id="emp_contact" class="pull-right"></b>
													</li>
													<li class="list-group-item">
														<b>Email Address</b> <b id="emp_email" class="pull-right"></b>
													</li>
													<li class="list-group-item">
														<b>Friends</b> <a class="pull-right">13,287</a>
													</li>
												</ul>
										
												<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
											</div> 
										</div>
				 					</div>
				 					 
								</div><br> 
								<div class="row" id="div_deduction">
									<div class="col-sm-2" style="width:150px;">
										<label for="">Deduction Amount: </label><br>
										<input type="text" name="deduct_amount" id="deduct_amount" class="form-control" style="width:100px;"> 
									</div>
									<div class="col-sm-2">
										<label for="">Deduction Description </label><br>
										<input type="text" name="deduct_desc" id="deduct_desc" class="form-control" required="required"> 
									</div>
									<div class="col-sm-2" style="width:150px;margin-top:5px"> <br>
										<button  class="btn btn-primary" name="btn-add-deduct" id="MyButton" value="add" onclick="add_deduction()">Add Deduction</button>	
									</div>
									<div class="col-sm-2" style="width:150px;">
										<label for="">Total Deduction </label><br>
										<input type="text" name="total_deduct" id="total_deduct" class="form-control" style="width:100px;" disabled> 
									</div>
								</div><br> 
								<div class="row"  id="div_allowance" hidden="true">
									<div class="col-sm-2" style="width:150px;"	>
											<label for="">Allowance Amount: </label><br>
											<input type="text" name="allowance_amount" id="allowance_amount" class="form-control" style="width:100px;"> 
										</div>
									<div class="col-sm-2">
										<label for="">Allowance Description </label><br>
										<input type="text" name="allowance_desc" id="allowance_desc" class="form-control"> 
									</div>
									<div class="col-sm-2" style="width:150px;margin-top:5px"> <br>
										<button type="submit"  class="btn btn-primary" name="btn-add" value="add" onclick="add_allowance()">Add Allowance</button>	
									</div>
									<div class="col-sm-2" style="width:150px;">
										<label for="">Total Allowance </label><br>
										<input type="text" name="total_allowance"  id="total_allowance" class="form-control"  style="width:100px;" disabled> 
									</div>
								</div>
						 <p>  
								<div class="row">
									<div class="row" id="row_day" hidden="">
										<div class="col-sm-1" style="width:10%;">
											<label id="div_date_header">Date</label>
										</div>
										<div class="col-sm-1" style="width:10%;">
											<label id="div_date_header">Log-In</label>
										</div>
										<div class="col-sm-1" style="width:10%;">
											<label id="div_date_header">Lunch-Out</label> 
										</div>
										<div class="col-sm-1" style="width:10%;">
											<label id="div_date_header">Lunch-IN</label>
										</div>
										<div class="col-sm-1" style="width:10%;">
											<label id="div_date_header">Log-Out</label>
										</div>   
									</div> <p>
									
									 <div class="row" id="row_day_1" hidden="">
										<div class="col-md-1" style="width:10%;">
											<input class="form-control" type="text" id="date_1" disabled="disabled"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_login_1" 	value="07:00 AM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchout_1" 	value="12:00 PM">  
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchin_1" 	value="01:00 PM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_logout_1"	value="05:00 PM"> 
										</div>  
										 <div class="col-md-1" style="width:5%;">
											<button class="btn btn-primary" name="add_dtr_1" id="add_dtr_1" value="add" onclick="add_dtr_1()">Save</button>
										</div> 
										 <div class="col-md-1">
											<label id="div_add_status" hidden="">Added</label>
										</div> 
									</div> <p>
									<div class="row" id="row_day_2" hidden="">
										<div class="col-md-1" style="width:10%;">
											<input class="form-control" type="text" id="date_2" disabled="disabled"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_login_2" 	value="07:00 AM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchout_2" 	value="12:00 PM">  
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchin_2" 	value="01:00 PM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_logout_2"	value="05:00 PM"> 
										</div>  
										 <div class="col-md-1" style="width:5%;">
											<button class="btn btn-primary" name="add_dtr_2" id="add_dtr_2" value="add" onclick="add_dtr_2()">Save</button>
										</div> 
										 <div class="col-md-1">
											<label id="div_add_status" hidden="">Added</label>
										</div> 
									</div> <p>
									<div class="row" id="row_day_3" hidden="">
										<div class="col-md-1" style="width:10%;">
											<input class="form-control" type="text" id="date_3" disabled="disabled"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_login_3" 	value="07:00 AM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchout_3" 	value="12:00 PM">  
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchin_3" 	value="01:00 PM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_logout_3"	value="05:00 PM"> 
										</div>  
										 <div class="col-md-1" style="width:5%;">
											<button class="btn btn-primary" name="add_dtr_3" id="add_dtr_3" value="add" onclick="add_dtr_3()">Save</button>
										</div> 
										 <div class="col-md-1">
											<label id="div_add_status" hidden="">Added</label>
										</div> 
									</div> <p>
									<div class="row" id="row_day_4" hidden="">
										<div class="col-md-1" style="width:10%;">
											<input class="form-control" type="text" id="date_4" disabled="disabled"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_login_4" 	value="07:00 AM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchout_4" 	value="12:00 PM">  
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchin_4" 	value="01:00 PM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_logout_4"	value="05:00 PM"> 
										</div>  
										 <div class="col-md-1" style="width:5%;">
											<button class="btn btn-primary" name="add_dtr_4" id="add_dtr_4" value="add" onclick="add_dtr_4()">Save</button>
										</div> 
										 <div class="col-md-1">
											<label id="div_add_status" hidden="">Added</label>
										</div> 
									</div> <p>
									<div class="row" id="row_day_5" hidden="">
										<div class="col-md-1" style="width:10%;">
											<input class="form-control" type="text" id="date_5" disabled="disabled"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_login_5" 	value="07:00 AM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchout_5" 	value="12:00 PM">  
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchin_5" 	value="01:00 PM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_logout_5"	value="05:00 PM"> 
										</div>  
										 <div class="col-md-1" style="width:5%;">
											<button class="btn btn-primary" name="add_dtr_5" id="add_dtr_5" value="add" onclick="add_dtr_5()">Save</button>
										</div> 
										 <div class="col-md-1">
											<label id="div_add_status" hidden="">Added</label>
										</div> 
									</div> <p>
									<div class="row" id="row_day_6" hidden="">
										<div class="col-md-1" style="width:10%;">
											<input class="form-control" type="text" id="date_6" disabled="disabled"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_login_6" 	value="07:00 AM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchout_6" 	value="12:00 PM">  
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchin_6" 	value="01:00 PM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_logout_6"	value="05:00 PM"> 
										</div>  
										 <div class="col-md-1" style="width:5%;">
											<button class="btn btn-primary" name="add_dtr_6" id="add_dtr_6" value="add" onclick="add_dtr_6()">Save</button>
										</div> 
										 <div class="col-md-1">
											<label id="div_add_status" hidden="">Added</label>
										</div> 
									</div> <p>
									 <div class="row" id="row_day_7" hidden="">
										<div class="col-md-1" style="width:10%;">
											<input class="form-control" type="text" id="date_7" disabled="disabled"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_login_7" 	value="07:00 AM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchout_7" 	value="12:00 PM">  
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_lunchin_7" 	value="01:00 PM"> 
										</div>
										<div class="col-md-1" style="width:10%;">
											<input class="timepicker form-control" type="text" id="day_logout_7"	value="05:00 PM"> 
										</div>  
										 <div class="col-md-1" style="width:5%;">
											<button class="btn btn-primary" name="add_dtr_7" id="add_dtr_7" value="add" onclick="add_dtr_7()">Save</button>
										</div> 
										 <div class="col-md-1">
											<label id="div_add_status" hidden="">Added</label>
										</div> 
									</div> <p>
								</div>
								
									
	
							</div><!-- /.box-body -->
	
							<div class="box-footer">
	
								<div class="form-actions">
								<div class="col-sm-2 "></div>
								<button type="submit"  class="btn btn-primary" name="btn-add" value="add" onclick="print_payslip()">Save</button>
								<a href="<?=base_url('employee');?>" class="btn btn-primary">Cancel</a>
							</div>
							</div>
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

