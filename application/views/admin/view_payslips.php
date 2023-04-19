
	<!-- Right side column. Contains the navbar and content of the page -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Employee Payslips </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#"> Employee Payslips</a></li>
				<li class="active">View  Employee Payslips</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">View Employee Payslips</h3>
						</div><!-- /.box-header -->
						
						<div class="box-body">  	
							<div class="row">
								 <div class="row">
								 <?= form_open('payslips/', array('class' => 'form-horizontal','id'=>'frm_payslip_create')); ?>
								 
									<div class="col-md-1" style="width:150px;">
										<label for="">Employee Position: </label>
									</div>
									<div class="col-md-2">  
										<select name="emp_position" id="emp_position" class="form-control"> 
											<?php foreach($get_position as $user):?> 
												<option value="<?=$user->position_no;?>"<?=$user->position_no == $emp_position ? 'selected="selected"': ''; ?>><?= $user->position;?></option>
											<?php endforeach; ?>  	
										</select>
									</div>
									<div>
										<label class="col-md-1" for="">Payroll Date: </label>
									</div>
									<div class="col-md-2">
										<input class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" name="wk_start_date" id="wk_start_date" onblur="isValidStartDate();" value="<?=$StartDate;?>"  required>
									</div>
									<div class="col-md-2">
											<input class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" type="text" name="wk_end_date" id="wk_end_dated"  onblur="isValidEndDate();" value="<?=$EndDate;?>" required> 
										</div>
									<div class="col-md-1">
										<button type="submit" id="btn_add_date" class="btn btn-primary" name="btn-add" value="add" >Add Dates</button>	
									</div>
									
<!-- 										<input type="hidden" name="hidden_emp_no" id="hidden_emp_no">  -->
<!-- 										<input type="hidden" name="hidden_start_date" id="hidden_start_date">  -->
<!-- 										<input type="hidden" name="hidden_end_date" id="hidden_end_date">  -->
									<?=form_close();?>
									<?= form_open('payslips/payslips_print_all', array('class' => 'form-horizontal','id'=>'frm_payslip_create')); ?>
									<div class="col-md-1">
										<button type="submit" id="btn_print" class="btn btn-primary" name="btn-print" value="add" >Print</button>	
									</div>
								</div><p>
							</div>		
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><input id="checkall" class="checkall" type="checkbox" value="<??>" name="checkall"/></th>
										<th>Emp Name</th>
										<th>Base Pay</th>
										<th>OT Pay</th>
										<th>Night OT Pay</th>
										<th>Total Pay</th>
										<th>Sub</th>
										<th>Add</th>
										<th>Date From</th>
										<th>Date To</th> 
									</tr>
								</thead>
								<tbody>
								<?php if(count($payslips)>0):?>
										<?php foreach ($payslips as $ps):?>
											<tr>
												<td>
													<input type="checkbox"  name="users[]" class="all" id="checkbox" value="<?php echo $ps->Ps_Id; ?>" />
												</td>
												<td><?=$ps->Ps_Emp_Name;?></td>
												<td><?=round($ps->Ps_Base_Pay,2);?></td>
												<td><?=round($ps->Ps_OT_Pay,2);?></td>
												<td><?=round($ps->Ps_Night_OT_Pay,2);?></td>
												<td><?=round($ps->Ps_Total_Pay,2);?></td>
												<td><?=round($ps->Ps_Sub,2);?></td>
												<td><?=round($ps->Ps_Add,2);?></td>
												<td><?=date('d-m-Y',strtotime($ps->Ps_Date_From));?></td>
												<td><?=date('d-m-Y',strtotime($ps->Ps_Date_To));?></td>
											 
											</tr>
										<?php endforeach;?>
									<?php else:?>
										<tr><td>No record found!</td></tr>
									<?php endif;?>
									
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th>Emp Name</th>
										<th>Base Pay</th>
										<th>OT Pay</th>
										<th>Night OT Pay</th>
										<th>Total Pay</th>
										<th>Sub</th>
										<th>Add</th>
										<th>Date From</th>
										<th>Date To</th> 	
									</tr>
								</tfoot>
							</table>
							<?=form_close();?>
							<div class="row">
								<div class="col-xs-8"> 
									 <p></p>
								</div>
 
								<div class="col-xs-4">
									<div class="dataTables_paginate paging_bootstrap">
										<ul class="pagination">
											<?//=$links;?>	
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
				<div  class="example-modal">
					<div id="alert_modal" class="modal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
									<p class="modal-title" style="font-size:23px;font-weight:bold;"> Alert!</p>
								</div>
								<div class="modal-body">
									<p style="font-size:22px;font-weight:bold;">Please click atleast one checkbox! </p>
								 
								 
										
								</div>
								<div class="modal-footer">
									<button type="button" class="btn" data-dismiss="modal">Close</button>
									 
								</div>
							</div>
						</div>
					</div>
				</div>
