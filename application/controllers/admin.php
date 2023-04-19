<?php
 //we need to call PHP's session object to access it through CI
/**
 * -------------------------------------------------------------------
 * Index Controller
 * -------------------------------------------------------------------
 * Maps to the following URL
 * http://localhost/dtr
 * Author: Emerson Tiamzon
 */
 
class admin extends CI_Controller
{
	/**
	 * Constructor
	 */
	function __construct()
    {
        parent::__construct();
        $this->load->model( array( 'mindex') );
        $this->load->model( array( 'mindex_employee','mglobal') );  
    }

    /**
     * Function Index
     * This function will load the header, body and footer of the form page
     */
   
    function index()
    {
	   	if($this->session->userdata('user_id')<> 0)
	   	{
	   	 	redirect('employee');
	   	}
	   	else 
	   	{
    		$this->session->sess_destroy();
    		$data['error_msg'] = 0;
			$this->load->view('admin/login',$data); 
	   	}    	
    }
    function loginfail()
    {
    	$this->session->sess_destroy();
    	$data['error_msg'] = 1;
    	$this->load->view('admin/login',$data);
    }
	function login()
	{	
		$email = $this->input->post('log_email');
		$password = $this->input->post('log_password');
		$login = $this->input->post('login');
		$user_id = "";
		$user_fname="";
		$user_lname="";

		if($email == "" or $password == "")
		{
		  	$this->session->sess_destroy();
          	$this->session->set_flashdata('error', 'error_message');
          	redirect('admin');
		}
		else
		{
			$adminlogin= $this->mindex->adminlogin(str_replace("'","''",$email), str_replace("'","''",$password));
			foreach($adminlogin as $row):
				$row->user_id;
				$row->user_fname;
				$row->user_lname;
				$row->user_position;
				$row->user_picture;
			endforeach;
			if(count($adminlogin) > 0)
			{
				$user_id = $adminlogin[0]->user_id;
				$user_fname = $adminlogin[0]->user_fname;
				$user_lname = $adminlogin[0]->user_lname;
				$user_position = $adminlogin[0]->user_position;
				$user_picture = $adminlogin[0]->user_picture; 
				$user_admin = $adminlogin[0]->user_admin;
				$this->session->set_userdata('user_id', $user_id);
				$this->session->set_userdata('user_fname', $user_fname);
				$this->session->set_userdata('user_lname', $user_lname);
				$this->session->set_userdata('user_position', $user_position);
				$this->session->set_userdata('user_picture', $user_picture);
				$this->session->set_userdata('user_admin', $user_admin);
				redirect('employee');
			}
			else
			{
				$this->session->sess_destroy();
	            $this->session->set_flashdata('error', 'error_login_code');
       	   	 	redirect('admin/loginfail');
			}
		}
	}
	function logout()
	{
	 	$this->session->set_userdata('id_users', 0);
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', lang('message_successfully_logged_off'));
        redirect('admin/index/');
	}

}


/**
* END Controller class
* End of file index.php
* Location: ..\application\controllers\index.php
*/
