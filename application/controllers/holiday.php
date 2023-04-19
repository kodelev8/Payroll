<?php 
class holiday extends Secure_Controller {

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
		$this->load->model( array('mindex_holiday','mglobal') );
		$this->load->library('form_validation','pagination');
	}

	public function index($holiday_row=0)
	{
		$this->session->set_userdata('cur_row',$holiday_row);
		$per_page = $this->mindex_holiday->active_holiday_num_rows();
		$per_page = $per_page->NumRows;
		$holiday_per_page =$per_page;
		$total_row= $this->mindex_holiday->count_holiday();
		$this->load->library('pagination');
		$config['base_url'] = base_url('holiday/index/');
		$config['total_rows'] = $total_row->holiday_count;
		$holiday_total =  $total_row->holiday_count;
		$config['cur_page'] = $holiday_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['holiday_count']=$holiday_total;
		$data['holiday'] = $this->mindex_holiday->holiday_view($holiday_per_page,$holiday_row,$holiday_total);
		$data['holiday_num_rows'] = $this->mindex_holiday->holiday_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_holiday',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_holiday_scan()
	{
		$holiday_row= $this->session->userdata('cur_row');
			echo ini_set('display_errors', 1);
		$per_page = $this->input->post('holiday_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_holiday->active_holiday_num_rows();
			$per_page = $per_page->NumRows;
		}
		$holiday_per_page =$per_page;
		$this->mindex_holiday->update_holiday_num_rows($holiday_per_page);
		$total_row= $this->mindex_holiday->count_holiday();
		$this->load->library('pagination');
		$config['base_url'] = base_url('holiday/index/');
		$config['total_rows'] = $total_row->holiday_count;
		$holiday_total =  $total_row->holiday_count;
		$config['cur_page'] = $holiday_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['holiday_count']=$holiday_total;
		$data['holiday'] = $this->mindex_holiday->holiday_view($holiday_per_page,$holiday_row,$holiday_total);
		$data['holiday_num_rows'] = $this->mindex_holiday->holiday_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_holiday',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_holiday_search($holiday_row=0)
	{
		$holiday_search=$this->session->userdata('holiday_search');
		$this->session->set_userdata('cur_row',$holiday_row);
		$per_page = $this->mindex_holiday->active_holiday_num_rows();
		$per_page = $per_page->NumRows;
		$holiday_per_page =$per_page;
		$this->mindex_holiday->update_holiday_num_rows($holiday_per_page);
		$total_row= $this->mindex_holiday->count_holiday_search($holiday_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('holiday/view_holiday_search/');
		$config['total_rows'] = $total_row->holiday_count;
		$holiday_total =  $total_row->holiday_count;
		$config['cur_page'] = $holiday_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['holiday_count']=$holiday_total;
		$data['holiday'] = $this->mindex_holiday->holiday_view_search($holiday_per_page,$holiday_search,$holiday_row,$holiday_total);
		$data['holiday_num_rows'] = $this->mindex_holiday->holiday_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_holiday_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_holiday_searched()
	{
		$holiday_row= $this->session->userdata('cur_row');
		$holiday_search=$this->input->post('hid_holiday_search');

		if($holiday_search)
		{
			$this->session->set_userdata('holiday_search',$holiday_search);
		}
	
		else
		{
			$holiday_search= $this->session->userdata('holiday_search');
		}
		if(substr_count($holiday_search,"'")>0)
		{
			redirect('holiday');
		}
		$per_page = $this->input->post('holiday_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_holiday->active_holiday_num_rows();
			$per_page = $per_page->NumRows;
			$holiday_row= 0;
		}
	
		$holiday_per_page =$per_page;
		$this->mindex_holiday->update_holiday_num_rows($holiday_per_page);
		$total_row= $this->mindex_holiday->count_holiday_search($holiday_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('holiday/view_holiday_search/');
		$config['total_rows'] = $total_row->holiday_count;
		$holiday_total =  $total_row->holiday_count;
		$config['cur_page'] = $holiday_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['holiday_count']=$holiday_total;
		echo ini_set('display_errors', 1);
		$data['holiday'] =$this->mindex_holiday->holiday_view_search($holiday_per_page,$holiday_search,$holiday_row,$holiday_total);
		$data['holiday_num_rows'] = $this->mindex_holiday->holiday_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_holiday_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function add_holiday()
	{
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$add = $this->input->post('btn-add');
		$holiday_type = $this->input->post('holiday_type');
		$holiday_date = $this->input->post('holiday_date');
		$holiday_name = $this->input->post('holiday_name');
		//$holiday_emp_id = $this->mindex_holiday->get_emp_id();
				
		if($add)
		{
			$data['record'] = array('holiday_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
	        $this->form_validation->set_rules('holiday_name',  		'Holiday Name',		'required');
	        $this->form_validation->set_rules('holiday_date',  		'Holiday Date',		'required|callback_validate_date');
	        $data['record'] = array(
		        'holiday_type'   		=> $this->input->post('holiday_type'),
		        'holiday_date'   		=> $this->input->post('holiday_date'),
		        'holiday_name'   	=> $this->input->post('holiday_name')
	        );

	        if ($this->form_validation->run() == false)
	        {
	        	$data['inputdate'] = $this->input->post('holiday_date');
	        	$data['hday_type_id'] =$holiday_type;
        		$data['holiday_type'] = $this->mindex_holiday->get_holiday_type();
	        	$data['get_holiday_type'] = $this->mindex_holiday->get_holiday_type();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/add_holiday',$data);
				$this->load->view('footer/footer_admin',$data);
	        }
	        else
	        {
	        	$holiday_date = date("Y-m-d", strtotime($holiday_date));
	        	$this->mindex_holiday->add_holiday($holiday_type,$holiday_date,str_replace("'","''",$holiday_name));
	        	redirect('holiday/added_holiday/');
	        }
			
		}
		else{
			$data['inputdate'] = date('d-m-Y');
			$data['record'] = '';
			$data['hday_type_id'] = 1;
			$data['holiday_type'] = $this->mindex_holiday->get_holiday_type();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/add_holiday',$data);
			$this->load->view('footer/footer_admin',$data);
			
		}
	}

	function added_holiday()
	{
		$get_holiday_info = $this->mindex_holiday->get_holiday_info();
		$holiday_id = $get_holiday_info->hday_id;
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['holiday_info']= $get_holiday_info;
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$data['holiday_action'] = 'Added';
		$data['btn_r']= 'holiday/';
		$data['btn_r_name']= 'View Holidays';
		$data['btn_l']= 'holiday/update_holiday/'.encode($holiday_id);
		$data['btn_l_name'] = 'Update Holiday';
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_holiday',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	function update_holiday($holiday_id=0)
	{
		$holiday_id = decode($holiday_id);
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$add = $this->input->post('btn-add');
		$holiday_type = $this->input->post('holiday_type');
		$holiday_date = $this->input->post('holiday_date');
		$holiday_name = $this->input->post('holiday_name');
		$holiday_update_info = $this->mindex_holiday->get_holiday_update($holiday_id);
		$data['record'] = array(
				'holiday_type'   	=> $holiday_update_info->hday_type,
				'holiday_date'   	=> date("d-m-Y", strtotime($holiday_update_info->hday_date)),
				'holiday_name'   	=> $holiday_update_info->hday_remarks
		
		);
		
		if($add)
		{
			$data['record'] = array('holiday_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('holiday_name',  		'Holiday Name',		'required');
			$this->form_validation->set_rules('holiday_date',  		'Holiday Date',		'required|callback_validate_date');
			$data['record'] = array(
					'holiday_type'   	=> $this->input->post('holiday_type'),
					'holiday_date'   	=> $this->input->post('holiday_date'),
					'holiday_name'   	=> $this->input->post('holiday_name'),
			);
	
			if ($this->form_validation->run() == false)
			{
				$data['inputdate']= date("d-m-Y", strtotime($holiday_update_info->hday_date));
				$data['holiday_id'] = $holiday_update_info->hday_id;
				$data['hday_type_id'] = $holiday_update_info->hday_id;
				$data['holiday_type'] = $this->mindex_holiday->get_holiday_type();
				$data['get_holiday_type'] = $this->mindex_holiday->get_holiday_type();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/update_holiday',$data);
				$this->load->view('footer/footer_admin',$data);
			}
			else
			{
				$holiday_date = date("Y-m-d", strtotime($holiday_date));
				$this->mindex_holiday->update_holiday($holiday_date,$holiday_type ,str_replace("'","''",$holiday_name),$holiday_id);
// 				echo $holiday_date,$holiday_type ,$holiday_name,$holiday_id;
				redirect('holiday/updated_holiday/'.encode($holiday_id));
			}
				
		}
		else{
			$data['inputdate']= date("d-m-Y", strtotime($holiday_update_info->hday_date));
			$data['holiday_id']=$holiday_id;
			$data['hday_type_id'] = $holiday_update_info->hday_id;
			$data['holiday_type'] = $this->mindex_holiday->get_holiday_type();
			$data['get_holiday_type'] = $this->mindex_holiday->get_holiday_type();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_holiday',$data);
			$this->load->view('footer/footer_admin');				
		}
	
	
	}
	function updated_holiday($holiday_id=0)
	{
		$holiday_id = decode($holiday_id);
		$data['menu_name']= 'holiday';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="active";
		$data['treeview_daily_task'] ="";
		$data['holiday_action'] = 'Updated';
		$data['btn_r']= 'holiday/';
		$data['btn_r_name']= 'View Employees holiday';
		$data['btn_l']= 'holiday/update_holiday/'.encode($holiday_id);
		$data['btn_l_name'] = 'Update Employee holiday';
		$data['holiday_info']= $this->mindex_holiday->get_holiday_update($holiday_id);
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_holiday',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function delete_holiday($holiday_id=0)
	{
		$holiday_id = decode($holiday_id);
		$info_holiday = $this->mindex_holiday->get_holiday_update($holiday_id);
		if(count($info_holiday)>0)
		{
			$data['menu_name']= 'holiday';
			$data['treeview_main'] = "";
			$data['treeview_employee'] ="";
			$data['treeview_leave'] ="";
			$data['treeview_dtr'] ="";
			$data['treeview_holiday'] ="active";
			$data['treeview_daily_task'] ="";
			$data['holiday_action'] = 'Delete';
			$data['btn_r']= 'holiday/deleted_holiday/'.encode($holiday_id);
			$data['btn_r_name']= 'Delete Holiday';
			$data['btn_l']= 'holiday/';
			$data['btn_l_name'] = 'View Holidays';
			$data['holiday_info']= $this->mindex_holiday->get_holiday_update($holiday_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_holiday',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{
			redirect('holiday');
		}

	}
	public function deleted_holiday($holiday_id=0)
	{
		$holiday_id = decode($holiday_id);
		$this->mindex_holiday->delete_holiday($holiday_id);
		redirect('holiday');
	}
	public function validate_date($holiday_date)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($dd, $mm,$yy) = preg_split('[-]', $holiday_date);
	
		if (!is_numeric($dd) || !is_numeric($mm) || !is_numeric($yy))
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