
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
 
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Post Leave
<!--             <small>advanced tables</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Post Leave</a></li>
            <li class="active">Post Leave</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3>Employee Information</h3>		
                </div><!-- /.box-header -->
                <div class="box-body">
				<div class="row">
					<div class="col-md-4">
		                <table class="table table-bordered table-striped" id="post-info">
		 					<tr>
		 						<td>Employee Name:</td>
		 						<td><?= $post_name ;?></td>
		 					</tr>
		 					<tr>
		 					 	<td>Month:</td>
		 						<td><?= $post_month ;?></td>
		 					</tr>
		 					<tr>
		 					 	<td>Year:</td>
		 						<td><?= $post_year ;?></td>
		 					</tr>
			 			</table>
					</div>
				</div>
                <h4>Employee Leave Available</h4>
                <p></p>
                <p></p>
                  <table class="table table-bordered table-striped">
                    <thead>
	                   	<tr>
							<td> Month</td>
							<td> Year</td>
							<td> Cut Off Date</td>
							<td> Leave Awarded</td>
							<td> Last Year Leave</td>
							<td> Leave Taken</td>
							<td> Leave This Month</td>
							<td> Leave Available</td>
							<td> Remarks</td>
						</tr>
                    </thead>
                    <tbody>
                    <?php foreach ($post_GetEmpLeaveAvailable as $gela):?>
                    	<tr>
                    		<td><?= $gela['MONTH'];?></td>
                    		<td><?= $gela['YEAR'];?></td>
                    		<td><?= $gela['CUT OFF DATE'];?></td>
                    		<td><?= $gela['LEAVE AWARDED'];?></td>
                    		<td><?= $gela['LAST YEAR LEAVE'];?></td>
                    		<td><?= $gela['LEAVE TAKEN'];?></td>
                    		<td><?= $gela['THIS MONTH LEAVE'];?></td>
                    		<td><?= $gela['LEAVE AVAILABLE'];?></td>
                    		<td><?= $gela['REMARKS'];?></td>
                   		</tr>
                    <?php endforeach;?>
                    </tbody>
                  </table>
                   <p></p>
                   <p></p>
                   <p></p>
                   <p></p>
                  <h4>Employee Current Leave Available</h4>
                  <table class="table table-bordered table-striped">
                    <thead>
	                   	<tr>
							<td> Month</td>
							<td> Year</td>
							<td> Cut Off Date</td>
							<td> Leave Awarded</td>
							<td> Last Year Leave</td>
							<td> Leave Taken</td>
							<td> Leave This Month</td>
							<td> Leave Available</td>
							<td> Remarks</td>
						</tr>
                    </thead>
                    <tbody>
                    <?php foreach ($post_GetCurrentLeaveAvailable as $gcla):?>
                    	<tr>
                    		<td><?= $gcla['MONTH'];?></td>
                    		<td><?= $gcla['YEAR'];?></td>
                    		<td><?= $gcla['CUT OFF DATE'];?></td>
                    		<td><?= $gcla['LEAVE AWARDED'];?></td>
                    		<td><?= $gcla['LAST YEAR LEAVE'];?></td>
                    		<td><?= $gcla['LEAVE TAKEN'];?></td>
                    		<td><?= $gcla['THIS MONTH LEAVE'];?></td>
                    		<td><?= $gcla['LEAVE AVAILABLE'];?></td>
                    		<td><?= $gcla['REMARKS'];?></td>
                   		</tr>
                    <?php endforeach;?>
                    </tbody>
   
                  </table>
                  		<?=form_open('dtr/summary', array('class' => 'form-horizontal', 'id'=> 'frm_dtr_summary'));?>
							<?php echo bs_inputfield_hidden('sel_name', element('sel_name', $record))?>
							<?php echo bs_inputfield_hidden('sel_month', element('sel_month', $record))?>
							<?php echo bs_inputfield_hidden('sel_year', element('sel_year', $record))?>
                   		<?=form_close();?>
                </div><!-- /.box-body -->
                   <div class="box-footer">
					
	                  <div class="form-actions">
		                  <div class="col-sm-3"></div>
							<table >
								<tr>
									<td>
										<button  class="btn btn-primary pull-left <?= $post_disable == 1 ? 'disabled':'';?>" name="btn-add" value="add" onclick="$('#myModal').modal('show');">
											Post
										</button>
									</td>
									<td width="50px">
									</td>
									<td>
										<a class="btn btn-primary pull-right" onclick="document.forms['frm_dtr_summary'].submit();">
											Back
										</a>
									</td>
								</tr>
							</table>	
						<div class="col-sm-3"></div>
	                 </div>

                  </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php $month_array = array(' ', 'January', 'February', 'March','April','May','June',
      							'July','August','September', 'October','November','December');   ?>
      							
		<div class="example-modal">
			<div id="myModal"  class="modal modal-info">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button class="close" aria-label="Close" data-dismiss="modal" type="button">
								<span aria-hidden="true">x</span>
							</button>
						<h4 class="modal-title">Post Employee Leave</h4>
						</div>
						<div class="modal-body">
							<p></p> Do you want Post the leave of 
							<?= $record['post_sel_name'];?> for this date <?=  $month_array[intval($record['post_sel_month'])].', '.$record['post_sel_year'];?>
							<?=form_open('dtr/view_posted_dtr', array('class' => 'form-horizontal', 'id'=> 'frm_dtr_post'));?>
								<?php echo bs_inputfield_hidden('post_sel_name', element('post_sel_name', $record))?>
								<?php echo bs_inputfield_hidden('post_sel_month', element('post_sel_month', $record))?>
								<?php echo bs_inputfield_hidden('post_sel_year', element('post_sel_year', $record))?>
                   		 	<?=form_close();?>
						</div>
						<div class="modal-footer">
							<button class="btn btn-outline pull-left" data-dismiss="modal" type="button">Close</button>
							<button class="btn btn-outline" type="button"  onclick="document.forms['frm_dtr_post'].submit();">Post</button>
						</div>
					</div>
				</div>
			</div>
		</div>
      

  