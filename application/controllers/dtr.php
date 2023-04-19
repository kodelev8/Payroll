<?php 

class DTR extends Secure_Controller {

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
		$this->load->model( array('mindex_dtr','mindex_dtr_pdf','mglobal') );
		$this->load->library('form_validation');
		$this->load->helper('url','form');
		$this->load->library('pdf'); // Load library
		$this->pdf->fontpath = 'font/'; // Specify font folder
	}
	public function index()
	{
		$data['menu_name'] ='main_dtr';
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_main');
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/dtr',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	public function dtr_log()
	{
		$data['menu_name'] ='main_dtr';
		$data['treeview_employee'] ="";
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_main');
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
		$dtr_check_emp_no = $this->mindex_dtr->show_emp_info($dtr_emp_no);
		$dtr_check_dual_remarks = $this->mindex_dtr->check_dual_remarks($dtr_emp_no,$dtr_option_name);

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
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/dtr',$data);
			$this->load->view('footer/footer_admin',$data);
			
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
				//$this->mindex_dtr->send_email($dtr_emp_email,$dtr_option_name, $dtr_full_name);
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
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/dtr',$data);
				$this->load->view('footer/footer_admin',$data);
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
				$this->load->view('header/header_admin',$data);
				$this->load->view('admin/dtr',$data);
				$this->load->view('footer/footer_admin',$data);
			}
		}
		
	}
	function update_dtr_log()
	{
		$data['menu_name'] ='main_dtr';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_main');
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
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/dtr',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else
		{
			redirect('dtr');
		}
	}
	
	public function summary()
	{
		$sel_name = $this->input->post('sel_name');
		$sel_month = $this->input->post('sel_month');
		$sel_year = $this->input->post('sel_year');
		$cutoffdate=0;
		$get_emp_top_row = "";
		$check_current_post_leave = "";
		$check_last_post_leave ="";
		$data['menu_name'] = 'dtr_summary';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_main');
		if($sel_month)
		{
			$check_current_post_leave = $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
			$check_last_post_leave = $this->mindex_dtr->check_last_post_leave($sel_name,$sel_month,$sel_year);
			$data['check_post'] = count($check_current_post_leave);
			$data['check_last_post'] = count($check_last_post_leave);
			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
							'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year,'dt_deduct'=>'');
			$data['sel_name'] = $sel_name;
			$data['sel_year'] = $sel_year;
			$data['sel_month'] = $sel_month;
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/dtr_summary',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else
		{
			$get_emp_top_row= $this->mindex_dtr->dtr_get_emp_info_first_row();
			$sel_name = $get_emp_top_row->emp_first_name . ' '.$get_emp_top_row->emp_last_name;
			$sel_month = date('m');
			$sel_year = date('Y');
			$check_current_post_leave= $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
			$check_last_post_leave = $this->mindex_dtr->check_last_post_leave($sel_name,$sel_month,$sel_year);
			$data['check_post'] = count($check_current_post_leave);
			$data['check_last_post'] = count($check_last_post_leave);
			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
							'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year,'dt_deduct'=>'');
			$data['sel_name'] = $sel_name;
			$data['sel_year'] = date('Y');
			$data['sel_month'] = date('m');
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/dtr_summary',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	}
	public function summary_leave_deducted()
	{
		$deduct_month = $this->input->post('deduct_month');
		$deduct_year = $this->input->post('deduct_year');
		$deduct_name = $this->input->post('deduct_name');
		$deduct_leave = $this->input->post('deduct_leave');
		$cutoffdate=0;
		$check_current_post_leave = "";
		$check_last_post_leave ="";
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$this->mindex_dtr->deduct_leave($deduct_name, $deduct_year, $deduct_leave);
		$sel_name = $deduct_name;
		$sel_month = $deduct_month;
		$sel_year = $deduct_year;
		$check_current_post_leave= $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
		$check_last_post_leave = $this->mindex_dtr->check_last_post_leave($sel_name,$sel_month,$sel_year);
		$data['check_post'] = count($check_current_post_leave);
		$data['check_last_post'] = count($check_last_post_leave);
		$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
		$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
		$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
		$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
		$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
				'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year,'dt_deduct'=>'');
		$data['sel_name'] = $sel_name;
		$data['sel_year'] = $sel_year;
		$data['sel_month'] = $sel_month;
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/dtr_summary',$data);
		$this->load->view('footer/footer_admin',$data);

	}
	
	public function view_dtr($dtr_row = 0)
	{
		  
		$dtr_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('dtr_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_dtr->active_dtr_num_rows();
			$per_page = $per_page->NumRows;
		} 
		
		
		
		$dtr_per_page =$per_page;
		$total_row= $this->mindex_dtr->count_dtr();
		$this->load->library('pagination');
		$config['base_url'] = base_url('dtr/view_dtr/');
		$config['total_rows'] = $total_row->count_dtr;
		$dtr_total =  $total_row->count_dtr;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = '';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view($dtr_per_page,$dtr_row,$dtr_total);
		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_search'] = "";
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_dtr',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_dtr_scan()
	{
			
		$dtr_row= $this->session->userdata('cur_row');
			
		$per_page = $this->input->post('dtr_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_dtr->active_dtr_num_rows();
			$per_page = $per_page->NumRows;
		}
		$dtr_per_page =$per_page;
		$this->mindex_dtr->update_dtr_num_rows($dtr_per_page);
		$total_row= $this->mindex_dtr->count_dtr();
		$this->load->library('pagination');
		$config['base_url'] = base_url('dtr/view_dtr/');
		$config['total_rows'] = $total_row->count_dtr;
		$dtr_total =  $total_row->count_dtr;
		$config['cur_page'] = $dtr_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
	
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = '';
		$data['treeview_employee'] ="";
		$data['treeview_leave'] ="";
		$data['treeview_main'] ="";
		$data['treeview_dtr'] ="active";
		$data['treeview_holiday'] ="";
		$data['treeview_daily_task'] ="";
		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view($dtr_per_page,$dtr_row,$dtr_total);
		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_search'] = "";
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_dtr',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_dtr_search($dtr_row = 0)
	{
		$dtr_search=$this->session->userdata('dtr_search');
		$this->session->set_userdata('cur_row',$dtr_row);
		$per_page = $this->mindex_dtr->active_dtr_num_rows();
		$per_page = $per_page->NumRows;
		$dtr_per_page =$per_page;
		$this->mindex_dtr->update_dtr_num_rows($dtr_per_page);
		$total_row= $this->mindex_dtr->count_dtr_search($dtr_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('dtr/view_dtr_search/');
		$config['total_rows'] = $total_row->count_dtr;
		$dtr_total =  $total_row->count_dtr;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
	
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = '';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view_search($dtr_per_page,$dtr_search,$dtr_row,$dtr_total);
		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_search'] = $dtr_search;
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_dtr_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_dtr_searched()
	{
		$dtr_row= $this->session->userdata('cur_row');
		$dtr_search=$this->input->post('hid_dtr_search');
		if($dtr_search)
		{
			$this->session->set_userdata('dtr_search',$dtr_search);
		}
		else 
		{
			$dtr_search= $this->session->userdata('dtr_search');
		}
		
		$per_page = $this->input->post('dtr_per_page_search');
		if ($per_page == "")
		{
			$per_page = $this->mindex_dtr->active_dtr_num_rows();
			$per_page = $per_page->NumRows;
			$dtr_row= 0;
		}
		
		$dtr_per_page =$per_page;
		$this->mindex_dtr->update_dtr_num_rows($dtr_per_page);
		$total_row= $this->mindex_dtr->count_dtr_search($dtr_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('dtr/view_dtr_search/');
		$config['total_rows'] = $total_row->count_dtr;
		$dtr_total =  $total_row->count_dtr;
		$config['cur_page'] = $dtr_row;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
	
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = '';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$data['treeview_daily_task'] ="";
		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view_search($dtr_per_page,$dtr_search,$dtr_row,$dtr_total);
		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['dtr_full_name'] = "";
		$data['dtr_emp_email'] = "";
		$data['dtr_emp_position']= "";
		$data['dtr_date'] = "";
		$data['dtr_option_name']="";
		$data['dtr_search'] = $dtr_search;
		$data['dtr_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_dtr_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function add_dtr()
	{
		$data['menu_name'] = 'dtr_action';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$btn =  $this->input->post('btn-add');
		$dtr_emp_no = $this->input->post('dtr_emp_no');
		$dtr_option = $this->input->post('dtr_option');
		$dtr_date = $this->input->post('dtr_date');
		$get_emp_info = $this->mindex_dtr->get_employees();
		$dailytimerecord = $this->mindex_dtr->dtr_view();
		$dtr_emp_id = $this->mindex_dtr->dtr_get_emp_id($dtr_emp_no);
		$dtr_option_name = "";
		$dtr_time=0;
		if($btn)
		{
			if($dtr_option == 1)
			{
				$dtr_option_name ="Log - IN";
			}
			elseif ($dtr_option == 2)
			{
				$dtr_option_name ="Log - OUT";
			}
			elseif ($dtr_option == 3)
			{
				$dtr_option_name ="Lunch Break - OUT";
			}
			elseif ($dtr_option == 4)
			{
				$dtr_option_name ="Lunch Break - IN";
			}
			else 
			{
				$dtr_option_name = '';
			}
			$dtr_time = substr($dtr_date, 10,12);
			$dtr_date = date("Y-m-d", strtotime($dtr_date)).$dtr_time;
			$dtr_emp_id=$dtr_emp_id->emp_user_id;
			$this->mindex_dtr->dtr_add($dtr_emp_id,$dtr_emp_no,$dtr_date,$dtr_option,$dtr_option_name);
			redirect('dtr/added_dtr');
		}	
		else	
		{	
			$data['get_emp_info'] = $get_emp_info;
			$data['dailytimerecord'] = $dailytimerecord;
			$data['dtr_emp_no'] = 03;
			$data['dtr_option'] = 1;
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/add_dtr',$data);
			$this->load->view('footer/footer_admin',$data);
	
		}
	}
	public function added_dtr()
	{
		$data['menu_name'] = '';
		$dtr_info =  $this->mindex_dtr->dtr_added_info();
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$data['dtr_info']= $dtr_info;
		$data['dtr_action'] = 'Added';
		$data['btn_r']= 'dtr/view_dtr';
		$data['btn_r_name']= 'View DTR';
		$data['btn_l']= 'dtr/update_dtr/'.encode($dtr_info->ts_id);
		$data['btn_l_name'] = 'Update DTR';
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_dtr',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function update_dtr($dtr_id=0)
	{
		$data['menu_name'] = 'dtr_action';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$dtr_id=decode($dtr_id);
		$btn =  $this->input->post('btn-add');
		$dtr_emp_no = $this->input->post('dtr_emp_no');
		$dtr_option = $this->input->post('dtr_option');
		$dtr_date = $this->input->post('dtr_date');
		$get_emp_info = $this->mindex_dtr->get_emp_info();
		$dailytimerecord = $this->mindex_dtr->dtr_view();
		$dtr_emp_id = $this->mindex_dtr->dtr_get_emp_id($dtr_emp_no);
		$dtr_option_name = "";
		$dtr_time=0;
		$data['menu_name'] = 'dtr_action';
		$dtr_update_info = $this->mindex_dtr->dtr_update_info($dtr_id);
		if($btn)
		{
			if($dtr_option == 1)
			{
				$dtr_option_name ="Log - IN";
			}
			elseif ($dtr_option == 2)
			{
				$dtr_option_name ="Log - OUT";
			}
			elseif ($dtr_option == 3)
			{
				$dtr_option_name ="Lunch Break - OUT";
			}
			elseif ($dtr_option == 4)
			{
				$dtr_option_name ="Lunch Break - IN";
			}
			else
			{
				$dtr_option_name = '';
			}
			
			$dtr_time = substr($dtr_date, 10,12);
			$dtr_date = date("Y-m-d", strtotime($dtr_date)).$dtr_time;
			$this->mindex_dtr->update_dtr($dtr_date,$dtr_option,$dtr_option_name,$dtr_id);
			redirect('dtr/updated_dtr/'.encode($dtr_id));
		}
		else
		{
			$dtr_date = substr($dtr_update_info->ts_time,0,19);
			$dtr_date = date("d-m-Y H:m:s", strtotime($dtr_date));
			$data['record'] = array('dtr_full_name' => $dtr_update_info->ts_first_name .' ' .$dtr_update_info->ts_last_name,
									'dtr_date'	=> $dtr_date );
			$data['dtr_id'] = $dtr_update_info->ts_id;
			$data['dailytimerecord'] = $dailytimerecord;
			$data['dtr_emp_no'] = 03;
			$data['dtr_option'] = $dtr_update_info->ts_option;
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/update_dtr',$data);
			$this->load->view('footer/footer_admin',$data);
	
		}
	}
	public function updated_dtr($dtr_id =0)
	{
		$dtr_id=decode($dtr_id);
		$data['menu_name'] = '';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$data['dtr_info']= $this->mindex_dtr->dtr_updated_info($dtr_id);
		$data['dtr_action'] = 'Updated';
		$data['btn_r']= 'dtr/view_dtr';
		$data['btn_r_name']= 'View DTR';
		$data['btn_l']= 'dtr/update_dtr/'.encode($dtr_id);
		$data['btn_l_name'] = 'Update DTR';
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/info_dtr',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function delete_dtr($dtr_id =0)
	{
		$dtr_id=decode($dtr_id);
		$info_dtr = $this->mindex_dtr->dtr_updated_info($dtr_id);
		if(count($info_dtr)>0)
		{
			$data['menu_name'] = '';
			$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
			$data['dtr_info']= $this->mindex_dtr->dtr_updated_info($dtr_id);
			$data['dtr_action'] = 'Delete';
			$data['btn_l']= 'dtr/view_dtr';
			$data['btn_l_name']= 'View DTR';
			$data['btn_r']= 'dtr/deleted_dtr/'.encode($dtr_id);
			$data['btn_r_name'] = 'Delete DTR';
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/info_dtr',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{
			redirect('dtr/view_dtr');
		}
		
	}
	public function deleted_dtr($dtr_id =0)
	{
		$data['menu_name'] = '';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$dtr_id = decode($dtr_id);
		$data['dtr_info']= $this->mindex_dtr->dtr_delete($dtr_id);
		redirect('dtr/view_dtr');
	}
	public function dtr_print_summary()
	{
		$data['menu_name'] = '';
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$data['treeview_daily_task'] ="";
		$dtr_print = $this->input->post('prn-dtr');
		$dtr_emp_name = $this->input->post('users');
		$dtr_month = $this->input->post('sel_month');
		$dtr_year = $this->input->post('sel_year');
		$cutoffdate = 0;
		$dtr_full_name = "";
		$name="";
		$count_user = count($dtr_emp_name);
		$data['menu_name'] = 'dtr_print_summary';
		if($dtr_month)
		{
			$this->mindex_dtr_pdf->print_all_summary($dtr_emp_name, $name,$cutoffdate,$dtr_month,$dtr_year,$count_user);

		}
		else 
		{
		$data['sel_month'] = date('m');
		$data['sel_year'] = date('Y');
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$data['dtr_employee'] = $this->mindex_dtr->dtr_get_emp_info();
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_print_summary',$data);
		$this->load->view('footer/footer_admin',$data);
	
		}

	}
	
	public function view_post_dtr()
	{

		$sel_name = decode($this->input->get('post_sel_name')) ;
		$sel_month = decode($this->input->get('post_sel_month'));
		$sel_year = decode($this->input->get('post_sel_year')) ;
		$post_name = $sel_name;
		$post_month = $sel_month;
		$post_year = $sel_year;
		$cutoffdate=0;
		$data['menu_name'] = ''; 
		$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
		$data['post_name'] = $sel_name;
		$data['post_month'] = $sel_month;
		$data['post_year'] = $sel_year;
		$check_current_post_leave = $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
		if (count($check_current_post_leave ) < 1)
		{
			$data['sel_name'] = $sel_name;
			$data['sel_year'] = $sel_year;
			$data['sel_month'] = $sel_month;
			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
							'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/dtr_summary',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{

			$data['post_disable'] = 0;
			$data['record'] = array('post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
			$data['post_GetEmpLeaveAvailable']= $this->mindex_dtr->post_GetEmpLeaveAvailable($post_name,$post_month,$post_year);
			$data['post_GetCurrentLeaveAvailable']= $this->mindex_dtr->dtr_emp_getleave();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_post_dtr',$data);
			$this->load->view('footer/footer_admin',$data);
		}
	}
	public function view_posted_dtr()
	{
			$post_name =  $this->input->post('post_sel_name');
			$post_month =  $this->input->post('post_sel_month');
			$post_year =  $this->input->post('post_sel_year');
			$sel_name = $post_name;
			$sel_month = $post_month;
			$sel_year = $post_year;
			$cutoffdate=0;
			$data['menu_name']= '';
			$data['get_treeview'] = $this->mindex_dtr->get_treeview('treeview_dtr');
			$data['post_disable'] = 1;
			$data['post_name'] = $post_name;
			$data['post_month'] = $post_month;
			$data['post_year'] = $post_year;
			$data['sel_name'] = $post_name;
			$data['sel_year'] = $post_year;
			$data['sel_month'] = $post_month;
			$this->mindex_dtr->post_InsertCurrentLeaveAvailable();
			$data['record'] = array('post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
			$data['post_GetEmpLeaveAvailable']= $this->mindex_dtr->post_GetEmpLeaveAvailable($post_name,$post_month,$post_year);
			$data['post_GetCurrentLeaveAvailable']= $this->mindex_dtr->dtr_emp_getleave();
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_post_dtr',$data);
			$this->load->view('footer/footer_admin',$data);
	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */