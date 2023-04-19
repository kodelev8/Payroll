<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_wages extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function wages_view($wages_per_page=0,$wages_row=0,$wages_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top $wages_per_page * from vwwages where wages_ROW between $wages_row and $wages_total and wages_deleted =0"); 	
  		return $query->result();	
// 		echo "select top $wages_	per_page * from vwwages where wages_ROW between $wages_row and $wages_total and wages_deleted =0";	
	}
	function count_wages()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select count(wages_Emp_No) as wages_count from vwwages  where wages_deleted =0");
		return $query->row();
	}
	
	function wages_view_search($wages_per_page=0,$wages_search="",$wages_row=0,$wages_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top $wages_per_page  * from fnSearchwages('$wages_search') where wages_row between $wages_row and $wages_total and wages_deleted =0");
		return $query->result();
	}
	function count_wages_search($wages_search="")
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select COUNT(*) as wages_count from fnSearchwages('$wages_search')");
		return $query->row();
	}
	function wages_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows, * from [rows per page] order by NumRows asc");
		return $query->result();
	}
	function active_wages_num_rows()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select [No of Rows] NumRows,* from [rows per page] where active =1 ");
		return $query->row();
	}
	function update_wages_num_rows($wages_per_page=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
		$query = $this->dbAll->query("update [rows per page] set Active = 1  where [No of Rows] = $wages_per_page");
	}

	function get_emp_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from [vwemployee] where emp_deleted = 0 and  emp_no not in (select Wages_Emp_No from vwWages where Wages_deleted =0)");
		return $query->result();
	}
	function get_emp_id($wages_emp_no='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select emp_user_id from [vwemployee] where emp_no = '$wages_emp_no'");
		return $query->row();
	}
	function add_wages($wages_emp_no="",$wages_amount_per_hour=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query( "insert into [employee wages] ([Wg Emp No],[Wg Amount per Hour],[Deleted])
				Values( '$wages_emp_no',$wages_amount_per_hour,0)");
	}
	function get_wages_info()
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select top 1  * from [vwwages] order by wages_id desc");
		return $query->row();
	}
	function get_wages_update($wages_id =0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from vwwages where wages_id = $wages_id ");
		return $query->row();
	}
	function update_wages($wages_amount_per_hour=0,$wages_id=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [Employee wages] set [Wg Amount per Hour]=$wages_amount_per_hour where [Wg ID] = $wages_id");
// 	echo "update [Employee wages] set [Wg Amount per Hour]=$wages_amount_per_hour where [Wg ID] = $wages_id";
	
	}
	function delete_wages($wages_id= 0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("update [employee wages] set [deleted] = 1 where [Wg ID] = $wages_id");
	
	}
	function get_treeview($treeview_name='')
	{
		$this->dbAll = $this->load->database('default', TRUE);
		$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
		return $query->row();
	}
}