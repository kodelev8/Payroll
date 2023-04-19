<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_allowance extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function allowance_view($allowance_per_page=0,$allowance_row=0,$allowance_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top $allowance_per_page * from vwAllowance where Allowance_ROW between $allowance_row and $allowance_total and allowance_deleted =0"); 	
  		return $query->result();		
	}
	function count_allowance()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select count(Allowance_Emp_No) as allowance_count from vwAllowance  where allowance_deleted =0");
		return $query->row();
	}
	
	function allowance_view_search($allowance_per_page=0,$allowance_search="",$allowance_row=0,$allowance_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top $allowance_per_page  * from fnSearchallowance('$allowance_search') where allowance_row between $allowance_row and $allowance_total");
		return $query->result();
	}
	function count_allowance_search($allowance_search="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select COUNT(*) as allowance_count from fnSearchallowance('$allowance_search')");
		return $query->row();
	}
	function allowance_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows, * from [rows per page] order by NumRows asc");
		return $query->result();
	}
	function active_allowance_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows,* from [rows per page] where active =1 ");
		return $query->row();
	}
	function update_allowance_num_rows($allowance_per_page=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
		$query = $this->dbAll->query("update [rows per page] set Active = 1  where [No of Rows] = $allowance_per_page");
	}

	function get_emp_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [vwemployee] where emp_deleted = 0 ");
		return $query->result();
	}
	function get_emp_id($allowance_emp_no='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_user_id from [vwemployee] where emp_no = '$allowance_emp_no'");
		return $query->row();
	}
	function add_allowance($allowance_emp_no="",$allowance_amount=0,$allowance_description="",$allowance_date="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query( "insert into [employee allowance] ([Allowance Emp No],[Allowance  Amount],[Allowance Description],[Allowance Date],[Obselete],[Deleted])
				Values( '$allowance_emp_no',$allowance_amount,'$allowance_description','$allowance_date',0,0)");
	}

	function view_allowance($allowance_emp_no="",$allowance_date="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwAllowance where Allowance_Emp_No = '$allowance_emp_no' and Allowance_Date = '$allowance_date' and Allowance_Deleted = 0 ");
		return $query->result();
	}
	
	function get_allowance_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top 1  * from [vwallowance] order by allowance_id desc");
		return $query->row();
	}
	function get_allowance_update($allowance_id =0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwallowance where allowance_id = $allowance_id ");
		return $query->row();
	}
	function update_allowance($allowance_emp_no="",$allowance_amount=0 ,$allowance_description="",$allowance_date="",$allowance_id=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [Employee Allowance] set [Allowance Emp No]='$allowance_emp_no',[Allowance  Amount]=$allowance_amount,[Allowance Description]= '$allowance_description'
				,[Allowance Date] = '$allowance_date' where [allowance ID] = $allowance_id");
	}
	function delete_allowance($allowance_id= 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [employee allowance] set [deleted] = 1 where [allowance ID] = $allowance_id");
	
	}
	function get_treeview($treeview_name='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
		return $query->row();
	}
}