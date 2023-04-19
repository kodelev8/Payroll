<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url('css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('css/AdminLTE.min.css');?>AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          P. Liwanag Construction Company
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong><?=$getpayslip_print[0]->Ps_Emp_Name; ?></strong><br>
		  Employee Number: <?=$getpayslip_print[0]->Ps_Emp_No; ?><br>
          Position:<?=$get_employee_info->emp_position;?><br>
          Basic Daily Rate: <br>
          Phone: (804) 123-5432<br>
        </address>	
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
         <table>
			<thead>
				<tr>
					<th>Date Covered</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>From : </td>
					<td><?=date('d-m-Y ',strtotime($getpayslip_print[0]->Ps_Date_From)); ?></td>
				</tr>
				<tr>
					<td>To : </td>
					<td><?=date('d-m-Y ',strtotime($getpayslip_print[0]->Ps_Date_To)); ?></td>
				</tr>
			</tbody>
		</table>
      </div>
     
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-md-6">
	  	<strong>Deductions</strong>
        <table class="table">
        	<thead>
        		<tr>
	        		<th>Description </th>
	        		<th>Date</th>
	        		<th>Amount</th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php if(count($get_deduction)>0):?>
	        	<?php $total_deduction =0 ;?>
	        	<?php foreach ($get_deduction as $get_deduction):?>
		          <tr>
		            <td><?=$get_deduction->Deduction_Description;?></td>
		            <td><?=date('d-m-Y',strtotime($get_deduction->Deduction_Date));?></td>
		            <td><?=$get_deduction->Deduction_Amount;?></td>
		          </tr>
		          <?php $total_deduction =$total_deduction+ $get_deduction->Deduction_Amount ;?>
	          	<?php endforeach;?>
	          	 <tr style="font-weight:bolder;">
		            <td></td>
		            <td>Total Deduction</td>
		            <td><?=number_format($total_deduction, 2, '.', '');?></td>
		          </tr>
				<?php else:?>
					<tr>
			            <td>None</td>
			            <td>None</td>
			            <td>None</td>
			          </tr>
				<?php endif;?>
        	</tbody>
     	</table>
     	</div>
     </div>	
      
    <div class="row">
	    <div class="col-md-6">
		  <strong>Allowances</strong>
	         <table class="table">
	         <thead>
		         <tr>
	        		<th>Description </th>
	        		<th>Date</th>
	        		<th>Amount</th>
        		</tr>
        	</thead>
        	<tbody>
	        	<?php if(count($get_allowance)>0):?>
	        	<?php $total_allowance =0;?>
		        	<?php foreach ($get_allowance as $get_allowance):?>
		        	
			          <tr>
			            <td><?=$get_allowance->Allowance_Description;?></td>
			            <td><?=date('d-m-Y',strtotime($get_allowance->Allowance_Date));?></td>
			            <td><?=$get_allowance->Allowance_Amount;?></td>
			          </tr>
			          <?php $total_allowance =$total_allowance+$get_allowance->Allowance_Amount  ;?>
		          	<?php endforeach;?>
	          		 <tr style="font-weight:bolder;">
			            <td></td>
			            <td>Total Allowance</td>
			            <td><?=number_format($total_allowance, 2, '.', '');?></td>
			          </tr>
					<?php else:?>
						<tr>
				            <td>None</td>
				            <td>None</td>
				            <td>None</td>
				          </tr>
				<?php endif;?>
        	</tbody>
	     	</table>
	      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-md-6">
	  <strong>Net Pay Summary</strong>
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>Basic Pay </th>
            <th> <?=round($getpayslip_print[0]->Ps_Base_Pay,2); ?></th>
          </tr>
          <tr>
            <th>Overtime Pay</th>
            <th><?=round($getpayslip_print[0]->Ps_OT_Pay,2); ?></td>
          </tr>
         <tr>
            <th>Night Overtime Pay</th>
            <th><?=round($getpayslip_print[0]->Ps_Night_OT_Pay,2); ?></th>
          </tr>
		  <tr>
            <th>Deductions</th>
            <th><?=round($getpayslip_print[0]->Ps_Sub,2); ?></th>
          </tr>
          <tr>
            <th>Allowance</th>
            <th><?=round($getpayslip_print[0]->Ps_Add,2); ?></th>
          </tr>
		  <tr>
            <th>Total Net Pay</th>
            <th><?=round($getpayslip_print[0]->Ps_Total_Pay,2); ?></th>
          </tr>
          </thead>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>