<?php 
class deduction extends Secure_Controller {

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
		$this->load->model( array('mindex_deduction','mglobal') );
		$this->load->library('form_validation');
	}
	public function index($deduction_row=0)
	{
		$this->session->set_userdata('cur_row',$deduction_row);
		$per_page = $this->mindex_deduction->active_deduction_num_rows();
		$per_page = $per_page->NumRows;
		$deduction_per_page =$per_page;
		$total_row= $this->mindex_deduction->count_deduction();
		$this->load->library('pagination');
		$config['base_url'] = base_url('deduction/index/');
		$config['total_rows'] = $total_row->deduction_count;
		$deduction_total =  $total_row->deduction_count;
		$config['cur_page'] = $deduction_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "deduction";
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['deduction_count']=$deduction_total;
		$data['deduction'] = $this->mindex_deduction->deduction_view($deduction_per_page,$deduction_row,$deduction_total);
		$data['deduction_num_rows'] = $this->mindex_deduction->deduction_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_deduction',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_deduction_scan()
	{
		$deduction_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('deduction_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_deduction->active_deduction_num_rows();
			$per_page = $per_page->NumRows;
		}
		$deduction_per_page =$per_page;
		$this->mindex_deduction->update_deduction_num_rows($deduction_per_page);
		$total_row= $this->mindex_deduction->count_deduction();
		$this->load->library('pagination');
		$config['base_url'] = base_url('deduction/index/');
		$config['total_rows'] = $total_row->deduction_count;
		$deduction_total =  $total_row->deduction_count;
		$config['cur_page'] = $deduction_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "deduction";
		$data['treeview_main'] = "";
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['deduction_count']=$deduction_total;
		$data['deduction'] = $this->mindex_deduction->deduction_view($deduction_per_page,$deduction_row,$deduction_total);
		$data['deduction_num_rows'] = $this->mindex_deduction->deduction_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_deduction',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_deduction_search($deduction_row=0)
	{
		$deduction_search=$this->session->userdata('deduction_search');
		$this->session->set_userdata('cur_row',$deduction_row);
		$per_page = $this->mindex_deduction->active_deduction_num_rows();
		$per_page = $per_page->NumRows;
		$deduction_per_page =$per_page;
		$this->mindex_deduction->update_deduction_num_rows($deduction_per_page);
		$total_row= $this->mindex_deduction->count_deduction_search($deduction_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('deduction/view_deduction_search/');
		$config['total_rows'] = $total_row->deduction_count;
		$deduction_total =  $total_row->deduction_count;
		$config['cur_page'] = $deduction_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "deduction";
		$data['treeview_main'] = "";
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['deduction_count']=$deduction_total;
		$data['deduction'] = $this->mindex_deduction->deduction_view_search($deduction_per_page,$deduction_search,$deduction_row,$deduction_total);
		$data['deduction_num_rows'] = $this->mindex_deduction->deduction_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_deduction_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_deduction_searched()
	{
		$deduction_row= $this->session->userdata('cur_row');
		$deduction_search=$this->input->post('hid_deduction_search');
		if($deduction_search)
		{
			$this->session->set_userdata('deduction_search',$deduction_search);
		}
		else
		{
			$deduction_search= $this->session->userdata('deduction_search');
		}
	
		$per_page = $this->input->post('deduction_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_deduction->active_deduction_num_rows();
			$per_page = $per_page->NumRows;
			$deduction= 0;
		}
	
		$deduction_per_page =$per_page;
		$this->mindex_deduction->update_deduction_num_rows($deduction_per_page);
		$total_row= $this->mindex_deduction->count_deduction_search($deduction_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('deduction/view_deduction_search/');
		$config['total_rows'] = $total_row->deduction_count;
		$deduction_total =  $total_row->deduction_count;
		$config['cur_page'] = $deduction_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = "deduction";
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['deduction_count']=$deduction_total;
		$data['deduction'] = $this->mindex_deduction->deduction_view_search($deduction_per_page,$deduction_search,$deduction_row,$deduction_total);
		$data['deduction_num_rows'] = $this->mindex_deduction->deduction_num_rows();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_deduction_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function add_deduction()
	{
		$data['menu_name'] = "deduction";
		$data['treeview_main'] = "";
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$add = $this->input->post('btn-add');
		$deduction_emp_no = $this->input->post('deduction_emp_no');
		$deduction_amount = $this->input->post('deduction_amount');
		$deduction_date = $this->input->post('deduction_date');
		$deduction_description = $this->input->post('deduction_description');
		$deduction_emp_id = $this->mindex_deduction->get_emp_id($deduction_emp_no);
		
		
		if($add)
		{
			$data['record'] = array('deduction_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('deduction_amount',  		'deduction Ammount',		'required|numeric');
			$this->form_validation->set_rules('deduction_date',  		'deduction Date',			'required|callback_validate_date');
			$this->form_validation->set_rules('deduction_description',  'deduction Description',	'required');
	        $data['record'] = array(
	        	'deduction_emp_no'   	=> $this->input->post('deduction_emp_no'),
		        'deduction_amount'   	=> $this->input->post('deduction_amount'),
		        'deduction_date'   		=> $this->input->post('deduction_date'),
		        'deduction_description' => $this->input->post('deduction_description')
	        );

	        if ($this->form_validation->run() == false)
	        {
	        	$data['inputdate']= date("d-m-Y", strtotime($deduction_date));
	        	$data['deduction_emp_no'] = $deduction_emp_no;
	        	$data['get_emp_info'] = $this->mindex_deduction->get_emp_info();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/add_deduction',$data);
				$this->load->view('footer/footer_admin',$data);
	        }
	        else
	        {
	        	$deduction_description =str_replace("'","''",$deduction_description);
	        	$deduction_date = date("Y-m-d", strtotime($deduction_date));
	        	$this->mindex_deduction->add_deduction($deduction_emp_no,$deduction_amount,$deduction_description,$deduction_date);
	        	$this->session->set_userdata('emp_picture', '');
	        	redirect('deduction/added_deduction/');
	        }
		}
		else{
			$data['inputdate']= date("d-m-Y");
			$data['deduction_emp_no'] = '03';
			$data['record'] = '';
			$data['get_emp_info'] = $this->mindex_deduction->get_emp_info();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/add_deduction',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	}

	function added_deduction()
	{
		$data['menu_name'] = "deduction";
		$deduction_info = $this->mindex_deduction->get_deduction_info();
		$deduction_id = $deduction_info->Deduction_ID;
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$data['deduction_action'] = 'Added';
		$data['btn_r'] = "deduction";
		$data['btn_r_name'] = 'View Employees Deduction';
		$data['btn_l']= 'deduction/update_deduction/'.encode($deduction_id);
		$data['btn_l_name'] = 'Update Employee Deduction';
		$data['deduction_info']= $deduction_info;
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_deduction',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	function update_deduction($deduction_id=0)
	{
		$data['menu_name'] = "deduction";
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$deduction_id = decode($deduction_id);
		$add = $this->input->post('btn-add');
		$deduction_emp_no = $this->input->post('deduction_emp_no');
		$deduction_amount = $this->input->post('deduction_amount');
		$deduction_date = $this->input->post('deduction_date');
		$deduction_description = $this->input->post('deduction_description');
		$deduction_update_info = $this->mindex_deduction->get_deduction_update($deduction_id);
		$data['record'] = array(
				'deduction_emp_no'   		=> $deduction_update_info->Deduction_Emp_No,
				'deduction_amount'   		=> number_format($deduction_update_info->Deduction_Amount,2),
				'deduction_date'   			=> date("d-m-Y", strtotime($deduction_update_info->Deduction_Date)),
				'deduction_description'   	=> $deduction_update_info->Deduction_Description
		
		);
		
		if($add)
		{
			$data['record'] = array('deduction_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('deduction_amount',  		'deduction Ammount',		'required|numeric');
			$this->form_validation->set_rules('deduction_date',  		'deduction Date',			'required|callback_validate_date');
			$this->form_validation->set_rules('deduction_description',  'deduction Description',	'required');
			$data['record'] = array(
					'deduction_emp_no'   	=> $this->input->post('deduction_emp_no'),
					'deduction_type'   		=> $this->input->post('deduction_type'),
					'deduction_date'   		=> $this->input->post('deduction_date'),
					'deduction_description'  => $this->input->post('deduction_description'),
					'deduction_emp_name'   	=> $this->input->post('deduction_emp_name')
			);
	
			if ($this->form_validation->run() == false)
			{
				$data['inputdate']= date("d-m-Y", strtotime($deduction_update_info->deduction_Date));
				$data['deduction_id'] = $deduction_update_info->deduction_ID;
				$data['deduction_emp_no'] = $deduction_emp_no;
// 				$data['deduction_type'] = $deduction_type;
				$data['get_emp_info'] = $this->mindex_deduction->get_emp_info();
// 				$data['get_deduction_type'] = $this->mindex_deduction->get_deduction_type();
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/update_deduction',$data);
				$this->load->view('footer/footer_admin',$data);
			}
			else
			{
// 				echo var_dump($deduction_date);
				$deduction_date = date("Y-m-d", strtotime($deduction_date));
				$this->mindex_deduction->update_deduction($deduction_emp_no,$deduction_amount , str_replace("'","''",$deduction_description),$deduction_date,$deduction_id);
				redirect('deduction/updated_deduction/'.encode($deduction_id));
			}
				
		}
		else{
			$data['inputdate']= date("d-m-Y", strtotime($deduction_update_info->Deduction_Date));
			$data['deduction_id'] = $deduction_update_info->Deduction_ID;
			$data['deduction_amount'] = $deduction_update_info->Deduction_Amount;
			$data['deduction_emp_no'] = $deduction_update_info->Deduction_Emp_No;
			$data['get_emp_info'] = $this->mindex_deduction->get_emp_info();
// 			$data['get_deduction_type'] = $this->mindex_deduction->get_deduction_type();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_deduction',$data);
			$this->load->view('footer/footer_admin',$data);				
		}
	
	
	}
	function updated_deduction($deduction_id=0)
	{
		$data['menu_name'] = "deduction";
		$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
		$deduction_id = decode($deduction_id);
		$data['deduction_action'] = 'Updated';
		$data['btn_r']= 'deduction/';
		$data['btn_r_name']= 'View Employees Deduction';
		$data['btn_l']= 'deduction/update_deduction/'.encode($deduction_id);
		$data['btn_l_name'] = 'Update Employee Deduction';
		$data['deduction_info']= $this->mindex_deduction->get_deduction_update($deduction_id);
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_deduction',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function delete_deduction($deduction_id=0)
	{
		$deduction_id = decode($deduction_id);
		$info_deduction = $this->mindex_deduction->get_deduction_update($deduction_id);
		if(count($info_deduction)>0)
		{
			$data['menu_name'] = "deduction";
			$data['get_treeview'] = $this->mindex_deduction->get_treeview('treeview_deduction');
			$data['deduction_action'] = 'Delete';
			$data['btn_r']= 'deduction/deleted_deduction/'.encode($deduction_id);
			$data['btn_r_name']= 'Delete Employees Deduction';
			$data['btn_l']= 'deduction/';
			$data['btn_l_name'] = 'View Employees Deduction';
			$data['deduction_info']= $this->mindex_deduction->get_deduction_update($deduction_id);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_deduction',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{
			redirect('deduction');
		}

	}
	public function deleted_deduction($deduction_id=0)
	{
		$deduction_id = decode($deduction_id);
		$this->mindex_deduction->delete_deduction($deduction_id);
		redirect('deduction');
	}
	public function validate_date($deduction_date)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($dd, $mm,$yy) = preg_split('[-]', $deduction_date);
	
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