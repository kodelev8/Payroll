

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Daily Time Record </h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Daily Time Record</a></li>
				<li class="active">Daily Time Record Added</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
						<h3 class="box-title">Daily Time Record <?=$dtr_action; ?></h3>
						</div><!-- /.box-header -->


						<div class="box-body">
							<div class="row">
								<div class="col-md-2"> </div><!-- /.col -->
								<div class="col-md-2"> </div><!-- /.col -->
								<div class="col-md-4">
									<table class="table ">
										<tr>
											<td></td>
											<td>Employee No:</td>
											<td><?=$dtr_info->ts_emp_no;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Employee Name:</td>
											<td><?=$dtr_info->ts_first_name .' ' .$dtr_info->ts_last_name;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Time:</td>
											<td><?=$dtr_info->ts_time;?></td>
										</tr>
										<tr>
											<td></td>
											<td>Remarks:</td>
											<td><?=$dtr_info->ts_option_name;?></td>
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

