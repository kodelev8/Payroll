<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class  mindex_report extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function timesheets_report_emp_no($report_emp_no = '',$startdate ='',$enddate ='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from Timesheets_report where emp_no = '$report_emp_no' and startdate between '$startdate' and '$enddate' and deleted = 0 "); 	
  		return $query->result();		
	}
	function timesheets_report_emp_position($report_emp_position='', $startdate='',$enddate='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from Timesheets_report where  left(emp_no,1) in ($report_emp_position) and   startdate between '$startdate' and '$enddate'  and deleted = 0  ");
		return $query->result();
	}
	function payslips_report_emp_no($report_emp_no = '',$startdate ='',$enddate ='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vw_payslips where Ps_Emp_no = '$report_emp_no' and Ps_Date_From between '$startdate' and '$enddate' and Ps_deleted = 0");
		return $query->result();
	 }
	function payslips_report_emp_position($report_emp_position='',$startdate='',$enddate='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vw_payslips where  left(Ps_Emp_No,1) in ($report_emp_position)   and Ps_Date_From between '$startdate' and '$enddate' and Ps_deleted= 0 order by Ps_Emp_Position asc");
		return $query->result();
	}
	function deduction_report_emp_position($report_emp_position='',$startdate='',$enddate='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("exec [sp_list_deduction] '$report_emp_position','$startdate','$enddate'");
		return $query->result_array();
	}
	function allowance_report_emp_position($report_emp_position='',$startdate='',$enddate='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwAllowance where left(Allowance_Emp_No,1) in ($report_emp_position) and Allowance_Date between '$startdate'and '$enddate' and Allowance_Deleted  = 0");
		return $query->result();
	}
	
	function allowance_report_emp_no($report_emp_no='',$startdate='',$enddate='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwAllowance where   Allowance_Emp_No= $report_emp_position and Allowance_Date between '$startdate'and '$enddate' and Allowance_Deleted  = 0");
		return $query->result();
	}
	function deduction_report_emp_no($report_emp_no='',$startdate='',$enddate='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("exec [sp_list_deduction_empno] '$report_emp_no','$startdate','$enddate'");
		return $query->result_array();
	}
	function list_emp_position()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [dbo].[fnGetPosition]() order by position asc ");
		return $query->result();
	}
	function list_emp_no()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_no, (emp_last_name+', '+emp_first_name+' '+ +emp_suffix_name ) emp_name from  vwEmployee where emp_deleted =0 order by emp_last_name asc ");
		return $query->result();
	}
 
	function get_treeview($treeview_name='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
		return $query->row();
	}
	
// 	function count_payslips()
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select COUNT(*) as count_payslips from vw_payslips  where ps_deleted = 0 ");
// 		return $query->row();
// 	}
// 	function count_payslips_process($PS_date_from=0,$PS_date_to=0)
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select COUNT(*) as count_payslips from vw_payslips  where ts_date	 between CAST ('2014-03-01' AS DATE) AND CAST ('2014-03-15' AS DATE) ts_deleted = 0 ");
// 		return $query->row();
// 	}
// 	function get_payslips_emp_no()
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select emp_no from vwEmployee where emp_deleted =0 ");
// 		return $query->result();
// 	}
// 	function get_timesheets_process($ts_emp_no=0,$wk_start_date="",$wk_end_date="")
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select * from vw_Timesheets where TS_Emp_No = '$ts_emp_no' and TS_Date between  
// 				'$wk_start_date' and '$wk_end_date'  and TS_Deleted = 0 ");
// 		return $query->result();
// 	}
		
// 	function payslips_process($PS_emp_no = "",$PS_date_from = "",$PS_date_to = "" )
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("exec Sp_createpayslipsrecord '$PS_emp_no','$PS_date_from','$PS_date_to' ");
// 		// 		return $query->result();
// 	}
// 	function payslips_num_rows()
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select [No of Rows] NumRows ,  * from [rows per page] ");
// 		return $query->result();
// 	}
// 	function active_payslips_num_rows()
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select [No of Rows] NumRows , 	* from [rows per page] where active =1 ");
// 		return $query->row();
// 	}
// 	function update_payslips_num_rows($per_page=0)
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
// 		$query = $this->dbAll->query("update [rows per page] set Active = 1  where [No of Rows] = $per_page");
// 	}
// 	function getpayslip_print($Ps_id =0)
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select  * from vw_payslips where ps_id =$Ps_id ");
// 		return $query->row();
// 	}
// 	function get_allowance($Ps_emp_no="",$ps_date_from ="",$ps_date_to ="")
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("SELECT * FROM  vwAllowance
// 			WHERE  Allowance_Emp_No	 = '$Ps_emp_no' and  Allowance_Date between '$ps_date_from' and '$ps_date_to'");
// 		return $query->result();
// 	}
// 	function get_deduction($Ps_emp_no="",$ps_date_from ="",$ps_date_to ="")
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("SELECT * FROM  vwdeduction
// 			WHERE  Deduction_Emp_No	 = '$Ps_emp_no' and  Deduction_Date between '$ps_date_from' and '$ps_date_to'");
// 		return $query->result();
// 	}
// 	function get_employee_info($Ps_emp_no="")
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("SELECT * FROM  vwemployee WHERE  emp_no = '$Ps_emp_no'");
// 		return $query->row();
// 	}
// 	function get_treeview($treeview_name='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
// 		return $query->row();
// 	}
// 	function generate_reports_ts($filename='',$month=0,$year=0)
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query(" EXEC	[dbo].[Sp_generate_report]@file = '$filename',@month = '$month',@year = '$year'");
// // 		echo " EXEC	[dbo].[Sp_generate_report]@file = '$filename',@month = '$month',@year = '$year'";
// // 		return $query->row();
// 	}
// 	function payslip_view_search($payslip_per_page=0,$payslip_search="",$payslip_row=0,$payslip_total=0)
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select top $payslip_per_page * from fnSearchpayslips('$payslip_search') where payslip_row between $payslip_row and $payslip_total and ps_deleted = 0 order by ps_id desc");
// 		return $query->result();
// // 		echo "select top $payslip_per_page * from fnSearchpayslips('$payslip_search') where payslip_row between $payslip_row and $payslip_total and ps_deleted = 0 order by Ps_Date_From desc";
// 	}
// 	function count_payslip_search($payslip_search="")
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select COUNT(*) as count_payslips from fnSearchpayslips('$payslip_search')");
// 		return $query->row();
// 	}
// 	function get_employees()
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
//   		$query = $this->dbAll->query("select emp_last_name+', ' +emp_first_name emp_name,* from vwEmployee order by emp_last_name asc"); 	
//   		return $query->result();		
// 	}
// 	function get_emp_info($emp_no='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select * from [vwemployee] where emp_no = '$emp_no' ");
// 		return $query->row();
// 	}
// 	function get_current_weeknr($week_no=0)
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("exec [sp_getcurrentweekno] $week_no");
// 		return $query->result_array();
// 	}
// 	function get_top_emp_no()
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select top 1 emp_no from vwEmployee order by (emp_last_name+' '+emp_first_name) asc");
// 		return $query->row();
// 	}
	
// 	function list_dates($StartDate='',$EndDate='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 			$query = $this->dbAll->query("exec [sp_listdates] '$StartDate','$EndDate'");
// 			return $query->result_array();  
// 	}
// 	function list_dates_from_ts($emp_no = '',$StartDate='',$EndDate='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("
// 				select row_number() over(order by ts_id asc) [level], CONVERT(char(10), TS_Date,126) [date] from vw_Timesheets 
// 				where TS_Emp_No = '$emp_no' and TS_Date between  '$StartDate' and  '$EndDate'");
// 		return $query->result();
// 	}
// 	function process_dtr_to_ts($ts_date='',$ts_emp_no='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("exec [sp_processDTR] '$ts_date','$ts_emp_no'");
	 
// 	}
// 	function get_payslip_print($ps_emp_no='',$ps_date_from='',$ps_date_to='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select * from vw_Payslips where Ps_Emp_No = '$ps_emp_no' and Ps_Date_From = '$ps_date_from' 
// 				and Ps_Date_To ='$ps_date_to' and Ps_deleted =0");
// 		return $query->row();
	
// 	}
// 	function get_sum_allowance($emp_no='',$date_from='',$date_to='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select * from [fngettotal_allowance_deduction] ('$emp_no','$date_from','$date_to')");
// 		return $query->row();
	
// 	}	
// 	function get__Payslips($emp_no='',$date_from='',$date_to='')
// 	{
// 		$this->dbAll = $this->load->database('default', TRUE);
// 		$query = $this->dbAll->query("select * from vw_Payslips");
// 		return $query->result();
	
// 	}
	 
}