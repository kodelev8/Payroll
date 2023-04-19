

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Employee Allowance </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employee Allowance</a></li>
				<li class="active"><?=$allowance_action; ?> Employee Allowance</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Employee Allowance <?=$allowance_action; ?></h3>
						</div><!-- /.box-header -->


						<div class="box-body">
							<div class="row">
								<div class="col-md-1"> </div><!-- /.col -->
								<div class="col-md-2"> </div><!-- /.col -->
								<div class="col-md-4">
									<table class="table ">
										<tr>
											<td></td>
											<td>Employee Name:</td>
											<td><?=$allowance_info->Allowance_Emp_Name;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Amount of Allowance:</td>
											<td><?=$allowance_info->Allowance_Amount;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Description of Allowance:</td>
											<td><?=$allowance_info->Allowance_Description;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Date of allowance:</td>
											<td><?=date('Y-m-d',strtotime($allowance_info->Allowance_Date));?></td>
										</tr> 
									</table>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->

						<div class="box-footer">
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-3">
									<a href="<?=base_url($btn_l);?>"class="btn btn-block btn-primary"><?=$btn_l_name?></a>
								</div>
								<div class="col-md-3">
									<a href="<?=base_url($btn_r);?>"class="btn btn-block btn-primary"><?=$btn_r_name; ?></a>
								</div>
							</div> 
						</div>
					</div><!-- /.box ---->
				</div>
			</div>   <!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
