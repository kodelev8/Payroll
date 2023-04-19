<?php
class Secure_Controller extends CI_Controller
{
	var $user_id = 0;
	
	    
	public function __construct()
    {
    	parent::__construct();
    	$this->Authenticate();
    }
    
    function Authenticate()
    {
        $this->user_id = $this->session->userdata('user_id');
        $this->user_admin = $this->session->userdata('user_admin');
        
    	if ($this->user_id == null || $this->user_id == 0)
		{	
			 redirect('admin/index/');
		}
		elseif ($this->user_admin == 0)
		{
			redirect('dtrms/index_summary');
		}
		
    }
}