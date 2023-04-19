<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_leave extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function leave_view($leave_per_page=0,$leave_row=0,$leave_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top $leave_per_page * from vwleave where row between $leave_row and $leave_total and deleted =0"); 	
  		return $query->result();		
	}
	function count_leave()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select count(leave_id) as leave_count from vwLeave  where deleted =0");
		return $query->row();
	}
	
	function leave_view_search($leave_per_page=0,$leave_search="",$leave_row=0,$leave_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top $leave_per_page  * from fnSearchLeave('$leave_search') where leaverow between $leave_row and $leave_total");
		return $query->result();
	}
	function count_leave_search($leave_search="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select COUNT(*) as leave_count from fnSearchleave('$leave_search')");
		return $query->row();
	}
	function leave_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [rows per page] order by numrows asc");
		return $query->result();
	}
	function active_leave_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [rows per page] where active =1 ");
		return $query->row();
	}
	function update_leave_num_rows($leave_per_page=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
		$query = $this->dbAll->query("update [rows per page] set Active = 1  where numrows = $leave_per_page");
	}
	function get_leave_type()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [leave type] as leave_type from [employee leave] a group by [leave type]");
		return $query->result();
	}
	function get_emp_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [vwemployee] where emp_deleted = 0 ");
		return $query->result();
	}
	function get_emp_id($leave_emp_no='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_user_id from [vwemployee] where emp_no = '$leave_emp_no'");
		return $query->row();
	}
	function add_leave($leave_reason =0 ,$leave_type= 0 ,$leave_date = 0,$leave_emp_no = 0,$leave_emp_id = '')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query( "insert into [employee leave] ([reason] ,[leave type], [date], [emp no],[user id])
				Values( '$leave_reason' ,'$leave_type' ,'$leave_date','$leave_emp_no','$leave_emp_id')");
	}
	function get_leave_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top 1  * from [vwLeave] order by leave_id desc");
		return $query->row();
	}
	function get_leave_update($leave_id =0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwLeave where leave_id = $leave_id ");
		return $query->row();
	}
	function update_leave($leave_date =0,$leave_type = 0 ,$leave_reason = 0,$leave_id= 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [employee leave] set [Date]='$leave_date', [leave type]='$leave_type',
				[reason]='$leave_reason' ,[Changed Date] = getdate() where [leave ID] = $leave_id");
	}
	function delete_leave($leave_id= 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [employee leave] set [deleted] = 1 where [leave ID] = $leave_id");
	
	}
}