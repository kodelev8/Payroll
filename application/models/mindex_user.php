<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_user extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function get_user_no()
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top 1 [emp no] as user_no from [users] order by [Emp No] desc"); 	
  		return $query->row();		
	}
	function user_view($user_per_page=0,$user_row=0,$user_total=0)
	{
		$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select top $user_per_page *from vwuser where row between $user_row and $user_total and user_deleted = 0"); 	
  		return $query->result();		
	}
	function count_user()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select count(user_no) as user_count from vwuser  where user_deleted =0");
		return $query->row();
    }

    function user_view_search($user_per_page=0,$user_search="",$user_row=0,$user_total=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select top $user_per_page  * from fnSearchuser('$user_search') where user_row between $user_row and $user_total");
    	return $query->result();
    }
    function count_user_search($user_search="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select COUNT(*) as user_count from fnSearchuser('$user_search')");
    	return $query->row();
    }
    function user_num_rows()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select [No of Rows] as Numrows,* from [rows per page] order by numrows asc");
    	return $query->result();
    }
    function active_user_num_rows()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select [No of Rows] as NumRows,* from [rows per page] where active =1 ");
    	return $query->row();
    }
    function update_user_num_rows($user_per_page=0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update [rows per page] set Active = 0 ");
    	$query = $this->dbAll->query("update [rows per page] set Active = 1  where [No of Rows] = $user_per_page");
    }
    function get_user_update($user_id = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from vwuser where user_id ='$user_id'");
 	 	 		 	
  		return $query->result();
    } 
    function check_password($user_id = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select [password] user_password  from Users where [users id]  =$user_id");
    	 
    	return $query->result();
    }
    
    function get_user_info($user_no = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from vwuser where user_no ='$user_no'");
    	 
    	return $query->row();
    }
    function get_user_added($user_no = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from vwuser where user_no ='$user_no'");
    	 
    	return $query->row();
    }
	function user_update($user_id=0,$user_last_name="",$user_first_name="",$user_mid_name="",$user_suffix_name="",$user_position="",$user_contact=0,$user_email="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("update [users] set  [Last Name]='$user_last_name', [First Name]='$user_first_name', [Middle Name ]='$user_mid_name' ,  [Suffix Name] = '$user_suffix_name',	
  		[Position] = '$user_position', [Contact Number] = $user_contact,[Email Address]='$user_email' where [users id] ='$user_id'");
    }  
    function user_delete($user_user_id="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("update users set deleted = 1 where [users id] = $user_user_id ");
    }  
	function user_add($user_no="", $user_username ="", $user_password="", $user_lastname="", $user_first_name="", $user_mid_name="",$user_suffix_name="", $user_position="",$user_contact=0, $user_email="",$user_pic="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("insert into [users] ( [Emp no], [User name],[User Password], [Last Name],[First Name],[Middle Name],[Suffix Name], 
  		[Position],[Contact Number],[Email Address],[Picture]) Values('$user_no','$user_username','$user_password','$user_lastname','$user_first_name','$user_mid_name','$user_suffix_name','$user_position',$user_contact, '$user_email','$user_pic')");
    }
    function user_change_password($user_id="",$user_password="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query(" update Users set [Password] = '$user_password' , [User Password] ='$user_password' where [Users ID] = '$user_id'");
//     	echo " update Users set [Password] = '$user_password' , [User Password] ='$user_password' where [Users ID] = '$user_id'";
    }
    function check_empno($user_no = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select [Emp no] as emp_no from [user] where [deleted] = '0' and [emp no] ='$user_no'");
  		return $query->result();
    } 
     function check_user($user_username )
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select [user name] from [user] where [deleted] = '0' and [user name] ='$user_username'");	
  		return $query->result();
    } 
     function check_email($user_email)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select [email address] from [user] where [deleted] = '0' and [email address] ='$user_email'");
  		return $query->result();
    }   
    function user_search($search ="",$user_row = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from fnSearchuser('$search')where emp_row between $user_row -14 and $user_row");
  		return $query->result();
    } 
    function user_count_search($search ="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select count(*) as row from fnSearchuser('$search')  ");
  		return $query->row();
    }
    function get_treeview($treeview_name='')
    {
    	$this->dbAll = $this->load->database('default', TRUE);
    	$query = $this->dbAll->query("select * from treeview where treeviewname = '$treeview_name'");
    	return $query->row();
    }
}