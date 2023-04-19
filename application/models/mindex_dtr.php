<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class  mindex_dtr extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function dtr_view($dtr_per_page=0,$dtr_row=0,$dtr_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
//   		$query = $this->dbAll->query("select top $dtr_per_page * from vwTimesheets where row between $dtr_row and $dtr_total and deleted = 0 order by ts_time desc"); 	
//   		return $query->result();		
		echo "select top $dtr_per_page * from vwTimesheets where row between $dtr_row and $dtr_total and deleted = 0 order by ts_time desc";
	}
	function count_dtr()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select COUNT(*) as count_dtr from vwTimesheets  where deleted = 0 ");
		return $query->row();
	}
	function dtr_view_search($dtr_per_page=0,$dtr_search="",$dtr_row=0,$dtr_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top $dtr_per_page * from fnSearchTimesheets('$dtr_search') where ts_row between $dtr_row and $dtr_total and deleted = 0 order by ts_emp_no, ts_option_name asc");
		return $query->result();

// 		ECHO "select top $dtr_per_page * from fnSearchTimesheets('$dtr_search') where ts_row between $dtr_row and $dtr_total and deleted = 0 order by ts_time desc";
		
	}
	function count_dtr_search($dtr_search="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select COUNT(*) as count_dtr from fnSearchTimesheets('$dtr_search')");
		return $query->row();
	}
	function dtr_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows ,  * from [rows per page] ");
		return $query->result();
	}
	function active_dtr_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows , 	* from [rows per page] where active =1 ");
		return $query->row();
	}
	function update_dtr_num_rows($dtr_per_page=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
		$query = $this->dbAll->query("update [rows per page] set Active = 1  where [No of Rows] = $dtr_per_page");
	}
	
	function get_employees()
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from vwemployee where emp_deleted = 0"); 	
  		return $query->result();		
	}
	function get_emp_info($dtr_emp_no='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [vwemployee] where emp_no = '$dtr_emp_no' ");
		return $query->row();
	}
	function get_emp_no($sel_name='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_no from [vwemployee] where (emp_first_name + ' ' +emp_last_name) = '$sel_name' ");
		return $query->row();
	}
	function save_dtr_log($dtr_emp_id = 0, $dtr_emp_no = 0, $dtr_option = 0, $dtr_option_name = '')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("INSERT INTO [dbo].[Daily Time Record]
				([User ID],[Emp No] ,[Option],[Option Name],[Deleted],Time)
				VALUES
				('$dtr_emp_id','$dtr_emp_no','$dtr_option','$dtr_option_name',0 ,getdate())");
		
	}
	
	function save_dtr_login($dtr_emp_id = 0, $dtr_emp_no = 0,$dtr_login="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("exec  [sp_insertDTR] $dtr_emp_id,'$dtr_emp_no','$dtr_login',1"); 
		 
	}
	function save_dtr_logout($dtr_emp_id = 0, $dtr_emp_no = 0,$dtr_logout="")
	{ 
		$query = $this->dbAll->query("exec  [sp_insertDTR] $dtr_emp_id,'$dtr_emp_no','$dtr_logout',2"); 
	}
	function save_dtr_lunchout($dtr_emp_id = 0, $dtr_emp_no = 0,$dtr_lunchout="")
	{
		$query = $this->dbAll->query("exec  [sp_insertDTR] $dtr_emp_id,'$dtr_emp_no','$dtr_lunchout',3");
	}
	function save_dtr_lunchin($dtr_emp_id = 0, $dtr_emp_no = 0,$dtr_lunchin="")
	{
		$query = $this->dbAll->query("exec  [sp_insertDTR] $dtr_emp_id,'$dtr_emp_no','$dtr_lunchin',4");
	}
	
	
	function save_dtr_log_manual($dtr_emp_id = 0, $dtr_emp_no = 0, $dtr_option = 0, $dtr_option_name = '', $dtr_time='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("INSERT INTO [dbo].[Daily Time Record]
				([User ID],[Emp No] ,[Option],[Option Name],[Deleted],Time)
				VALUES
				('$dtr_emp_id','$dtr_emp_no','$dtr_option','$dtr_option_name',0 ,'$dtr_time')");
	
	}
	function show_emp_info($dtr_emp_no = 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("SELECT  [Emp No] as emp_no FROM Employee
				where [Emp No] = '$dtr_emp_no' and  deleted = '0'");
	
		return $query->row();
	}
	
	function dtr_emp_info($dtr_emp_no = 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("SELECT * FROM vwemployee
				where emp_no = '$dtr_emp_no' and  emp_deleted = '0'");
	
		return $query->row();
	}
	
	function check_dual_remarks($dtr_emp_no = '', $dtr_option_name = '')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from fnDailyTimeRecord() where dtr_emp_no = '$dtr_emp_no' and dtr_option_name = '$dtr_option_name'");
		return $query->row();
	}
	function check_dual_remarks_manual($dtr_emp_no = '', $dtr_option_name = '',$dtr_time='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from fnDailyTimeRecordManual() where dtr_emp_no = '$dtr_emp_no' and dtr_option_name = '$dtr_option_name' and  dateadd (dd, 0,datediff (dd, 0,dtr_time ))= cast('$dtr_time' as datetime)");
		return $query->row();
// echo "select * from fnDailyTimeRecordManual() where dtr_emp_no = '$dtr_emp_no' and dtr_option_name = '$dtr_option_name' and  dateadd (dd, 0,datediff (dd, 0,dtr_time ))= cast('$dtr_time' as datetime)"
;
	}
	function check_option_login($dtr_emp_no = '', $dtr_option_name = '')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_no from fnTimeRecordOptionCheck() where emp_no = '$dtr_emp_no' ");
		return $query->row();
	}
	function get_treeview($treeview_name='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
		return $query->row();
	}
// 	[fnTimeRecordOptionCheck]
	function send_email_dtr($dtr_emp_email = "",$dtr_option_name= "", $dtr_full_name="")
	{	
// 		$dtr_emp_email="emerson@prechart.com";
// 		$config['protocol'] = 'smtp';
// 		$config['smtp_host'] = 'smtp.mailgun.org';
// 		$config['smtp_port'] = 'tls';
// 		$config['smtp_port'] = 587;
// 		$config['smtp_user'] = 'postmaster@sandboxb54ff44cb80b405eaf0473c3695de74a.mailgun.org';
// 		$config['smtp_pass'] = '4op65jnrxap1';
// 		$config['mailtype']  = 'html';
// 		date_default_timezone_set('Asia/Taipei');
// 		$date = date('Y-m-d h:m:s');
// 		$html_email = "<table><tr><td>Hi Peter,</td>".'<tr><td>'.$dtr_full_name .' '. '['.$dtr_option_name.
// 		' '.$date.']'.'</td></tr><tr><td></td></tr><tr><td>'.$dtr_full_name.'</td></tr></table>';
// 		$this->load->library('email', $config);
// 		$this->email->set_newline("\r\n");
			
// 		$this->email->from('NO-REPLY@prechart.com');
// 		$this->email->to('emerson@prechart.com');
// 		$this->email->cc($dtr_emp_email);
// 		$this->email->subject('['.$dtr_option_name. ']'.'['.$date.']'.'['.$dtr_full_name.']' );
// 		$this->email->set_mailtype("html");
	
// 		$this->email->message($html_email);
// 		$this->email->send();
			
	}
	function dtr_update($dtr_update_id="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [daily time record] set time = getdate(),
				[changed date]= getdate() where [id] = '$dtr_update_id' ");
	}
	function dtr_date()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select convert(varchar(10), getdate(), 103)+ ' ' + convert(varchar(8), getdate(), 108) as date ");
		return $query->row();
	}
	function dtr_get_emp_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwemployee where emp_deleted =0");
		return $query->result();
	}
	function dtr_get_emp_id($dtr_emp_no = 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_user_id from vwemployee where emp_no = '$dtr_emp_no'");
		return $query->row();
	}
	function dtr_add($dtr_emp_id = 0,$dtr_emp_no = 0 ,$dtr_date ="", $dtr_option = 0,$dtr_option_name="" )
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("Insert Into [Daily Time Record] ([User ID],[Emp No],[Time],[Option],[Option Name],[Deleted]) 
				Values ($dtr_emp_id,'$dtr_emp_no','$dtr_date',$dtr_option,'$dtr_option_name',0)");
	}
	function dtr_added_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top 1 * from vwtimesheets order by ts_id desc");
		return $query->row();
	}
	function update_dtr($dtr_date = "",$dtr_option = 0,$dtr_option_name="", $dtr_id =0 )
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [Daily Time Record] set [time] = '$dtr_date' ,[option] = $dtr_option, 
		[option name] = '$dtr_option_name', [changed date] = getdate()  where id = $dtr_id ");
// 		echo "update [Daily Time Record] set [time] = '$dtr_date', [option] = $dtr_option, [option name] = '$dtr_option_name' where id = $dtr_id ";
	}
	function dtr_updated_info($dtr_id =0 )
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select  * from vwtimesheets where ts_id = $dtr_id");
		return $query->row();
	}
	function dtr_delete($dtr_id =0 )
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [Daily Time Record] set [deleted] = 1, [changed date] = getdate() where id =  $dtr_id");
	}
	function dtr_get_emp_info_first_row()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top 1* from vwemployee");
		return $query->row();
	}
	function dtr_update_info($dtr_id=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwtimesheets where ts_id = '$dtr_id'");
		return $query->row();
	}
	function dtr_emp_rec($sel_name= '', $cutoffdate = 0, $sel_month = 0, $sel_year = 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("spGetEmpDTR @EMPNAME='$sel_name', @CUTOFFDATE='$cutoffdate', @MONTH='$sel_month',  @YEAR='$sel_year' ");
		return $query->result_array();
	}
	function dtr_emp_header($sel_name= '', $cutoffdate = 0, $sel_month = 0, $sel_year = 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("spGetEmpHeaderDTR @EMPNAME='$sel_name', @CUTOFFDATE='$cutoffdate', @MONTH='$sel_month',  @YEAR='$sel_year' ");
		return $query->result_array();
	}
	function dtr_emp_getleave()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("spGetCurrentLeaveAvailable");
		return $query->result_array();
	}
	function post_GetEmpLeaveAvailable($post_name="",$post_month="",$post_year="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("spGetEmpLeaveAvailable @empname='$post_name', @month='$post_month', @year='$post_year'");
		return $query->result_array();
		//echo "spGetEmpLeaveAvailable @empname='$post_name', @month='$post_month', @year='$post_year'";
	}
	function post_InsertCurrentLeaveAvailable()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("spInsertCurrentLeaveAvailable");
		return $query->result_array();
	}
	function check_current_post_leave($sel_name="",$sel_month="",$sel_year="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("select month from [employee leave available] where MONTH =convert(int,'$sel_month' -1) and YEAR=$sel_year
						and [emp no] = (select [Emp No] from Employee where ([First Name] +' '+ [Last Name] = '$sel_name') )");
		return $query->result_array();
	}
	function check_last_post_leave($sel_name="",$sel_month="",$sel_year="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("select month from [employee leave available] where MONTH =$sel_month and YEAR=$sel_year
				and [emp no] = (select [Emp No] from Employee where ([First Name] +' '+ [Last Name] = '$sel_name') )");
		return $query->result_array();
	}
	function deduct_leave($deduct_name="", $deduct_year=0, $deduct_leave=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query =  $this->dbAll->query("spDeductLeave @empname='$deduct_name', @year=$deduct_year, @noofleave=$deduct_leave");
		//return $query->result_array();
	}
}