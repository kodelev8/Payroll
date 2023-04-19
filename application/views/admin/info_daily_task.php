	<?php 
		//$view_identify == '1' ? $emp_pic = $emp_pic: $emp_pic = $info_emp[0]->emp_picture; 
// 		$dt_action == 'Delete' ? $get_l = '': $get_l= encode($dt_info->dt_id) ;
// 		$dt_action == 'Delete' ? $get_r = encode($dt_info->dt_id) : $get_r='';
	?>

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Employee Daily Task </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Employee Daily Task</a></li>
				<li class="active">Added Employee Daily Task</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						<h3 class="box-title">Employee Daily Task <?=$dt_action; ?></h3>
						</div><!-- /.box-header -->


						<div class="box-body">
							<div class="row">
								<div class="col-md-2"> </div><!-- /.col -->
								<div class="col-md-2"> </div><!-- /.col -->
								<div class="col-md-4">
									<table class="table ">
										<tr>
											<td></td>
											<td>Employee Name:</td>
											<td><?=$dt_emp_name;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Date:</td>
											<td><?= date('Y-m-d', strtotime($dt_info->dt_date));?></td>
										</tr>
										<tr>
											<td></td>
											<td>Time In:</td>
											<td><?=$dt_info->dt_in;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Time Out:</td>
											<td><?=$dt_info->dt_out;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Remarks:</td>
											<td><?=$dt_info->dt_remarks;?></td>
										</tr>
									</table>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->

						<div class="box-footer">
							<div class="row">
								<div class="col-md-3"></div>
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
