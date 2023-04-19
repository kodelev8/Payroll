<?php 
include_once(APPPATH."third_party/PhpWord/Autoloader.php");
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

Autoloader::register();
Settings::loadConfig();

class Dtrms extends CI_controller {

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
		$this->load->model( array('mindex_dtr','mindex_daily_task','mindex_payslips') );
		$this->load->library('form_validation');
		$this->load->library('pdf'); // Load library
		$this->pdf->fontpath = 'font/'; // Specify font folder	
	}
	public function main_index()
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'index';
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_main',$data);
		$this->load->view('main/index');
		$this->load->view('footer/footer_main');
	}
	
	public function index()
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'index';
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_main',$data);
		$this->load->view('main/main');
		$this->load->view('footer/footer_main');
	}
	public function dtr_manual()
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'dtr_manual';
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_main',$data);
		$this->load->view('main/main_dtr_manual');
		$this->load->view('footer/footer_main');
	}
	public function dtr_log()
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'index';
		$dtr_emp_no = $this->input->post('dtr_emp_id');
		$dtr_option = $this->input->post('dtr_txt_option');
		$dtr_option_name = $this->input->post('dtr_txt_option_name');
		$date = $this->mindex_dtr->dtr_date();
		$dtr_date = $date->date;
		$dtr_emp_id	= "";
		$dtr_emp_fname	= "";
		$dtr_emp_lname	= "";
		$dtr_emp_midname = "";
		$dtr_emp_email= "";
		$dtr_full_name="";
		$dtr_emp_position="";
		$dtr_emp_pic="";
		$dtr_check_emp_no = $this->mindex_dtr->show_emp_info($dtr_emp_no);
		$dtr_check_dual_remarks = $this->mindex_dtr->check_dual_remarks($dtr_emp_no,$dtr_option_name);
		$dtr_check_option_login =  $this->mindex_dtr->check_option_login($dtr_emp_no);
		if(count($dtr_check_emp_no)==0)
		{
			$data['nrf'] = "No Record Found!";
			$data['modal_show'] = "";
			$data['dtr_update_id'] = "";
			$data['dtr_emp_no'] = "";
			$data['dtr_full_name'] = "";
			$data['dtr_emp_email'] = "";
			$data['dtr_emp_position']= "";
			$data['dtr_date'] = "";
			$data['dtr_option_name']="";
			$data['dtr_emp_pic'] = "~/Pictures/default.png";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$data['dailytimerecord'] = $this->mindex_dtr->dtr_view();
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main');
			$this->load->view('footer/footer_main');
		}
		
		else 
		{
			if(count($dtr_check_dual_remarks)==0)
			{
				
				$get_emp_info = $this->mindex_dtr->get_emp_info($dtr_emp_no);
						
				$dtr_emp_no = $get_emp_info->emp_no;
				$dtr_emp_id	= $get_emp_info->emp_user_id;
				$dtr_full_name = $get_emp_info->emp_first_name." ".$get_emp_info->emp_last_name;
				$dtr_emp_position = $get_emp_info->emp_position;
				$dtr_emp_email= $get_emp_info->emp_email;
				$dtr_emp_pic= $get_emp_info->emp_picture;
				$dtr_save_log = $this->mindex_dtr->save_dtr_log($dtr_emp_id, $dtr_emp_no, $dtr_option, $dtr_option_name);
				$this->mindex_dtr->send_email_dtr($dtr_emp_email,$dtr_option_name, $dtr_full_name);
				$data['nrf'] = "";
				$data['modal_show'] = "";
				$data['dtr_emp_no']=$dtr_emp_no;
				$data['dtr_update_id'] = "";
				$data['dtr_full_name'] = $dtr_full_name;
				$data['dtr_emp_email'] = $dtr_emp_email;
				$data['dtr_emp_position']= $dtr_emp_position;
				$data['dtr_emp_pic'] = $dtr_emp_pic;
				$data['dtr_date'] = $dtr_date;
				$data['dtr_option_name']=$dtr_option_name;
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_main');
				$this->load->view('main/main',$data);
					$this->load->view('footer/footer_main');
				
			}
			else 
			{
				$data['nrf'] = "";
				$data['modal_show'] = "$('#myModal').modal('show');";
				$data['dtr_update_emp_no']=$dtr_emp_no;
				$data['dtr_update_id'] =  $dtr_check_dual_remarks->dtr_id;
				$data['dtr_full_name'] = "";
				$data['dtr_emp_email'] = "";
				$data['dtr_emp_position']= "";
				$data['dtr_date'] = "";
				$data['dtr_option_name']="";
				$data['dtr_emp_pic'] = "~/Pictures/default.png";
				$data['chk_dtr_date'] = $dtr_date;
				$data['chk_dtr_emp_id'] = $dtr_emp_id;
				$data['chk_dtr_option_name']=$dtr_option_name;
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_main',$data);
				$this->load->view('main/main');
				$this->load->view('footer/footer_main');
			}
		}
	}
	function update_dtr_log()
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'dtr_manual';
		$date = $this->mindex_dtr->dtr_date();
		$dtr_date = $date->date;
		$dtr_option_name =  $this->input->post('dtr_option_name');
		$dtr_update_emp_no= $this->input->post('dtr_update_emp_no');	
		$get_emp_info = $this->mindex_dtr->get_emp_info($dtr_update_emp_no);
		$dtr_emp_no = $get_emp_info->emp_no;
		$dtr_emp_id	= $get_emp_info->emp_user_id;
		$dtr_full_name = $get_emp_info->emp_first_name." ".$get_emp_info->emp_last_name;
		$dtr_emp_position = $get_emp_info->emp_position;
		$dtr_emp_email= $get_emp_info->emp_email;
		$dtr_emp_pic= $get_emp_info->emp_picture;
		if($dtr_option_name)
		{
			$dtr_update_id = $this->input->post('dtr_update_id');
			$this->mindex_dtr->dtr_update($dtr_update_id);
			$this->mindex_dtr->send_email_dtr($dtr_emp_email,$dtr_option_name, $dtr_full_name);
			$data['nrf'] = "";
			$data['modal_show'] = "";
			$data['dtr_emp_no']=$dtr_emp_no;
			$data['dtr_update_id'] = "";
			$data['dtr_full_name'] = $dtr_full_name;
			$data['dtr_emp_email'] = $dtr_emp_email;
			$data['dtr_emp_position']= $dtr_emp_position;
			$data['dtr_emp_pic'] = $dtr_emp_pic;
			$data['dtr_date'] = $dtr_date;
			$data['dtr_option_name']=$dtr_option_name;
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main');
			$this->load->view('footer/footer_main');
		}
		else
		{
			redirect('dtrms');
		}
	}

	public function dtr_log_manual()
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'dtr_manual';
		$dtr_emp_no = $this->input->post('dtr_emp_id_manual');
		$dtr_option = $this->input->post('dtr_txt_option');
		$dtr_option_name = $this->input->post('dtr_txt_option_name');
		$dtr_date = $this->input->post('dtr_time_manual');
		$dtr_emp_id	= "";
		$dtr_emp_fname	= "";
		$dtr_emp_lname	= "";
		$dtr_emp_midname = "";
		$dtr_emp_email= "";
		$dtr_full_name="";
		$dtr_emp_position="";
		$dtr_emp_pic="";
		$dtr_check_emp_no = $this->mindex_dtr->show_emp_info($dtr_emp_no);
		
		$dtr_check_dual_remarks = $this->mindex_dtr->check_dual_remarks_manual($dtr_emp_no,$dtr_option_name,substr($dtr_date,0, 10));
		$dtr_check_option_login =  $this->mindex_dtr->check_option_login($dtr_emp_no);
		if(count($dtr_check_emp_no)==0)
		{
			$data['nrf'] = "No Record Found!";
			$data['modal_show'] = "";
			$data['dtr_update_id'] = "";
			$data['dtr_emp_no'] = "";
			$data['dtr_full_name'] = "";
			$data['dtr_emp_email'] = "";
			$data['dtr_emp_position']= "";
			$data['dtr_date'] = "";
			$data['dtr_option_name']="";
			$data['dtr_emp_pic'] = "~/Pictures/default.png";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$data['dailytimerecord'] = $this->mindex_dtr->dtr_view();
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main_dtr_manual');
			$this->load->view('footer/footer_main');
		}
	
		else
		{
			if(count($dtr_check_dual_remarks)==0)
			{
	
				$get_emp_info = $this->mindex_dtr->get_emp_info($dtr_emp_no);
	
				$dtr_emp_no = $get_emp_info->emp_no;
				$dtr_emp_id	= $get_emp_info->emp_user_id;
				$dtr_full_name = $get_emp_info->emp_first_name." ".$get_emp_info->emp_last_name;
				$dtr_emp_position = $get_emp_info->emp_position;
				$dtr_emp_email= $get_emp_info->emp_email;
				$dtr_emp_pic= $get_emp_info->emp_picture;
				$dtr_save_log = $this->mindex_dtr->save_dtr_log_manual($dtr_emp_id, $dtr_emp_no, $dtr_option, $dtr_option_name,$dtr_date);
				$this->mindex_dtr->send_email_dtr($dtr_emp_email,$dtr_option_name, $dtr_full_name);
				$data['nrf'] = "";
				$data['modal_show'] = "";
				$data['dtr_emp_no']=$dtr_emp_no;
				$data['dtr_update_id'] = "";
				$data['dtr_full_name'] = $dtr_full_name;
				$data['dtr_emp_email'] = $dtr_emp_email;
				$data['dtr_emp_position']= $dtr_emp_position;
				$data['dtr_emp_pic'] = $dtr_emp_pic;
				$data['dtr_date'] = $dtr_date;
				$data['dtr_option_name']=$dtr_option_name;
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_main');
				$this->load->view('main/main_dtr_manual',$data);
				$this->load->view('footer/footer_main');
	
			}
			else
			{
				$data['nrf'] = "";
				$data['modal_show'] = "$('#myModal').modal('show');";
				$data['dtr_update_emp_no']=$dtr_emp_no;
				$data['dtr_update_id'] =  $dtr_check_dual_remarks->dtr_id;
				$data['dtr_full_name'] = "";
				$data['dtr_emp_email'] = "";
				$data['dtr_emp_position']= "";
				$data['dtr_date'] = "";
				$data['dtr_option_name']="";
				$data['dtr_emp_pic'] = "~/Pictures/default.png";
				$data['chk_dtr_date'] = $dtr_date;
				$data['chk_dtr_emp_id'] = $dtr_emp_id;
				$data['chk_dtr_option_name']=$dtr_option_name;
				$data['user_lname']= $this->session->userdata('user_lname');
				$data['user_fname'] = $this->session->userdata('user_fname');
				$data['user_position']= $this->session->userdata('user_position');
				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
				$this->load->view('header/header_main',$data);
				$this->load->view('main/main_dtr_manual');
				$this->load->view('footer/footer_main');
			}
		}
	}
	
	
	public function index_summary()
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'summary';
		$sel_name = $this->input->post('sel_name');
		$sel_month = $this->input->post('sel_month');
		$sel_year = $this->input->post('sel_year');
		$cutoffdate=0;
		$get_emp_top_row = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		if($sel_month)
		{	
			$dt_emp_no = $this->mindex_dtr->get_emp_no($sel_name);
			$data['dt_emp_no'] = $dt_emp_no->emp_no;
			$this->session->set_userdata('dt_emp_no',$dt_emp_no->emp_no);
			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
			$data['dtr_emp_info'] = $this->mindex_dtr->dtr_emp_info($dt_emp_no->emp_no);
			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
									'dt_sel_name' => $sel_name,  'dt_sel_month' => $sel_month, 'dt_sel_year' => $sel_year);
			$data['sel_name'] = $sel_name;
			$data['sel_year'] = $sel_year;
			$data['sel_month'] = $sel_month;
			
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main_summary');
			$this->load->view('footer/footer_main');
		}
		else 
		{
			$get_emp_top_row= $this->mindex_dtr->dtr_get_emp_info_first_row();
			$sel_name = $get_emp_top_row->emp_first_name . ' '.$get_emp_top_row->emp_last_name;
			$sel_month = date('m');
			$sel_year = date('Y');
			$dt_emp_no = $this->mindex_dtr->get_emp_no($sel_name);
			$this->session->set_userdata('dt_emp_no',$dt_emp_no->emp_no);
			$data['dt_emp_no'] = $dt_emp_no->emp_no;
			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
									'dt_sel_name' => $sel_name,  'dt_sel_month' => $sel_month, 'dt_sel_year' => $sel_year);
			$data['sel_name'] = $sel_name;
			$data['sel_year'] = date('Y');
			$data['sel_month'] = date('m');
			$data['dtr_emp_info'] = $this->mindex_dtr->dtr_emp_info($dt_emp_no->emp_no);
		
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main_summary');
			$this->load->view('footer/footer_main');
		}
	}
	public function main_daily_task($dt_emp_no=0,$dt_date=0)
	{	
		$this->Authenticate_User();
		$dt_emp_no = decode($dt_emp_no);
		$dt_date = decode($dt_date);
		$dt_date= date('Y-m-d',strtotime($dt_date));
		$data['menu_name'] = 'daily_task';
		$dt_from = $this->input->post('dt_from');
		$dt_to = $this->input->post('dt_to');

		if($dt_from <> "")
		{
			if($dt_emp_no="");
			{
				$dt_emp_no = $this->session->userdata('dt_emp_no');
					
			}
			$dt_emp_no = $this->input->post('dt_emp_no');
			$dt_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
			$dt_week = $this->input->post('dt_week');
			$dt_year = $this->input->post('dt_year');
			$dt_emp_name = $dt_emp_name->dt_emp_name;
			$getWeekNumberCurrent = $this->mindex_daily_task->getWeekNumberCurrent($dt_week,$dt_year);
			$dt_from = $getWeekNumberCurrent->StartDate;
			$dt_to = $getWeekNumberCurrent->EndDate;
			$data['dt_from'] =$dt_from;
			$data['dt_to'] =$dt_to;
			$data['dt_year'] = $dt_year;
			$data['dt_week'] = $dt_week;
			$data['record'] = array('dt_emp_name'=> $dt_emp_name,'dt_emp_no'=>$dt_emp_no,'dt_from'=>$dt_from,'dt_to'=>$dt_from);
			$data['dt_emp_no'] = $dt_emp_no;
			$data['dt_modal_title'] = 'No Daily Task Records';
			$data['dt_modal_body'] = 'Unable to download excel file.';
			$data['dt_call_modal'] = '';
			$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
			$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
			$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main_daily_task',$data);
			$this->load->view('footer/footer_main',$data);
		}
		else
		{
			if($dt_emp_no="");
			{
				$dt_emp_no = $this->session->userdata('dt_emp_no');
					
			}
			$getCurrentWeekNo= $this->mindex_daily_task->getCurrentWeekNo();
			$dt_week = $getCurrentWeekNo->weeknum;
			$dt_year = date('Y');
			$getWeekNumberCurrent = $this->mindex_daily_task->getWeekNumberCurrent($dt_week,$dt_year);
			$dt_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
			$dt_emp_name = $dt_emp_name->dt_emp_name;
			$dt_from = $getWeekNumberCurrent->StartDate;
			$dt_to = $getWeekNumberCurrent->EndDate;
			$data['record'] = array('dt_emp_name'=> $dt_emp_name,'dt_emp_no'=>$dt_emp_no,'dt_from'=>$dt_from,'dt_to'=>$dt_from);
			$data['dt_emp_no'] = $dt_emp_no;
			$data['dt_from'] = $dt_from;
			$data['dt_to'] = $dt_to;
			$data['dt_year'] = date('Y');
			$data['dt_week'] = $dt_week;
			$data['dt_modal_title'] = 'No Daily Task Records';
			$data['dt_modal_body'] = 'Unable to download excel file.';
			$data['dt_call_modal'] = '';
			$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
			$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
			$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main_daily_task',$data);
			$this->load->view('footer/footer_main',$data);
		}
	}
	
	public function add_daily_task($dt_emp_no=0, $dt_date ='')
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'action_daily_task';
		$dt_emp_no = decode($dt_emp_no);
		$dt_date = decode($dt_date);
		$btn_add = $this->input->post('btn-add');
		$dt_time_in = $this->input->post('dt_time_in');
		$dt_time_out = $this->input->post('dt_time_out');
		
		$dt_remarks = $this->input->post('dt_remarks');
		$get_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
		$dt_emp_name = $get_emp_name->dt_emp_name;
		if($btn_add)
		{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('dt_date',  			'Date',			'required|callback_validate_date');
			$this->form_validation->set_rules('dt_time_in',  		'Time In',		'required|callback_validate_time_in');
			$this->form_validation->set_rules('dt_time_out',  		'Time Out',		'required|callback_validate_time_out|callback_compare_time['.$dt_time_in.']');
			$this->form_validation->set_rules('dt_remarks',  		'Remarks',		'required');
			$data['record'] = array('dt_emp_no'=> $dt_emp_no, 'dt_date'=>$dt_date, 'dt_time_in'=>$dt_time_in ,
					'dt_time_out'=> $dt_time_out, 'dt_remarks' => $dt_remarks, 'dt_emp_name'=> $dt_emp_name);
	
			if ($this->form_validation->run() == false)
			{
				$this->load->view('header/header_main',$data);
				$this->load->view('main/main_add_daily_task',$data);
				$this->load->view('footer/footer_main',$data);
			}
			else
			{
				$dt_date = $this->input->post('dt_date');
				$dt_date= date('Y-m-d',strtotime($dt_date));
				$this->mindex_daily_task->add_daily_task($dt_emp_no,$dt_date,$dt_time_in,$dt_time_out,str_replace("'","''",$dt_remarks));
				$this->load->view('header/header_main',$data);
				redirect('dtrms/added_daily_task/'.encode($dt_emp_no).'/'.encode($dt_date));
				$this->load->view('footer/footer_main',$data);
			}
		}
		else
		{
			$dt_date= date('d-m-Y',strtotime($dt_date));
			$data['record'] =array('dt_emp_name'=> $dt_emp_name,'dt_emp_no'=>$dt_emp_no,'dt_date'=>'',);
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main_add_daily_task',$data);
			$this->load->view('footer/footer_main',$data);
		}
		
	}
	public function added_daily_task($dt_emp_no=0,$dt_date=0)
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'daily_task';
		$dt_emp_no = decode($dt_emp_no);
		$dt_date = decode($dt_date);
	 	$dt_year= substr($dt_date,0,4);
	 	$getWeekNumberview =$this->mindex_daily_task->getWeekNumberview($dt_year,$dt_date);
	 	$dt_to= $getWeekNumberview->EndDate;
	 	$dt_from= $getWeekNumberview->StartDate;
		$dt_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
		$dt_emp_name = $dt_emp_name->dt_emp_name;
		$data['record'] = array('dt_emp_name'=> $dt_emp_name,'dt_emp_no'=>$dt_emp_no);
		$data['dt_emp_no'] = $dt_emp_no;
		$data['dt_from'] = $dt_from;
		$data['dt_to'] = $dt_to;
		$data['dt_year']=$dt_year;
		$data['dt_week']=$getWeekNumberview->WeekNr;
		$data['getWeekNumberCurrent']=$getWeekNumberview->WeekNr;
		$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
		$data['dt_modal_title'] = 'Add Daily Task';
		$data['dt_modal_body'] = 'Daily Task Added';
		$data['dt_call_modal'] = "$('#myModal').modal('show');";
		$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
		$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
		$this->load->view('header/header_main',$data);
		$this->load->view('main/main_daily_task',$data);
		$this->load->view('footer/footer_main',$data);
	} 
	public function update_daily_task($dt_id=0)
	{
		$this->Authenticate_User();
		$dt_id = decode($dt_id);
		$btn_add = $this->input->post('btn-add');
		$dt_time_in = $this->input->post('dt_time_in');
		$dt_time_out = $this->input->post('dt_time_out');
		$dt_date = $this->input->post('dt_date');
		$dt_remarks = $this->input->post('dt_remarks');
		$get_dt_update_info = $this->mindex_daily_task->get_dt_update_info($dt_id);
		$dt_emp_no = $get_dt_update_info->dt_emp_no;
		$get_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
		$dt_emp_name = $get_emp_name->dt_emp_name;
		$data['menu_name'] = 'action_daily_task';
		if($btn_add)
		{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('dt_date',  			'Date',			'required|callback_validate_date');
			$this->form_validation->set_rules('dt_time_in',  		'Time In',		'required|callback_validate_time_in');
			$this->form_validation->set_rules('dt_time_out',  		'Time Out',		'required|callback_validate_time_out|callback_compare_time['.$dt_time_in.']');
			$this->form_validation->set_rules('dt_remarks',  		'Remarks',		'required');

	
			if ($this->form_validation->run() == false)
			{
				$data['record'] = array('dt_id'=>$get_dt_update_info->dt_id,'dt_emp_no'=> $dt_emp_no, 'dt_date'=>$dt_date, 'dt_time_in'=>$dt_time_in ,
						'dt_time_out'=> $dt_time_out, 'dt_remarks' => $dt_remarks, 'dt_emp_name'=> $dt_emp_name);
				$this->load->view('header/header_main',$data);
				$this->load->view('main/main_update_daily_task',$data);
				$this->load->view('footer/footer_main',$data);
			
			}
			else
			{
				$dt_date= date('Y-m-d',strtotime($dt_date));
				$this->mindex_daily_task->update_daily_task($dt_emp_no,$dt_date,$dt_time_in,$dt_time_out,str_replace("'","''",$dt_remarks),$dt_id);
				redirect('dtrms/updated_daily_task/'.encode($dt_emp_no).'/'.encode($dt_date));
			}
		}
		else
		{
			$dt_date = date("d-m-Y", strtotime($get_dt_update_info->dt_date));
			$data['record'] =array('dt_id'=>$get_dt_update_info->dt_id, 'dt_emp_name'=> $dt_emp_name,'dt_emp_no'=>$dt_emp_no, 'dt_date'=>$dt_date,
							'dt_time_in'=>$get_dt_update_info->dt_in,'dt_time_out'=> $get_dt_update_info->dt_out,'dt_remarks'=>$get_dt_update_info->dt_remarks);
			$this->load->view('header/header_main',$data);
			$this->load->view('main/main_update_daily_task',$data);
			$this->load->view('footer/footer_main',$data);
		}
		
	}
	public function updated_daily_task($dt_emp_no=0,$dt_date=0)
	{
		$this->Authenticate_User();
		$data['menu_name'] = 'daily_task';
		$dt_emp_no = decode($dt_emp_no);
		$dt_date = decode($dt_date);
	 	$dt_year= substr($dt_date,0,4);
	 	$getWeekNumberview =$this->mindex_daily_task->getWeekNumberview($dt_year,$dt_date);
	 	$dt_to= $getWeekNumberview->EndDate;
	 	$dt_from= $getWeekNumberview->StartDate;
		$dt_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
		$dt_emp_name = $dt_emp_name->dt_emp_name;
		$data['record'] = array('dt_emp_name'=> $dt_emp_name,'dt_emp_no'=>$dt_emp_no);
		$data['dt_emp_no'] = $dt_emp_no;
		$data['dt_from'] = $dt_from;
		$data['dt_to'] = $dt_to;
		$data['dt_year']=$dt_year;
		$data['dt_week']=$getWeekNumberview->WeekNr;
		$data['getWeekNumberCurrent']=$getWeekNumberview->WeekNr;
		$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
		$data['dt_modal_title'] = 'Update Daily Task';
		$data['dt_modal_body'] = 'Daily Task Updated';
		$data['dt_call_modal'] = "$('#myModal').modal('show');";
		$data['get_emp_info'] = $this->mindex_daily_task->get_emp_info();
		$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
		$this->load->view('header/header_main',$data);
		$this->load->view('main/main_daily_task',$data);
		$this->load->view('footer/footer_main',$data);
	} 
	public function delete_daily_task($dt_id=0, $dt_date=0)
	{
		$this->Authenticate_User();
		$dt_id = decode($dt_id);
		$dt_date = decode($dt_date);
		$dt_year= substr($dt_date,0,4);
		$getWeekNumberview =$this->mindex_daily_task->getWeekNumberview($dt_year,$dt_date);
		$dt_to= $getWeekNumberview->EndDate;
		$dt_from= $getWeekNumberview->StartDate;
		
		$get_dt_update_info = $this->mindex_daily_task->get_dt_update_info($dt_id);
		$dt_emp_no = $get_dt_update_info->dt_emp_no;
		$this->mindex_daily_task->delete_daily_task($dt_id);
		$dt_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
		$dt_emp_name = $dt_emp_name->dt_emp_name;
		$data['menu_name'] = 'daily_task';
		$data['record'] = array('dt_emp_name'=> $dt_emp_name,'dt_emp_no'=>$dt_emp_no);
		$data['dt_emp_no'] = $dt_emp_no;
		$data['dt_from'] = $dt_from;
		$data['dt_to'] = $dt_to;
		$data['dt_year']=$dt_year;
		$data['dt_week']=$getWeekNumberview->WeekNr;
		$data['getWeekNumberCurrent']=$getWeekNumberview->WeekNr;
		$data['getWeekNumbers'] = $this->mindex_daily_task->getWeekNumbers();
		$data['dt_modal_title'] = 'No Daily Task Records';
		$data['dt_modal_body'] = 'Unable to download excel file.';
		$data['dt_call_modal'] = "";
		$data['daily_task'] = $this->mindex_daily_task->get_daily_task($dt_emp_no,$dt_from,$dt_to);
		$this->load->view('header/header_main',$data);
		$this->load->view('main/main_daily_task',$data);
		$this->load->view('footer/footer_main',$data);
	} 
	public function create_payslip()
	{
		$this->Authenticate_User();
		$ts_emp_no= $_REQUEST['emp_no'];
		$ts_date_from= $_REQUEST['date_from'];
		$ts_date_to= $_REQUEST['date_to'];
		
		$get_payslip_print= $this->mindex_payslips->get_payslip_print($ts_emp_no,str_replace("-", "", $ts_date_from),str_replace("-", "", $ts_date_to));
		
		$file_name = $get_payslip_print->Ps_Emp_No.'_'.$get_payslip_print->Ps_Emp_Name.'.docx';
		$file_name = str_replace(" ", "", $file_name);
		$dateto = substr($get_payslip_print->Ps_Date_To, 0,10) ;
		$datefrom = substr($get_payslip_print->Ps_Date_From, 0,10) ;
		$dayfrom =  substr($datefrom, 8,2);
		$dayto =  substr($dateto, 8,2);
		$monthNum  = substr($datefrom, 5,2);
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F');
	
	
		$monthperiod = $monthName.' '.$dayfrom .'-'.$dayto .' '.substr($datefrom, 0,4);
	
		$this->load->library('pdf');
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);
	
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/payslip_template.docx');
		setlocale(LC_MONETARY,"en_PH");
		$templateProcessor->setValue('emp_no1', 	$get_payslip_print->Ps_Emp_No);
		$templateProcessor->setValue('emp_name1', 	$get_payslip_print->Ps_Emp_Name);
		$templateProcessor->setValue('payperiod1', 	$monthperiod);
		$templateProcessor->setValue('position1', 	$get_payslip_print->Ps_Emp_Position);
		$templateProcessor->setValue('basepay1', 	number_format((float)$get_payslip_print->Ps_Base_Pay, 2, '.', ''));
		$templateProcessor->setValue('allowance1', 	number_format((float)$get_payslip_print->Ps_Add, 2, '.', ''));
		$templateProcessor->setValue('deduction1', 	number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('totalotpay1', number_format((float)$get_payslip_print->Ps_OT_Pay, 2, '.', ''));
		$templateProcessor->setValue('noofdays1', 	number_format((float)$get_payslip_print->Ps_Total_Hours, 2, '.', '') / 8);
		$templateProcessor->setValue('SSS1', 		'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('pagibig1', 	'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('philhealth1', '0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('totalpay1', 	number_format((float)$get_payslip_print->Ps_Total_Pay, 2, '.', ''));
		$templateProcessor->setValue('date1', 		 $dateto);
	
		$templateProcessor->setValue('emp_no2', 	$get_payslip_print->Ps_Emp_No);
		$templateProcessor->setValue('emp_name2', 	$get_payslip_print->Ps_Emp_Name);
		$templateProcessor->setValue('payperiod2', 	$monthperiod);
		$templateProcessor->setValue('position2', 	$get_payslip_print->Ps_Emp_Position);
		$templateProcessor->setValue('basepay2', 	number_format((float)$get_payslip_print->Ps_Base_Pay, 2, '.', ''));
		$templateProcessor->setValue('allowance2', 	number_format((float)$get_payslip_print->Ps_Add, 2, '.', ''));
		$templateProcessor->setValue('deduction2', 	number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('totalotpay2', number_format((float)$get_payslip_print->Ps_OT_Pay, 2, '.', ''));
		$templateProcessor->setValue('noofdays2', 	number_format((float)$get_payslip_print->Ps_Total_Hours, 2, '.', '') / 8);
		$templateProcessor->setValue('SSS2', 		'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('pagibig2', 	'0.00');//	number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('philhealth2', '0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('totalpay2', 	number_format((float)$get_payslip_print->Ps_Total_Pay, 2, '.', ''));
		$templateProcessor->setValue('date2', 		 $dateto);
		$templateProcessor->saveAs('templates/temp/'.$file_name);
	
		 
		$file_name = base_url('templates/temp/').'/'.$file_name;
		
		echo  json_encode($file_name);
	
	
	}
	
	public function getreport()
	{
		
		$get__Payslips = $this->mindex_payslips->get__Payslips();
		$salary = 0;
		$overtime = 0;
		$allowance = 0;
		$deduction = 0;
		$total_salary = 0;
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);
		
		$targetFile = "./global/uploads/";
		$filename = 'test.docx';
		
	 
		// add style settings for the title and paragraph
		$section = $phpWord->addSection(array('marginLeft' => 200, 'marginRight' => 200,
						'marginTop' => 200, 'marginBottom' => 200)); 
		$section->addImage('images/logo_on_white.png' ,array('align' => 'center','width'=>200, 'height'=>50));
		$section->addText('Salary Reports', array('bold' => true,'name'=> 'arial','size' => 21),array('align' => 'center', 'spaceAfter' => 10));
		$section->addTextBreak(1);
		
		$table = $section->addTable(array('align'=>'center','borderSize'=>6,));
// 		$phpWord->addFontStyle('rStyle', array('bold'=>true, 'italic'=>true, 'size'=>16));
		//header row
// 		$phpWord->addFontStyle('rStyle', array('center'=>true,'align'=>'center'));
		$table->addRow(400, array('bgColor'=>'dbdbdb'));
		$table->addCell(3500, array('bgColor'=>'dbdbdb'))->addText('Employee Name',array('bold'=>true));
		$table->addCell(1500, array('bgColor'=>'dbdbdb'))->addText('Salary',array('bold'=>true));
		$table->addCell(1500, array('bgColor'=>'dbdbdb'))->addText('Overtime',array('bold'=>true));
		$table->addCell(1500, array('bgColor'=>'dbdbdb'))->addText('Allowance',array('bold'=>true));
		$table->addCell(1500, array('bgColor'=>'dbdbdb'))->addText('Deduction',array('bold'=>true));
		$table->addCell(1500, array('bgColor'=>'dbdbdb'))->addText('Total Salary',array('bold'=>true));
		$table->addCell(1500, array('bgColor'=>'dbdbdb'))->addText('Date',array('bold'=>true));
		foreach ($get__Payslips as $payslips)
		{
			$table->addRow(400, array());
			$table->addCell(3500, array())->addText($payslips->Ps_Emp_Name);
			$table->addCell(1500, array())->addText((float)$payslips->Ps_Base_Pay);
			$table->addCell(1500, array())->addText((float)$payslips->Ps_Total_OT_Pay);
			$table->addCell(1500, array())->addText((float)$payslips->Ps_Add);
			$table->addCell(1500, array())->addText((float)$payslips->Ps_Sub);
			$table->addCell(1500, array())->addText((float)$payslips->Ps_Total_Pay);
			$table->addCell(1500, array())->addText(date('Y-m-d', strtotime($payslips->Ps_Date_To)));
				
			$salary = $salary + $payslips->Ps_Base_Pay ;
			$overtime = $overtime + $payslips->Ps_Total_OT_Pay ;
			$allowance = $allowance + $payslips->Ps_Add ;
			$deduction =  $deduction + $payslips->Ps_Sub ;
			$total_salary = $total_salary + $payslips->Ps_Total_Pay;
			
		}
			
		$table->addRow(400, array());
		$table->addCell(3500, array())->addText('Totals',array('bold'=>true));
		$table->addCell(1500, array())->addText((float)$salary,array('bold'=>true));
		$table->addCell(1500, array())->addText((float)$overtime,array('bold'=>true));
		$table->addCell(1500, array())->addText((float)$allowance,array('bold'=>true));
		$table->addCell(1500, array())->addText((float)$deduction,array('bold'=>true));
		$table->addCell(1500, array())->addText((float)$total_salary,array('bold'=>true));
		$table->addCell(1500, array())->addText();
		
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save($filename);
		// send results to browser to download
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		flush();
		readfile($filename);
		unlink($filename); // deletes the temporary file
	
		exit;
		
	}
	public  function validate_payslip()
	{

		$ts_date_from= $_REQUEST['date_from'];
		$ts_date_to= $_REQUEST['date_to'];
		$ts_emp_no= $_REQUEST['emp_no'];
		$get_payslip_print= $this->mindex_payslips->get_payslip_print($ts_emp_no,str_replace("-", "", $ts_date_from),str_replace("-", "", $ts_date_to));
// 		echo var_dump($get_payslip_print);
		echo  json_encode(count($get_payslip_print));
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

	public function Authenticate_User()
	{
  		$this->user_id = $this->session->userdata('user_id'); 
    	if ($this->user_id == null || $this->user_id == 0)
		{	
			 redirect('admin/index/');
		}
		 
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */