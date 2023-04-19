<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class Mindex_deduction extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function deduction_view($deduction_per_page=0,$deduction_row=0,$deduction_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top $deduction_per_page * from vwdeduction where deduction_ROW between $deduction_row and $deduction_total  "); 	
  		return $query->result();

	}
	function count_deduction()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select count(deduction_Emp_No) as deduction_count from vwdeduction   ");
		return $query->row();
	}
	
	function deduction_view_search($deduction_per_page=0,$deduction_search="",$deduction_row=0,$deduction_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top $deduction_per_page  * from fnSearchdeduction('$deduction_search') where deduction_row between $deduction_row and $deduction_total");
		return $query->result();
	}
	function count_deduction_search($deduction_search="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select COUNT(*) as deduction_count from fnSearchdeduction('$deduction_search')");
		return $query->row();
	}
	function deduction_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows, * from [rows per page] order by NumRows asc");
		return $query->result();
	}
	function active_deduction_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows,* from [rows per page] where active =1 ");
		return $query->row();
	}
	function update_deduction_num_rows($deduction_per_page=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
		$query = $this->dbAll->query("update [rows per page] set Active = 1  where [No of Rows] = $deduction_per_page");
	}

	function get_emp_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [vwemployee] where emp_deleted = 0 ");
		return $query->result();
	}
	function get_emp_id($deduction_emp_no='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_user_id from [vwemployee] where emp_no = '$deduction_emp_no'");
		return $query->row();
	}
	function add_deduction($deduction_emp_no="",$deduction_amount=0,$deduction_description="",$deduction_date="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query( "insert into [Employee Deduction] ([Deduction Emp No],[Deduction Amount],[Deduction Description],[Deduction Date],[Obselete],[Deleted])
				Values( '$deduction_emp_no',$deduction_amount,'$deduction_description','$deduction_date',0,0)");
	}
	function view_deduction($deduction_emp_no="",$deduction_date="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
			$query = $this->dbAll->query( "select * from vwdeduction where [Deduction_Emp_No] = '$deduction_emp_no' and [Deduction_Date] = '$deduction_date' and Deduction_Deleted = 0 ");
			return $query->result();
		//echo  "select * from vwdeduction where [Deduction_Emp_No] = '$deduction_emp_no' and [Deduction_Date] = '$deduction_date' and Deduction_deleted = 0 ";
	}
	function get_deduction_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top 1  * from [vwdeduction] order by deduction_id desc");
		return $query->row();
	}
	function get_deduction_update($deduction_id =0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwdeduction where deduction_id = $deduction_id ");
		return $query->row();
	}
	function update_deduction($deduction_emp_no="",$deduction_amount=0 ,$deduction_description="",$deduction_date="",$deduction_id=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [Employee deduction] set [Deduction Emp No]='$deduction_emp_no',[Deduction Amount]=$deduction_amount,[Deduction Description]= '$deduction_description'
				,[Deduction Date] = '$deduction_date' where [Deduction ID] = $deduction_id");
	}
	function delete_deduction($deduction_id= 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [employee deduction] set [deleted] = 1 where [deduction ID] = $deduction_id");
	
	}
	function get_treeview($treeview_name='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
		return $query->row();
	}
}