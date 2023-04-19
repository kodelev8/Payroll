<?php 
class allowance extends Secure_Controller {

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
		$this->load->model( array('mindex_allowance','mglobal') );
		$this->load->library('form_validation');
	}
	public function index($allowance_row=0)
	{
		$this->session->set_userdata('cur_row',$allowance_row);
		$per_page = $this->mindex_allowance->active_allowance_num_rows();
		$per_page = $per_page->NumRows;
		$allowance_per_page =$per_page;
		$total_row= $this->mindex_allowance->count_allowance();
		$this->load->library('pagination');
		$config['base_url'] = base_url('allowance/index/');
		$config['total_rows'] = $total_row->allowance_count;
		$allowance_total =  $total_row->allowance_count;
		$config['cur_page'] = $allowance_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "allowance";
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['allowance_count']=$allowance_total;
		$data['allowance'] = $this->mindex_allowance->allowance_view($allowance_per_page,$allowance_row,$allowance_total);
		$data['allowance_num_rows'] = $this->mindex_allowance->allowance_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_allowance',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_allowance_scan()
	{
		$allowance_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('allowance_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_allowance->active_allowance_num_rows();
			$per_page = $per_page->NumRows;
		}
		$allowance_per_page =$per_page;
		$this->mindex_allowance->update_allowance_num_rows($allowance_per_page);
		$total_row= $this->mindex_allowance->count_allowance();
		$this->load->library('pagination');
		$config['base_url'] = base_url('allowance/index/');
		$config['total_rows'] = $total_row->allowance_count;
		$allowance_total =  $total_row->allowance_count;
		$config['cur_page'] = $allowance_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "allowance";
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['allowance_count']=$allowance_total;
		$data['allowance'] = $this->mindex_allowance->allowance_view($allowance_per_page,$allowance_row,$allowance_total);
		$data['allowance_num_rows'] = $this->mindex_allowance->allowance_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_allowance',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_allowance_search($allowance_row=0)
	{
		$allowance_search=$this->session->userdata('allowance_search');
		$this->session->set_userdata('cur_row',$allowance_row);
		$per_page = $this->mindex_allowance->active_allowance_num_rows();
		$per_page = $per_page->NumRows;
		$allowance_per_page =$per_page;
		$this->mindex_allowance->update_allowance_num_rows($allowance_per_page);
		$total_row= $this->mindex_allowance->count_allowance_search($allowance_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('allowance/view_allowance_search/');
		$config['total_rows'] = $total_row->allowance_count;
		$allowance_total =  $total_row->allowance_count;
		$config['cur_page'] = $allowance_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "allowance";
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['allowance_count']=$allowance_total;
		$data['allowance'] = $this->mindex_allowance->allowance_view_search($allowance_per_page,$allowance_search,$allowance_row,$allowance_total);
		$data['allowance_num_rows'] = $this->mindex_allowance->allowance_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_allowance_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_allowance_searched()
	{
		$allowance_row= $this->session->userdata('cur_row');
		$allowance_search=$this->input->post('hid_allowance_search');
		if($allowance_search)
		{
			$this->session->set_userdata('allowance_search',$allowance_search);
		}
		else
		{
			$allowance_search= $this->session->userdata('allowance_search');
		}
	
		$per_page = $this->input->post('allowance_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_allowance->active_allowance_num_rows();
			$per_page = $per_page->NumRows;
			$allowance= 0;
		}
	
		$allowance_per_page =$per_page;
		$this->mindex_allowance->update_allowance_num_rows($allowance_per_page);
		$total_row= $this->mindex_allowance->count_allowance_search($allowance_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('allowance/view_allowance_search/');
		$config['total_rows'] = $total_row->allowance_count;
		$allowance_total =  $total_row->allowance_count;
		$config['cur_page'] = $allowance_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "allowance";
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['allowance_count']=$allowance_total;
		$data['allowance'] = $this->mindex_allowance->allowance_view_search($allowance_per_page,$allowance_search,$allowance_row,$allowance_total);
		$data['allowance_num_rows'] = $this->mindex_allowance->allowance_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_allowance_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function add_allowance()
	{
		$data['menu_name'] = "allowance";
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$add = $this->input->post('btn-add');
		$allowance_emp_no = $this->input->post('allowance_emp_no');
		$allowance_amount = $this->input->post('allowance_amount');
		$allowance_date = $this->input->post('allowance_date');
		$allowance_description = $this->input->post('allowance_description');
		$allowance_emp_id = $this->mindex_allowance->get_emp_id($allowance_emp_no);
		
		
		if($add)
		{
			$data['record'] = array('allowance_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('allowance_amount',  		'Allowance Ammount',		'required|numeric');
			$this->form_validation->set_rules('allowance_date',  		'Allowance Date',			'required|callback_validate_date');
			$this->form_validation->set_rules('allowance_description',  'Allowance Description',	'required');
	        $data['record'] = array(
	        	'allowance_emp_no'   	=> $this->input->post('allowance_emp_no'),
		        'allowance_amount'   	=> $this->input->post('allowance_amount'),
		        'allowance_date'   		=> $this->input->post('allowance_date'),
		        'allowance_description' => $this->input->post('allowance_description')
	        );

	        if ($this->form_validation->run() == false)
	        {
	        	$data['inputdate']= date("d-m-Y", strtotime($allowance_date));
	        	$data['allowance_emp_no'] = $allowance_emp_no;
	        	$data['get_emp_info'] = $this->mindex_allowance->get_emp_info();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/add_allowance',$data);
				$this->load->view('footer/footer_admin',$data);
	        }
	        else
	        {
	        	$allowance_date = date("Y-m-d", strtotime($allowance_date));
	        	$this->mindex_allowance->add_allowance($allowance_emp_no,$allowance_amount,$allowance_description,$allowance_date);
	        	$this->session->set_userdata('emp_picture', '');
	        	redirect('allowance/added_allowance/');
	        }
		}
		else{
			$data['inputdate']= date("d-m-Y");
			$data['allowance_emp_no'] = '03';
			$data['record'] = '';
			$data['get_emp_info'] = $this->mindex_allowance->get_emp_info();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/add_allowance',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	}

	function added_allowance()
	{
		$data['menu_name'] = "allowance";
		$allowance_info = $this->mindex_allowance->get_allowance_info();
		$allowance_id = $allowance_info->Allowance_ID; 
		$data['allowance_action'] = 'Added';
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$data['btn_r'] = "";
		$data['btn_r_name'] = 'View Employees Allowance';
		$data['btn_l']= 'allowance/update_allowance/'.encode($allowance_id);
		$data['btn_l_name'] = 'Update Employee Allowance';
		$data['allowance_info']= $allowance_info;
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_allowance',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	function update_allowance($allowance_id=0)
	{
		$data['menu_name'] = "allowance";
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$allowance_id = decode($allowance_id);
		$add = $this->input->post('btn-add');
		$allowance_emp_no = $this->input->post('allowance_emp_no');
		$allowance_amount = $this->input->post('allowance_amount');
		$allowance_date = $this->input->post('allowance_date');
		$allowance_description = $this->input->post('allowance_description');
		$allowance_update_info = $this->mindex_allowance->get_allowance_update($allowance_id);
		$data['record'] = array(
				'allowance_emp_no'   	=> $allowance_update_info->Allowance_Emp_No,
				'allowance_amount'   		=> number_format($allowance_update_info->Allowance_Amount,2),
				'allowance_date'   		=> date("d-m-Y", strtotime($allowance_update_info->Allowance_Date)),
				'allowance_description'   	=> $allowance_update_info->Allowance_Description
		
		);
		
		if($add)
		{
			$data['record'] = array('allowance_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('allowance_amount',  		'Allowance Ammount',		'required|numeric');
			$this->form_validation->set_rules('allowance_date',  		'Allowance Date',			'required|callback_validate_date');
			$this->form_validation->set_rules('allowance_description',  'Allowance Description',	'required');
			$data['record'] = array(
					'allowance_emp_no'   	=> $this->input->post('allowance_emp_no'),
					'allowance_type'   		=> $this->input->post('allowance_type'),
					'allowance_date'   		=> $this->input->post('allowance_date'),
					'allowance_description'   	=> $this->input->post('allowance_description'),
					'allowance_emp_name'   	=> $this->input->post('allowance_emp_name')
			);
	
			if ($this->form_validation->run() == false)
			{
				$data['inputdate']= date("d-m-Y", strtotime($allowance_update_info->Allowance_Date));
				$data['allowance_id'] = $allowance_update_info->Allowance_ID;
				$data['allowance_emp_no'] = $allowance_emp_no;
// 				$data['allowance_type'] = $allowance_type;
				$data['get_emp_info'] = $this->mindex_allowance->get_emp_info();
// 				$data['get_allowance_type'] = $this->mindex_allowance->get_allowance_type();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/update_allowance',$data);
				$this->load->view('footer/footer_admin',$data);
			}
			else
			{
				$allowance_date = date("Y-m-d", strtotime($allowance_date));
				$this->mindex_allowance->update_allowance($allowance_emp_no,$allowance_amount , str_replace("'","''",$allowance_description),$allowance_date,$allowance_id);
				redirect('allowance/updated_allowance/'.encode($allowance_id));
			}
				
		}
		else{
			$data['inputdate']= date("d-m-Y", strtotime($allowance_update_info->Allowance_Date));
			$data['allowance_id'] = $allowance_update_info->Allowance_ID;
			$data['allowance_amount'] = $allowance_update_info->Allowance_Amount;
			$data['allowance_emp_no'] = $allowance_update_info->Allowance_Emp_No;
			$data['get_emp_info'] = $this->mindex_allowance->get_emp_info();
// 			$data['get_allowance_type'] = $this->mindex_allowance->get_allowance_type();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_allowance',$data);
			$this->load->view('footer/footer_admin',$data);				
		}
	
	
	}
	function updated_allowance($allowance_id=0)
	{
		$data['menu_name'] = "allowance";
		$data['get_treeview'] = $this->mindex_allowance->get_treeview('treeview_allowance');
		$allowance_id = decode($allowance_id);
		$data['allowance_action'] = 'Updated';
		$data['btn_r']= 'allowance/';
		$data['btn_r_name']= 'View Employees Allowance';
		$data['btn_l']= 'allowance/update_allowance/'.encode($allowance_id);
		$data['btn_l_name'] = 'Update Employee Allowance';
		$data['allowance_info']= $this->mindex_allowance->get_allowance_update($allowance_id);
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_allowance',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function delete_allowance($allowance_id=0)
	{
		$allowance_id = decode($allowance_id);
		$info_allowance = $this->mindex_allowance->get_allowance_update($allowance_id);
		if(count($info_allowance)>0)
		{
			$data['menu_name'] = "allowance";
			$data['treeview_main'] = "";
			$data['treeview_employee'] ="";
			$data['treeview_leave'] ="active";
			$data['treeview_dtr'] ="";
			$data['treeview_holiday'] ="";
			$data['treeview_daily_task'] ="";
			$data['allowance_action'] = 'Delete';
			$data['btn_r']= 'allowance/deleted_allowance/'.encode($allowance_id);
			$data['btn_r_name']= 'Delete Employees allowance';
			$data['btn_l']= 'allowance/';
			$data['btn_l_name'] = 'View Employees allowance';
			$data['allowance_info']= $this->mindex_allowance->get_allowance_update($allowance_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_allowance',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{
			redirect('allowance');
		}

	}
	public function deleted_allowance($allowance_id=0)
	{
		$allowance_id = decode($allowance_id);
		$this->mindex_allowance->delete_allowance($allowance_id);
		redirect('allowance');
	}
	public function validate_date($allowance_date)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($dd, $mm,$yy) = preg_split('[-]', $allowance_date);
	
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