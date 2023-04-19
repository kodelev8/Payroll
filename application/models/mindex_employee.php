<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_employee extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function get_emp_no()
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top 1 * from vwEmployee where left(emp_no,1) = 1 order by emp_no desc"); 	
  		return $query->row();		
	}
	function employee_view($emp_per_page=0,$emp_row=0,$emp_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top $emp_per_page *from vwEmployee where row between $emp_row and $emp_total and emp_deleted = 0"); 	
  		return $query->result();		
	}
	function count_employee()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select count(emp_no) as emp_count from vwEmployee  where emp_deleted =0");
		return $query->row();
    }
    function get_position()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from [dbo].[fnGetPosition]() where position != 'All' ");
    	return $query->result();
    }
    function get_last_emp_no($emp_no=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select top 1 * from vwEmployee where left(emp_no,1) = $emp_no order by emp_no desc");
    	return $query->row();
    }
    function get_emp_position($emp_position=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from vw_Position where position_no = $emp_position");
    	return $query->row();
    }
    function employee_view_search($emp_per_page=0,$emp_search="",$emp_row=0,$emp_total=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select top $emp_per_page  * from fnSearchEmployee('$emp_search') where emp_row between $emp_row and $emp_total");
    	return $query->result();
    }
    function count_employee_search($emp_search="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select COUNT(*) as emp_count from fnSearchEmployee('$emp_search')");
    	return $query->row();
    }
    function employee_num_rows()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select [No of Rows] as Numrows,* from [rows per page] order by numrows asc");
    	return $query->result();
    }
    function active_employee_num_rows()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select [No of Rows] as NumRows,* from [rows per page] where active =1 ");
    	return $query->row();
    }
    function update_employee_num_rows($emp_per_page=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
    	$query = $this->dbAll->query("update [rows per page] set Active = 1  where [No of Rows] = $emp_per_page");
    }
    function get_user_update($emp_user_id = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from vwEmployee where emp_user_id ='$emp_user_id'");
 	 	 		 	
  		return $query->result();
    } 
    function get_emp_added($emp_no = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from vwEmployee where emp_no ='$emp_no'");
    	 
    	return $query->row();
    }
	function employee_update($emp_user_id=0,$emp_last_name="",$emp_first_name="",$emp_mid_name="",$emp_suffix_name="",$emp_position="",$emp_contact=0,$emp_email="",$emp_address="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("update [employee] set  [Last Name]='$emp_last_name', [First Name]='$emp_first_name', [Middle Name ]='$emp_mid_name' ,  [Suffix Name] = '$emp_suffix_name',	
  		[Position] = '$emp_position', [Contact Number] = '$emp_contact',[Email Address]='$emp_email',[address] = '$emp_address' where [users id] ='$emp_user_id'");
    }  
    function employee_update_pic($emp_pic=0,$emp_user_id=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update [employee] set  [picture]= '$emp_pic' where [users id] ='$emp_user_id'");
    }
    function employee_delete($emp_user_id="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update employee set deleted = 1 where [users id] = $emp_user_id ");
    }  
	function employee_add($emp_no="", $emp_username ="", $emp_password="", $emp_lastname="", $emp_first_name="", $emp_mid_name="",$emp_suffix_name="", $emp_position="",$emp_contact=0, $emp_email="",$emp_pic="",$emp_address="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("insert into [employee] ( [Emp no], [Last Name],[First Name],[Middle Name],[Suffix Name], 
  		[Position],[Contact Number],[Email Address],[Picture],[Address]) Values('$emp_no','$emp_lastname','$emp_first_name','$emp_mid_name','$emp_suffix_name','$emp_position','$emp_contact', '$emp_email','$emp_pic','$emp_address')");
    }
    function employee_add_wages($emp_no="", $emp_wages=0 )
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("insert into [employee wages]  ([Wg Emp No],[Wg Amount per Hour],[deleted]) Values('$emp_no','$emp_wages',0)");
    }
    function employee_update_wages($emp_no="", $emp_wages=0 )
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update [employee wages] set [Wg Amount per Hour] = $emp_wages where [Wg Emp No] = '$emp_no' ");
    }
    function check_empno($emp_no = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select [Emp no] as emp_no from [employee] where [deleted] = '0' and [emp no] ='$emp_no'");
  		return $query->result();
    } 
     function check_user($emp_username )
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select [user name] from [employee] where [deleted] = '0' and [user name] ='$emp_username'");	
  		return $query->result();
    } 
     function check_email($emp_email)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select [email address] from [employee] where [deleted] = '0' and [email address] ='$emp_email'");
  		return $query->result();
    }   
    function employee_search($search ="",$emp_row = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from fnSearchEmployee('$search')where emp_row between $emp_row -14 and $emp_row");
  		return $query->result();
    } 
    function employee_count_search($search ="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select count(*) as row from fnSearchEmployee('$search')  ");
  		return $query->row();
    }
    function get_treeview($treeview_name='')
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
    	return $query->row();
    }
}