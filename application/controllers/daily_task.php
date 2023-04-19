<?php 

class daily_task extends Secure_Controller {

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
		$this->load->model( array('mindex_daily_task') );
		$this->load->library('form_validation');
		$this->load->helper('url','form');
	}
	public function index()
	{
		$dt_emp_no = $this->input->post('dt_emp_no');
		$dt_year = $this->input->post('dt_year');
		$dt_week = $this->input->post('dt_week');

		$data['menu_name'] = 'daily_task';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";		
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['treeview_daily_task'] ="active";
		if($dt_emp_no <> "")
		{
			$getWeekNumberCurrent = $this->mindex_daily_task->getWeekNumberCurrent($dt_week,$dt_year);
			$dt_from = $getWeekNumberCurrent->StartDate;
			$dt_to = $getWeekNumberCurrent->EndDate;
			$data['dt_emp_no'] = $dt_emp_no;
			$data['dt_from'] =$dt_from;
			$data['dt_to'] =$dt_to;
			$data['dt_year'] = $dt_year;
			$data['dt_week'] = $dt_week;
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
			$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
			$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
			$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_daily_task',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else
		{
			
			$get_first_emp_no = $this->mindex_daily_task->get_first_emp_no();
			$getCurrentWeekNo= $this->mindex_daily_task->getCurrentWeekNo();
			$dt_week = $getCurrentWeekNo->weeknum;
			$dt_year = date('Y');
			$getWeekNumberCurrent = $this->mindex_daily_task->getWeekNumberCurrent($dt_week,$dt_year);
			$dt_emp_no =  $get_first_emp_no->emp_no;
			$dt_from = $getWeekNumberCurrent->StartDate;
			$dt_to = $getWeekNumberCurrent->EndDate;
			$data['dt_emp_no'] = $get_first_emp_no->emp_no;
			$data['dt_from'] = $getWeekNumberCurrent->StartDate;
			$data['dt_to'] = $getWeekNumberCurrent->EndDate;
			$data['dt_year'] = date('Y');
			$data['dt_week'] = $dt_week;
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
			$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
			$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_daily_task',$data);
			$this->load->view('footer/footer_admin',$data);
		}

	
	}
	function add_daily_task($dt_emp_no=0)
	{
		$data['menu_name'] = "";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['treeview_daily_task'] ="active";
		$dt_emp_no = decode($dt_emp_no);
		$add = $this->input->post('btn-add');
		$dt_date =$this->input->post('dt_date');
		$dt_time_in = $this->input->post('dt_time_in');
		$dt_time_out=$this->input->post('dt_time_out');
		$dt_remarks=$this->input->post('dt_remarks');
		$dt_emp_name=$this->mindex_daily_task->get_emp_name($dt_emp_no);
		if($add)
		{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('dt_date',  			'Date',			'required|callback_validate_date');
			$this->form_validation->set_rules('dt_time_in',  		'Time In',		'required|callback_validate_time_in');
			$this->form_validation->set_rules('dt_time_out',  		'Time Out',		'required|callback_validate_time_out|callback_compare_time['.$dt_time_in.']');
			$this->form_validation->set_rules('dt_remarks',  		'Remarks',		'required');
			$data['record'] = array('dt_emp_no'=> $dt_emp_no, 'dt_date'=>$dt_date, 	'dt_time_in'=>$dt_time_in ,
					'dt_time_out'=> $dt_time_out, 'dt_remarks' => $dt_remarks, 'dt_emp_name'=> $dt_emp_name->dt_emp_name);
	
			if ($this->form_validation->run() == false)
			{
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/add_daily_task',$data);
				$this->load->view('footer/footer_admin',$data);
			
			}
			else
			{
				$dt_date= date('Y-m-d',strtotime($dt_date));
				$this->mindex_daily_task->add_daily_task($dt_emp_no,$dt_date,$dt_time_in,$dt_time_out,str_replace("'","''",$dt_remarks));
				redirect('daily_task/added_daily_task/'.encode($dt_emp_no));

			}
				
		}
		else{
				$get_first_emp_no = $this->mindex_daily_task->get_first_emp_no();
				$dt_date =date('d-m-Y');
				$dt_time_in = date('H:i');
				$dt_time_out = date('H:i',time() + 3600);
				$data['leave_emp_no'] = $get_first_emp_no->emp_no;
				$data['record'] =array('dt_emp_no'=> $dt_emp_no, 'dt_date'=>$dt_date, 'dt_time_in'=>$dt_time_in , 'dt_time_out'=> $dt_time_out,'dt_emp_name'=> $dt_emp_name->dt_emp_name);
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/add_daily_task',$data);
				$this->load->view('footer/footer_admin',$data);	
		}
	}
	function added_daily_task($dt_emp_no=0)
	{
		$data['menu_name'] = "";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="active";
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$dt_emp_no = decode($dt_emp_no);
		$dt_emp_name=$this->mindex_daily_task->get_emp_name($dt_emp_no);
		$dt_info = $this->mindex_daily_task->get_dt_info();
		$data['dt_emp_name'] = $dt_emp_name->dt_emp_name;
		$data['dt_action'] = 'Added';
		$data['btn_r']= 'daily_task/view_daily_task/'.encode($dt_info->dt_id);
		$data['btn_r_name']= 'View Daily Task';
		$data['btn_l']= 'daily_task/update_daily_task/'.encode($dt_info->dt_id);
		$data['btn_l_name'] = 'Update Daily Task';
		$data['dt_info']= $this->mindex_daily_task->get_dt_info();
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_daily_task',$data);
		$this->load->view('footer/footer_admin');
	}
	function update_daily_task($dt_id=0)
	{
		$data['menu_name'] = "";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="active";
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$dt_id= decode($dt_id);
		$dt_emp_no =$this->input->post('dt_emp_no');
		$add = $this->input->post('btn-add');
		$dt_date =$this->input->post('dt_date');
		$dt_time_in = $this->input->post('dt_time_in');
		$dt_time_out=$this->input->post('dt_time_out');
		$dt_remarks=$this->input->post('dt_remarks');
		$dt_emp_name=$this->mindex_daily_task->get_emp_name($dt_emp_no);
		if($add)
		{
			$data['record'] = array('leave_emp_no' => 'cxzcxz');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('dt_date',  			'Date',		'required|callback_validate_date');
			$this->form_validation->set_rules('dt_time_in',  		'Time In',		'required|callback_validate_time_in');
			$this->form_validation->set_rules('dt_time_out',  		'Time Out',		'required|callback_validate_time_out|callback_compare_time['.$dt_time_in.']');
			$this->form_validation->set_rules('dt_remarks',  		'Remarks',		'required');
			$data['record'] = array('dt_emp_no'=> $dt_emp_no, 'dt_date'=>$dt_date, 'dt_time_in'=>$dt_time_in ,
					'dt_time_out'=> $dt_time_out, 'dt_remarks' => $dt_remarks, 'dt_emp_name'=> $dt_emp_name->dt_emp_name);
	
			if ($this->form_validation->run() == false)
			{
				$data['dt_id'] = $dt_id;
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/update_daily_task',$data);
				$this->load->view('footer/footer_admin',$data);
					
			}
			else
			{
				$dt_date= date('Y-m-d',strtotime($dt_date));
				$this->mindex_daily_task->update_daily_task($dt_emp_no,$dt_date,$dt_time_in,$dt_time_out,str_replace("'","''",$dt_remarks),$dt_id);
				redirect('daily_task/updated_daily_task/'.encode($dt_id));
			}
	
		}
		else{
			$dt_update_info = $this->mindex_daily_task->get_dt_update_info($dt_id);
			$dt_date = date("d-m-Y", strtotime($dt_update_info->dt_date));
			$dt_time_in = $dt_update_info->dt_in;
			$dt_time_out = $dt_update_info->dt_out;
			$dt_remarks = $dt_update_info->dt_remarks;
			$dt_emp_no = $dt_update_info->dt_emp_no;
			$dt_emp_name=$this->mindex_daily_task->get_emp_name($dt_emp_no);
			$data['dt_id'] = $dt_id;
			$data['record'] =array('dt_emp_no'=> $dt_emp_no, 'dt_date'=>$dt_date, 'dt_time_in'=>$dt_time_in , 'dt_emp_name' =>$dt_emp_name->dt_emp_name,
					'dt_time_out'=> $dt_time_out,'dt_emp_name'=> $dt_emp_name->dt_emp_name,'dt_remarks'=>$dt_remarks);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_daily_task',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	}
	function updated_daily_task($dt_id=0)
	{
		$data['menu_name'] = "";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="active";
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$dt_id = decode($dt_id);
		$dt_update_info = $this->mindex_daily_task->get_dt_update_info($dt_id);
		$dt_emp_no = $dt_update_info->dt_emp_no;
		$dt_emp_name=$this->mindex_daily_task->get_emp_name($dt_emp_no);
		$data['dt_emp_name'] = $dt_emp_name->dt_emp_name;
		$data['dt_action'] = 'Updated';
		$data['btn_r']= 'daily_task/view_daily_task/'.encode($dt_id);
		$data['btn_r_name']= 'View Daily Task';
		$data['btn_l']= 'daily_task/update_daily_task/'.encode($dt_id);
		$data['btn_l_name'] = 'Update Daily Task';
		$data['dt_info']= $dt_update_info;
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_daily_task',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	function delete_daily_task($dt_id=0)
	{
		$data['menu_name'] = "";
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="active";
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$dt_id = decode($dt_id);
		$dt_update_info = $this->mindex_daily_task->get_dt_update_info($dt_id);
		$dt_emp_no = $dt_update_info->dt_emp_no;
		$dt_emp_name=$this->mindex_daily_task->get_emp_name($dt_emp_no);
		$data['dt_emp_name'] = $dt_emp_name->dt_emp_name;
		$data['dt_action'] = 'Delete';
		$data['btn_r']= 'daily_task/deleted_daily_task/'.encode($dt_id);
		$data['btn_r_name']= 'Delete Daily Task';
		$data['btn_l']= 'daily_task/view_daily_task/'.encode($dt_id);
		$data['btn_l_name'] = 'View Daily Task';
		$data['dt_info']= $dt_update_info;
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_daily_task',$data);
		$this->load->view('footer/footer_admin');
	}
	function deleted_daily_task($dt_id=0)
	{
		$dt_id = decode($dt_id);
		$this->mindex_daily_task->delete_daily_task($dt_id);
		redirect('daily_task/view_daily_task/'.encode($dt_id));
	}
	function view_daily_task($dt_id=0){
		$dt_id = decode($dt_id);
		$get_dt_update_info = $this->mindex_daily_task->get_dt_update_info($dt_id);
		$dt_emp_no = $get_dt_update_info->dt_emp_no;
		$dt_from = $get_dt_update_info->dt_date;
		$dt_to =$get_dt_update_info->dt_date;
		$dt_year = date("Y", strtotime($dt_to));
		$dt_date = $dt_from;
		$getWeekNumberview=$this->mindex_daily_task->getWeekNumberview($dt_year,$dt_date);
		$dt_from =$getWeekNumberview->StartDate;
		$dt_to =$getWeekNumberview->EndDate;
		$data['menu_name'] = 'daily_task';
		$data['treeview_main'] = "";
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_dtr'] ="";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="active";
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['dt_emp_no'] = $dt_emp_no;
		$data['dt_from'] = $dt_from;
		$data['dt_to'] = $dt_to;
		$data['dt_week'] = $getWeekNumberview->WeekNr;
		$data['dt_year'] = date("Y", strtotime($dt_to));
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
		$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
		$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_daily_task',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function dt_date_check($dt_date="")
	{
		
		$date_max = new DateTime('+10 day');
		$date_min = new DateTime('-10 day');
		$dt_date=  str_replace('-', '', $dt_date);
		if($dt_date < $date_max->format('dmY'))
		{
			$this->form_validation->set_message('dt_date', 'Invalid Date Input');
			return FALSE;
		}

		else
		{
			return TRUE;
		}
	}
	
	public function validate_time_in($dt_in)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($hh, $mm) = preg_split('[:]', $dt_in);
	
		if (!is_numeric($hh) || !is_numeric($mm))
		{
			$this->form_validation->set_message('validate_time_in', 'The Time In Field is invalid.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function validate_time_out($dt_out)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($hh, $mm) = preg_split('[:]', $dt_out);
	
		if (!is_numeric($hh) || !is_numeric($mm))
		{
			$this->form_validation->set_message('validate_time_out', 'The Time Out Field is invalid.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function validate_date($dt_date)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($dd, $mm,$yy) = preg_split('[-]', $dt_date);
	
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
	public function compare_time($dt_out,$dt_in)
	{
		//Assume $str SHOULD be entered as HH:MM
	
		list($hh, $mm) = preg_split('[:]', $dt_out);
		$dt_out = intval($hh.$mm);
		list($hh, $mm) = preg_split('[:]', $dt_in);
		$dt_in = intval($hh.$mm);
		if ($dt_in >= $dt_out ||$dt_in == $dt_out)
		{
			$this->form_validation->set_message('compare_time', 'The Time Out Field is less than/equal to Time In field.');
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