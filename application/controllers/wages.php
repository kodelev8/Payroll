<?php 
class wages extends Secure_Controller {

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
		$this->load->model( array('mindex_wages','mglobal') );
		$this->load->library('form_validation');
	}
	public function index($wages_row=0)
	{
		$this->session->set_userdata('cur_row',$wages_row);
		$per_page = $this->mindex_wages->active_wages_num_rows();
		$per_page = $per_page->NumRows;
		$wages_per_page =$per_page;
		$total_row= $this->mindex_wages->count_wages();
		$this->load->library('pagination');
		$config['base_url'] = base_url('wages/index/');
		$config['total_rows'] = $total_row->wages_count;
		$wages_total =  $total_row->wages_count;
		$config['cur_page'] = $wages_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "wages";
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['wages_count']=$wages_total;
		$data['wages'] = $this->mindex_wages->wages_view($wages_per_page,$wages_row,$wages_total);
		$data['wages_num_rows'] = $this->mindex_wages->wages_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_wages',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_wages_scan()
	{
		$wages_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('wages_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_wages->active_wages_num_rows();
			$per_page = $per_page->NumRows;
		}
		$wages_per_page =$per_page;
		$this->mindex_wages->update_wages_num_rows($wages_per_page);
		$total_row= $this->mindex_wages->count_wages();
		$this->load->library('pagination');
		$config['base_url'] = base_url('wages/index/');
		$config['total_rows'] = $total_row->wages_count;
		$wages_total =  $total_row->wages_count;
		$config['cur_page'] = $wages_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "wages";
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['wages_count']=$wages_total;
		$data['wages'] = $this->mindex_wages->wages_view($wages_per_page,$wages_row,$wages_total);
		$data['wages_num_rows'] = $this->mindex_wages->wages_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_wages',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_wages_search($wages_row=0)
	{
		$wages_search=$this->session->userdata('wages_search');
		$this->session->set_userdata('cur_row',$wages_row);
		$per_page = $this->mindex_wages->active_wages_num_rows();
		$per_page = $per_page->NumRows;
		$wages_per_page =$per_page;
		$this->mindex_wages->update_wages_num_rows($wages_per_page);
		$total_row= $this->mindex_wages->count_wages_search($wages_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('wages/view_wages_search/');
		$config['total_rows'] = $total_row->wages_count;
		$wages_total =  $total_row->wages_count;
		$config['cur_page'] = $wages_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "wages";
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['wages_count']=$wages_total;
		$data['wages'] = $this->mindex_wages->wages_view_search($wages_per_page,$wages_search,$wages_row,$wages_total);
		$data['wages_num_rows'] = $this->mindex_wages->wages_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_wages_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_wages_searched()
	{
		$wages_row= $this->session->userdata('cur_row');
		$wages_search=$this->input->post('hid_wages_search');
		if($wages_search)
		{
			$this->session->set_userdata('wages_search',$wages_search);
		}
		else
		{
			$wages_search= $this->session->userdata('wages_search');
		}
	
		$per_page = $this->input->post('wages_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_wages->active_wages_num_rows();
			$per_page = $per_page->NumRows;
			$wages= 0;
		}
	
		$wages_per_page =$per_page;
		$this->mindex_wages->update_wages_num_rows($wages_per_page);
		$total_row= $this->mindex_wages->count_wages_search($wages_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('wages/view_wages_search/');
		$config['total_rows'] = $total_row->wages_count;
		$wages_total =  $total_row->wages_count;
		$config['cur_page'] = $wages_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "wages";
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['wages_count']=$wages_total;
		$data['wages'] = $this->mindex_wages->wages_view_search($wages_per_page,$wages_search,$wages_row,$wages_total);
		$data['wages_num_rows'] = $this->mindex_wages->wages_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_wages_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function add_wages()
	{
		$data['menu_name'] = "wages";
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$add = $this->input->post('btn-add');
		$wages_emp_no = $this->input->post('wages_emp_no');
		$wages_amount_per_hour = $this->input->post('wages_amount_per_hour');
		$wages_amount_per_hour = $wages_amount_per_hour / 8;
		$wages_date = $this->input->post('wages_date');
		$wages_description = $this->input->post('wages_description');
		
		
		if($add)
		{
			$data['record'] = array('wages_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('wages_amount_per_hour',  'Wages Amount Per Hour',		'required|numeric');
			$data['record'] = array(
					'wages_amount_per_hour'   	=> $this->input->post('wages_amount_per_hour'), 					
	        );

	        if ($this->form_validation->run() == false)
	        {
	        	$data['inputdate']= date("d-m-Y", strtotime($wages_date));
	        	$data['wages_emp_no'] = $wages_emp_no;
	        	$data['get_emp_info'] = $this->mindex_wages->get_emp_info();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/add_wages',$data);
				$this->load->view('footer/footer_admin',$data);
	        }
	        else
	        {
	        	$wages_date = date("Y-m-d", strtotime($wages_date));
	        	$this->mindex_wages->add_wages($wages_emp_no,$wages_amount_per_hour);
	        	$this->session->set_userdata('emp_picture', '');
	        	redirect('wages/added_wages/');
	        }
		}
		else{
			$data['inputdate']= date("d-m-Y");
			$data['wages_emp_no'] = '03';
			$data['record'] = '';
			$data['get_emp_info'] = $this->mindex_wages->get_emp_info();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/add_wages',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	}

	function added_wages()
	{
		$data['menu_name'] = "wages";
		$wages_info = $this->mindex_wages->get_wages_info();
		$wages_id = $wages_info->Wages_ID;
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$data['wages_action'] = 'Added';
		$data['btn_r'] = "wages";
		$data['btn_r_name'] = 'View Employees wages';
		$data['btn_l']= 'wages/update_wages/'.encode($wages_id);
		$data['btn_l_name'] = 'Update Employee wages';
		$data['wages_info']= $wages_info;
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_wages',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	function update_wages($wages_id=0)
	{
		$data['menu_name'] = "wages";
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$wages_id = decode($wages_id);
		$add = $this->input->post('btn-add');
		$wages_emp_no = $this->input->post('wages_emp_no');
		$wages_amount_per_hour = $this->input->post('wages_amount_per_hour');
		$wages_date = $this->input->post('wages_date');
		$wages_description = $this->input->post('wages_description');
		$wages_update_info = $this->mindex_wages->get_wages_update($wages_id);
		$data['record'] = array(
				'wages_emp_name'   	=> $wages_update_info->Wages_Emp_Name,
				'wages_amount_per_hour'   		=> number_format($wages_update_info->Wages_Amount_Per_Hour,2)*8
		
		);
		
		if($add)
		{
			$data['record'] = array('wages_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('wages_amount_per_hour',  'Wages Amount Per Hour',		'required|numeric');
			$data['record'] = array(
					'wages_amount_per_hour'   	=> $this->input->post('wages_amount_per_hour'),
					'wages_emp_name'   	=> $this->input->post('wages_emp_name')
			);
	
			if ($this->form_validation->run() == false)
			{
				$data['wages_id'] = $wages_update_info->Wages_ID;
				$data['wages_emp_no'] = $wages_emp_no;
				$data['get_emp_info'] = $this->mindex_wages->get_emp_info();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/update_wages',$data);
				$this->load->view('footer/footer_admin',$data);
			}
			else
			{
				$wages_date = date("Y-m-d", strtotime($wages_date));
				$wages_amount_per_hour = $wages_amount_per_hour/8;
				$this->mindex_wages->update_wages($wages_amount_per_hour, $wages_id);
				redirect('wages/updated_wages/'.encode($wages_id));
			}
				
		}
		else{ 
			$data['wages_id'] = $wages_update_info->Wages_ID;
			$data['wages_amount'] = $wages_update_info->Wages_Amount_Per_Hour;
			$data['wages_emp_no'] = $wages_update_info->Wages_Emp_No;
			$data['get_emp_info'] = $this->mindex_wages->get_emp_info(); 
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_wages',$data);
			$this->load->view('footer/footer_admin',$data);				
		}
	
	
	}
	function updated_wages($wages_id=0)
	{
		$data['menu_name'] = "wages";
		$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
		$wages_id = decode($wages_id);
		$data['wages_action'] = 'Updated';
		$data['btn_r']= 'wages/';
		$data['btn_r_name']= 'View Employees Wages';
		$data['btn_l']= 'wages/update_wages/'.encode($wages_id);
		$data['btn_l_name'] = 'Update Employee Wages';
		$data['wages_info']= $this->mindex_wages->get_wages_update($wages_id);
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_wages',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function delete_wages($wages_id=0)
	{
		$wages_id = decode($wages_id);
		$info_wages = $this->mindex_wages->get_wages_update($wages_id);
		if(count($info_wages)>0)
		{
			$data['menu_name'] = "wages";
			$data['get_treeview'] = $this->mindex_wages->get_treeview('treeview_wages');
			$data['wages_action'] = 'Delete';
			$data['btn_r']= 'wages/deleted_wages/'.encode($wages_id);
			$data['btn_r_name']= 'Delete Employees Wages';
			$data['btn_l']= 'wages/';
			$data['btn_l_name'] = 'View Employees Wages';
			$data['wages_info']= $this->mindex_wages->get_wages_update($wages_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_wages',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{
			redirect('wages');
		}

	}
	public function deleted_wages($wages_id=0)
	{
		$wages_id = decode($wages_id);
		$this->mindex_wages->delete_wages($wages_id);
		redirect('wages');
	}
	public function validate_date($wages_date)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($dd, $mm,$yy) = preg_split('[-]', $wages_date);
	
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