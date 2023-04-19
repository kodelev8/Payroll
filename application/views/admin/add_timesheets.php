
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			Employee Payslips
			<!-- <small>Preview</small> -->
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employee Payslips</a></li>
				<li class="active">Add Employee Payslips</li>
			</ol>
		</section>
	
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						<h3 class="box-title"> </h3>
						</div><!-- /.box-header -->
 
							<div class="box-body">
								<div class="row">
									<div class="col-md-1" style="width:150px;">
										<label for="">Employee No: </label>
									</div>
									<div class="col-md-1">
										<select name="emp_number" id="emp_number" class="form-control" onchange="show_emp_number();">
											<?php foreach($get_employee_number as $emp):?>
												<option value="<?=$emp->emp_no;?>"<?= $emp->emp_no == $emp_no ? 'selected="selected"': ''; ?>><?= $emp->emp_no;?></option>
											<?php endforeach; ?>  	
										</select>
									</div>
									<div class="col-md-1" style="width:150px;">
										<label for="">Employee Name: </label>
									</div>
									<div class="col-md-2">
										<select name="emp_no" id="emp_name" class="form-control" onchange="show_emp_info();">
											<?php foreach($get_employees as $user):?>
												<option value="<?=$user->emp_no;?>"<?= $user->emp_no == $emp_no ? 'selected="selected"': ''; ?>><?= $user->emp_name;?></option>
											<?php endforeach; ?>  	
										</select>
									</div>
									<div>
										<label class="col-md-1" for="">Payroll Date: </label>
									</div>
									<div class="col-md-2">
										<input class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" id="wk_start_date" value="<?=$StartDate;?>" disabled>
									</div>
									<div class="col-md-2">
											<input class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" id="wk_end_date" value="<?=$EndDate;?>" disabled> 
										</div>
									<div class="col-md-1">
										<button type="submit" id="btn_add_date" class="btn btn-primary" name="btn-add" value="add" onclick="add_date()" disabled>Add Dates</button>	
									</div>
									<?= form_open('payslips/print_payslip', array('class' => 'form-horizontal','id'=>'frm_payslip_create')); ?>
										<input type="hidden" name="hidden_emp_no" id="hidden_emp_no"> 
										<input type="hidden" name="hidden_start_date" id="hidden_start_date"> 
										<input type="hidden" name="hidden_end_date" id="hidden_end_date"> 
									<?=form_close();?>
								</div><p>
								<div class="row" id="tbl_emp_info" hidden="">
									<div class="col-md-6">
										<div class="row" id="div_deduction">
											<div class="col-sm-2" style="width:150px;">
												<label for="">Deduction Amount:</label><br>
												<input type="text" name="deduct_amount" id="deduct_amount" class="form-control" style="width:100px;" maxlength="4" autocomplete="off"> 
											</div>
											<div class="col-sm-2" style="width:300px;">
												<label for="">Description</label><br>
<!-- 												<input type="text" name="deduct_desc" id="deduct_desc" class="form-control" required="required">  -->
												<select name="deduct_desc" id="deduct_desc" class="form-control" >
													<option value="Cash Advanced" selected="selected">Cash Advanced</option>
													<option value="Uniform">Uniform</option>
												</select>
											</div>
											<div class="col-sm-2" style="width:150px;margin-top:5px"> <br>
												<button  class="btn btn-primary" name="btn-add-deduct" id="MyButton" value="add" onclick="add_deduction()">Add Deduction</button>	
											</div>
											<div class="col-sm-2" style="width:150px;">
												<label for="">Total</label><br>
												<input type="text" name="total_deduct" id="total_deduct" class="form-control" style="width:100px;" disabled> 
											</div>
										</div><br> 
										<div class="row"  id="div_allowance">
											<div class="col-sm-2" style="width:150px;"	>
													<label for="">Allowance Amount: </label><br>
													<input type="text" name="allowance_amount" id="allowance_amount" class="form-control" style="width:100px;" maxlength="4" autocomplete="off"> 
												</div>
											<div class="col-sm-2" style="width:300px;">
												<label for="">Description</label><br>
												<input type="text" name="allowance_desc" id="allowance_desc" class="form-control"> 
											</div>
											<div class="col-sm-2" style="width:150px;margin-top:5px"> <br>
												<button type="submit"  class="btn btn-primary" name="btn-add" value="add" onclick="add_allowance()">Add Allowance</button>	
											</div>
											<div class="col-sm-2" style="width:150px;">
												<label for="">Total</label><br>
												<input type="text" name="total_allowance"  id="total_allowance" class="form-control"  style="width:100px;" disabled> 
											</div>
										</div>
										<div class="row" style="margin-left:5px;"> <br>
											<div class="row" id="row_day" hidden="">
												<div class="col-sm-1" style="width:15%;">
													<label id="div_date_header">Date</label>
												</div>
												<div class="col-sm-1" style="width:15%;">
													<label id="div_date_header">Log-In</label>
												</div>
												<div class="col-sm-1" style="width:15%;">
													<label id="div_date_header">Lunch-Out</label> 
												</div>
												<div class="col-sm-1" style="width:15%;">
													<label id="div_date_header">Lunch-IN</label>
												</div>
												<div class="col-sm-1" style="width:15%;">
													<label id="div_date_header">Log-Out</label>
												</div>   
											</div> <p>
											
											 <div class="row" id="row_day_1" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_1" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_1" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_1" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_1" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_1"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_1" id="add_dtr_1" value="add" onclick="add_dtr_1()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_1" id="edit_dtr_1" value="add" onclick="update_dtr_1()">Edit</button>
												</div> 
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_2" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_2" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_2" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_2" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_2" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_2"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_2" id="add_dtr_2" value="add" onclick="add_dtr_2()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_2" id="edit_dtr_2" value="add" onclick="update_dtr_2()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_3" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_3" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_3" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_3" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_3" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_3"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_3" id="add_dtr_3" value="add" onclick="add_dtr_3()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_3" id="edit_dtr_3" value="add" onclick="update_dtr_3()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_4" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_4" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_4" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_4" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_4" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_4"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_4" id="add_dtr_4" value="add" onclick="add_dtr_4()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_4" id="edit_dtr_4" value="add" onclick="update_dtr_4()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_5" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_5" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_5" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_5" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_5" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_5"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_5" id="add_dtr_5" value="add" onclick="add_dtr_5()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_5" id="edit_dtr_5" value="add" onclick="update_dtr_5()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_6" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_6" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_6" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_6" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_6" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_6"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_6" id="add_dtr_6" value="add" onclick="add_dtr_6()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_6" id="edit_dtr_6" value="add" onclick="update_dtr_6()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											 <div class="row" id="row_day_7" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_7" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_7" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_7" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_7" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_7"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_7" id="add_dtr_7" value="add" onclick="add_dtr_7()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_7" id="edit_dtr_7" value="add" onclick="update_dtr_7()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_8" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_8" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_8" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_8" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_8" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_8"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_8" id="add_dtr_8" value="add" onclick="add_dtr_8()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_8" id="edit_dtr_8" value="add" onclick="update_dtr_8()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_9" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_9" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_9" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_9" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_9" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_9"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_9" id="add_dtr_9" value="add" onclick="add_dtr_9()">Save</button>
												</div> 
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_9" id="edit_dtr_9" value="add" onclick="update_dtr_9()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_10" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_10" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_10" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_10" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_10" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_10"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_10" id="add_dtr_10" value="add" onclick="add_dtr_10()">Save</button>
												</div> 												
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_10" id="edit_dtr_10" value="add" onclick="update_dtr_10()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_11" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_11" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_11" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_11" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_11" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_11"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_11" id="add_dtr_11" value="add" onclick="add_dtr_11()">Save</button>
												</div> 												
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_11" id="edit_dtr_11" value="add" onclick="update_dtr_11()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_12" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_12" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_12" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_12" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_12" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_12"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_12" id="add_dtr_12" value="add" onclick="add_dtr_12()">Save</button>
												</div> 											
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_12" id="edit_dtr_12" value="add" onclick="update_dtr_12()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_13" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_13" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_13" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_13" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_13" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_13"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_13" id="add_dtr_13" value="add" onclick="add_dtr_13()">Save</button>
												</div> 												
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_13" id="edit_dtr_13" value="add" onclick="update_dtr_13()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
											<div class="row" id="row_day_14" hidden="">
												<div class="col-md-1" style="width:15%;">
													<input class="form-control" type="text" id="date_14" disabled="disabled"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_login_14" 	value="07:30 AM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchout_14" 	value="12:00 PM">  
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_lunchin_14" 	value="01:00 PM"> 
												</div>
												<div class="col-md-1" style="width:15%;">
													<input class="timepicker form-control" type="text" id="day_logout_14"	value="05:00 PM"> 
												</div>  
												 <div class="col-md-1" style="width:5%;">
													<button class="btn btn-primary" name="add_dtr_14" id="add_dtr_14" value="add" onclick="add_dtr_14()">Save</button>
												</div> 												
												<div class="col-md-1" style="width:5%;margin-left:15px;">
													<button class="btn btn-primary" name="edit_dtr_14" id="edit_dtr_14" value="add" onclick="update_dtr_14()">Edit</button>
												</div>
												 <div class="col-md-1">
													<label id="div_add_status" hidden="">Added</label>
												</div> 
											</div> <p>
										</div>
										
									</div> 
				 					<div class="col-md-3">
				 						<div class="box box-primary">
											<div class="box-body box-profile">
												<center>
													<img class="profile-user-img img-responsive img-circle" id="image_emp" src="<?=base_url('images').'/pictures/thumb_default.png';?>" alt="User profile picture">
												</center>
												<h3 id="emp_name_1" class="profile-username text-center"> </h3>
										
												<p id="emp_position" class="text-muted text-center"></p>
										
												<ul class="list-group list-group-unbordered">
													<li class="list-group-item">
														<b>Employee Number</b> <b id="emp_no" class="pull-right"></b>
													</li>
													<li class="list-group-item">
														<b>Contact Number</b> <b id="emp_contact" class="pull-right"></b>
													</li>
													<li class="list-group-item">
														<b>Email Address</b> <b id="emp_email" class="pull-right"></b>
													</li>
													<li class="list-group-item">
														<b>Wage</b> <b id="emp_wages" class="pull-right"></b>
													</li>
												</ul>
										 
											</div> 
										</div>
				 					</div>
				 					 
								</div><br> 
								  
								
									
	
							</div><!-- /.box-body -->
	
							<div class="box-footer">
	
								<div class="form-actions">
								<div class="col-sm-2 "></div>
								<button type="button" data-toggle="modal" data-target="#save_modal" class="btn btn-primary" id="btn-print" name="btn-add" value="add"  disabled> SAVE PAYSLIPS <i class="fa fa-save" style="font-size:20px;"></i></button>
								<a href="" class="btn btn-primary" id="print_payslip" disabled>PRINT PAYSLIP <i class="fa fa-print" style="font-size:20px;"></i></a>
								</div>
								
							</div>
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
			
				<div  class="example-modal">
					<div id="save_modal" class="modal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background-color: #1E3F74;color: #fff;">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="color: #fff;" aria-hidden="true">&times;</span></button>
									<p class="modal-title" style="font-size:23px;font-weight:bold;"> Your going to create the payslip! </p>
								</div>
								<div class="modal-body">
									<p style="font-size:22px;font-weight:bold;">Please double check the following </p>
									<ul style="font-size:20px;">
										<li>Deductions Amount</li>
										<li>Allowances Amount</li>
										<li>Daily Time Record</li>
											<ul>
												<li>Undertime</li>
												<li>Absences</li>
												<li>Overtime</li>
											</ul>
									</ul>
								 
										
								</div>
								<div class="modal-footer" style="background-color: #1E3F74;">
									<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-outline pull-left" data-dismiss="modal" onclick="print_payslip()">Save <i class="fa fa-save" style="font-size:18px;"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			
			
			
			
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
	
	
 
