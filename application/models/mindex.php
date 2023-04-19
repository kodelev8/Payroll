<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mIndex extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */
	function get_emp_info($emp_no = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("SELECT [Users ID] as user_id, [Emp No] as emp_no, [User Name] as user_name, 
  		[User Password] as password, [First Name] as first_name, [Middle Name] as middle_name, [Last Name] as last_name, 
  		[Email Address] as email_address ,  Position, Picture FROM Users where [Emp no] = '$emp_no' and deleted = '0'");
    	return $query->row();	
    } 
    function save_emp_info($user_id = 0, $emp_no = 0, $datetime , $option = 0, $option_name = '')
    {
	    $this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("INSERT INTO [DTRMS].[dbo].[Daily Time Record]
           ([User ID],[Emp No] ,[Option],[Option Name],[Deleted],Time)
     	VALUES
           ('$user_id','$emp_no','$option','$option_name',0 ,getdate())");
  	
    }
	function show_emp_info($emp_no = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("SELECT  [Emp No] as emp_no FROM Users
	  	where [Emp No] = '$emp_no' and  deleted = '0'");
  		
  		return $query->result();
    }
	function adminlogin($email="",$password="")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("SELECT  [users id] as user_id,[Email Address] as user_email ,[emp no] as user_empno,
  		[First Name] as user_fname, [last name] as user_lname,[position] as user_position, [Picture] as user_picture, [Admin] as user_admin FROM Users
	  	where [Email Address] = '$email' and [password] = '$password' and deleted = '0'");
  		return $query->result();
    }
    function check_dual_remarks($option_name = '', $emp_no = '')
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("select * from fnTimeRecordCheck()where emp_no = '$emp_no' and option_name = '$option_name'");
  		return $query->result();    
    }
    function send_email_dtr($email_name = "",$option_name= "", $date = "", $email_address="")
    {
    	$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_port'] = 'tls';
		$config['smtp_port'] = 587;
		$config['smtp_user'] = 'postmaster@sandboxb54ff44cb80b405eaf0473c3695de74a.mailgun.org';
		$config['smtp_pass'] = '4op65jnrxap1';
		$config['mailtype']  = 'html';
					
		$html_email = "<table><tr><td>Hi Peter,</td>".'<tr><td>'.$email_name .' '. '['.$option_name. 
		' '.$date.']'.'</td></tr><tr><td></td></tr><tr><td>'.$email_name.'</td></tr></table>';
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
					
		$this->email->from('NO-REPLY@prechart.com');
		$this->email->to('emerson@prechart.com');
		$this->email->cc($email_address);		
		$this->email->subject('['.$option_name. ']'.'['.$date.']'.'['.$email_name.']' );	
		$this->email->set_mailtype("html");
						
		$this->email->message($html_email);
		$this->email->send();
					
    }
    function dtr_update($dtr_id_update="", $dtr_option_name_update = "")
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("update [daily time record] set [option name] = '$dtr_option_name_update' , time = getdate(),
  									[changed date]= getdate() where [id] = '$dtr_id_update' ");	
    }
}
