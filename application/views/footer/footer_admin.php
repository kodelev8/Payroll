	<footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; <?= date('Y')-1 .'-' .date('Y');?> <a href="">P. Liwanag Construction Company</a>.</strong> All rights reserved.
    </footer>
    
	 <!-- jQuery 2.1.3 -->
	<script src="<?=base_url('js/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
	<!-- Bootstrap 3.3.2 JS -->
	<script src="<?=base_url('js/bootstrap.min.js');?>" type="text/javascript"></script>  
	<!-- AdminLTE App -->
	<script src="<?=base_url('js/app.min.js');?>" type="text/javascript"></script>
	<!-- AdminLTE for demo purposes --> 

    <?php if($menu_name == 'dtr_print_summary'):?>
		<script src="<?=base_url('js/date-picker.js'); ?>" type="text/javascript"></script>
    	<script type="text/javascript">
			jQuery(document).ready(function() {
				populatedropdown("month_summary", "year_summary")
				document.getElementById("month_summary").value = "<?=$sel_month; ?>";
				document.getElementById("year_summary").value = "<?=$sel_year;?>";
				$(document).on('click', '.checkall', function() {

					var atLeastOneIsChecked = $('.checkall:checked').length > 0;

					if (atLeastOneIsChecked) {
						$('input:checkbox').prop('checked', true);
					} else {
						$('input:checkbox').prop('checked', false);
					}
				});

				$(".all").change(function() {
					var a = $(".all");
					if (a.length == a.filter(":checked").length) {
						$('.checkall').attr('checked', true);
					} else {
						$('.checkall').attr('checked', false);
					}
				});

				$('#prn-dtr').click(function() {

					if ($('.all:checked').length == 0) {
						$('#alert_modal').modal('show');
						return false;
					} else {
						$('#frm_summary').submit();

					}
				});

				var lastChecked = null;
				$(document).ready(function() {
					var $chkboxes = $('.all');

					$chkboxes.click(function(e) {
						if (!lastChecked) {
							lastChecked = this;
							return;
						}

						if (e.shiftKey) {
							var start = $chkboxes.index(this);
							var end = $chkboxes.index(lastChecked);

							$chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).attr('checked', lastChecked.checked);
						}
						lastChecked = this;
					});
				});
			});
		</script>
    <?php elseif($menu_name == 'daily_task'):?>
    	
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/date-picker.js'); ?>" type="text/javascript"></script>
		<script type="text/javascript">
			window.onload=function()
			{
				populatedropdownyear()
				
				document.getElementById("dt_year").value = "<?=$dt_year;?>";
				
				
			jQuery(function ($) {
			var dt = <?= count($daily_task); ?>;
			if (dt < 1)
			{
			$("#prn-dtr").attr('onclick',"$('#myModal').modal('show');");
			//alert('dada');
			}
			$("#get_emp_info").change(function() {
				$("#frm_summary").submit();});
			$("#dt_year").change(function() {
			$("#frm_summary").submit();});
			$("#dt_week").change(function() {
			$("#frm_summary").submit();});

			});
			}

			function populatedropdownyear()
			{
				var today=new Date()
				var yearfield=document.getElementById("dt_year")
				var thisyear=today.getFullYear()
				for (var y=0; y<10; y++)
				{
					yearfield.options[y]=new Option(thisyear, thisyear)
					thisyear-=1
				}
				
			}
		</script>
	<?php elseif($menu_name =='dtr'):?>
		<script src="<?=base_url('js/moment.js');?>" type="text/javascript"></script>
		<!-- DATA TABES SCRIPT -->
		<script src="<?=base_url('js/bootstrap-datetimepicker.min.js');?>" type="text/javascript"></script> 

		<script type="text/javascript">  
			$(function () {

			$('#ts_date_from').datetimepicker({
			format: 'YYYY-MM-DD',
			pick12HourFormat: false            
			});
			});
			$(function () {

				$('#ts_date_to').datetimepicker({
				format: 'YYYY-MM-DD',
				pick12HourFts_date_fromrmat: false            
				});
				});
				
// 			 $('#btn_ts_process').click(function()
// 					  {
// 				  		var ts_from = $('#ts_date_from');
// 				  		var ts_to = $('#ts_date_to');
// 						if(ts_from.val().length< 1)
// 						{
// 							alert("Please Input Date from and Date To");
// 							return false;
// 						}
// 						if( ts_to.val().length < 1)
// 						{
// 							alert("Please Input Date from and Date To");
// 							return false;
// 						}
// 						else
// 						{
// 							$('#frm_ts').submit();
// 						}
				  		
					      
// 					  });	
			
		</script>
	<?php elseif ($menu_name == 'main_dtr'):?>
		<!-- DATA TABES SCRIPT -->
		<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<script type="text/javascript">

			$(function() {
				$("#example1").dataTable();
				$('#example2').dataTable({
					"bPaginate": true,
					"bLengthChange": false,
					"bFilter": false,
					"bSort": true,
					"bInfo": true,
					"bAutoWidth": false
				});
			});

			$(document).ready(function() { <?= $modal_show; ?>
				$('.btn-block').on('click', function() {
					var btn = $(this).attr('id');
					var option = '';
					var option_name = '';
					var btn_name = '';
					if (btn == 'btn_login') {
						option = '1';
						option_name = 'Log - IN';
						btn_name = 'Log-in';
					} else if (btn == 'btn_lunchout') {
						option = '3';
						option_name = 'Lunch Break - OUT';
						btn_name = 'Lunch Break-out';
					} else if (btn == 'btn_lunchin') {
						option = '4';
						option_name = 'Lunch Break - IN';
						btn_name = 'Lunch Break-in';
					} else if (btn == 'btn_logout') {
						option = '2';
						option_name = 'Log - OUT';
						btn_name = 'Log-out';
					}
					$('.txt_option').val(option);
					$('.txt_option_name').val(option_name);
					$('#lbl_option').html(btn_name);
					$(this).addClass('btn_color');
					$('#emp_id').removeAttr('disabled');
					$('#emp_id').val('');
					$('#btn_id').removeAttr('disabled');
					$('#btn_ok').removeAttr('disabled');
					$('#emp_id').focus();
					return false;
				});
			});
			$(document).ready(function() {

				$('#lbl_option').html('<?=$nrf; ?>');
				$("#emp_id").keydown(function(event) {
					if ($.inArray(event.keyCode, [46, 8, 9, 27, 13]) !== -1 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
						return;
					} else {
						if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
							event.preventDefault();
						}
					}
				});
			});

			function date() {
				var m = "AM";
				var gd = new Date();
				var secs = gd.getSeconds();
				var minutes = gd.getMinutes();
				var hours = gd.getHours();
				var day = gd.getDay();
				var month = gd.getMonth();
				var date = gd.getDate();
				var year = gd.getUTCFullYear();
				if (secs < 10) {
					secs = "0" + secs;
				}
				if (minutes < 10) {
					minutes = "0" + minutes;
				}
				if (hours < 10) {
					hours = "0" + hours;
				}
				var montharray = new Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
				var fulldate = montharray[month] + "/" + date + "/" + year + " " + hours + ":" + minutes + ":" + secs;
				$("#date").html(fulldate);
				setTimeout("date()", 1000);
			}
			date();
		</script>	
	<?php elseif($menu_name =='dtr_action'):?>
		<script src="<?=base_url('js/moment.js');?>" type="text/javascript"></script>
		<!-- DATA TABES SCRIPT -->
		<script src="<?=base_url('js/bootstrap-datetimepicker.min.js');?>" type="text/javascript"></script>
	
		<script type="text/javascript">  
			$(function () {
			$('#dtr_date').datetimepicker({
			format: 'DD-MM-YYYY HH:mm:ss',
			pick12HourFormat: false            
			});
			});
		</script>
	<?php elseif($menu_name=='dtr_summary'):?>
		<script src="<?=base_url('js/date-picker.js'); ?>" type="text/javascript"></script>
		<!-- DATA TABES SCRIPT -->
		<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
	   <script type="text/javascript">
	    window.onload=function()
	    {
		        populatedropdown( "month_summary", "year_summary")
		        document.getElementById("month_summary").value = "<?=$sel_month;?>";
		        document.getElementById("year_summary").value = "<?=$sel_year;?>";
		        document.getElementById("sel_name").value = "<?=$sel_name;?>";
		        document.getElementById("deduct_name").value = "<?=$sel_name;?>";
		        document.getElementById("deduct_year").value = "<?=$sel_year;?>";
		        document.getElementById("deduct_month").value = "<?=$sel_month;?>";
		        
				$("#dt_deduct").keydown(function(event) {
					if ($.inArray(event.keyCode, [46, 8, 9, 27, 13]) !== -1 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
						return;
					} else {
						if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
							event.preventDefault();
						}
					}
					$("#deduct_leave").val($("#dt_deduct").val());
				});
				$("#dt_deduct").keyup(function(event) {
	
					$("#deduct_leave").val($("#dt_deduct").val());
					
				});
	    }
	
	    $(document).ready(function() 
	      {
	    	$("#month_summary").change(function(e) {
	    	$('#frm_summary').submit();
	    	return true;
	    	});
	    	$("#year_summary").change(function(e) {
	    	$('#frm_summary').submit();
	    	return true;
	    	});
	    	$("#sel_name").change(function(e) {
	        $('#frm_summary').submit();
	        return true;
	        });
	    	 $("#post").disabled('true');
	    	});

	    </script>
    <?php elseif($menu_name==''):?>
	   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- DATA TABES SCRIPT -->
    	<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
	    <!-- SlimScroll -->
	    <script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='<?=base_url('js/plugins/fastclick/fastclick.min.js');?>'></script>
	
		<script type="text/javascript">
		window.onload=function()
		{
			 document.getElementById("sel_month").value = "<?=$post_month;?>";
			 document.getElementById("sel_year").value = "<?=$post_year;?>";
			 document.getElementById("sel_name").value = "<?=$post_name;?>";
		 
		}
		  $(function() {
			  $("#input-mask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
			  $("#dt_date").attr('inputmask',"");
			  $("#dt_date").attr('data-inputmask',"'alias': 'dd-mm-yyyy'");
			  $("#dt_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
			  $("#dt_time_in").attr('inputmask',"");
			  $("#dt_time_in").attr('data-inputmask',"'alias': 'hh:mm'");
			  $("#dt_time_in").inputmask("hh:mm", {"placeholder": "hh:mm"});
			  $("#dt_time_out").attr('inputmask',"");
			  $("#dt_time_out").attr('data-inputmask',"'alias': 'hh:mm'");
			  $("#dt_time_out").inputmask("hh:mm", {"placeholder": "hh:mm"});
			  $('#dtr_per_page').change(function()
					  {
					      $('#frm_dtr_view').submit();
					  });
			  $('#dtr_per_page_search').change(function()
					  {
					      $('#frm_dtr_searched').submit();
					  });			  

			  $('#dtr_search').focusout(function()
					  {
				  		  $('#hid_dtr_search').val($('#dtr_search').val());
					      $('#frm_dtr_search').submit();
					  });
			  $("#dtr_search").keydown(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				        $('#hid_dtr_search').val($('#dtr_search').val());
				        $('#frm_dtr_search').submit();
				    }
				});
			  $('#emp_per_page').change(function()
					  {
					      $('#frm_emp_view').submit();
					  });
			  $('#emp_per_page_search').change(function()
					  {
					      $('#frm_emp_searched').submit();
					  });			  

			  $('#emp_search').focusout(function()
					  {
				  		  $('#hid_emp_search').val($('#emp_search').val());
					      $('#frm_emp_search').submit();
					  });
			  $("#emp_search").keydown(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				        $('#hid_emp_search').val($('#emp_search').val());
				        $('#frm_emp_search').submit();
				    }
				});
			  $('#user_per_page').change(function()
					  {
					      $('#frm_user_view').submit();
					  });
			  $('#user_per_page_search').change(function()
					  {
					      $('#frm_user_searched').submit();
					  });			  

			  $('#user_search').focusout(function()
					  {
				  		  $('#hid_user_search').val($('#user_search').val());
					      $('#frm_user_search').submit();
					  });
			  $("#user_search").keydown(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				        $('#hid_user_search').val($('#user_search').val());
				        $('#frm_user_search').submit();
				    }
				});
			    $("#example1").dataTable();
		        $('#example2').dataTable({
		          "bPaginate": true,
		          "bLengthChange": false,
		          "bFilter": false,
		          "bSort": false,
		          "bInfo": true,
		          "bAutoWidth": false
		        });
		  });

		  function get_last_empno() {
				var emp_no = $("#emp_position").val(); 
				console.log(emp_no);
				$.ajax({
					type: "POST",
					url: "<?=base_url('index.php/employee/get_last_empno/');?>",
					data: ({
						emp_no: emp_no, 
					}),
					success: function(readed) {
						read = readed;
						$("#emp_no").val(read);
						console.log(read); 
					}
				});

			}

		  
// 			$(function(){
// 				$('table').tablesorter({
// 					widgets        : ['zebra', 'columns'],
// 					usNumberFormat : false,
// 					sortReset      : true,
// 					sortRestart    : true
// 				});
// 			});
	
		</script>
    <?php elseif($menu_name=='leave'):?>
	   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- DATA TABES SCRIPT -->
    	<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
	    <!-- SlimScroll -->
	    <script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='<?=base_url('js/plugins/fastclick/fastclick.min.js');?>'></script>
	
		<script type="text/javascript">
		  $(function() {
			  $("#leave_date").attr('inputmask',"");
			  $("#leave_date").attr('data-inputmask',"'alias': 'dd-mm-yyyy'");
			  $("#leave_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
			  $('#leave_per_page').change(function()
					  {
					      $('#frm_leave_view').submit();
					  });
			  $('#leave_per_page_search').change(function()
					  {
					      $('#frm_leave_searched').submit();
					  });			  

			  $('#leave_search').focusout(function()
					  {
				  		  $('#hid_leave_search').val($('#leave_search').val());
					      $('#frm_leave_search').submit();
					  });
			  $("#leave_search").keydown(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				        $('#hid_leave_search').val($('#leave_search').val());
				        $('#frm_leave_search').submit();
				    }
				});
			  
			    $("#example1").dataTable();
		        $('#example2').dataTable({
	        	  "bPaginate": true,
		          "bLengthChange": false,
		          "bFilter": false,
		          "bSort": false,
		          "bInfo": true,
		          "bAutoWidth": false
		        });
		  });
	
		</script>
    <?php elseif($menu_name=='holiday'):?>
	   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- DATA TABES SCRIPT -->
    	<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
	    <!-- SlimScroll -->
	    <script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='<?=base_url('js/plugins/fastclick/fastclick.min.js');?>'></script>
		<script type="text/javascript">
		  $(function() {
			  $("#holiday_date").attr('inputmask',"");
			  $("#holiday_date").attr('data-inputmask',"'alias': 'dd-mm-yyyy'");
			  $("#holiday_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
// 			    $("#example1").dataTable();
// 		        $('#example2').dataTable({
// 	        	  "bPaginate": true,
// 		          "bLengthChange": false,
// 		          "bFilter": false,
// 		          "bSort": false,
// 		          "bInfo": true,
// 		          "bAutoWidth": false
// 		        });
				  $('#holiday_per_page').change(function()
						  {
						      $('#frm_holiday_view').submit();
						  });
				  $('#holiday_per_page_search').change(function()
						  {
						      $('#frm_holiday_searched').submit();
						  });			  

				  $('#holiday_search').focusout(function()
						  {
					  		  $('#hid_holiday_search').val($('#holiday_search').val());
						      $('#frm_holiday_search').submit();
						  });
				  $("#holiday_search").keydown(function(event) {
					    if (event.which == 13) {
					        event.preventDefault();
					        $('#hid_holiday_search').val($('#holiday_search').val());
					        $('#frm_holiday_search').submit();
					    }
					});
		  });

		</script>
	<?php elseif($menu_name=='allowance'):?>
	   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- DATA TABES SCRIPT -->
    	<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
	    <!-- SlimScroll -->
	    <script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='<?=base_url('js/plugins/fastclick/fastclick.min.js');?>'></script>
	
		<script type="text/javascript">
		  $(function() {
			  $("#allowance_date").attr('inputmask',"");
			  $("#allowance_date").attr('data-inputmask',"'alias': 'dd-mm-yyyy'");
			  $("#allowance_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
				  
			  $('#allowance_per_page').change(function()
					  {
					      $('#frm_allowance_view').submit();
					  });
			  $('#allowance_per_page_search').change(function()
					  {
					      $('#frm_allowance_searched').submit();
					  });			  
			  $('#allowance_search').focusout(function()
					  {
				  		  $('#hid_allowance_search').val($('#allowance_search').val());
					      $('#frm_allowance_search').submit();
					  });
			  $("#allowance_search").keydown(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				        $('#hid_allowance_search').val($('#allowance_search').val());
				        $('#frm_allowance_search').submit();
				    }
				});
			  
			    $("#example1").dataTable();
		        $('#example2').dataTable({
	        	  "bPaginate": true,
		          "bLengthChange": false,
		          "bFilter": false,
		          "bSort": false,
		          "bInfo": true,
		          "bAutoWidth": false
		        });
		  });
	
		</script>
		
	<?php elseif($menu_name=='deduction'):?>
	   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- DATA TABES SCRIPT -->
    	<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
	    <!-- SlimScroll -->
	    <script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='<?=base_url('js/plugins/fastclick/fastclick.min.js');?>'></script>
	
		<script type="text/javascript">
		  $(function() {
			  $("#deduction_date").attr('inputmask',"");
			  $("#deduction_date").attr('data-inputmask',"'alias': 'dd-mm-yyyy'");
			  $("#deduction_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
				  
			  $('#deduction_per_page').change(function()
					  {
					      $('#frm_deduction_view').submit();
					  });
			  $('#deduction_per_page_search').change(function()
					  {
					      $('#frm_deduction_searched').submit();
					  });			  
			  $('#deduction_search').focusout(function()
					  {
				  		  $('#hid_deduction_search').val($('#deduction_search').val());
					      $('#frm_deduction_search').submit();
					  });
			  $("#deduction_search").keydown(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				        $('#hid_deduction_search').val($('#deduction_search').val());
				        $('#frm_deduction_search').submit();
				    }
				});
			  
			    $("#example1").dataTable();
		        $('#example2').dataTable({
	        	  "bPaginate": true,
		          "bLengthChange": false,
		          "bFilter": false,
		          "bSort": false,
		          "bInfo": true,
		          "bAutoWidth": false
		        });
		  });
	
			</script>
			<?php elseif($menu_name=='wages'):?>
<!-- 			emer -->
		   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
			<!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
			<!-- DATA TABES SCRIPT -->
			<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
			<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
			<!-- Input Mask -->
			<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
			<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
			<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
			<!-- SlimScroll -->
			<script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
			<!-- FastClick -->
			<script src='<?=base_url('js/plugins/fastclick/fastclick.min.js');?>'></script>
		
			<script type="text/javascript">
			  $(function() {
				var check_emp = 0;
				  $('#wages_per_page').change(function()
						  {
							  $('#frm_wages_view').submit();
						  });
				  $('#wages_per_page_search').change(function()
						  {
							  $('#frm_wages_searched').submit();
						  });			  
				  $('#wages_search').focusout(function()
						  {
							  $('#hid_wages_search').val($('#wages_search').val());
							  $('#frm_wages_search').submit();
						  });
				  $("#wages_search").keydown(function(event) {
						if (event.which == 13) {
							event.preventDefault();
							$('#hid_wages_search').val($('#wages_search').val());
							$('#frm_wages_search').submit();
						}
					});
				  check_emp=  $('#wages_emp_no').val();
				   if(check_emp == null)
				   {
						$('#emp_wages_add').attr('disabled',true);
					}
					$("#example1").dataTable();
					$('#example2').dataTable({
					  "bPaginate": true,
					  "bLengthChange": false,
					  "bFilter": false,
					  "bSort": false,
					  "bInfo": true,
					  "bAutoWidth": false
					});
			  });
		</script>
		<?php elseif($menu_name=='payslip'):?>
	   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- DATA TABES SCRIPT -->
    	<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
	    <!-- SlimScroll -->
	    <script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src="<?=base_url('js/plugins/fastclick/fastclick.min.js');?>"></script> 
		<script type="text/javascript">  
		$( document ).ready(function() {
			var error_msg = '<?=$error_msg;?>';
			console.log(error_msg)
			if(error_msg != '')
			{
					alert(error_msg);
			}

		 
		 	
		});
	      
		jQuery(document).ready(function() { 
			$(document).on('click', '.checkall', function() {

				var atLeastOneIsChecked = $('.checkall:checked').length > 0;

				if (atLeastOneIsChecked) {
					$('input:checkbox').prop('checked', true);
				} else {
					$('input:checkbox').prop('checked', false);
				}
			});

			$(".all").change(function() {
				var a = $(".all");
				if (a.length == a.filter(":checked").length) {
					$('.checkall').attr('checked', true);
				} else {
					$('.checkall').attr('checked', false);
				}
			});

			$('#btn_print').click(function() {

				if ($('.all:checked').length == 0) {
					$('#alert_modal').modal('show');
					return false;
				} else {
					$('#frm_summary').submit();

				}
			});

			var lastChecked = null;
			$(document).ready(function() {
				var $chkboxes = $('.all');

				$chkboxes.click(function(e) {
					if (!lastChecked) {
						lastChecked = this;
						return;
					}

					if (e.shiftKey) {
						var start = $chkboxes.index(this);
						var end = $chkboxes.index(lastChecked);

						$chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1).attr('checked', lastChecked.checked);
					}
					lastChecked = this;
				});
			});
		});
		
		 $(function() {
		     $(".timepicker").inputmask("hh:mm t", {
		         alias: 'time',
		         placeholder: "hh:mm t",
		         insertMode: true,
		         showMaskOnHover: true,
		         hourFormat: 12
		     });
		     $('[data-mask]').inputmask();
		     $('#datemask').inputmask('yyyy-mm-dd', {
		         'placeholder': 'yyyy-mm-dd'
		     });
		     $('[data-mask]').inputmask();

// 		     $("#deduct_amount").inputmask({
// 		         'alias': 'integer',
// 		         'mask': "9999",
// 		         rightAlign: true
// 		     });
// 		     $("#allowance_amount").inputmask({
// 		         'alias': 'integer',
// 		         'mask': "9999",
// 		         rightAlign: true
// 		     });
			 $('#payslip_per_page').change(function()
			  {
				  $('#frm_payslip_view').submit();
			  });
		     $('#payslip_per_page_search').change(function() {
		         $('#frm_payslip_searched').submit();
		     });

		     $('#payslip_search').focusout(function() {
		         $('#hid_payslip_search').val($('#payslip_search').val());
		         $('#frm_payslip_search').submit();
		     });
		     $("#payslip_search").keydown(function(event) {
		         if (event.which == 13) {
		             event.preventDefault();
		             $('#hid_payslip_search').val($('#payslip_search').val());
		             $('#frm_payslip_search').submit();
		         }
		     });
		     $("#deduct_amount").keydown(function(event) {
		         if ($.inArray(event.keyCode, [46, 8, 9, 27, 13]) !== -1 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
		             return;
		         } else {
		             if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
		                 event.preventDefault();
		             }
		         }
		     });


		     $("#example1").dataTable();
		     $('#example2').dataTable({
		         "bPaginate": true,
		         "bLengthChange": false,
		         "bFilter": false,
		         "bSort": false,
		         "bInfo": true,
		         "bAutoWidth": false
		     });


	
		     
		 });
		 function isValidStartDate() {
			 str = document.getElementById('wk_start_date').value;
			 var from_date = new Date(str); 
			  var cur_date = "<?=$StartDate;?>";
			  var d = new Date(str);

			  console.log(from_date);
			  if(from_date == "Invalid Date") // set date as 1995 here and your logic here
			  { 
				  $("#wk_start_date").val(cur_date); 
			  }

			  return true; 
			}
		 function isValidEndDate() {
			 str = document.getElementById('wk_end_dated').value;
			 var from_date = new Date(str); 
			  var cur_date = "<?=$EndDate;?>";
			  var d = new Date(str);

			  console.log(from_date);
			  if(from_date == "Invalid Date") // set date as 1995 here and your logic here
			  { 
				  $("#wk_end_dated").val(cur_date); 
			  }

			  return true; 
			}
		function show_emp_number()
		{
			
			var emp_no =document.getElementById('emp_number').value;
			$("#emp_name").val(emp_no);
			 show_emp_info();
		}
		function show_emp_info()
		{
			var emp_no =document.getElementById('emp_name').value;
			var start_date =document.getElementById('wk_start_date').value;
			var end_date =document.getElementById('wk_end_date').value;
			 $.ajax({
			        type: "POST",
			        url: "<?=base_url('index.php/payslips/show_emp_info/');?>",
				        data:({product:emp_no}),
				        success: function(readed) {
				            read = JSON.parse(readed);
// 				            $("#cartcount").html(read);
							console.log(read);
							// alert(read["emp_contact"]);
							var emp_pic= "<?=base_url('images'); ?>";
							console.log('----------------');
							var pic = read['emp_picture'];
							if (pic != null)
							{
								var emp_pic = emp_pic+ read['emp_picture'].substr(1)
							}
							else
							{
								var emp_pic = emp_pic+'thumb_default.png';
							}
							var wages = parseFloat(read["emp_wages"]).toFixed(2) * 8;
							$("#wk_start_date").removeAttr('disabled');
							$("#wk_end_date").removeAttr('disabled');
							$("#btn_add_date").removeAttr('disabled');
							$("#div_allowance").removeAttr('hidden');
							$("#div_deduction").removeAttr('hidden');
							$("#tbl_emp_info").removeAttr('hidden');
							$("#emp_name_1").html(read["emp_first_name"]+' '+read["emp_last_name"]);
							$("#emp_no").html(read["emp_no"]);
							$("#emp_position").html(read["emp_position"]); 
							$("#emp_email").html(read["emp_email"]);
							$("#emp_contact").html(read["emp_contact"]);
							$("#emp_wages").html(wages +'/ day');    
// 							$("#wk_start_date").val(" $StartDate; ");     
// 							$("#wk_end_date").val(" $EndDate; "); remove for fixing date value when changing and add 20180824
							$("#emp_number").val(emp_no); 
							$("#image_emp").attr("src",emp_pic);
							console.log(emp_pic);
							
						     $.ajax({
							        type: "POST",
							        url: "<?=base_url('index.php/payslips/get_emp_info/');?>",
								        data:({emp_no:emp_no,start_date:start_date,end_date:end_date}),
								        success: function(readed) {
								            read = JSON.parse(readed);
//								            $("#cartcount").html(read);
											console.log(read);
											var deduction =read["deduction"];
											var allowance = read["allowance"];
											if(deduction < 1)
											{
												deduction = 0;
											}
											if(allowance < 1)
											{
												allowance = 0;
											}
											$("#total_deduct").val(deduction);
											$("#total_allowance").val(allowance);  
							        }
							    });
						    $('#row_day_1').attr('hidden',true);
			                $('#row_day_2').attr('hidden',true);
			                $('#row_day_3').attr('hidden',true);
			                $('#row_day_4').attr('hidden',true);
			                $('#row_day_5').attr('hidden',true);
			                $('#row_day_6').attr('hidden',true);
			                $('#row_day_7').attr('hidden',true);
			                $('#row_day_8').attr('hidden',true);
			                $('#row_day_9').attr('hidden',true);
			                $('#row_day_10').attr('hidden',true);
			                $('#row_day_11').attr('hidden',true);
			                $('#row_day_12').attr('hidden',true);
			                $('#row_day_13').attr('hidden',true);
			                $('#row_day_14').attr('hidden',true);
			                
						    $("#day_login_1").removeAttr('disabled');
							$("#day_lunchin_1").removeAttr('disabled');
							$("#day_lunchout_1").removeAttr('disabled');
							$("#day_logout_1").removeAttr('disabled');
							$("#add_dtr_1").removeAttr('disabled'); 

							$("#day_login_2").removeAttr('disabled');
							$("#day_lunchin_2").removeAttr('disabled');
							$("#day_lunchout_2").removeAttr('disabled');
							$("#day_logout_2").removeAttr('disabled');
							$("#add_dtr_2").removeAttr('disabled'); 


							$("#day_login_3").removeAttr('disabled');
							$("#day_lunchin_3").removeAttr('disabled');
							$("#day_lunchout_3").removeAttr('disabled');
							$("#day_logout_3").removeAttr('disabled');
							$("#add_dtr_3").removeAttr('disabled'); 


							$("#day_login_4").removeAttr('disabled');
							$("#day_lunchin_4").removeAttr('disabled');
							$("#day_lunchout_4").removeAttr('disabled');
							$("#day_logout_4").removeAttr('disabled');
							$("#add_dtr_4").removeAttr('disabled'); 

							$("#day_login_5").removeAttr('disabled');
							$("#day_lunchin_5").removeAttr('disabled');
							$("#day_lunchout_5").removeAttr('disabled');
							$("#day_logout_5").removeAttr('disabled');
							$("#add_dtr_5").removeAttr('disabled'); 

							$("#day_login_6").removeAttr('disabled');
							$("#day_lunchin_6").removeAttr('disabled');
							$("#day_lunchout_6").removeAttr('disabled');
							$("#day_logout_6").removeAttr('disabled');
							$("#add_dtr_6").removeAttr('disabled'); 


							$("#day_login_7").removeAttr('disabled');
							$("#day_lunchin_7").removeAttr('disabled');
							$("#day_lunchout_7").removeAttr('disabled');
							$("#day_logout_7").removeAttr('disabled');
							$("#add_dtr_7").removeAttr('disabled'); 

							$("#day_login_8").removeAttr('disabled');
							$("#day_lunchin_8").removeAttr('disabled');
							$("#day_lunchout_8").removeAttr('disabled');
							$("#day_logout_8").removeAttr('disabled');
							$("#add_dtr_8").removeAttr('disabled'); 

							$("#day_login_9").removeAttr('disabled');
							$("#day_lunchin_9").removeAttr('disabled');
							$("#day_lunchout_9").removeAttr('disabled');
							$("#day_logout_9").removeAttr('disabled');
							$("#add_dtr_9").removeAttr('disabled'); 

							$("#day_login_10").removeAttr('disabled');
							$("#day_lunchin_10").removeAttr('disabled');
							$("#day_lunchout_10").removeAttr('disabled');
							$("#day_logout_10").removeAttr('disabled');
							$("#add_dtr_10").removeAttr('disabled'); 

							$("#day_login_11").removeAttr('disabled');
							$("#day_lunchin_11").removeAttr('disabled');
							$("#day_lunchout_11").removeAttr('disabled');
							$("#day_logout_11").removeAttr('disabled');
							$("#add_dtr_11").removeAttr('disabled'); 

							$("#day_login_12").removeAttr('disabled');
							$("#day_lunchin_12").removeAttr('disabled');
							$("#day_lunchout_12").removeAttr('disabled');
							$("#day_logout_12").removeAttr('disabled');
							$("#add_dtr_12").removeAttr('disabled'); 

							$("#day_login_13").removeAttr('disabled');
							$("#day_lunchin_13").removeAttr('disabled');
							$("#day_lunchout_13").removeAttr('disabled');
							$("#day_logout_13").removeAttr('disabled');
							$("#add_dtr_13").removeAttr('disabled'); 

							$("#day_login_14").removeAttr('disabled');
							$("#day_lunchin_14").removeAttr('disabled');
							$("#day_lunchout_14").removeAttr('disabled');
							$("#day_logout_14").removeAttr('disabled');
							$("#add_dtr_14").removeAttr('disabled'); 
				    }
			    });
			  
				
				return false;
				
				
				
		}

		function add_deduction()
		{
			var emp_no =document.getElementById('emp_name').value;
			var deduct_date =document.getElementById('wk_start_date').value;
			var deduct_amount =document.getElementById('deduct_amount').value;
			var deduct_desc =document.getElementById('deduct_desc').value;
			console.log(deduct_desc.length);

			if(deduct_desc.length>1 && deduct_amount.length> 1 )
			{
			 
				 $.ajax({
				        type: "POST",
				        url: "<?=base_url('index.php/payslips/add_deduction/');?>" ,
					        data:({emp_no:emp_no,deduct_date:deduct_date,deduct_amount:deduct_amount,deduct_desc:deduct_desc}),
					        success: function(readed) {
					            read =  readed;
	// 				            $("#cartcount").html(read);
								console.log(read);
								$("#total_deduct").val(read);
								$("#deduct_amount").val(""); 
	// 							// alert(read["emp_contact"]);
	// 							$("#lbl_date_cover").removeAttr('hidden');
	// 							$("#tbl_emp_info").removeAttr('hidden');
	// 							$("#emp_no").html(read["emp_no"]);
	// 							$("#emp_position").html(read["emp_position"]);
	// 							$("#emp_contact").html(read["emp_contact"]);
	// 							$("#emp_wages").html(read["emp_wages"]);       
					        }
					    });
					  
						return false;
					
				}
				else
				{
// 					alert('ettutu');
					$("#deduct_amount").attr('required', ''); 
					$("#deduct_desc").attr('required', '');  
					 //turns required on
// 					$('#deduct_desc').toggleAttr('required'W);
// 					$('input').prop('required',true);
// 					$('#deduct_desc').prop('required',true);
					
				}
			}
			function add_allowance()
			{
				var emp_no =document.getElementById('emp_name').value;
				var allowance_date =document.getElementById('wk_start_date').value;
				var allowance_amount =document.getElementById('allowance_amount').value;
				var allowance_desc =document.getElementById('allowance_desc').value;

				if(allowance_desc.length>1 && allowance_amount.length> 1 )
				{ 
					 $.ajax({
					        type: "POST",
					        url: "<?=base_url('index.php/payslips/add_allowance/');?>" ,
				        data:({emp_no:emp_no,allowance_date:allowance_date,allowance_amount:allowance_amount,allowance_desc:allowance_desc}),
				        success: function(readed) {
				            read =  readed; 
							console.log(read); 
							$("#total_allowance").val(read);     
							$("#allowance_amount").val("");
							$("#allowance_desc").val(""); 
				        }
				    });
				  
					return false;

			}
			else
			{
			}		
		}

		function add_date() {
			var ctr=0;
			var ctr_date=0;
		    var StartDate = document.getElementById('wk_start_date').value;
		    var EndDate = document.getElementById('wk_end_date').value; 
		    var url = '<?=base_url('index.php/payslips/print_payslips/')?>';
			var emp_no =document.getElementById('emp_name').value;
			var start_date =document.getElementById('wk_start_date').value;
			var end_date =document.getElementById('wk_end_date').value;
			$('#btn-print').attr('disabled','disabled');
            $('#print_payslip').attr('disabled','disabled'); 
            $.ajax({
    			type: "POST",
    			url: "<?=base_url('index.php/payslips/count_ts_temp/');?>",
    			data: ({
    				emp_no:emp_no,
    				StartDate: StartDate,
    				EndDate: EndDate
    			}),
    			
    			success: function(readed) {
    				read = readed; 
    				ctr_date = readed; 

    				console.log(ctr_date+'aaaa')
    			}

    		});
		    $.ajax({
		        type: "POST",
		        url: "<?=base_url('index.php/payslips/add_dates/');?>",
		        data: ({
		        	emp_no:emp_no,
		            StartDate: StartDate,
		            EndDate: EndDate
		        }),
		        success: function(readed) {
		            read = JSON.parse(readed); 
		            $('#row_day_1').attr('hidden',true);
	                $('#row_day_2').attr('hidden',true);
	                $('#row_day_3').attr('hidden',true);
	                $('#row_day_4').attr('hidden',true);
	                $('#row_day_5').attr('hidden',true);
	                $('#row_day_6').attr('hidden',true);
	                $('#row_day_7').attr('hidden',true);
	                $('#row_day_8').attr('hidden',true);
	                $('#row_day_9').attr('hidden',true);
	                $('#row_day_10').attr('hidden',true);
	                $('#row_day_11').attr('hidden',true);
	                $('#row_day_12').attr('hidden',true);
	                $('#row_day_13').attr('hidden',true);
	                $('#row_day_14').attr('hidden',true);
	              
		            $.each(read, function() {
		                var level = this.level;
		                var date = this.date;
		                var day = this.day;
		                var login = this.login;
		                var lunchout = this.lunchout;
		                var lunchin = this.lunchin;
		                var logout = this.logout; 
		                var id = '#row_day_' + level
		                var date_id = '#date_' + level
		                var day_login = '#day_login_' + level
		                var day_lunchin = '#day_lunchin_' + level
		                var day_lunchout = '#day_lunchout_' + level
		                var day_logout = '#day_logout_' + level
		                var add_dtr = '#add_dtr_' + level
		                var edit_dtr = '#edit_dtr_' + level
		                $('#row_day').removeAttr('hidden');
		                $(id).removeAttr('hidden');
		                $(date_id).val(date); 
		                $(day_login).removeAttr('disabled');
		                $(day_lunchin).removeAttr('disabled');
		                $(day_lunchout).removeAttr('disabled');
		                $(day_logout).removeAttr('disabled');
		                $(add_dtr).removeAttr('disabled');
		                $(edit_dtr).attr('disabled','disabled');
		            	$(day_login).val(login);
		            	$(day_lunchin).val(lunchin);
		            	$(day_lunchout).val(lunchout);
		            	$(day_logout).val(logout); 
		            	getsunday(day,level);
		            });
		         

		            $.ajax({
				        type: "POST",
				        url: "<?=base_url('index.php/payslips/get_payslips/');?>",
				        data: ({
				        	emp_no:emp_no,
				            StartDate: StartDate,
				            EndDate: EndDate
				        }),
				        success: function(ps_id) {
// 				        	ps_id = JSON.parse(ps_id);
				        	
				            url= url+'/'+ps_id.replace('"','');
				            $("#print_payslip").attr("href", url.replace('"','')); 
							ps_id = ps_id.replace('"','');
							ps_id = ps_id.replace('"','');
				            console.log(ps_id);
				            console.log("ddadsafsafs");
				            if(ps_id > 0)
				            {
				            	$("#print_payslip").removeAttr('disabled');	
				            	console.log(ps_id+'pppppppp');
					        }
					        }});

		           
		            if(ctr_date > 0)
		            {
		            	$.ajax({
					        type: "POST",
					        url: "<?=base_url('index.php/payslips/add_dates_from_ts/');?>",
					        data: ({
					        	emp_no:emp_no,
					            StartDate: StartDate,
					            EndDate: EndDate
					        }),
					        
					        success: function(readed) {
					            read = JSON.parse(readed);
					            console.log(readed.length+'ddd'); 
					            $.each(read, function() {
						            ctr=ctr+1;
						            });
					            console.log(ctr);
					            if(ctr > 0)
					            {
					            	
					            	$('#row_day_1').attr('hidden',true);
					                $('#row_day_2').attr('hidden',true);
					                $('#row_day_3').attr('hidden',true);
					                $('#row_day_4').attr('hidden',true);
					                $('#row_day_5').attr('hidden',true);
					                $('#row_day_6').attr('hidden',true);
					                $('#row_day_7').attr('hidden',true);
					                $('#row_day_8').attr('hidden',true);
					                $('#row_day_9').attr('hidden',true);
					                $('#row_day_10').attr('hidden',true);
					                $('#row_day_11').attr('hidden',true);
					                $('#row_day_12').attr('hidden',true);
					                $('#row_day_13').attr('hidden',true);
					                $('#row_day_14').attr('hidden',true);

						             
						            $.each(read, function() {
						                var level = this.level;
						                var date = this.date;
						                var login = this.login;
						                var lunchout = this.lunchout;
						                var lunchin = this.lunchin;
						                var logout = this.logout; 
						                var present = this.present; 
						                var id = '#row_day_' + level
						                var date_id = '#date_' + level
						                var day_login = '#day_login_' + level
						                var day_lunchin = '#day_lunchin_' + level
						                var day_lunchout = '#day_lunchout_' + level
						                var day_logout = '#day_logout_' + level
						                var add_dtr = '#add_dtr_' + level
						                var edit_dtr = '#edit_dtr_' + level
						                $('#row_day').removeAttr('hidden');
						                $(id).removeAttr('hidden');
						                $(date_id).val(date); 
						                if(present ==1)
						                {
						                	$(day_login).attr('disabled','disabled');
							                $(day_lunchin).attr('disabled','disabled');
							                $(day_lunchout).attr('disabled','disabled');
							                $(day_logout).attr('disabled','disabled');
							                $(add_dtr).attr('disabled','disabled');
							                $(edit_dtr).removeAttr('disabled');
							            }
						            	$(day_login).val(login);
						            	$(day_lunchin).val(lunchin);
						            	$(day_lunchout).val(lunchout);
						            	$(day_logout).val(logout);
						            	
						            }); 
						         }
					        }
					        }); 
			        }

		            
		            $.ajax({
				        type: "POST",
				        url: "<?=base_url('index.php/payslips/get_emp_info/');?>",
					        data:({emp_no:emp_no,start_date:start_date,end_date:end_date}),
					        success: function(readed) {
					            read = JSON.parse(readed);
//					            $("#cartcount").html(read);
								console.log(read);
								var deduction =read["deduction"];
								var allowance = read["allowance"];
								if(deduction < 1)
								{
									deduction = 0;
								}
								if(allowance < 1)
								{
									allowance = 0;
								}
								$("#total_deduct").val(deduction);
								$("#total_allowance").val(allowance);  
				        }
				    });
		




		            
		        }
		    });

		    return false;
		 
		} ///end of add_date
		function print_payslip() {
			var emp_no = document.getElementById('emp_name').value; 
			var wk_start_date = document.getElementById('wk_start_date').value;
			var wk_end_date = document.getElementById('wk_end_date').value;
			var url = '<?=base_url('index.php/payslips/print_payslips/')?>';
			  $.ajax({
			        type: "POST",
			        url: "<?=base_url('index.php/payslips/print_payslip/');?>",
			        data: ({
			            emp_no: emp_no,
			            wk_start_date: wk_start_date,
			            wk_end_date: wk_end_date, 
			        }),
			        success: function(readed) {
			            read = readed;
			            console.log(readed);
			            url= url+'/'+readed.replace('"','');
			            $("#print_payslip").attr("href", url.replace('"',''));
			            $('#btn-print').attr('disabled','disabled'); 
		                $('#print_payslip').removeAttr('disabled');
			        }
			    });
//this commented changes from save and print to save then print			
// 			$("#hidden_emp_no").val(emp_no);
// 			$("#hidden_start_date").val(wk_start_date);
// 			$("#hidden_end_date").val(wk_end_date);
// 			$('#frm_payslip_create').submit();
						
  

		}	
		function getsunday(day,level)
		{
			var edit = '#edit_dtr_'+level;
			var add =  '#add_dtr_'+level;
			var date =  '#date_'+level;
// 			var day_login =  '#day_login_'+level;
// 			var day_lunchout =  '#day_lunchout_'+level;
// 			var day_lunchin =  '#day_lunchin_'+level;
// 			var day_logout =  '#day_logout_'+level;
			if(day == 1)
			{
				$(edit).css("background","red");
				$(add).css("background","red");
				$(date).css("background","red");
// 				$(day_login).css("background","red");
// 				$(day_lunchin).css("background","red");
// 				$(day_lunchout).css("background","red");
// 				$(day_logout).css("background","red");

			}
			 
// 			document.getElementById("edit_dtr_1").style.background='#ff000';

		}
		function add_dtr_1() {
		    var emp_no = document.getElementById('emp_name').value;
		    var day_login_1 = document.getElementById('date_1').value + ' ' + document.getElementById('day_login_1').value;
		    var day_logout_1 = document.getElementById('date_1').value + ' ' + document.getElementById('day_logout_1').value;
		    var day_lunchin_1 = document.getElementById('date_1').value + ' ' + document.getElementById('day_lunchin_1').value;
		    var day_lunchout_1 = document.getElementById('date_1').value + ' ' + document.getElementById('day_lunchout_1').value;
		    $.ajax({
		        type: "POST",
		        url: "<?=base_url('index.php/payslips/add_dtr_1/');?>",
		        data: ({
		            emp_no: emp_no,
		            day_login_1: day_login_1,
		            day_logout_1: day_logout_1,
		            day_lunchin_1: day_lunchin_1,
		            day_lunchout_1: day_lunchout_1
		        }),
		        success: function(readed) {
		            read = readed;
		            console.log(readed);
		            $("#add_dtr_1").attr("disabled", true);
		            $("#edit_dtr_1").removeAttr("disabled");
		            $("#day_login_1").attr("disabled", true);
		            $("#day_logout_1").attr("disabled", true);
		            $("#day_lunchin_1").attr("disabled", true);
		            $("#day_lunchout_1").attr("disabled", true);
	                $('#btn-print').removeAttr('disabled');
		        }
		    });

		}
		function add_dtr_2() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_2 = document.getElementById('date_2').value + ' ' + document.getElementById('day_login_2').value;
			var day_logout_2 = document.getElementById('date_2').value + ' ' + document.getElementById('day_logout_2').value;
			var day_lunchin_2 = document.getElementById('date_2').value + ' ' + document.getElementById('day_lunchin_2').value;
			var day_lunchout_2 = document.getElementById('date_2').value + ' ' + document.getElementById('day_lunchout_2').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_2/');?>",
				data: ({
					emp_no: emp_no,
					day_login_2: day_login_2,
					day_logout_2: day_logout_2,
					day_lunchin_2: day_lunchin_2,
					day_lunchout_2: day_lunchout_2
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_2").attr("disabled", true);
		            $("#edit_dtr_2").removeAttr("disabled");
					$("#day_login_2").attr("disabled", true);
					$("#day_logout_2").attr("disabled", true);
					$("#day_lunchin_2").attr("disabled", true);
					$("#day_lunchout_2").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_3() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_3 = document.getElementById('date_3').value + ' ' + document.getElementById('day_login_3').value;
			var day_logout_3 = document.getElementById('date_3').value + ' ' + document.getElementById('day_logout_3').value;
			var day_lunchin_3 = document.getElementById('date_3').value + ' ' + document.getElementById('day_lunchin_3').value;
			var day_lunchout_3 = document.getElementById('date_3').value + ' ' + document.getElementById('day_lunchout_3').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_3/');?>",
				data: ({
					emp_no: emp_no,
					day_login_3: day_login_3,
					day_logout_3: day_logout_3,
					day_lunchin_3: day_lunchin_3,
					day_lunchout_3: day_lunchout_3
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_3").attr("disabled", true);
		            $("#edit_dtr_3").removeAttr("disabled");
					$("#day_login_3").attr("disabled", true);
					$("#day_logout_3").attr("disabled", true);
					$("#day_lunchin_3").attr("disabled", true);
					$("#day_lunchout_3").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_4() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_4 = document.getElementById('date_4').value + ' ' + document.getElementById('day_login_4').value;
			var day_logout_4 = document.getElementById('date_4').value + ' ' + document.getElementById('day_logout_4').value;
			var day_lunchin_4 = document.getElementById('date_4').value + ' ' + document.getElementById('day_lunchin_4').value;
			var day_lunchout_4 = document.getElementById('date_4').value + ' ' + document.getElementById('day_lunchout_4').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_4/');?>",
				data: ({
					emp_no: emp_no,
					day_login_4: day_login_4,
					day_logout_4: day_logout_4,
					day_lunchin_4: day_lunchin_4,
					day_lunchout_4: day_lunchout_4
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_4").attr("disabled", true);
		            $("#edit_dtr_4").removeAttr("disabled");
					$("#day_login_4").attr("disabled", true);
					$("#day_logout_4").attr("disabled", true);
					$("#day_lunchin_4").attr("disabled", true);
					$("#day_lunchout_4").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_5() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_5 = document.getElementById('date_5').value + ' ' + document.getElementById('day_login_5').value;
			var day_logout_5 = document.getElementById('date_5').value + ' ' + document.getElementById('day_logout_5').value;
			var day_lunchin_5 = document.getElementById('date_5').value + ' ' + document.getElementById('day_lunchin_5').value;
			var day_lunchout_5 = document.getElementById('date_5').value + ' ' + document.getElementById('day_lunchout_5').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_5/');?>",
				data: ({
					emp_no: emp_no,
					day_login_5: day_login_5,
					day_logout_5: day_logout_5,
					day_lunchin_5: day_lunchin_5,
					day_lunchout_5: day_lunchout_5
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_5").attr("disabled", true);
		            $("#edit_dtr_5").removeAttr("disabled");
					$("#day_login_5").attr("disabled", true);
					$("#day_logout_5").attr("disabled", true);
					$("#day_lunchin_5").attr("disabled", true);
					$("#day_lunchout_5").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}	
		function add_dtr_6() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_6 = document.getElementById('date_6').value + ' ' + document.getElementById('day_login_6').value;
			var day_logout_6 = document.getElementById('date_6').value + ' ' + document.getElementById('day_logout_6').value;
			var day_lunchin_6 = document.getElementById('date_6').value + ' ' + document.getElementById('day_lunchin_6').value;
			var day_lunchout_6 = document.getElementById('date_6').value + ' ' + document.getElementById('day_lunchout_6').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_6/');?>",
				data: ({
					emp_no: emp_no,
					day_login_6: day_login_6,
					day_logout_6: day_logout_6,
					day_lunchin_6: day_lunchin_6,
					day_lunchout_6: day_lunchout_6
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_6").attr("disabled", true);
		            $("#edit_dtr_6").removeAttr("disabled");
					$("#day_login_6").attr("disabled", true);
					$("#day_logout_6").attr("disabled", true);
					$("#day_lunchin_6").attr("disabled", true);
					$("#day_lunchout_6").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_7() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_7 = document.getElementById('date_7').value + ' ' + document.getElementById('day_login_7').value;
			var day_logout_7 = document.getElementById('date_7').value + ' ' + document.getElementById('day_logout_7').value;
			var day_lunchin_7 = document.getElementById('date_7').value + ' ' + document.getElementById('day_lunchin_7').value;
			var day_lunchout_7 = document.getElementById('date_7').value + ' ' + document.getElementById('day_lunchout_7').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_7/');?>",
				data: ({
					emp_no: emp_no,
					day_login_7: day_login_7,
					day_logout_7: day_logout_7,
					day_lunchin_7: day_lunchin_7,
					day_lunchout_7: day_lunchout_7
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_7").attr("disabled", true);
		            $("#edit_dtr_7").removeAttr("disabled");
					$("#day_login_7").attr("disabled", true);
					$("#day_logout_7").attr("disabled", true);
					$("#day_lunchin_7").attr("disabled", true);
					$("#day_lunchout_7").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_8() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_8 = document.getElementById('date_8').value + ' ' + document.getElementById('day_login_8').value;
			var day_logout_8 = document.getElementById('date_8').value + ' ' + document.getElementById('day_logout_8').value;
			var day_lunchin_8 = document.getElementById('date_8').value + ' ' + document.getElementById('day_lunchin_8').value;
			var day_lunchout_8 = document.getElementById('date_8').value + ' ' + document.getElementById('day_lunchout_8').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_8/');?>",
				data: ({
					emp_no: emp_no,
					day_login_8: day_login_8,
					day_logout_8: day_logout_8,
					day_lunchin_8: day_lunchin_8,
					day_lunchout_8: day_lunchout_8
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_8").attr("disabled", true);
		            $("#edit_dtr_8").removeAttr("disabled");
					$("#day_login_8").attr("disabled", true);
					$("#day_logout_8").attr("disabled", true);
					$("#day_lunchin_8").attr("disabled", true);
					$("#day_lunchout_8").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_9() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_9 = document.getElementById('date_9').value + ' ' + document.getElementById('day_login_9').value;
			var day_logout_9 = document.getElementById('date_9').value + ' ' + document.getElementById('day_logout_9').value;
			var day_lunchin_9 = document.getElementById('date_9').value + ' ' + document.getElementById('day_lunchin_9').value;
			var day_lunchout_9 = document.getElementById('date_9').value + ' ' + document.getElementById('day_lunchout_9').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_9/');?>",
				data: ({
					emp_no: emp_no,
					day_login_9: day_login_9,
					day_logout_9: day_logout_9,
					day_lunchin_9: day_lunchin_9,
					day_lunchout_9: day_lunchout_9
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_9").attr("disabled", true);
		            $("#edit_dtr_9").removeAttr("disabled");
					$("#day_login_9").attr("disabled", true);
					$("#day_logout_9").attr("disabled", true);
					$("#day_lunchin_9").attr("disabled", true);
					$("#day_lunchout_9").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_10() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_10 = document.getElementById('date_10').value + ' ' + document.getElementById('day_login_10').value;
			var day_logout_10 = document.getElementById('date_10').value + ' ' + document.getElementById('day_logout_10').value;
			var day_lunchin_10 = document.getElementById('date_10').value + ' ' + document.getElementById('day_lunchin_10').value;
			var day_lunchout_10 = document.getElementById('date_10').value + ' ' + document.getElementById('day_lunchout_10').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_10/');?>",
				data: ({
					emp_no: emp_no,
					day_login_10: day_login_10,
					day_logout_10: day_logout_10,
					day_lunchin_10: day_lunchin_10,
					day_lunchout_10: day_lunchout_10
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_10").attr("disabled", true);
		            $("#edit_dtr_10").removeAttr("disabled");
					$("#day_login_10").attr("disabled", true);
					$("#day_logout_10").attr("disabled", true);
					$("#day_lunchin_10").attr("disabled", true);
					$("#day_lunchout_10").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_11() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_11 = document.getElementById('date_11').value + ' ' + document.getElementById('day_login_11').value;
			var day_logout_11 = document.getElementById('date_11').value + ' ' + document.getElementById('day_logout_11').value;
			var day_lunchin_11 = document.getElementById('date_11').value + ' ' + document.getElementById('day_lunchin_11').value;
			var day_lunchout_11 = document.getElementById('date_11').value + ' ' + document.getElementById('day_lunchout_11').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_11/');?>",
				data: ({
					emp_no: emp_no,
					day_login_11: day_login_11,
					day_logout_11: day_logout_11,
					day_lunchin_11: day_lunchin_11,
					day_lunchout_11: day_lunchout_11
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_11").attr("disabled", true);
		            $("#edit_dtr_11").removeAttr("disabled");
					$("#day_login_11").attr("disabled", true);
					$("#day_logout_11").attr("disabled", true);
					$("#day_lunchin_11").attr("disabled", true);
					$("#day_lunchout_11").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_12() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_12 = document.getElementById('date_12').value + ' ' + document.getElementById('day_login_12').value;
			var day_logout_12 = document.getElementById('date_12').value + ' ' + document.getElementById('day_logout_12').value;
			var day_lunchin_12 = document.getElementById('date_12').value + ' ' + document.getElementById('day_lunchin_12').value;
			var day_lunchout_12 = document.getElementById('date_12').value + ' ' + document.getElementById('day_lunchout_12').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_12/');?>",
				data: ({
					emp_no: emp_no,
					day_login_12: day_login_12,
					day_logout_12: day_logout_12,
					day_lunchin_12: day_lunchin_12,
					day_lunchout_12: day_lunchout_12
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_12").attr("disabled", true); 
		            $("#edit_dtr_12").removeAttr("disabled");
					$("#day_login_12").attr("disabled", true);
					$("#day_logout_12").attr("disabled", true);
					$("#day_lunchin_12").attr("disabled", true);
					$("#day_lunchout_12").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_13() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_13 = document.getElementById('date_13').value + ' ' + document.getElementById('day_login_13').value;
			var day_logout_13 = document.getElementById('date_13').value + ' ' + document.getElementById('day_logout_13').value;
			var day_lunchin_13 = document.getElementById('date_13').value + ' ' + document.getElementById('day_lunchin_13').value;
			var day_lunchout_13 = document.getElementById('date_13').value + ' ' + document.getElementById('day_lunchout_13').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_13/');?>",
				data: ({
					emp_no: emp_no,
					day_login_13: day_login_13,
					day_logout_13: day_logout_13,
					day_lunchin_13: day_lunchin_13,
					day_lunchout_13: day_lunchout_13
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_13").attr("disabled", true);
		            $("#edit_dtr_13").removeAttr("disabled");
					$("#day_login_13").attr("disabled", true);
					$("#day_logout_13").attr("disabled", true);
					$("#day_lunchin_13").attr("disabled", true);
					$("#day_lunchout_13").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}
		function add_dtr_14() {
			var emp_no = document.getElementById('emp_name').value;
			var day_login_14 = document.getElementById('date_14').value + ' ' + document.getElementById('day_login_14').value;
			var day_logout_14 = document.getElementById('date_14').value + ' ' + document.getElementById('day_logout_14').value;
			var day_lunchin_14 = document.getElementById('date_14').value + ' ' + document.getElementById('day_lunchin_14').value;
			var day_lunchout_14 = document.getElementById('date_14').value + ' ' + document.getElementById('day_lunchout_14').value;
			$.ajax({
				type: "POST",
				url: "<?=base_url('index.php/payslips/add_dtr_14/');?>",
				data: ({
					emp_no: emp_no,
					day_login_14: day_login_14,
					day_logout_14: day_logout_14,
					day_lunchin_14: day_lunchin_14,
					day_lunchout_14: day_lunchout_14
				}),
				success: function(readed) {
					read = readed;
					console.log(readed);
					$("#add_dtr_14").attr("disabled", true);
		            $("#edit_dtr_14").removeAttr("disabled");
					$("#day_login_14").attr("disabled", true);
					$("#day_logout_14").attr("disabled", true);
					$("#day_lunchin_14").attr("disabled", true);
					$("#day_lunchout_14").attr("disabled", true);
					$('#btn-print').removeAttr('disabled'); 
				}
			});

		}



		function update_dtr_1() 
		{ 
			$("#day_login_1").removeAttr("disabled");
			$("#day_logout_1").removeAttr("disabled");
			$("#day_lunchin_1").removeAttr("disabled");
			$("#day_lunchout_1").removeAttr("disabled");
			$("#add_dtr_1").removeAttr("disabled");
			$("#edit_dtr_1").attr("disabled",true);
			
		}
		function update_dtr_2() 
		{

			$("#day_login_2").removeAttr("disabled");
			$("#day_logout_2").removeAttr("disabled");
			$("#day_lunchin_2").removeAttr("disabled");
			$("#day_lunchout_2").removeAttr("disabled");
			$("#add_dtr_2").removeAttr("disabled");
			$("#edit_dtr_2").attr("disabled",true);
			
		}
		function update_dtr_3() 
		{

			$("#day_login_3").removeAttr("disabled");
			$("#day_logout_3").removeAttr("disabled");
			$("#day_lunchin_3").removeAttr("disabled");
			$("#day_lunchout_3").removeAttr("disabled");
			$("#add_dtr_3").removeAttr("disabled");
			$("#edit_dtr_3").attr("disabled",true);
			
		}
		function update_dtr_4() 
		{
			$("#day_login_4").removeAttr("disabled");
			$("#day_logout_4").removeAttr("disabled");
			$("#day_lunchin_4").removeAttr("disabled");
			$("#day_lunchout_4").removeAttr("disabled");
			$("#add_dtr_4").removeAttr("disabled");
			$("#edit_dtr_4").attr("disabled",true);
			
		}
		function update_dtr_5() 
		{
			$("#day_login_5").removeAttr("disabled");
			$("#day_logout_5").removeAttr("disabled");
			$("#day_lunchin_5").removeAttr("disabled");
			$("#day_lunchout_5").removeAttr("disabled");
			$("#add_dtr_5").removeAttr("disabled");
			$("#edit_dtr_5").attr("disabled",true);
			
		}
		function update_dtr_6() 
		{

			$("#day_login_6").removeAttr("disabled");
			$("#day_logout_6").removeAttr("disabled");
			$("#day_lunchin_6").removeAttr("disabled");
			$("#day_lunchout_6").removeAttr("disabled");
			$("#add_dtr_6").removeAttr("disabled");
			$("#edit_dtr_6").attr("disabled",true);
			
		}
		function update_dtr_7() 
		{
			$("#day_login_7").removeAttr("disabled");
			$("#day_logout_7").removeAttr("disabled");
			$("#day_lunchin_7").removeAttr("disabled");
			$("#day_lunchout_7").removeAttr("disabled");
			$("#add_dtr_7").removeAttr("disabled");
			$("#edit_dtr_7").attr("disabled",true);
			
		}
		function update_dtr_8() 
		{
			$("#day_login_8").removeAttr("disabled");
			$("#day_logout_8").removeAttr("disabled");
			$("#day_lunchin_8").removeAttr("disabled");
			$("#day_lunchout_8").removeAttr("disabled");
			$("#add_dtr_8").removeAttr("disabled");
			$("#edit_dtr_8").attr("disabled",true);
			
		}
		function update_dtr_9() 
		{
			$("#day_login_9").removeAttr("disabled");
			$("#day_logout_9").removeAttr("disabled");
			$("#day_lunchin_9").removeAttr("disabled");
			$("#day_lunchout_9").removeAttr("disabled");
			$("#add_dtr_9").removeAttr("disabled");
			$("#edit_dtr_9").attr("disabled",true);
			
		}
		function update_dtr_10() 
		{
			$("#day_login_10").removeAttr("disabled");
			$("#day_logout_10").removeAttr("disabled");
			$("#day_lunchin_10").removeAttr("disabled");
			$("#day_lunchout_10").removeAttr("disabled");
			$("#add_dtr_10").removeAttr("disabled");
			$("#edit_dtr_10").attr("disabled",true);
			
		}
		function update_dtr_11() 
		{
			$("#day_login_11").removeAttr("disabled");
			$("#day_logout_11").removeAttr("disabled");
			$("#day_lunchin_11").removeAttr("disabled");
			$("#day_lunchout_11").removeAttr("disabled");
			$("#add_dtr_11").removeAttr("disabled");
			$("#edit_dtr_11").attr("disabled",true);
			
		}
		function update_dtr_12() 
		{
			$("#day_login_12").removeAttr("disabled");
			$("#day_logout_12").removeAttr("disabled");
			$("#day_lunchin_12").removeAttr("disabled");
			$("#day_lunchout_12").removeAttr("disabled");
			$("#add_dtr_12").removeAttr("disabled");
			$("#edit_dtr_12").attr("disabled",true);
			
		}
		function update_dtr_13() 
		{
			$("#day_login_13").removeAttr("disabled");
			$("#day_logout_13").removeAttr("disabled");
			$("#day_lunchin_13").removeAttr("disabled");
			$("#day_lunchout_13").removeAttr("disabled");
			$("#add_dtr_13").removeAttr("disabled");
			$("#edit_dtr_13").attr("disabled",true);
			
		}
		function update_dtr_14() 
		{
			$("#day_login_14").removeAttr("disabled");
			$("#day_logout_14").removeAttr("disabled");
			$("#day_lunchin_14").removeAttr("disabled");
			$("#day_lunchout_14").removeAttr("disabled");
			$("#add_dtr_14").removeAttr("disabled");
			$("#edit_dtr_14").attr("disabled",true);
			
		}
// 			$(document).ready(function(){
// 			    $('#MyButton').click(function(){
// 				var deduct_date =$("#deduct_date").val();
// 				var deduct_amount =document.getElementById('deduct_amount').value;
// 				var deduct_desc =document.getElementById('deduct_desc').value;
// // 				if(deduct_date.val().length == 0)
// // 				{
// // 					$('#deduct_date').prop('required', true);				
// // 				}
// // 				else if(deduct_amount.val().length == 0)
// // 				{
// // 					$('#deduct_amount').prop('required', true);
// // 				}
// // 				else if(deduct_desc.val().length == 0)
// // 				{
// // 					$('#deduct_desc').prop('required', true);
// // 				}
// alert(deduct_date);
// 			console.log;
// 			    });
// 			  });
	
		</script> 
	<?php elseif($menu_name=='report'):?>
	   <!--   <script src="<?//=base_url().'js/moment.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- <script src="<?//=base_url().'js/jquery.min.js';?>" type="text/javascript"></script> remove for tables -->
	    <!-- DATA TABES SCRIPT -->
    	<script src="<?=base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
		<!-- Input Mask -->
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.date.extensions.js');?>" type="text/javascript"></script>
		<script src="<?=base_url('js/plugins/input-mask/jquery.inputmask.extensions.js');?>" type="text/javascript"></script>	
	    <!-- SlimScroll -->
	    <script src="<?=base_url('js/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src="<?=base_url('js/plugins/fastclick/fastclick.min.js');?>"></script>
	
		<script type="text/javascript">  
 
		
		 $(function() {
		     $(".timepicker").inputmask("hh:mm t", {
		         alias: 'time',
		         placeholder: "hh:mm t",
		         insertMode: true,
		         showMaskOnHover: true,
		         hourFormat: 12
		     });
		     $('[data-mask]').inputmask();
		     $('#datemask').inputmask('yyyy-mm-dd', {
		         'placeholder': 'yyyy-mm-dd'
		     });
		     $('[data-mask]').inputmask();
				
		     $('#employee_position').click(function()
			  {
    	 		$("#report_emp_position").attr("disabled", false);
			  	$("#report_emp_no").attr("disabled", true); 
			  	$("#report_emp_position").val("%")
			  });	

		     $('#employee_no').click(function()
			  { 
    	 		$("#report_emp_position").attr("disabled", true);
			  	$("#report_emp_no").attr("disabled", false);
			  	$("#report_emp_no").val("<?=$report_emp_no;?>");
			  });	
			
		     
		 } );
     </script>
		     <?php endif;?>
  </body>
</html>