<?php

class Employee extends Secure_Controller {

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
		$this->load->model( array( 'mindex_employee','mglobal') );
		$this->load->library('form_validation');
		$this->load->helper('url','form');
	}
	public function index($emp_row=0)
	{
		$this->session->set_userdata('cur_row',$emp_row);
		$per_page = $this->mindex_employee->active_employee_num_rows();
		$per_page = $per_page->NumRows;
		$emp_per_page =$per_page;
		$total_row= $this->mindex_employee->count_employee();
		$this->load->library('pagination');
		$config['base_url'] = base_url('employee/index/');
		$config['total_rows'] = $total_row->emp_count;
		$emp_total =  $total_row->emp_count;
		$config['cur_page'] = $emp_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['employee_count']=$emp_total;
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['employee'] = $this->mindex_employee->employee_view($emp_per_page,$emp_row,$emp_total);
		$data['emp_num_rows'] = $this->mindex_employee->employee_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_employee',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_employee_scan()
	{
		$emp_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('emp_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_employee->active_emp_num_rows();
			$per_page = $per_page->NumRows;
		}
		$emp_per_page =$per_page;
		$this->mindex_employee->update_employee_num_rows($emp_per_page);
		$total_row= $this->mindex_employee->count_employee();
		$this->load->library('pagination');
		$config['base_url'] = base_url('employee/view_employee_search/');
		$config['total_rows'] = $total_row->emp_count;
		$emp_total =  $total_row->emp_count;
		$config['cur_page'] = $emp_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['employee_count']=$emp_total;
		$data['employee'] = $this->mindex_employee->employee_view($emp_per_page,$emp_row,$emp_total);
		$data['emp_num_rows'] = $this->mindex_employee->employee_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_employee',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_employee_search($emp_row=0)
	{
		$emp_search=$this->session->userdata('emp_search');
		$this->session->set_userdata('cur_row',$emp_row);
		$per_page = $this->mindex_employee->active_employee_num_rows();
		$per_page = $per_page->NumRows;
		$emp_per_page =$per_page;
		$this->mindex_employee->update_employee_num_rows($emp_per_page);
		$total_row= $this->mindex_employee->count_employee_search($emp_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('employee/view_employee_search/');
		$config['total_rows'] = $total_row->emp_count;
		$emp_total =  $total_row->emp_count;
		$config['cur_page'] = $emp_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['employee_count']=$emp_total;
		$data['employee'] = $this->mindex_employee->employee_view_search($emp_per_page,$emp_search,$emp_row,$emp_total);
		$data['emp_num_rows'] = $this->mindex_employee->employee_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_employee_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_employee_searched()
	{
		$emp_row= $this->session->userdata('cur_row');
		$emp_search=$this->input->post('hid_emp_search');
// 		if($emp_search)
// 		{
// 			$this->session->set_userdata('emp_search',$emp_search);
// 		}
// 		else 
// 		{
// 			$emp_search= $this->session->userdata('emp_search');
// 		}
		
		$per_page = $this->input->post('emp_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_employee->active_employee_num_rows();
			$per_page = $per_page->NumRows;
			$emp_row= 0;
		}
		
		$emp_per_page =$per_page;
		$this->mindex_employee->update_employee_num_rows($emp_per_page);
		$total_row= $this->mindex_employee->count_employee_search($emp_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('employee/view_employee_search/');
		$config['total_rows'] = $total_row->emp_count;
		$emp_total =  $total_row->emp_count;
		$config['cur_page'] = $emp_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['employee_count']=$emp_total;
		$data['employee'] = $this->mindex_employee->employee_view_search($emp_per_page,$emp_search,$emp_row,$emp_total);
		$data['emp_num_rows'] = $this->mindex_employee->employee_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_employee_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function add_employee()
	{
		$emp_user_id="";
		$emp_pic = $this->input->post('userfile');
		$add =  $this->input->post('btn-add');
		$emp_no = $this->input->post('emp_no');
		$emp_last_name = $this->input->post('emp_last_name');
		$emp_first_name = $this->input->post('emp_first_name');
		$emp_mid_name = $this->input->post('emp_mid_name');
		$emp_suffix_name = $this->input->post('emp_suffix_name');
		$emp_position = $this->input->post('emp_position');
		$emp_contact = $this->input->post('emp_contact');
		$emp_email = $this->input->post('emp_email');
		$emp_address = $this->input->post('emp_address');
		$emp_username = $this->input->post('emp_username');
		$emp_password = $this->input->post('emp_password');
		$emp_wages = $this->input->post('emp_wages');
		$emp_wages = ($emp_wages/8);
		$get_emp_no = $this->mindex_employee->get_emp_no();
		$get_emp_position = $this->mindex_employee->get_position();
// 		$get_last_emp_no = $this->mindex_employee->get_last_emp_no($emp_no);
		
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['get_emp_position'] =$get_emp_position;
		$data['emp_position_no'] =1;
		if($add)
		{
			$get_position = $this->mindex_employee->get_emp_position($emp_position);
			$emp_position = $get_position->position;
			$get_last_emp_no = $this->mindex_employee->get_last_emp_no($emp_no);
			$data['emp_position_no'] =$get_position->position_no;
			$data['record'] = array('emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
	    	$this->form_validation->set_rules('emp_no',					'Employee Number' ,	'required|numeric|callback_empno_check');
	        $this->form_validation->set_rules('emp_first_name',  		'First Name',		'required|alpha_name');
	        $this->form_validation->set_rules('emp_mid_name', 			'Middle Name',		'required|alpha_name');
	        $this->form_validation->set_rules('emp_last_name',			'Last Name',  		'required|alpha_name');
	        $this->form_validation->set_rules('emp_position',			'Position', 		'required');
	        $this->form_validation->set_rules('emp_address',			'Address', 			'required');
// 	        $this->form_validation->set_rules('emp_contact',			'Contact Number',	'required|numeric');
// 	        $this->form_validation->set_rules('emp_email',				'Email Address',	'required|valid_email|callback_email_check');
	        $this->form_validation->set_rules('emp_wages',				'Wages Per Day',	'required|numeric');
	        $data['record'] = array(
	        	'emp_no'   			=> $this->input->post('emp_no'),
		        'emp_first_name'   	=> $this->input->post('emp_first_name'),
		        'emp_mid_name'   	=> $this->input->post('emp_mid_name'),
		        'emp_last_name'   	=> $this->input->post('emp_last_name'),
        		'emp_suffix_name'  	=> $this->input->post('emp_suffix_name'),
		        'emp_position'   	=> $this->input->post('emp_position'),
	        	'emp_contact'   	=> $this->input->post('emp_contact'),
        		'emp_address'   	=> $this->input->post('emp_address'),
		        'emp_email'   		=> $this->input->post('emp_email'),
		        'emp_username'   	=> $this->input->post('emp_username'),
		        'emp_password'   	=> $this->input->post('emp_password'),
        		'emp_wages'   	=> $this->input->post('emp_wages')
	       
	        );

	        if ($this->form_validation->run($this) == false)
	        {
	        		$data['success']="";
					$data['user_lname']= $this->session->userdata('user_lname');
					$data['user_fname'] = $this->session->userdata('user_fname');
					$data['user_position']= $this->session->userdata('user_position');
					$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
					$data['employee'] = $this->mindex_employee->employee_view();
					$this->load->view('header/header_admin',$data);
					$this->load->view('admin/add_employee',$data);
					$this->load->view('footer/footer_admin',$data);
	        }
	        else
	        {
				$this->uploadImage_add($emp_first_name.$emp_no);
				$emp_pic = '~/Pictures/'.$this->session->userdata('emp_picture');
	        	$this->mindex_employee->employee_add($emp_no, $emp_username, $emp_password, $emp_last_name, $emp_first_name, $emp_mid_name,$emp_suffix_name, $emp_position,$emp_contact, $emp_email,$emp_pic,$emp_address);
	        	$this->mindex_employee->employee_add_wages($emp_no,$emp_wages);
	        	$emp_user_id = $this->mindex_employee->get_emp_added($emp_no);
	        	$emp_user_id = $emp_user_id->emp_user_id;
	        	$this->session->set_userdata('emp_picture', '');
	        	redirect('employee/added_employee/'.encode($emp_user_id));
	        }
    	}
		else 
		{
		$data['success'] = "";
		if(count($get_emp_no)<1)
		{
			$data['record'] = array('emp_no'=> '0'.'1');
		}	
		elseif(intval($get_emp_no->emp_no) <9)
		{
			$data['record'] = array('emp_no'=> '0'.strval($get_emp_no->emp_no + 1));
		}
		else
		{
			$data['record'] = array('emp_no'=> intval( $get_emp_no->emp_no + 1));
		}
		
    	$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['employee'] = $this->mindex_employee->employee_view();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/add_employee',$data);
		$this->load->view('footer/footer_admin',$data);
		}
	}
	function get_last_empno($emp_no = "")
	{
		$emp_no 	= $_REQUEST['emp_no'];
// 		$emp_no=2;

		if ($emp_no == null)
		{
			$emp_no=2;
			
		}
		$get_emp_info= $this->mindex_employee->get_last_emp_no($emp_no);
		
		$output = $get_emp_info->emp_no +1;
		echo $output ;
		
	}
	function added_employee($emp_user_id=0)
	{
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$emp_user_id = decode($emp_user_id);
		if($emp_user_id==0)
		{
			redirect('welcome');
		}
		else
		{
			$data['get_l'] = "";
			$data['get_r'] = "";
			$data['emp_pic'] ="";
			$data['view_identify'] = 0;
			$data['emp_action'] = 'Added';
			$data['btn_l_name'] = "Edit Employee";
			$data['btn_l'] = 'employee/update_employee/'.encode($emp_user_id);
			$data['btn_r_name'] = "View Employees";
			$data['btn_r'] = 'employee/';
			$data['info_emp'] = $this->mindex_employee->get_user_update($emp_user_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_employee',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	
	}
	function update_employee($emp_user_id = 0)
	{
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$emp_user_id = decode($emp_user_id);
		$emp_pic = $this->input->post('userfile');
		$this->load->model( array( 'mindex_employee') );
		$data['emp_user_id'] = $emp_user_id;
		$data['record'] = '';
		$data['success'] = '';
		$get_user = $this->mindex_employee->get_user_update($emp_user_id);
		$emp_last_name = $this->input->post('emp_last_name');
		$emp_first_name = $this->input->post('emp_first_name');
		$emp_mid_name = $this->input->post('emp_mid_name');
		$emp_suffix_name = $this->input->post('emp_suffix_name');
		$emp_position = $this->input->post('emp_position');
		$emp_contact = $this->input->post('emp_contact');
		$emp_email = $this->input->post('emp_email');
		$emp_no = $get_user[0]->emp_no;
		$emp_address = $this->input->post('emp_address'); 
		$emp_wages = $this->input->post('emp_wages');
		$emp_wages = ($emp_wages/8);
		$get_emp_no = $this->mindex_employee->get_emp_no();
		$get_emp_position = $this->mindex_employee->get_position();
		$data['get_emp_position'] = $get_emp_position;
		$data['emp_position_no'] = substr($get_user[0]->emp_no,0,1);
		if($emp_user_id<>"")
		{	
			$data['record'] = array(
					'emp_no'   			=> $get_user[0]->emp_no,
					'emp_first_name'   	=> $get_user[0]->emp_first_name,
					'emp_mid_name'   	=> $get_user[0]->emp_mid_name,
					'emp_last_name'   	=> $get_user[0]->emp_last_name,
					'emp_suffix_name'   => $get_user[0]->emp_suffix_name,
					'emp_position'   	=> $get_user[0]->emp_position,
					'emp_contact'   	=> $get_user[0]->emp_contact,
					'emp_email'   		=> $get_user[0]->emp_email,
					'emp_address'   	=> $get_user[0]->emp_address,
					'emp_wages'   		=> $get_user[0]->emp_wages*8,
					'emp_pic'   		=> $get_user[0]->emp_picture,
			);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('emp_first_name',    	'First Name',		'required|alpha_name');
			$this->form_validation->set_rules('emp_mid_name', 		'Middle Name',  	'required|alpha_name');
			$this->form_validation->set_rules('emp_last_name',		'Last Name',  		'required|alpha_name');
			$this->form_validation->set_rules('emp_position',		'Position', 		'required');
// 			$this->form_validation->set_rules('emp_contact',		'Contact Number', 	'required|numeric');
// 			$this->form_validation->set_rules('emp_email',			'Email Address', 	'required|valid_email');
			$this->form_validation->set_rules('emp_address',		'Address', 			'required');
			$this->form_validation->set_rules('emp_wages',			'Wages Per Day', 	'required|numeric');
				
			if ($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error', 'error_message');
			}
			else
			{ 

				$gep = $this->mindex_employee->get_emp_position($emp_position);
				$emp_position = $gep->position;
// 				$fileName= substr($get_user[0]->emp_picture,11);
				$fileName = $emp_first_name.$emp_no;
				$this->mindex_employee->employee_update($emp_user_id,$emp_last_name,$emp_first_name,$emp_mid_name,$emp_suffix_name,$emp_position,$emp_contact,$emp_email,$emp_address);
				$this->mindex_employee->employee_update_wages($emp_no, $emp_wages);
				$this->uploadImage($fileName,$emp_user_id);
				
				redirect('employee/updated_employee/'.encode($emp_user_id));
			}
			
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_employee',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else
		{
			redirect('employee');	
		}
	}
	function updated_employee($emp_user_id=0)
	{
		$data['menu_name'] = "";
		$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');		
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$emp_user_id = decode($emp_user_id);
		$get_user_update="";
		if($emp_user_id==0)
		{
			redirect('employee');
		}
		else 
		{
			$get_user_update= $this->mindex_employee->get_user_update($emp_user_id);
			$data['get_l'] = "";
			$data['get_r'] = "";
			$data['view_identify'] = 1;
			$data['back'] = 'employee/update_employee/'.$emp_user_id;
			$data['emp_action'] = 'Updated';
			$data['btn_l_name'] = "Update Employee";
			$data['btn_l'] = 'employee/update_employee/'.encode($emp_user_id);
			$data['btn_r_name'] = "View Employees";
			$data['btn_r'] = 'employee/';
			$data['info_emp'] = $this->mindex_employee->get_user_update($emp_user_id);
			$data['emp_pic'] = $get_user_update[0]->emp_picture;
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_employee',$data);
			$this->load->view('footer/footer_admin',$data);
		}

	}
	function delete_employee($emp_user_id=0)
	{
		$emp_user_id = decode($emp_user_id);
		$info_emp =$this->mindex_employee->get_user_update($emp_user_id);
		if(count($info_emp)>0)
		{		
			$data['menu_name'] = "";
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['get_treeview'] = $this->mindex_employee->get_treeview('treeview_employee');
			$data['get_l'] = "";
			$data['get_r'] = "";
			$data['emp_pic'] ="";
			$data['view_identify'] = 0;
			$data['emp_action'] = 'Delete';
			$data['btn_l_name'] = "Back";
			$data['btn_l'] = 'employee/';
			$data['btn_r_name'] = "Delete";
			$data['btn_r'] = 'employee/deleted_employee/'.encode($emp_user_id);
			$data['info_emp'] = $this->mindex_employee->get_user_update($emp_user_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_employee',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else {
			redirect('employee');
		}
	}
	function deleted_employee($emp_user_id=0)
	{
		$emp_user_id = decode($emp_user_id);
		$this->mindex_employee->employee_delete($emp_user_id);
		redirect('employee');
	}
	public function username_check($emp_username="")
	{
		$test = $this->mindex_employee->check_user($emp_username);
		if(count($test) > 0)
		{
			$this->form_validation->set_message('username_check', 'Username already exist!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function empno_check($emp_no="")
	{
		$test = $this->mindex_employee->check_empno($emp_no);
		if(count($test) > 0)
		{
			$this->form_validation->set_message('empno_check', 'Employee Number already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function email_check($emp_email="")
	{
		$test = $this->mindex_employee->check_email($emp_email);
		if(count($test) > 0)
		{
			$this->form_validation->set_message('email_check', 'Email Address already exist');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function uploadImage($fileName,$emp_user_id)
	{
		$config['upload_path']   =   "images/Pictures/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$config['file_name']	 = $fileName;
	 	$this->load->library('upload',$config);
       if(!$this->upload->do_upload())
       {
           //echo $this->upload->display_errors();
       		$this->session->set_userdata('emp_picture',  $fileName);
       		 
       }
       else
       {
           $finfo=$this->upload->data();
           $this->session->set_userdata('emp_picture',  $finfo['file_name']);
           $this->_createThumbnail($finfo['file_name']);
           $data['uploadInfo'] = $finfo;
           $data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
           $emp_pic = '~/Pictures/'.$finfo['file_name'];
           $this->mindex_employee->employee_update_pic($emp_pic,$emp_user_id);
       }
	}
	public function uploadImage_add($fileName)
	{
		$config['upload_path']   =   "images/Pictures/";
		$config['allowed_types'] =   "gif|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$config['file_name']	 = $fileName;
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload())
		{
			//echo $this->upload->display_errors();
			$this->session->set_userdata('emp_picture',  'default.png');
		}
		else
		{
			$finfo=$this->upload->data();
			$this->session->set_userdata('emp_picture',  $finfo['file_name']);
			$this->_createThumbnail($finfo['file_name']);
			$data['uploadInfo'] = $finfo;
			$data['thumbnail_name'] = $finfo['raw_name']. '_thumb' .$finfo['file_ext'];
		}
	}
	//Create Thumbnail function
	
	public function _createThumbnail($filename)
	
	{
	
		$config['image_library']    = "gd2";
		$config['source_image']     = "images/Pictures/" .$filename;
		$config['create_thumb']     = TRUE;
		$config['maintain_ratio']   = TRUE;	
		$config['width'] = "200";
		$config['height'] = "220";
		$this->load->library('image_lib',$config);
		if(!$this->image_lib->resize())
	
		{
	
			echo $this->image_lib->display_errors();
	
		}
	
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */