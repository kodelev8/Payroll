<footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; <?= date('Y')-1 .'-' .date('Y');?> <a href="http://prechart.com">Prechart Software Inc</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
    

          
          
    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url().'js/plugins/jQuery/jQuery-2.1.3.min.js';?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url().'js/bootstrap.min.js';?>" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?=base_url().'js/plugins/datatables/jquery.dataTables.js';?>" type="text/javascript"></script>
    <script src="<?=base_url().'js/plugins/datatables/dataTables.bootstrap.js';?>" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?=base_url().'js/plugins/slimScroll/jquery.slimscroll.min.js';?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?=base_url().'js/plugins/fastclick/fastclick.min.js';?>'></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url().'js/app.min.js';?>" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=base_url().'js/demo.js'?>" type="text/javascript"></script>
    <!-- page script -->
	<script src="<?=base_url().'js/date-picker.js'; ?>" type="text/javascript"></script>
    <script type="text/javascript">
    window.onload=function()
    {
	        populatedropdown( "month_summary", "year_summary")
	        document.getElementById("month_summary").value = "<?=$sel_month;?>";
	        document.getElementById("year_summary").value = "<?=$sel_year;?>";
	        document.getElementById("sel_name").value = "<?=$sel_name;?>";
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

  </body>
</html>