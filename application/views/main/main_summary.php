<div class="content-wrapper">
	<div class="row">
		<div class="register-logo">
			 
		</div>
		
		<div class="col-md-3">

			<div class="col-md-1"></div>
			<div class="col-md-3"style="min-width:350px;">
				<div class="box box-solid bg-blue-biscay">
					<div class="box-header with-border">
						<i class="fa fa-calendar"></i>
						<h3 class="box-title">Employee Wages Info</h3>
					</div>
					<div class="box-body" id="summary_tbl">
						<?=form_open('dtrms/index_summary', array('class' => 'form-horizontal', 'id'=> 'frm_summary'));?>
							<div class="row">
								<div class="col-md-2 bg-blue-biscay" style="min-height:50px; min-width:310px;margin-top:5px;margin-left:10px"> 
								<label>Name:</label>
									<select name="sel_name" id="emp_dtr_select">
										<?php foreach($dtr_get_emp_info as $emp_info):?>
										<?php $emp_name = $emp_info->emp_first_name .' '.$emp_info->emp_last_name; ?>
				      				    	<option value="<?=$emp_name;?>"><?=$emp_name;?></option>
				      				    <?php endforeach;?>
									</select>
								</div>
							</div> 
							<div class="row">
								<div class="col-md-1 bg-blue-biscay" style="min-height:50px; min-width:310px;margin-top:5px;margin-left:10px">
									<label>Date:</label>
									<select id="month_summary" name="sel_month"></select>  
									<select id="year_summary" name="sel_year"></select> 
								</div>  
							</div> 
							
							<div class="row">
								<div class="col-md-2 bg-blue-biscay" style="min-height:50px; min-width:310px;margin-top:5px;margin-left:10px">
									<label id="summary_info">Position:</label><label id="summary_info"> <?=$dtr_emp_info->emp_position; ?></label>	
								</div>
							</div> 
							
							<div class="row">
								<div class="col-md-2 bg-blue-biscay" style="min-height:50px; min-width:310px;margin-top:5px;margin-left:10px">
									<label id="summary_info">Salary:</label><label id="summary_info"> <?=number_format((float) $dtr_emp_info->emp_wages, 2, '.', '') *8; ?></label>	
								</div>
							</div> 
							
							 <div class="row">
								<div class="col-md-2 bg-blue-biscay" style="min-height:50px; min-width:310px;margin-top:5px;margin-left:10px">
									<label id="summary_info">Payroll Cover:</label>
									<input type="text" name="date_from" id="date_from" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" onblur="date_from_onkeyup()" value="" style="text-align:center; width:90px;font-size:15px; color:black; padding-top:10px;">
									<input type="text" name="date_to"   id="date_to" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" onblur="date_to_onkeyup()" value="" style="text-align:center; width:90px;font-size:15px; color:black; padding-top:10px;" disabled>
								</div>
							</div> 
							
						<?=form_close();?>
					</div>
					<div class="box-footer bg-light-blue-gradient bg-blue-biscay">
						<div class="row">
							<p></p>
						</div> 
					</div>
				</div>	
			</div>		 
		</div>
		
		<div class="col-md-6">
			<div class="box box-solid bg-blue-biscay">
				<div class="box-header with-border">
					<i class="fa fa-calendar"></i>
					<h3 class="box-title">Daily Time Record Monitoring</h3> 
				</div>
				<div class="box-body" id="summary_tbl">
					<div class="row"> 
				      	<?=form_open('dtr_pdf', array('class' => 'form-horizontal', 'id'=> 'frm_summarys'));?>
				      	
						<div class="col-md-2">

							<!-- <button class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="document.forms['frm_summarys'].submit();">  -->
<!-- 								<i class="fa fa-download"></i> -->
<!-- 								Generate PDF -->
<!-- 							</button> -->
						</div>
						<?=form_close();?>
				   </div>
					<div class="row">
						<p></p>
						<div class="col-md-2"></div>
						<div class="col-md-12">
				 			<table class="table table-bordered" style="margin-bottom:-1px; color: #333333;"> 
								<thead>
									<tr>
										<th style="width:9.3%;text-align:center;"></th>
										<th style="width:30%;text-align:center;">MORNING</th>
										<th style="width:30%;text-align:center;">AFTERNOON</th>
										<th style="width:30%;text-align:center;">OVERTIME</th> 
									</tr>
								</thead>
								<tbody></tbody>
							</table>
							<table class="table table-bordered" style="color: #333333; border-top:0px; ">
								<thead>
									<tr>
										<th style="width:9.3%;">Day</th>
										<th style="width:15%;">Log In</th>
										<th style="width:15%;">Log Out</th>
										<th style="width:15%;">Log In</th>
										<th style="width:15%;">Log Out</th> 
										<th style="width:15%;">Log In</th>
										<th style="width:15%;">Log Out</th> 
									</tr>
								</thead>
								<tbody>
									<?php foreach($dtr_emp_rec as $rec):?> 
										<td><?= substr($rec['DATE'],8,2);?></td>
										<td><?= $rec['LOG IN'] ;?></td>
										<td>
											<?php 
													$logout= '';
													if(strtotime($rec['LOG OUT']) >= 1522314000 )
													{
														$logout = '17:00:00';
													}
													elseif ($rec['LOG OUT'] == null)
													{
														$logout= '';
													}
													else
													{
														$logout= $rec['LOG OUT'];
													}
													echo $logout;
											 ?>
										 </td> 	
										<td><?= $rec['LUNCH BREAK - IN'];?></td>
										<td><?= $rec['LUNCH BREAK - OUT'];?></td>
										<td><?= $rec['LOG IN'];?></td>
										<td><?= $rec['LOG OUT'];?></td> 
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
						<div class="col-md-2"></div>
					</div><!-- /.row -->
				</div><!-- ./box-body -->
				<div class="box-footer bg-blue-biscay">
				<div class="row">
					<p></p>
				</div><!-- /.row -->
			</div><!-- /.box-footer -->
			</div><!-- /.box -->
	
		</div>
		<!-- /.col -->
		<div class="col-md-3">
			<div class="col-md-3"style="min-width:350px;">
				<div class="box box-solid bg-blue-biscay">
					<div class="box-header with-border">
						<i class="fa fa-calendar"></i>
						<h3 class="box-title">Employee Information</h3>
					</div>
					<div class="box-body" id="summary_tbl">
						<div class="row">
							<div class="col-md-2"style="min-width:130px;">
								<h4 style="color:#1E3F74; font-weight:bold;">Employee #:</h4>
							</div>
							<div class="col-md-2"style="width:150px;">
							 	<input type="text" id="emp_no" class="form-control" value="<?=$dtr_emp_info->emp_no;?>" style="text-align:center;font-weight:bold; width:150px;font-size:24px;" disabled="disabled">
							</div> 
						</div> 
						<div class="row">
							<div class="col-md-2"style="min-width:130px;"> 
							</div>
							<div class="col-md-2"style="min-width:150px;">
							 	<img src="<?=base_url('images'.str_replace('~', '', $dtr_emp_info->emp_picture));?>" id="emp_dtr_pic">
							</div> 
						</div>
						<p></p><p></p>
					 	<div class="row">
							<div class="col-md-2"style="min-width:130px;"> 
							</div>
							<div class="col-md-2"style="min-width:150px;">
							 	<button type="submit"  class="btn btn-primary" id="btn-print" name="btn-add" value="add" onclick="print_payslip()" disabled><i class="fa fa-print" style="font-size:20px;"></i> Print Payslip</button>
							</div> 
						</div>
					</div>
					<div class="box-footer bg-light-blue-gradient bg-blue-biscay">
						<div class="row">
							<p></p>
						</div> 
					</div>
				</div>	
			</div>	
		</div>
	</div>
</div>		
