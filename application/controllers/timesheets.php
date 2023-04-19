<?php 

class timesheets extends Secure_Controller {

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
		$this->load->model( array('mindex_timesheets') );
		$this->load->library('form_validation');
		$this->load->helper('url','form');
		$this->load->library('pdf'); // Load library
		$this->pdf->fontpath = 'font/'; // Specify font folder
	}
	public function index($TS_row = 0)
	{
		
		$this->session->set_userdata('cur_row',$TS_row);
		 
		$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
		$per_page = $per_page->NumRows;
		$TS_per_page =$per_page;
		$total_row= $this->mindex_timesheets->count_timesheets();
		$this->load->library('pagination');
		$config['base_url'] = base_url('timesheets/index/');
		$config['total_rows'] = $total_row->count_timesheets;
		$TS_total =  $total_row->count_timesheets;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = 'dtr';
		$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
		$data['timesheets'] = $this->mindex_timesheets->timesheets_view($TS_per_page,$TS_row,$TS_total);
		$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['timesheets_full_name'] = "";
		$data['timesheets_emp_email'] = "";
		$data['timesheets_emp_position']= "";
		$data['timesheets_date'] = "";
		$data['timesheets_option_name']="";
		$data['timesheets_search'] = "";
		$data['timesheets_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_timesheets',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	
	public function getTimesheets($TS_row = 0)
	{
		$get_timesheets=0;
		$ts_date_process  = $this->input->post('ts_date_process');
		$ts_btn_process   = $this->input->post('btn_process');
		$ts_proc = $this->input->post('btn-process');
		$ts_date =  $this->input->post('ts_date');
		$ts_proc_btn =0 ;
		if($ts_proc)
		{
			$this->session->set_userdata('ts_date',$ts_date);
			$this->session->set_userdata('ts_proc_btn',1);
			$ts_proc_btn =$this->session->userdata('ts_proc_btn');	
			$ts_date = date('Ymd', strtotime($this->input->post('ts_date')));
			$this->mindex_timesheets->processtimesheets_view($ts_date);
			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
			$per_page = $per_page->NumRows;
			$TS_per_page =100;//$per_page; --- pagiination change for 200 employees it has no per page selection
			$total_row= $this->mindex_timesheets->count_timesheets();
			$this->load->library('pagination');
			$config['base_url'] = base_url('timesheets/getTimesheets/');
			$config['total_rows'] = $total_row->count_timesheets;
			$TS_total =  $total_row->count_timesheets;
			$config['per_page'] =100;
			$this->pagination->initialize($config);
			$ts_date_from = $this->input->post('ts_date_from');
			$ts_date_to = $this->input->post('ts_date_to'); 
			$get_timesheets =$this->mindex_timesheets->temptimesheets_view($TS_per_page,$TS_row,$TS_total);
		
			if(count($get_timesheets)==0)
			{
				$ts_proc_btn =0;
			}
			$data['ts_date'] = date("Y-m-d", strtotime($ts_date) );
			$data['links']= $this->pagination->create_links();
			$data['menu_name'] = 'dtr';
			$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
			$data['ts_date_process'] = $ts_date;
			$data['ts_proc_btn'] = $ts_proc_btn;
			$data['timesheets'] = $this->mindex_timesheets->temptimesheets_view($TS_per_page,$TS_row,$TS_total);
			$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['timesheets_full_name'] = "";
			$data['timesheets_emp_email'] = "";
			$data['timesheets_emp_position']= "";
			$data['timesheets_date'] = "";
			$data['timesheets_option_name']="";
			$data['timesheets_search'] = "";
			$data['timesheets_emp_pic'] = "~/Pictures/default.png";
			$data['nrf'] = "";
			$data['modal_show'] = "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_process_timesheets',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else if($ts_btn_process)
		{
			$this->session->set_userdata('ts_date',0);
			$this->session->set_userdata('ts_proc_btn',0);
			$ts_proc_btn =$this->session->userdata('ts_proc_btn');	
			$ts_date = date('Ymd', strtotime($ts_date_process));
			$this->mindex_timesheets->createtimesheets_view($ts_date);
			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
			$per_page = $per_page->NumRows;
			$TS_per_page =100;//$per_page; --- pagiination change for 200 employees it has no per page selection;
			$total_row= $this->mindex_timesheets->count_timesheets();
			$this->load->library('pagination');
			$config['base_url'] = base_url('timesheets/getTimesheets/');
			$config['total_rows'] = $total_row->count_timesheets;
			$TS_total =  $total_row->count_timesheets;
			$config['per_page'] =100;//$per_page;
			$this->pagination->initialize($config);
			$ts_date_from = $this->input->post('ts_date_from');
			$ts_date_to = $this->input->post('ts_date_to');
			$data['ts_date'] ="";
			$data['links']= $this->pagination->create_links();
			$data['menu_name'] = 'dtr';
			$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
			$data['ts_proc_btn'] = $ts_proc_btn;
			$data['ts_date_process'] = $ts_date;
			$data['timesheets'] = $this->mindex_timesheets->temptimesheets_view($TS_per_page,$TS_row,$TS_total);
			$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['timesheets_full_name'] = "";
			$data['timesheets_emp_email'] = "";
			$data['timesheets_emp_position']= "";
			$data['timesheets_date'] = "";
			$data['timesheets_option_name']="";
			$data['timesheets_search'] = "";
			$data['timesheets_emp_pic'] = "~/Pictures/default.png";
			$data['nrf'] = "";
			$data['modal_show'] = "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_process_timesheets',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		
		else 
		{
			$ts_proc_btn =$this->session->userdata('ts_proc_btn');
			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
			$per_page = $per_page->NumRows;
			$TS_per_page =100;//$per_page; --- pagiination change for 200 employees it has no per page selection;
			$total_row= $this->mindex_timesheets->count_timesheets();
			$this->load->library('pagination');
			$config['base_url'] = base_url('timesheets/getTimesheets/');
			$config['total_rows'] = $total_row->count_timesheets;
			$TS_total =  $total_row->count_timesheets;
			$config['per_page'] = 100;//$per_page;
			$this->pagination->initialize($config);
			if($this->session->userdata('ts_date'))
			{
				$data['ts_date'] = $this->session->userdata('ts_date');
				$data['ts_date_process'] = $this->session->userdata('ts_date');
			}
			else 
			{
				$data['ts_date'] = "";
				$data['ts_date_process']="";
			}
			
			$data['links']= $this->pagination->create_links();
			$data['menu_name'] = 'dtr';
			$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
			
			$data['ts_proc_btn'] = $ts_proc_btn;
			$data['timesheets'] = $this->mindex_timesheets->temptimesheets_view($TS_per_page,$TS_row,$TS_total);
			$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['timesheets_full_name'] = "";
			$data['timesheets_emp_email'] = "";
			$data['timesheets_emp_position']= "";
			$data['timesheets_date'] = "";
			$data['timesheets_option_name']="";
			$data['timesheets_search'] = "";
			$data['timesheets_emp_pic'] = "~/Pictures/default.png";
			$data['nrf'] = "";
			$data['modal_show'] = "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_process_timesheets',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		
	}
	public function createTimesheets($TS_row = 0)
	{
		$get_timesheets =0 ;
		$this->session->set_userdata('cur_row',$TS_row);
		$ts_proc = $this->input->post('btn_process');
		$ts_date =  $this->input->post('ts_date_process');
		$ts_proc_btn =0;
		if($ts_proc)
		{
			$ts_proc_btn =1;
			$ts_date = date('Ymd', strtotime($this->input->post('ts_date_process')));
			$this->mindex_timesheets->createtimesheets_view($ts_date);
			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
			$per_page = $per_page->NumRows;
			$TS_per_page =$per_page;
			$total_row= $this->mindex_timesheets->count_timesheets();
			$this->load->library('pagination');
			$config['base_url'] = base_url('timesheets/index/');
			$config['total_rows'] = $total_row->count_timesheets;
			$TS_total =  $total_row->count_timesheets;
			$config['per_page'] = $per_page;
			$this->pagination->initialize($config);
			$ts_date_from = $this->input->post('ts_date_from');
			$ts_date_to = $this->input->post('ts_date_to');
			$data['timesheets'] = $this->mindex_timesheets->temptimesheets_view($TS_per_page,$TS_row,$TS_total);
			$data['links']= $this->pagination->create_links();
			$data['menu_name'] = 'dtr';
			$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
			$data['ts_proc_btn'] = $ts_proc_btn;
			$data['ts_date_process'] = $ts_date;
			
			$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['timesheets_full_name'] = "";
			$data['timesheets_emp_email'] = "";
			$data['timesheets_emp_position']= "";
			$data['timesheets_date'] = "";
			$data['timesheets_option_name']="";
			$data['timesheets_search'] = "";
			$data['timesheets_emp_pic'] = "~/Pictures/default.png";
			$data['nrf'] = "";
			$data['modal_show'] = "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_process_timesheets',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else
		{
			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
			$per_page = $per_page->NumRows;
			$TS_per_page =$per_page;
			$total_row= $this->mindex_timesheets->count_timesheets();
			$this->load->library('pagination');
			$config['base_url'] = base_url('timesheets/index/');
			$config['total_rows'] = $total_row->count_timesheets;
			$TS_total =  $total_row->count_timesheets;
			$config['per_page'] = $per_page;
			$this->pagination->initialize($config);
			$ts_date_from = $this->input->post('ts_date_from');
			$ts_date_to = $this->input->post('ts_date_to');
			$data['ts_proc_btn'] = $ts_proc_btn;
			$data['ts_date_process'] = $ts_date;
			$data['links']= $this->pagination->create_links();
			$data['menu_name'] = 'dtr';
			$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
			$data['timesheets'] = $this->mindex_timesheets->temptimesheets_view($TS_per_page,$TS_row,$TS_total);
			$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['timesheets_full_name'] = "";
			$data['timesheets_emp_email'] = "";
			$data['timesheets_emp_position']= "";
			$data['timesheets_date'] = "";
			$data['timesheets_option_name']="";
			$data['timesheets_search'] = "";
			$data['timesheets_emp_pic'] = "~/Pictures/default.png";
			$data['nrf'] = "";
			$data['modal_show'] = "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_process_timesheets',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	
	}
	public function timesheets_process($TS_row = 0)
	{
	
		$this->session->set_userdata('cur_row',$TS_row);
			
		$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
		$per_page = $per_page->NumRows;
		$TS_per_page =100;
		$total_row= $this->mindex_timesheets->count_timesheets();
		$this->load->library('pagination');
		$config['base_url'] = base_url('timesheets/index/');
		$config['total_rows'] = $total_row->count_timesheets;
		$TS_total =  $total_row->count_timesheets;
		$config['per_page'] = 100;
		$this->pagination->initialize($config);
		$ts_date_from = $this->input->post('ts_date_from');
		$ts_date_to = $this->input->post('ts_date_to');
		$btn_ts_process = $this->input->post('btn-process');
		$count_timesheets = 0;
		$data['check_ts_record'] = 0;
		
		if(!$btn_ts_process)
		{
			
			$this->session->set_userdata('cur_row',$TS_row);
			
			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
			$per_page = $per_page->NumRows;
			$TS_per_page =100;
			$total_row= $this->mindex_timesheets->count_timesheets();
			$this->load->library('pagination');
			$config['base_url'] = base_url('timesheets/index/');
			$config['total_rows'] = $total_row->count_timesheets;
			$TS_total =  $total_row->count_timesheets;
			$config['per_page'] = 100;
			$this->pagination->initialize($config);
			$data['check_ts_record'] = 0;
			$data['links']= $this->pagination->create_links();
			$data['menu_name'] = 'dtr';
			$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
			$data['timesheets'] = $this->mindex_timesheets->timesheets_view($TS_per_page,$TS_row,$TS_total);
			$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['timesheets_full_name'] = "";
			$data['timesheets_emp_email'] = "";
			$data['timesheets_emp_position']= "";
			$data['timesheets_date'] = "";
			$data['timesheets_option_name']="";
			$data['timesheets_search'] = "";
			$data['timesheets_emp_pic'] = "~/Pictures/default.png";
			$data['nrf'] = "";
			$data['modal_show'] = "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_timesheets',$data);
			$this->load->view('footer/footer_admin',$data);
			
		}
		else 
		{


			$count_timesheets =  $this->mindex_timesheets->check_timesheets_process($ts_date_from,$ts_date_to);
			if(count($count_timesheets)< 1)
			{
			
				$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
				$per_page = $per_page->NumRows;
				$TS_per_page =100;
				$total_row= $this->mindex_timesheets->count_timesheets();
				$this->load->library('pagination');
				$config['base_url'] = base_url('timesheets/index/');
				$config['total_rows'] = $total_row->count_timesheets;
				$TS_total =  $total_row->count_timesheets;
				$config['per_page'] = 100;
				$this->pagination->initialize($config);
				$data['check_ts_record'] = 1;
				$data['links']= $this->pagination->create_links();
				$data['menu_name'] = 'dtr';
				$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
				$data['timesheets'] = $this->mindex_timesheets->timesheets_view($TS_per_page,$TS_row,$TS_total);
				$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
				$data['post_month'] = "";
				$data['post_year'] = "";
				$data['post_name']= "";
				$data['timesheets_full_name'] = "";
				$data['timesheets_emp_email'] = "";
				$data['timesheets_emp_position']= "";
				$data['timesheets_date'] = "";
				$data['timesheets_option_name']="";
				$data['timesheets_search'] = "";
				$data['timesheets_emp_pic'] = "~/Pictures/default.png";
				$data['nrf'] = "";
				$data['modal_show'] = "";
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/view_timesheets',$data);
				$this->load->view('footer/footer_admin',$data);
			}
			else
			{
				$get_timesheets_emp_no = $this->mindex_timesheets->get_timesheets_emp_no();
				foreach($get_timesheets_emp_no as $ts)
				{
			
					$this->mindex_timesheets->timesheets_process($ts->emp_no,$ts_date_from,$ts_date_to);
			
			
				}
			
				$data['check_ts_record'] = 0;
				$data['links']= $this->pagination->create_links();
				$data['menu_name'] = 'dtr';
				$data['get_treeview'] = $this->mindex_timesheets->get_treeview('treeview_timesheets');
				$data['timesheets'] = $this->mindex_timesheets->timesheets_view($TS_per_page,$TS_row,$TS_total);
				$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
				$data['post_month'] = "";
				$data['post_year'] = "";
				$data['post_name']= "";
				$data['timesheets_full_name'] = "";
				$data['timesheets_emp_email'] = "";
				$data['timesheets_emp_position']= "";
				$data['timesheets_date'] = "";
				$data['timesheets_option_name']="";
				$data['timesheets_search'] = "";
				$data['timesheets_emp_pic'] = "~/Pictures/default.png";
				$data['nrf'] = "";
				$data['modal_show'] = "";
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/view_timesheets',$data);
				$this->load->view('footer/footer_admin',$data);
			
			}
				
			
		}
	}
	
// 	public function timesheets_log()
// 	{
// 		$data['menu_name'] ='main_timesheets';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="active";
// 		$data['treeview_timesheets'] ="";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$TS_emp_no = $this->input->post('timesheets_emp_id');
// 		$TS_option = $this->input->post('timesheets_txt_option');
// 		$TS_option_name = $this->input->post('timesheets_txt_option_name');
// 		$date = $this->mindex_timesheets->timesheets_date();
// 		$TS_date = $date->date;
// 		$TS_emp_id	= "";
// 		$TS_emp_fname	= "";
// 		$TS_emp_lname	= "";
// 		$TS_emp_midname = "";
// 		$TS_emp_email= "";
// 		$TS_check_emp_no = $this->mindex_timesheets->show_emp_info($TS_emp_no);
// 		$TS_check_dual_remarks = $this->mindex_timesheets->check_dual_remarks($TS_emp_no,$TS_option_name);

// 		if(count($TS_check_emp_no)==0)
// 		{
// 			$data['nrf'] = "No Record Found!";
// 			$data['modal_show'] = "";
// 			$data['timesheets_update_id'] = "";
// 			$data['timesheets_emp_no'] = "";
// 			$data['timesheets_full_name'] = "";
// 			$data['timesheets_emp_email'] = "";
// 			$data['timesheets_emp_position']= "";
// 			$data['timesheets_date'] = "";
// 			$data['timesheets_option_name']="";
// 			$data['timesheets_emp_pic'] = "~/Pictures/default.png";
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$data['dailytimerecord'] = $this->mindex_timesheets->timesheets_view();
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
			
// 		}
		
// 		else 
// 		{
// 			if(count($TS_check_dual_remarks)==0)
// 			{
// 				$get_emp_info = $this->mindex_timesheets->get_emp_info($TS_emp_no);
// 				$TS_emp_no = $get_emp_info->emp_no;
// 				$TS_emp_id	= $get_emp_info->emp_user_id;
// 				$TS_full_name = $get_emp_info->emp_first_name." ".$get_emp_info->emp_last_name;
// 				$TS_emp_position = $get_emp_info->emp_position;
// 				$TS_emp_email= $get_emp_info->emp_email;
// 				$TS_emp_pic= $get_emp_info->emp_picture;
// 				$TS_save_log = $this->mindex_timesheets->save_timesheets_log($TS_emp_id, $TS_emp_no, $TS_option, $TS_option_name);
// 				//$this->mindex_timesheets->send_email($TS_emp_email,$TS_option_name, $TS_full_name);
// 				$data['nrf'] = "";
// 				$data['modal_show'] = "";
// 				$data['timesheets_emp_no']=$TS_emp_no;
// 				$data['timesheets_update_id'] = "";
// 				$data['timesheets_full_name'] = $TS_full_name;
// 				$data['timesheets_emp_email'] = $TS_emp_email;
// 				$data['timesheets_emp_position']= $TS_emp_position;
// 				$data['timesheets_emp_pic'] = $TS_emp_pic;
// 				$data['timesheets_date'] = $TS_date;
// 				$data['timesheets_option_name']=$TS_option_name;
// 				$data['user_lname']= $this->session->userdata('user_lname');
// 				$data['user_fname'] = $this->session->userdata('user_fname');
// 				$data['user_position']= $this->session->userdata('user_position');
// 				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 				$this->load->view('header/header_admin',$data);
// 				$this->load->view('admin/timesheets',$data);
// 				$this->load->view('footer/footer_admin',$data);
// 			}
// 			else 
// 			{
// 				$data['nrf'] = "";
// 				$data['modal_show'] = "$('#myModal').modal('show');";
// 				$data['timesheets_update_emp_no']=$TS_emp_no;
// 				$data['timesheets_update_id'] =  $TS_check_dual_remarks->timesheets_id;
// 				$data['timesheets_full_name'] = "";
// 				$data['timesheets_emp_email'] = "";
// 				$data['timesheets_emp_position']= "";
// 				$data['timesheets_date'] = "";
// 				$data['timesheets_option_name']="";
// 				$data['timesheets_emp_pic'] = "~/Pictures/default.png";
// 				$data['chk_timesheets_date'] = $TS_date;
// 				$data['chk_timesheets_emp_id'] = $TS_emp_id;
// 				$data['chk_timesheets_option_name']=$TS_option_name;
// 				$data['user_lname']= $this->session->userdata('user_lname');
// 				$data['user_fname'] = $this->session->userdata('user_fname');
// 				$data['user_position']= $this->session->userdata('user_position');
// 				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 				$this->load->view('header/header_admin',$data);
// 				$this->load->view('admin/timesheets',$data);
// 				$this->load->view('footer/footer_admin',$data);
// 			}
// 		}
		
// 	}
// 	function update_timesheets_log()
// 	{
// 		$data['menu_name'] ='main_timesheets';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_timesheets'] ="";
// 		$data['treeview_main'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$date = $this->mindex_timesheets->timesheets_date();
// 		$TS_date = $date->date;
// 		$TS_option_name =  $this->input->post('timesheets_option_name');
// 		$TS_update_emp_no= $this->input->post('timesheets_update_emp_no');	
// 		$get_emp_info = $this->mindex_timesheets->get_emp_info($TS_update_emp_no);
// 		$TS_emp_no = $get_emp_info->emp_no;
// 		$TS_emp_id	= $get_emp_info->emp_user_id;
// 		$TS_full_name = $get_emp_info->emp_first_name." ".$get_emp_info->emp_last_name;
// 		$TS_emp_position = $get_emp_info->emp_position;
// 		$TS_emp_email= $get_emp_info->emp_email;
// 		$TS_emp_pic= $get_emp_info->emp_picture;
// 		if($TS_option_name)
// 		{
// 			$TS_update_id = $this->input->post('timesheets_update_id');
// 			$this->mindex_timesheets->timesheets_update($TS_update_id);
// 			$data['nrf'] = "";
// 			$data['modal_show'] = "";
// 			$data['timesheets_emp_no']=$TS_emp_no;
// 			$data['timesheets_update_id'] = "";
// 			$data['timesheets_full_name'] = $TS_full_name;
// 			$data['timesheets_emp_email'] = $TS_emp_email;
// 			$data['timesheets_emp_position']= $TS_emp_position;
// 			$data['timesheets_emp_pic'] = $TS_emp_pic;
// 			$data['timesheets_date'] = $TS_date;
// 			$data['timesheets_option_name']=$TS_option_name;
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else
// 		{
// 			redirect('timesheets');
// 		}
// 	}
	
// 	public function summary()
// 	{
// 		$sel_name = $this->input->post('sel_name');
// 		$sel_month = $this->input->post('sel_month');
// 		$sel_year = $this->input->post('sel_year');
// 		$cutoffdate=0;
// 		$get_emp_top_row = "";
// 		$check_current_post_leave = "";
// 		$check_last_post_leave ="";
// 		$data['menu_name'] = 'timesheets_summary';
// 		$data['treeview_main'] ="active";
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_timesheets'] ="";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		if($sel_month)
// 		{
// 			$check_current_post_leave = $this->mindex_timesheets->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 			$check_last_post_leave = $this->mindex_timesheets->check_last_post_leave($sel_name,$sel_month,$sel_year);
// 			$data['check_post'] = count($check_current_post_leave);
// 			$data['check_last_post'] = count($check_last_post_leave);
// 			$data['timesheets_emp_rec'] = $this->mindex_timesheets->timesheets_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['timesheets_emp_header'] = $this->mindex_timesheets->timesheets_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['timesheets_get_emp_info'] = $this->mindex_timesheets->timesheets_get_emp_info();
// 			$data['timesheets_emp_getleave'] = $this->mindex_timesheets->timesheets_emp_getleave();
// 			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
// 							'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year,'dt_deduct'=>'');
// 			$data['sel_name'] = $sel_name;
// 			$data['sel_year'] = $sel_year;
// 			$data['sel_month'] = $sel_month;
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/timesheets_summary',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else
// 		{
// 			$get_emp_top_row= $this->mindex_timesheets->timesheets_get_emp_info_first_row();
// 			$sel_name = $get_emp_top_row->emp_first_name . ' '.$get_emp_top_row->emp_last_name;
// 			$sel_month = date('m');
// 			$sel_year = date('Y');
// 			$check_current_post_leave= $this->mindex_timesheets->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 			$check_last_post_leave = $this->mindex_timesheets->check_last_post_leave($sel_name,$sel_month,$sel_year);
// 			$data['check_post'] = count($check_current_post_leave);
// 			$data['check_last_post'] = count($check_last_post_leave);
// 			$data['timesheets_get_emp_info'] = $this->mindex_timesheets->timesheets_get_emp_info();
// 			$data['timesheets_emp_header'] = $this->mindex_timesheets->timesheets_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['timesheets_emp_rec'] = $this->mindex_timesheets->timesheets_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['timesheets_emp_getleave'] = $this->mindex_timesheets->timesheets_emp_getleave();
// 			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
// 							'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year,'dt_deduct'=>'');
// 			$data['sel_name'] = $sel_name;
// 			$data['sel_year'] = date('Y');
// 			$data['sel_month'] = date('m');
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/timesheets_summary',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 	}
// 	public function summary_leave_deducted()
// 	{
// 		$deduct_month = $this->input->post('deduct_month');
// 		$deduct_year = $this->input->post('deduct_year');
// 		$deduct_name = $this->input->post('deduct_name');
// 		$deduct_leave = $this->input->post('deduct_leave');
// 		$cutoffdate=0;
// 		$check_current_post_leave = "";
// 		$check_last_post_leave ="";
// 		$data['menu_name'] = 'timesheets_summary';
// 		$data['treeview_main'] ="";
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$this->mindex_timesheets->deduct_leave($deduct_name, $deduct_year, $deduct_leave);
// 		$sel_name = $deduct_name;
// 		$sel_month = $deduct_month;
// 		$sel_year = $deduct_year;
// 		$check_current_post_leave= $this->mindex_timesheets->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 		$check_last_post_leave = $this->mindex_timesheets->check_last_post_leave($sel_name,$sel_month,$sel_year);
// 		$data['check_post'] = count($check_current_post_leave);
// 		$data['check_last_post'] = count($check_last_post_leave);
// 		$data['timesheets_get_emp_info'] = $this->mindex_timesheets->timesheets_get_emp_info();
// 		$data['timesheets_emp_header'] = $this->mindex_timesheets->timesheets_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 		$data['timesheets_emp_rec'] = $this->mindex_timesheets->timesheets_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 		$data['timesheets_emp_getleave'] = $this->mindex_timesheets->timesheets_emp_getleave();
// 		$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
// 				'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year,'dt_deduct'=>'');
// 		$data['sel_name'] = $sel_name;
// 		$data['sel_year'] = $sel_year;
// 		$data['sel_month'] = $sel_month;
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/timesheets_summary',$data);
// 		$this->load->view('footer/footer_admin',$data);

// 	}
	
// 	public function view_timesheets($TS_row = 0)
// 	{
		 
// 		$this->session->set_userdata('cur_row',$TS_row);
		 
// 		$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
// 		$per_page = $per_page->NumRows;
// 		$TS_per_page =$per_page;
// 		$total_row= $this->mindex_timesheets->count_timesheets();
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('timesheets/view_timesheets/');
// 		$config['total_rows'] = $total_row->count_timesheets;
// 		$TS_total =  $total_row->count_timesheets;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
		
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_timesheets->timesheets_view($TS_per_page,$TS_row,$TS_total);
// 		$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['timesheets_full_name'] = "";
// 		$data['timesheets_emp_email'] = "";
// 		$data['timesheets_emp_position']= "";
// 		$data['timesheets_date'] = "";
// 		$data['timesheets_option_name']="";
// 		$data['timesheets_search'] = "";
// 		$data['timesheets_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_timesheets',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function view_timesheets_scan()
// 	{
			
// 		$TS_row= $this->session->userdata('cur_row');
			
// 		$per_page = $this->input->post('timesheets_per_page');
// 		if ($per_page == "")
// 		{
// 			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
// 			$per_page = $per_page->NumRows;
// 		}
// 		$TS_per_page =$per_page;
// 		$this->mindex_timesheets->update_timesheets_num_rows($TS_per_page);
// 		$total_row= $this->mindex_timesheets->count_timesheets();
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('timesheets/view_timesheets/');
// 		$config['total_rows'] = $total_row->count_timesheets;
// 		$TS_total =  $total_row->count_timesheets;
// 		$config['cur_page'] = $TS_row;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
	
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_timesheets->timesheets_view($TS_per_page,$TS_row,$TS_total);
// 		$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['timesheets_full_name'] = "";
// 		$data['timesheets_emp_email'] = "";
// 		$data['timesheets_emp_position']= "";
// 		$data['timesheets_date'] = "";
// 		$data['timesheets_option_name']="";
// 		$data['timesheets_search'] = "";
// 		$data['timesheets_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_timesheets',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function view_timesheets_search($TS_row = 0)
// 	{
// 		$TS_search=$this->session->userdata('timesheets_search');
// 		$this->session->set_userdata('cur_row',$TS_row);
// 		$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
// 		$per_page = $per_page->NumRows;
// 		$TS_per_page =$per_page;
// 		$this->mindex_timesheets->update_timesheets_num_rows($TS_per_page);
// 		$total_row= $this->mindex_timesheets->count_timesheets_search($TS_search);
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('timesheets/view_timesheets_search/');
// 		$config['total_rows'] = $total_row->count_timesheets;
// 		$TS_total =  $total_row->count_timesheets;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
	
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_timesheets->timesheets_view_search($TS_per_page,$TS_search,$TS_row,$TS_total);
// 		$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['timesheets_full_name'] = "";
// 		$data['timesheets_emp_email'] = "";
// 		$data['timesheets_emp_position']= "";
// 		$data['timesheets_date'] = "";
// 		$data['timesheets_option_name']="";
// 		$data['timesheets_search'] = $TS_search;
// 		$data['timesheets_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_timesheets_search',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function view_timesheets_searched()
// 	{
// 		$TS_row= $this->session->userdata('cur_row');
// 		$TS_search=$this->input->post('hid_timesheets_search');
// 		if($TS_search)
// 		{
// 			$this->session->set_userdata('timesheets_search',$TS_search);
// 		}
// 		else 
// 		{
// 			$TS_search= $this->session->userdata('timesheets_search');
// 		}
		
// 		$per_page = $this->input->post('timesheets_per_page_search');
// 		if ($per_page == "")
// 		{
// 			$per_page = $this->mindex_timesheets->active_timesheets_num_rows();
// 			$per_page = $per_page->NumRows;
// 			$TS_row= 0;
// 		}
		
// 		$TS_per_page =$per_page;
// 		$this->mindex_timesheets->update_timesheets_num_rows($TS_per_page);
// 		$total_row= $this->mindex_timesheets->count_timesheets_search($TS_search);
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('timesheets/view_timesheets_search/');
// 		$config['total_rows'] = $total_row->count_timesheets;
// 		$TS_total =  $total_row->count_timesheets;
// 		$config['cur_page'] = $TS_row;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
	
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_timesheets->timesheets_view_search($TS_per_page,$TS_search,$TS_row,$TS_total);
// 		$data['timesheets_num_rows'] = $this->mindex_timesheets->timesheets_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['timesheets_full_name'] = "";
// 		$data['timesheets_emp_email'] = "";
// 		$data['timesheets_emp_position']= "";
// 		$data['timesheets_date'] = "";
// 		$data['timesheets_option_name']="";
// 		$data['timesheets_search'] = $TS_search;
// 		$data['timesheets_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_timesheets_search',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function add_timesheets()
// 	{
// 		$data['menu_name'] = 'timesheets_action';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$btn =  $this->input->post('btn-add');
// 		$TS_emp_no = $this->input->post('timesheets_emp_no');
// 		$TS_option = $this->input->post('timesheets_option');
// 		$TS_date = $this->input->post('timesheets_date');
// 		$get_emp_info = $this->mindex_timesheets->get_employees();
// 		$dailytimerecord = $this->mindex_timesheets->timesheets_view();
// 		$TS_emp_id = $this->mindex_timesheets->timesheets_get_emp_id($TS_emp_no);
// 		$TS_option_name = "";
// 		$TS_time=0;
// 		if($btn)
// 		{
// 			if($TS_option == 1)
// 			{
// 				$TS_option_name ="Log - IN";
// 			}
// 			elseif ($TS_option == 2)
// 			{
// 				$TS_option_name ="Log - OUT";
// 			}
// 			elseif ($TS_option == 3)
// 			{
// 				$TS_option_name ="Lunch Break - OUT";
// 			}
// 			elseif ($TS_option == 4)
// 			{
// 				$TS_option_name ="Lunch Break - IN";
// 			}
// 			else 
// 			{
// 				$TS_option_name = '';
// 			}
// 			$TS_time = substr($TS_date, 10,12);
// 			$TS_date = date("Y-m-d", strtotime($TS_date)).$TS_time;
// 			$TS_emp_id=$TS_emp_id->emp_user_id;
// 			$this->mindex_timesheets->timesheets_add($TS_emp_id,$TS_emp_no,$TS_date,$TS_option,$TS_option_name);
// 			redirect('timesheets/added_timesheets');
// 		}	
// 		else	
// 		{	
// 			$data['get_emp_info'] = $get_emp_info;
// 			$data['dailytimerecord'] = $dailytimerecord;
// 			$data['timesheets_emp_no'] = 03;
// 			$data['timesheets_option'] = 1;
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/add_timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
	
// 		}
// 	}
// 	public function added_timesheets()
// 	{
// 		$data['menu_name'] = '';
// 		$TS_info =  $this->mindex_timesheets->timesheets_added_info();
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['timesheets_info']= $TS_info;
// 		$data['timesheets_action'] = 'Added';
// 		$data['btn_r']= 'timesheets/view_timesheets';
// 		$data['btn_r_name']= 'View timesheets';
// 		$data['btn_l']= 'timesheets/update_timesheets/'.encode($TS_info->ts_id);
// 		$data['btn_l_name'] = 'Update timesheets';
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/info_timesheets',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function update_timesheets($TS_id=0)
// 	{
// 		$data['menu_name'] = 'timesheets_action';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$TS_id=decode($TS_id);
// 		$btn =  $this->input->post('btn-add');
// 		$TS_emp_no = $this->input->post('timesheets_emp_no');
// 		$TS_option = $this->input->post('timesheets_option');
// 		$TS_date = $this->input->post('timesheets_date');
// 		$get_emp_info = $this->mindex_timesheets->get_emp_info();
// 		$dailytimerecord = $this->mindex_timesheets->timesheets_view();
// 		$TS_emp_id = $this->mindex_timesheets->timesheets_get_emp_id($TS_emp_no);
// 		$TS_option_name = "";
// 		$TS_time=0;
// 		$data['menu_name'] = 'timesheets_action';
// 		$TS_update_info = $this->mindex_timesheets->timesheets_update_info($TS_id);
// 		if($btn)
// 		{
// 			if($TS_option == 1)
// 			{
// 				$TS_option_name ="Log - IN";
// 			}
// 			elseif ($TS_option == 2)
// 			{
// 				$TS_option_name ="Log - OUT";
// 			}
// 			elseif ($TS_option == 3)
// 			{
// 				$TS_option_name ="Lunch Break - OUT";
// 			}
// 			elseif ($TS_option == 4)
// 			{
// 				$TS_option_name ="Lunch Break - IN";
// 			}
// 			else
// 			{
// 				$TS_option_name = '';
// 			}
			
// 			$TS_time = substr($TS_date, 10,12);
// 			$TS_date = date("Y-m-d", strtotime($TS_date)).$TS_time;
// 			$this->mindex_timesheets->update_timesheets($TS_date,$TS_option,$TS_option_name,$TS_id);
// 			redirect('timesheets/updated_timesheets/'.encode($TS_id));
// 		}
// 		else
// 		{
// 			$TS_date = substr($TS_update_info->ts_time,0,19);
// 			$TS_date = date("d-m-Y H:m:s", strtotime($TS_date));
// 			$data['record'] = array('timesheets_full_name' => $TS_update_info->ts_first_name .' ' .$TS_update_info->ts_last_name,
// 									'timesheets_date'	=> $TS_date );
// 			$data['timesheets_id'] = $TS_update_info->ts_id;
// 			$data['dailytimerecord'] = $dailytimerecord;
// 			$data['timesheets_emp_no'] = 03;
// 			$data['timesheets_option'] = $TS_update_info->ts_option;
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/update_timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
	
// 		}
// 	}
// 	public function updated_timesheets($TS_id =0)
// 	{
// 		$TS_id=decode($TS_id);
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['timesheets_info']= $this->mindex_timesheets->timesheets_updated_info($TS_id);
// 		$data['timesheets_action'] = 'Updated';
// 		$data['btn_r']= 'timesheets/view_timesheets';
// 		$data['btn_r_name']= 'View timesheets';
// 		$data['btn_l']= 'timesheets/update_timesheets/'.encode($TS_id);
// 		$data['btn_l_name'] = 'Update timesheets';
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/info_timesheets',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function delete_timesheets($TS_id =0)
// 	{
// 		$TS_id=decode($TS_id);
// 		$info_timesheets = $this->mindex_timesheets->timesheets_updated_info($TS_id);
// 		if(count($info_timesheets)>0)
// 		{
// 			$data['menu_name'] = '';
// 			$data['treeview_employee'] ="";
// 			$data['treeview_main'] ="";
// 			$data['treeview_leave'] ="";
// 			$data['treeview_timesheets'] ="active";
// 			$data['treeview_holiday'] ="";
// 			$data['treeview_daily_task'] ="";
// 			$data['timesheets_info']= $this->mindex_timesheets->timesheets_updated_info($TS_id);
// 			$data['timesheets_action'] = 'Delete';
// 			$data['btn_l']= 'timesheets/view_timesheets';
// 			$data['btn_l_name']= 'View timesheets';
// 			$data['btn_r']= 'timesheets/deleted_timesheets/'.encode($TS_id);
// 			$data['btn_r_name'] = 'Delete timesheets';
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/info_timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else 
// 		{
// 			redirect('timesheets/view_timesheets');
// 		}
		
// 	}
// 	public function deleted_timesheets($TS_id =0)
// 	{
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$TS_id = decode($TS_id);
// 		$data['timesheets_info']= $this->mindex_timesheets->timesheets_delete($TS_id);
// 		redirect('timesheets/view_timesheets');
// 	}
// 	public function timesheets_print_summary()
// 	{
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_timesheets'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$TS_print = $this->input->post('prn-timesheets');
// 		$TS_emp_name = $this->input->post('users');
// 		$TS_month = $this->input->post('sel_month');
// 		$TS_year = $this->input->post('sel_year');
// 		$cutoffdate = 0;
// 		$TS_full_name = "";
// 		$name="";
// 		$count_user = count($TS_emp_name);
// 		$data['menu_name'] = 'timesheets_print_summary';
// 		if($TS_month)
// 		{
// 			$this->mindex_timesheets_pdf->print_all_summary($TS_emp_name, $name,$cutoffdate,$TS_month,$TS_year,$count_user);

// 		}
// 		else 
// 		{
// 		$data['sel_month'] = date('m');
// 		$data['sel_year'] = date('Y');
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$data['timesheets_employee'] = $this->mindex_timesheets->timesheets_get_emp_info();
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_print_summary',$data);
// 		$this->load->view('footer/footer_admin',$data);
	
// 		}

// 	}
	
// 	public function view_post_timesheets()
// 	{

// 		$sel_name = decode($this->input->get('post_sel_name')) ;
// 		$sel_month = decode($this->input->get('post_sel_month'));
// 		$sel_year = decode($this->input->get('post_sel_year')) ;
// 		$post_name = $sel_name;
// 		$post_month = $sel_month;
// 		$post_year = $sel_year;
// 		$cutoffdate=0;
// 		$data['menu_name'] = ''; 
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="active";
// 		$data['treeview_timesheets'] ="";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['post_name'] = $sel_name;
// 		$data['post_month'] = $sel_month;
// 		$data['post_year'] = $sel_year;
// 		$check_current_post_leave = $this->mindex_timesheets->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 		if (count($check_current_post_leave ) < 1)
// 		{
// 			$data['sel_name'] = $sel_name;
// 			$data['sel_year'] = $sel_year;
// 			$data['sel_month'] = $sel_month;
// 			$data['timesheets_get_emp_info'] = $this->mindex_timesheets->timesheets_get_emp_info();
// 			$data['timesheets_emp_header'] = $this->mindex_timesheets->timesheets_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['timesheets_emp_rec'] = $this->mindex_timesheets->timesheets_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['timesheets_emp_getleave'] = $this->mindex_timesheets->timesheets_emp_getleave();
// 			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
// 							'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/timesheets_summary',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else 
// 		{

// 			$data['post_disable'] = 0;
// 			$data['record'] = array('post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
// 			$data['post_GetEmpLeaveAvailable']= $this->mindex_timesheets->post_GetEmpLeaveAvailable($post_name,$post_month,$post_year);
// 			$data['post_GetCurrentLeaveAvailable']= $this->mindex_timesheets->timesheets_emp_getleave();
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/view_post_timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 	}
// 	public function view_posted_timesheets()
// 	{
// 			$post_name =  $this->input->post('post_sel_name');
// 			$post_month =  $this->input->post('post_sel_month');
// 			$post_year =  $this->input->post('post_sel_year');
// 			$sel_name = $post_name;
// 			$sel_month = $post_month;
// 			$sel_year = $post_year;
// 			$cutoffdate=0;
// 			$data['menu_name']= '';
// 			$data['treeview_employee'] ="";
// 			$data['treeview_leave'] ="";
// 			$data['treeview_main'] ="active";
// 			$data['treeview_timesheets'] ="";
// 			$data['treeview_holiday'] ="";
// 			$data['treeview_daily_task'] ="";
// 			$data['post_disable'] = 1;
// 			$data['post_name'] = $post_name;
// 			$data['post_month'] = $post_month;
// 			$data['post_year'] = $post_year;
// 			$data['sel_name'] = $post_name;
// 			$data['sel_year'] = $post_year;
// 			$data['sel_month'] = $post_month;
// 			$this->mindex_timesheets->post_InsertCurrentLeaveAvailable();
// 			$data['record'] = array('post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
// 			$data['post_GetEmpLeaveAvailable']= $this->mindex_timesheets->post_GetEmpLeaveAvailable($post_name,$post_month,$post_year);
// 			$data['post_GetCurrentLeaveAvailable']= $this->mindex_timesheets->timesheets_emp_getleave();
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/view_post_timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */