<?php 
class leave extends Secure_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 * 
	 */
	
	function __construct()
	{
		parent::__construct();
		$this->load->model( array('mindex_leave','mglobal') );
		$this->load->library('form_validation');
	}
	public function index($leave_row=0)
	{
		$this->session->set_userdata('cur_row',$leave_row);
		$per_page = $this->mindex_leave->active_leave_num_rows();
		$per_page = $per_page->NumRows;
		$leave_per_page =$per_page;
		$total_row= $this->mindex_leave->count_leave();
		$this->load->library('pagination');
		$config['base_url'] = base_url('leave/index/');
		$config['total_rows'] = $total_row->leave_count;
		$leave_total =  $total_row->leave_count;
		$config['cur_page'] = $leave_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "leave";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['leave_count']=$leave_total;
		$data['leave'] = $this->mindex_leave->leave_view($leave_per_page,$leave_row,$leave_total);
		$data['leave_num_rows'] = $this->mindex_leave->leave_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_leave',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_leave_scan()
	{
		$leave_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('leave_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_leave->active_leave_num_rows();
			$per_page = $per_page->NumRows;
		}
		$leave_per_page =$per_page;
		$this->mindex_leave->update_leave_num_rows($leave_per_page);
		$total_row= $this->mindex_leave->count_leave();
		$this->load->library('pagination');
		$config['base_url'] = base_url('leave/index/');
		$config['total_rows'] = $total_row->leave_count;
		$leave_total =  $total_row->leave_count;
		$config['cur_page'] = $leave_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "leave";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['leave_count']=$leave_total;
		$data['leave'] = $this->mindex_leave->leave_view($leave_per_page,$leave_row,$leave_total);
		$data['leave_num_rows'] = $this->mindex_leave->leave_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_leave',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_leave_search($leave_row=0)
	{
		$leave_search=$this->session->userdata('leave_search');
		$this->session->set_userdata('cur_row',$leave_row);
		$per_page = $this->mindex_leave->active_leave_num_rows();
		$per_page = $per_page->NumRows;
		$leave_per_page =$per_page;
		$this->mindex_leave->update_leave_num_rows($leave_per_page);
		$total_row= $this->mindex_leave->count_leave_search($leave_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('leave/view_leave_search/');
		$config['total_rows'] = $total_row->leave_count;
		$leave_total =  $total_row->leave_count;
		$config['cur_page'] = $leave_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "leave";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['leave_count']=$leave_total;
		$data['leave'] = $this->mindex_leave->leave_view_search($leave_per_page,$leave_search,$leave_row,$leave_total);
		$data['leave_num_rows'] = $this->mindex_leave->leave_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_leave_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_leave_searched()
	{
		$leave_row= $this->session->userdata('cur_row');
		$leave_search=$this->input->post('hid_leave_search');
		if($leave_search)
		{
			$this->session->set_userdata('leave_search',$leave_search);
		}
		else
		{
			$leave_search= $this->session->userdata('leave_search');
		}
	
		$per_page = $this->input->post('leave_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_leave->active_leave_num_rows();
			$per_page = $per_page->NumRows;
			$leave= 0;
		}
	
		$leave_per_page =$per_page;
		$this->mindex_leave->update_leave_num_rows($leave_per_page);
		$total_row= $this->mindex_leave->count_leave_search($leave_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('leave/view_leave_search/');
		$config['total_rows'] = $total_row->leave_count;
		$leave_total =  $total_row->leave_count;
		$config['cur_page'] = $leave_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "leave";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['leave_count']=$leave_total;
		$data['leave'] = $this->mindex_leave->leave_view_search($leave_per_page,$leave_search,$leave_row,$leave_total);
		$data['leave_num_rows'] = $this->mindex_leave->leave_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_leave_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function add_leave()
	{
		$data['menu_name'] = "leave";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$add = $this->input->post('btn-add');
		$leave_emp_no = $this->input->post('leave_emp_no');
		$leave_type = $this->input->post('leave_type');
		$leave_date = $this->input->post('leave_date');
		$leave_reason = $this->input->post('leave_reason');
		$leave_emp_id = $this->mindex_leave->get_emp_id($leave_emp_no);
		
		
		if($add)
		{
			$data['record'] = array('leave_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('leave_date',  		'Leave Date',		'required|callback_validate_date');
	        $this->form_validation->set_rules('leave_reason',  		'Leave Reason',		'required');
	        $data['record'] = array(
	        	'leave_emp_no'   	=> $this->input->post('leave_emp_no'),
		        'leave_type'   		=> $this->input->post('leave_type'),
		        'leave_date'   		=> $this->input->post('leave_date'),
		        'leave_reason'   	=> $this->input->post('leave_reason'),
		        'emp_position'   	=> $this->input->post('emp_position')
	        );

	        if ($this->form_validation->run() == false)
	        {
	        	$data['inputdate']= date("d-m-Y", strtotime($leave_date));
	        	$data['leave_emp_no'] = $leave_emp_no;
        		$data['leave_type'] = $leave_type;
	        	$data['get_emp_info'] = $this->mindex_leave->get_emp_info();
	        	$data['get_leave_type'] = $this->mindex_leave->get_leave_type();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/add_leave',$data);
				$this->load->view('footer/footer_admin',$data);
	        }
	        else
	        {
	        	$leave_date = date("Y-m-d", strtotime($leave_date));
	        	$this->mindex_leave->add_leave(str_replace("'","''",$leave_reason),$leave_type,$leave_date,$leave_emp_no,$leave_emp_id);
	        	$this->session->set_userdata('emp_picture', '');
	        	redirect('leave/added_leave/');
	        }
		}
		else{
			$data['inputdate']= date("d-m-Y");
			$data['leave_type'] = $leave_type;
			$data['leave_emp_no'] = '03';
			$data['record'] = '';
			$data['get_emp_info'] = $this->mindex_leave->get_emp_info();
			$data['get_leave_type'] = $this->mindex_leave->get_leave_type();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/add_leave',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	}

	function added_leave()
	{
		$data['menu_name'] = "leave";
		$leave_info = $this->mindex_leave->get_leave_info();
		$leave_id = $leave_info->leave_id;
		$data['treeview_employee'] ="";
		$data['treeview_main'] ="";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$data['leave_action'] = 'Added';
		$data['btn_r'] = "";
		$data['btn_r_name'] = 'View Employees Leave';
		$data['btn_l']= 'leave/update_leave/'.encode($leave_id);
		$data['btn_l_name'] = 'Update Employee Leave';
		$data['leave_info']= $leave_info;
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_leave',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	function update_leave($leave_id=0)
	{
		$data['menu_name'] = "leave";
		$data['treeview_employee'] ="";
		$data['treeview_main'] = "";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$leave_id = decode($leave_id);
		$add = $this->input->post('btn-add');
		$leave_emp_no = $this->input->post('leave_emp_no');
		$leave_type = $this->input->post('leave_type');
		$leave_date = $this->input->post('leave_date');
		$leave_reason = $this->input->post('leave_reason');
		$leave_update_info = $this->mindex_leave->get_leave_update($leave_id);
		$data['record'] = array(
				'leave_emp_no'   	=> $leave_update_info->leave_emp_no,
				'leave_type'   		=> $leave_update_info->leave_type,
				'leave_date'   		=> date("d-m-Y", strtotime($leave_update_info->leave_date)),
				'leave_reason'   	=> $leave_update_info->leave_reason,
				'leave_emp_name'   	=> $leave_update_info->leave_emp_name
		
		);
		
		if($add)
		{
			$data['record'] = array('leave_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('leave_date',  		'Leave Date',		'required|callback_validate_date');
			$this->form_validation->set_rules('leave_reason',  		'Leave Reason',		'required');
			$data['record'] = array(
					'leave_emp_no'   	=> $this->input->post('leave_emp_no'),
					'leave_type'   		=> $this->input->post('leave_type'),
					'leave_date'   		=> $this->input->post('leave_date'),
					'leave_reason'   	=> $this->input->post('leave_reason'),
					'leave_emp_name'   	=> $this->input->post('leave_emp_name')
			);
	
			if ($this->form_validation->run() == false)
			{
				$data['inputdate']= date("d-m-Y", strtotime($leave_update_info->leave_date));
				$data['leave_id'] = $leave_update_info->leave_id;
				$data['leave_emp_no'] = $leave_emp_no;
				$data['leave_type'] = $leave_type;
				$data['get_emp_info'] = $this->mindex_leave->get_emp_info();
				$data['get_leave_type'] = $this->mindex_leave->get_leave_type();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/update_leave',$data);
				$this->load->view('footer/footer_admin',$data);
			}
			else
			{
				$leave_date = date("Y-m-d", strtotime($leave_date));
				$this->mindex_leave->update_leave($leave_date,$leave_type ,str_replace("'","''",$leave_reason),$leave_id);
				redirect('leave/updated_leave/'.encode($leave_id));
			}
				
		}
		else{
			$data['inputdate']= date("d-m-Y", strtotime($leave_update_info->leave_date));
			$data['leave_id'] = $leave_update_info->leave_id;
			$data['leave_type'] = $leave_update_info->leave_type;
			$data['leave_emp_no'] = $leave_update_info->leave_emp_no;
			$data['get_emp_info'] = $this->mindex_leave->get_emp_info();
			$data['get_leave_type'] = $this->mindex_leave->get_leave_type();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_leave',$data);
			$this->load->view('footer/footer_admin',$data);				
		}
	
	
	}
	function updated_leave($leave_id=0)
	{
		$data['menu_name'] = "leave";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="active";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$leave_id = decode($leave_id);
		$data['leave_action'] = 'Updated';
		$data['btn_r']= 'leave/';
		$data['btn_r_name']= 'View Employees Leave';
		$data['btn_l']= 'leave/update_leave/'.encode($leave_id);
		$data['btn_l_name'] = 'Update Employee Leave';
		$data['leave_info']= $this->mindex_leave->get_leave_update($leave_id);
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_leave',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function delete_leave($leave_id=0)
	{
		$leave_id = decode($leave_id);
		$info_leave = $this->mindex_leave->get_leave_update($leave_id);
		if(count($info_leave)>0)
		{
			$data['menu_name'] = "leave";
			$data['treeview_main'] = "";
			$data['treeview_employee'] ="";
			$data['treeview_leave'] ="active";
			$data['treeview_dtr'] ="";
			$data['treeview_holiday'] ="";
			$data['treeview_daily_task'] ="";
			$data['leave_action'] = 'Delete';
			$data['btn_r']= 'leave/deleted_leave/'.encode($leave_id);
			$data['btn_r_name']= 'Delete Employees Leave';
			$data['btn_l']= 'leave/';
			$data['btn_l_name'] = 'View Employees Leave';
			$data['leave_info']= $this->mindex_leave->get_leave_update($leave_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_leave',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{
			redirect('leave');
		}

	}
	public function deleted_leave($leave_id=0)
	{
		$leave_id = decode($leave_id);
		$this->mindex_leave->delete_leave($leave_id);
		redirect('leave');
	}
	public function validate_date($leave_date)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($dd, $mm,$yy) = preg_split('[-]', $leave_date);
	
		if (!is_numeric($dd) || !is_numeric($mm) || !is_numeric($yy) )
		{
			$this->form_validation->set_message('validate_date', 'The Date Field is invalid.');
			return FALSE;
		}
		elseif($yy> date('Y'))
		{
			$this->form_validation->set_message('validate_date', 'The Date Field is greater than current year.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */