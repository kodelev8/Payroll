<?php 
include_once(APPPATH."third_party/PhpWord/Autoloader.php");  
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings; 
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Writer\PDF;

Autoloader::register();
Settings::loadConfig();
class payslips extends Secure_Controller {

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
		$this->load->model( array('mindex_dtr','mindex_dtr_pdf','mindex_payslips','mindex_deduction','mindex_allowance') );
		$this->load->library('form_validation');
		$this->load->helper('url','form');
		$this->load->library('pdf'); // Load library
		$this->pdf->fontpath = 'font/'; // Specify font folder
		/* @property phpword_model $phpword_model */
// 		include_once(APPPATH."third_party/PhpWord/Autoloader.php");
// // 		include_once(APPPATH."core/Front_end.php");
		
// 		use PhpOffice\PhpWord\Autoloader;
// 		use PhpOffice\PhpWord\Settings;
// 		Autoloader::register();
// 		Settings::loadConfig();
	}
	public function index($PS_row = 0)
	{
		
		$this->session->set_userdata('cur_row',$PS_row);
// 		 if(strlen($ps_sort) < 1)
// 		 {
// 		 	$ps_sort = 'Ps_Total_Pay';
		 	
// 		 }
		 $per_page = $this->input->post('payslip_per_page');
		 if ($per_page == "")
		 {
		 	$per_page = $this->mindex_payslips->active_payslips_num_rows();
			$per_page = $per_page->NumRows;
		 }
		
		$PS_per_page =$per_page;
		$total_row= $this->mindex_payslips->count_payslips();
		$this->load->library('pagination');
		$config['base_url'] = base_url('payslips/index/');
		$config['total_rows'] = $total_row->count_payslips;
		$PS_total =  $total_row->count_payslips;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		
		$data['error_msg']="";
		$data['StartDate']= "";
		$data['EndDate'] = "";
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = 'payslip';
		$data['get_treeview'] = $this->mindex_payslips->get_treeview('treeview_payslips');
		$data['payslips'] = $this->mindex_payslips->payslips_view($PS_per_page,$PS_row,$PS_total);
		$data['payslips_num_rows'] = $this->mindex_payslips->payslips_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['payslips_full_name'] = "";
		$data['payslips_emp_email'] = "";
		$data['payslips_emp_position']= "";
		$data['payslips_date'] = "";
		$data['payslips_option_name']="";
		$data['payslips_search'] = "";
		$data['payslips_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_payslips',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function view_payslip_search($payslip_row = 0)
	{
	
		$payslip_row = $this->session->userdata('cur_row');
// 		if(strlen($ps_sort) < 1)
// 		{
// 			$ps_sort = 'Ps_Total_Pay';
		
// 		}
		$payslip_search= $this->input->post('hid_payslip_search');
		
// 		if(strlen($payslip_search)>1)
// 		{
// 			$this->session->set_userdata('ps_search',$payslip_search);
// 		}
// 		else 
// 		{
// 			$payslip_search = $this->session->userdata('ps_search');
// 		}
		$per_page = $this->input->post('payslip_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_payslips->active_payslips_num_rows();
			$per_page = $per_page->NumRows;
		}

		$per_page = $this->mindex_payslips->active_payslips_num_rows();
		$per_page = $per_page->NumRows;
		$payslip_per_page =$per_page;
		$total_row= $this->mindex_payslips->count_payslip_search($payslip_search);
		$this->load->library('pagination');
		$config['base_url'] = base_url('payslips/view_payslip_search/');
		$config['total_rows'] = $total_row->count_payslips;
		$payslip_total =  $total_row->count_payslips;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
	
		$data['error_msg']="";
		$data['StartDate']= "";
		$data['EndDate'] = "";
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = 'payslip';
		$data['get_treeview'] = $this->mindex_payslips->get_treeview('treeview_payslips');
		$data['payslips'] = $this->mindex_payslips->payslip_view_search($payslip_per_page,$payslip_search,$payslip_row,$payslip_total);
		$data['payslips_num_rows'] = $this->mindex_payslips->payslips_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['payslips_full_name'] = "";
		$data['payslips_emp_email'] = "";
		$data['payslips_emp_position']= "";
		$data['payslips_date'] = "";
		$data['payslips_option_name']="";
		$data['payslips_search'] = "";
		$data['payslips_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_payslips_search',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	
	public function view_payslip_scan($PS_row = 0)
	{
		$per_page = $this->input->post('payslip_per_page');
		if ($per_page == "")
		{
			$per_page = $this->mindex_payslips->active_payslips_num_rows();
			$per_page = $per_page->NumRows;
		}
		
// 		$this->session->set_userdata('cur_row',$PS_row);
			
// 		$per_page = $this->input->post('payslip_per_page');
		
// 		if(strlen($ps_sort) < 1)
// 		{
// 			$ps_sort = 'Ps_Total_Pay';
		
// 		}
// 		if ($per_page == "")
// 		{
// 			$per_page = $this->mindex_payslips->active_payslips_num_rows();
// 			$per_page = $per_page->NumRows;
// 		}
		$this->mindex_payslips->update_payslips_num_rows($per_page);
		$PS_per_page =$per_page;
		$total_row= $this->mindex_payslips->count_payslips();
		$this->load->library('pagination');
		$config['base_url'] = base_url('payslips/index/');
		$config['total_rows'] = $total_row->count_payslips;
		$PS_total =  $total_row->count_payslips;
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['error_msg']="";
		$data['StartDate']= "";
		$data['EndDate'] = "";
		$data['links']= $this->pagination->create_links();
		$data['menu_name'] = 'payslip';
		$data['get_treeview'] = $this->mindex_payslips->get_treeview('treeview_payslips');
		$data['payslips'] = $this->mindex_payslips->payslips_view($PS_per_page,$PS_row,$PS_total);
		$data['payslips_num_rows'] = $this->mindex_payslips->payslips_num_rows();
		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['payslips_full_name'] = "";
		$data['payslips_emp_email'] = "";
		$data['payslips_emp_position']= "";
		$data['payslips_date'] = "";
		$data['payslips_option_name']="";
		$data['payslips_search'] = "";
		$data['payslips_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/view_payslips',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function add_payslip()
	{
		
		$weekno = date('W');
		$StartDate="";
		$EndDate="";
		$emp_no = "";
		$get_current_weeknr= $this->mindex_payslips->get_current_weeknr($weekno);
// 		echo  $get_current_weeknr[0]['EndDate'];
// echo $get_current_weeknr["StartDate"];
		foreach ($get_current_weeknr as $week)
		{
			$StartDate = date('Y-m-d',strtotime($week["StartDate"]));
			$EndDate  = date('Y-m-d',strtotime($week["EndDate"]));
		}  
		$get_top_emp_no = $this->mindex_payslips->get_top_emp_no();
		if(count($get_top_emp_no) ==0)
		{
			$emp_no ="";
		}
		else 
		{
			$emp_no = $get_top_emp_no->emp_no;
		}
		$data['error_msg']="";
		$data['StartDate']= $StartDate;
		$data['EndDate'] = $EndDate;
		$data['emp_no'] = $emp_no;
		$data['get_employees'] = $this->mindex_payslips->get_employees();
		$data['get_employee_number'] = $this->mindex_payslips->get_employee_number();
		$data['menu_name'] = 'payslip';
		$data['get_treeview'] = $this->mindex_payslips->get_treeview('treeview_payslips');
// 		$data['payslips'] = $this->mindex_payslips->payslips_view($PS_per_page,$PS_row,$PS_total);
// 		$data['payslips_num_rows'] = $this->mindex_payslips->payslips_num_rows();
// 		$data['post_month'] = "";
		$data['post_year'] = "";
		$data['post_name']= "";
		$data['payslips_full_name'] = "";
		$data['payslips_emp_email'] = "";
		$data['payslips_emp_position']= "";
		$data['payslips_date'] = "";
		$data['payslips_option_name']="";
		$data['payslips_search'] = "";
		$data['payslips_emp_pic'] = "~/Pictures/default.png";
		$data['nrf'] = "";
		$data['modal_show'] = "";
		$data['user_lname']= $this->session->userdata('user_lname');
		$data['user_fname'] = $this->session->userdata('user_fname');
		$data['user_position']= $this->session->userdata('user_position');
		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
		$this->load->view('header/header_admin',$data);
		$this->load->view('admin/add_timesheets',$data);
		$this->load->view('footer/footer_admin',$data);
	}
	public function print_payslips($PS_id = 0)
	{
		
		$get_payslip_print = $this->mindex_payslips->getpayslip_print($PS_id);
		$ps_deduct_id = str_replace(";",",",$get_payslip_print->Ps_Sub_ID);
		$ps_deduct_id = substr_replace($ps_deduct_id, "", -1);
		$get_deduction_ca = $this->mindex_payslips->get_deduction_ca($ps_deduct_id);
		$get_deduction_uni = $this->mindex_payslips->get_deduction_uni($ps_deduct_id);
		$file_name = $get_payslip_print->Ps_Emp_No.'_'.$get_payslip_print->Ps_Emp_Name.'.docx';
		$file_name = str_replace(" ", "", $file_name);
		$dateto = substr($get_payslip_print->Ps_Date_To, 0,10) ;
		$datefrom = substr($get_payslip_print->Ps_Date_From, 0,10) ;
		$dayfrom =  substr($datefrom, 8,2);
		$dayto =  substr($dateto, 8,2);
		$monthNum  = substr($datefrom, 5,2);
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F');
		
		$monthNum2  = substr($dateto, 5,2);
		$dateObj2   = DateTime::createFromFormat('!m', $monthNum2);
		$monthName2 = $dateObj2->format('F');
			
		
		$monthperiod = $monthName.' '.$dayfrom .'-'.$monthName2.' '.$dayto .' '.substr($datefrom, 0,4);
		
		$this->load->library('pdf');
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);
		
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/template_payslips.docx');
		setlocale(LC_MONETARY,"en_PH");
		$templateProcessor->setValue('emp_no1', 	$get_payslip_print->Ps_Emp_No);
		$templateProcessor->setValue('emp_name1', 	$get_payslip_print->Ps_Emp_Name);
		$templateProcessor->setValue('payperiod1', 	$monthperiod);
		$templateProcessor->setValue('position1', 	$get_payslip_print->Ps_Emp_Position);
		$templateProcessor->setValue('basepay1', 	number_format((float)$get_payslip_print->Ps_Emp_wages, 2, '.', '')*8);
		$templateProcessor->setValue('allowance1', 	number_format((float)$get_payslip_print->Ps_Add, 2, '.', ''));
		$templateProcessor->setValue('deduction1', 	number_format((float)$get_deduction_ca->Deduction_Amount, 2, '.', ''));
		$templateProcessor->setValue('sdeduction1', number_format((float)$get_deduction_uni->Deduction_Amount, 2, '.', ''));
		$templateProcessor->setValue('totalotpay1', number_format((float)$get_payslip_print->Ps_OT_Pay, 2, '.', ''));
		$templateProcessor->setValue('nootdays1', 	number_format((float)$get_payslip_print->Ps_OT_Hours, 2, '.', '') /8);
		$templateProcessor->setValue('noofdays1', 	number_format((float)$get_payslip_print->Ps_Normal_Hours, 2, '.', '') /8);
		$templateProcessor->setValue('SSS1', 		'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('pagibig1', 	'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('philhealth1', '0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('totalpay1', 	number_format((float)$get_payslip_print->Ps_Total_Pay, 2, '.', ''));
		$templateProcessor->setValue('date1', 		 $dateto);
		
// 		$templateProcessor->setValue('emp_no2', 	$get_payslip_print->Ps_Emp_No);
// 		$templateProcessor->setValue('emp_name2', 	$get_payslip_print->Ps_Emp_Name);
// 		$templateProcessor->setValue('payperiod2', 	$monthperiod);
// 		$templateProcessor->setValue('position2', 	$get_payslip_print->Ps_Emp_Position);
// 		$templateProcessor->setValue('basepay2', 	number_format((float)$get_payslip_print->Ps_Base_Pay, 2, '.', ''));
// 		$templateProcessor->setValue('allowance2', 	number_format((float)$get_payslip_print->Ps_Add, 2, '.', ''));
// 		$templateProcessor->setValue('deduction2', 	number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
// 		$templateProcessor->setValue('totalotpay2', number_format((float)$get_payslip_print->Ps_OT_Pay, 2, '.', ''));
// 		$templateProcessor->setValue('nootdays2', 	number_format((float)$get_payslip_print->Ps_OT_Hours, 2, '.', '') /8);
// 		$templateProcessor->setValue('noofdays2', 	number_format((float)$get_payslip_print->Ps_Normal_Hours, 2, '.', '')/8);
// 		$templateProcessor->setValue('SSS2', 		'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
// 		$templateProcessor->setValue('pagibig2', 	'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
// 		$templateProcessor->setValue('philhealth2', '0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
// 		$templateProcessor->setValue('totalpay2', 	number_format((float)$get_payslip_print->Ps_Total_Pay, 2, '.', ''));
// 		$templateProcessor->setValue('date2', 		 $dateto);
		$templateProcessor->saveAs('templates/temp/'.$file_name );
	 	$sourcedir = '"C:/Web/payroll/templates/temp/'. $file_name.'"';
	 	$outdir = '"C:/Web/payroll/templates/output/"';
	 	$cmd = 'soffice --headless --convert-to pdf ' .$sourcedir. ' --outdir '.$outdir;
		shell_exec($cmd);
		echo $cmd;
// 		unlink('templates/temp/'.$file_name);
// 		shell_exec('soffice --headless --convert-to pdf "d:\cd\1065_ALEXANDERVERUELA.docx" --outdir "d:\cd\1065_ALEXANDERVERUELA"');
		$file_name = $get_payslip_print->Ps_Emp_No.'_'.$get_payslip_print->Ps_Emp_Name.'.pdf';
		$file_name = str_replace(" ", "", $file_name);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='. $file_name);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize( 'templates/output/'.$file_name));
		while (ob_get_level()) {
			ob_end_clean();
			}
		readfile( 'templates/output/'.$file_name);
		unlink('templates/output/'.$file_name);
		
// 		$FilePath = "templates/temp/1068_JEMMYSONDELACRUZ.docx";
// 		$FilePathPdf = "templates/1068_JEMMYSONDELACRUZ.pdf";
		
		
		
// 		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		
// 		//Load temp file
// 		$phpWord = \PhpOffice\PhpWord\IOFactory::load($FilePath);
// 		//Save it
// 		$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
// 		$xmlWriter->save($FilePathPdf);
// 		ECHO var_export($xmlWriter);
	}
	public function docs()
	{ 
		
		$FilePath = "templates/temp/1068_JEMMYSONDELACRUZ.docx";
		$FilePathPdf = "templates/temp/1068_JEMMYSONDELACRUZ.pdf";
		
	
		
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		
		//Load temp file
		$phpWord = \PhpOffice\PhpWord\IOFactory::load($FilePath); 
		//Save it
		$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord , 'PDF');
		$xmlWriter->save($FilePathPdf);
	}
	
	public function generate_report_ts()
	{
	
		$month = '04';
		$year = '2018';
		$filename = 'PLiwanag_TimesheetsReport'.$month.'_'.$year.'.xlsx';
		copy('templates/Reports.xlsx', 'templates/temp/'.$filename);
		
		
		$this->mindex_payslips->generate_reports_ts($filename,$month,$year);
		// send results to browser to download
		header('Content-Description: File Transfer');
		header('Content-Type: "application/octet-stream"');
		header('Content-Disposition: attachment; filename='. $filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize(  'templates/temp/'.$filename));
		flush( 'templates/temp/'.$filename);
		readfile(  'templates/temp/'.$filename); 
// 		force_download(base_url().'templates/temp/'.$filename);
		unlink('templates/temp/'.$filename);
	
	
	
	}
	public function get_emp_info()
	{
		
		$emp_no = $_REQUEST['emp_no'];
		$StartDate = $_REQUEST['start_date'];;
		$EndDate =  $_REQUEST['end_date'];; 
 
		$get_sum_allowance = $this->mindex_payslips->get_sum_allowance($emp_no,$StartDate,$EndDate);
// 		 var_dump($get_sum_allowance);
		echo  json_encode($get_sum_allowance);
	}
	
	
	public function show_emp_info()
	{
		$emp_no = $_REQUEST['product'];
		
		$get_emp_info= $this->mindex_payslips->get_emp_info($emp_no);
		echo  json_encode($get_emp_info);
	}
	
	public function add_deduction()
	{
		 
		$deduction_emp_no 	= $_REQUEST['emp_no'];
		$deduction_date 	= $_REQUEST['deduct_date'];
		$deduction_amount 	= $_REQUEST['deduct_amount'];
		$deduction_description 	= $_REQUEST['deduct_desc'];
		$this->mindex_deduction->add_deduction($deduction_emp_no,$deduction_amount,$deduction_description,$deduction_date);
		$view_deduction = $this->mindex_deduction->view_deduction($deduction_emp_no,$deduction_date);
		$total_deduction = 0;
		foreach ($view_deduction as $vw_deduct)
		{
			$total_deduction = $total_deduction +floatval($vw_deduct->Deduction_Amount);
		}
// 		$total_deduction = var_dump($view_deduction);
		echo  json_encode($total_deduction);
	}
	public function print_payslip()
	{

		$file_name= "";		
// 		$ts_emp_no 	= '1086';
// 		$wk_start_date 	= '20180409';
// 		$wk_end_date 	='20180415';
		$ts_emp_no 	= $_REQUEST['emp_no'];
		$wk_start_date 	= $_REQUEST['wk_start_date'];
		$wk_end_date 	= $_REQUEST['wk_end_date'];
// 		$ts_emp_no = $this->input->post('hidden_emp_no');
// 		$wk_start_date = $this->input->post('hidden_start_date');
// 		$wk_end_date = $this->input->post('hidden_end_date');
		$list_dates=  $this->mindex_payslips->list_dates($wk_start_date,$wk_end_date); 
		$ts_date = "";
		$ts_count = 0;
		$output=0;
		foreach ($list_dates as $Ld)
		{
			$ts_date = str_replace("-", "", $Ld['date']); 
			$this->mindex_payslips->process_dtr_to_ts($ts_date,$ts_emp_no);
		}
		$ts_count = $this->mindex_payslips->get_timesheets_process($ts_emp_no,$wk_start_date,$wk_end_date);
		if(count($ts_count)>0)
		{
			$this->mindex_payslips->payslips_process($ts_emp_no,str_replace("-", "", $wk_start_date),str_replace("-", "", $wk_end_date));
			$get_payslip_print= $this->mindex_payslips->get_payslip_print($ts_emp_no,str_replace("-", "", $wk_start_date),str_replace("-", "", $wk_end_date));
// 			if(count($get_payslip_print)>0)
// 			{
				
// 				$this->docx($get_payslip_print);
// 				$file_name = $get_payslip_print->Ps_Emp_No.'_'.$get_payslip_print->Ps_Emp_Name.'.docx';
// 			}
			
// 			$file_name = base_url('templates/temp/').'/'.str_replace(" ", "", $file_name);

			$output = $get_payslip_print->Ps_Id;
		}  
		else 
		{

			$output = 1;
		}
		echo  json_encode($output);
// 		if($file_name<>"")
// 		{
// 			header('Content-Description: File Transfer');
// 			header('Content-Type: application/octet-stream');
// 			header('Content-Disposition: attachment; filename='. $file_name);
// 			header('Content-Transfer-Encoding: binary');
// 			header('Expires: 0');
// 			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// 			header('Pragma: public');
// 			header('Content-Length: ' . filesize( $file_name));
// 			flush();
// 			readfile( $file_name);
// 			unlink($file_name);
// 		}
// 		else 
// 		{ 
// 			$data['error_msg'] = 'Following date has already payslips';
// 			$data['StartDate']= $wk_start_date;
// 			$data['EndDate'] = $wk_end_date;
// 			$data['emp_no'] =$ts_emp_no;
// 			$data['get_employees'] = $this->mindex_payslips->get_employees();
// 			$data['menu_name'] = 'payslip';
// 			$data['get_treeview'] = $this->mindex_payslips->get_treeview('treeview_payslips');
// 			// 		$data['payslips'] = $this->mindex_payslips->payslips_view($PS_per_page,$PS_row,$PS_total);
// 			// 		$data['payslips_num_rows'] = $this->mindex_payslips->payslips_num_rows();
// 			// 		$data['post_month'] = "";
// 			$data['post_year'] = "";
// 			$data['post_name']= "";
// 			$data['payslips_full_name'] = "";
// 			$data['payslips_emp_email'] = "";
// 			$data['payslips_emp_position']= "";
// 			$data['payslips_date'] = "";
// 			$data['payslips_option_name']="";
// 			$data['payslips_search'] = "";
// 			$data['payslips_emp_pic'] = "~/Pictures/default.png";
// 			$data['nrf'] = "";
// 			$data['modal_show'] = "";
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/add_timesheets',$data);
// 			$this->load->view('footer/footer_admin',$data);
			
// 		}
	} 
	public function docx($get_payslip_print=0)
	{
		$file_name = $get_payslip_print->Ps_Emp_No.'_'.$get_payslip_print->Ps_Emp_Name.'.docx';
		$file_name = str_replace(" ", "", $file_name);
		$dateto = substr($get_payslip_print->Ps_Date_To, 0,10) ;
		$datefrom = substr($get_payslip_print->Ps_Date_From, 0,10) ;
		$dayfrom =  substr($datefrom, 8,2);
		$dayto =  substr($dateto, 8,2);
		$monthNum  = substr($datefrom, 5,2);
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F');
		

		$monthNum2  = substr($dateto, 5,2);
		$dateObj2   = DateTime::createFromFormat('!m', $monthNum2);
		$monthName2 = $dateObj2->format('F');
		
		
		$monthperiod = $monthName.' '.$dayfrom .'-'.$monthName2.' '.$dayto .' '.substr($datefrom, 0,4);
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
		$templateProcessor->setValue('noofdays1', 	number_format((float)$get_payslip_print->Ps_Total_Hours, 2, '.', '')/8);
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
		$templateProcessor->setValue('noofdays2', 	number_format((float)$get_payslip_print->Ps_Total_Hours, 2, '.', '')/8);
		$templateProcessor->setValue('SSS2', 		'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('pagibig2', 	'0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('philhealth2', '0.00');//number_format((float)$get_payslip_print->Ps_Sub, 2, '.', ''));
		$templateProcessor->setValue('totalpay2', 	number_format((float)$get_payslip_print->Ps_Total_Pay, 2, '.', ''));
		$templateProcessor->setValue('date2', 		 $dateto);
		$templateProcessor->saveAs($file_name); 
	 
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='. $file_name);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize( $file_name));
		flush();
		readfile( $file_name);
		unlink($file_name);
		
 
	}
	 
	
	public function add_allowance()
	{
			
		$allowance_emp_no 	= $_REQUEST['emp_no'];
		$allowance_date 	= $_REQUEST['allowance_date'];
		$allowance_amount 	= $_REQUEST['allowance_amount'];
		$allowance_description 	= $_REQUEST['allowance_desc'];
		$this->mindex_allowance->add_allowance($allowance_emp_no,$allowance_amount,$allowance_description,$allowance_date);
		$view_allowance = $this->mindex_allowance->view_allowance($allowance_emp_no,$allowance_date);
		$total_allowance = 0;
		foreach ($view_allowance as $vw_allowance)
		{
			$total_allowance = $total_allowance +floatval($vw_allowance->Allowance_Amount);
		}
// 				$total_deduction = var_dump($view_deduction);
		echo  json_encode($total_allowance);
	}
	public function add_dates()
	{

		$emp_no 	= $_REQUEST['emp_no'];
		$StartDate 	= $_REQUEST['StartDate'];
		$EndDate 	= $_REQUEST['EndDate']; 
		$list_dates=  $this->mindex_payslips->list_dates($StartDate,$EndDate);

		$list_dates_from_ts=  $this->mindex_payslips->list_dates_from_ts($emp_no,$StartDate,$EndDate);
		$html ="";
		if(count($list_dates_from_ts)>0)
		{
			$list_dates =$list_dates_from_ts;
		}
// 		$view_deduction = $this->mindex_deduction->view_deduction($deduction_emp_no,$deduction_date);
		 
// 		foreach ($list_dates as $list_dates)
// 		{ 
			 
			
// 		}
		// 		$total_deduction = var_dump($view_deduction);
		echo  json_encode($list_dates);
	}
	public function add_dates_from_ts()
	{
	
		$emp_no 	= $_REQUEST['emp_no'];
		$StartDate 	= $_REQUEST['StartDate'];
		$EndDate 	= $_REQUEST['EndDate'];
// 		$list_dates=  $this->mindex_payslips->list_dates($StartDate,$EndDate);
	
		$list_dates=  $this->mindex_payslips->list_dates_from_ts($emp_no,$StartDate,$EndDate);
		$html ="";
		if(count($list_dates)==0)
		{
			$list_dates =0;
		}
		// 		$view_deduction = $this->mindex_deduction->view_deduction($deduction_emp_no,$deduction_date);
			
		// 		foreach ($list_dates as $list_dates)
			// 		{
	
			
			// 		}
		// 		$total_deduction = var_dump($view_deduction);
		echo  json_encode($list_dates);
	}
	public function get_payslips()
	{
	
		$emp_no 	= $_REQUEST['emp_no'];
		$StartDate 	= $_REQUEST['StartDate'];
		$EndDate 	= $_REQUEST['EndDate'];


// 				$emp_no 	= '1012';
// 				$StartDate 	= '20180409';
// 				$EndDate 	= '20180415';
		// 		$list_dates=  $this->mindex_payslips->list_dates($StartDate,$EndDate);
		$output=0;
		$get_payslip_print=  $this->mindex_payslips->get_payslip_print($emp_no,$StartDate,$EndDate);
		$html ="";
		if(count($get_payslip_print)==0)
		{
			$output=0;
		}
		else
		 {
		 	$output= $get_payslip_print->Ps_Id;
			
		}
// 		echo var_dump($get_payslip_print);
		
// 		echo $output;
		echo  json_encode($output);
	}
	public function add_dtr_1()
	{
		$emp_no			= $_REQUEST['emp_no'];
		$day_login_1 	= $_REQUEST['day_login_1'];
		$day_logout_1 	= $_REQUEST['day_logout_1'];
		$day_lunchin_1 	= $_REQUEST['day_lunchin_1'];
		$day_lunchout_1 = $_REQUEST['day_lunchout_1'];
		$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
		$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
		$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
		$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_1);
		$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_1);
		$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_1);
		$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_1);  
		
		echo  json_encode('') ;
	}
		public function add_dtr_2()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_2 	= $_REQUEST['day_login_2'];
			$day_logout_2 	= $_REQUEST['day_logout_2'];
			$day_lunchin_2 	= $_REQUEST['day_lunchin_2'];
			$day_lunchout_2 = $_REQUEST['day_lunchout_2'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_2);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_2);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_2);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_2);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_3()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_3 	= $_REQUEST['day_login_3'];
			$day_logout_3 	= $_REQUEST['day_logout_3'];
			$day_lunchin_3 	= $_REQUEST['day_lunchin_3'];
			$day_lunchout_3 = $_REQUEST['day_lunchout_3'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_3);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_3);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_3);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_3);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_4()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_4 	= $_REQUEST['day_login_4'];
			$day_logout_4 	= $_REQUEST['day_logout_4'];
			$day_lunchin_4 	= $_REQUEST['day_lunchin_4'];
			$day_lunchout_4 = $_REQUEST['day_lunchout_4'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_4);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_4);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_4);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_4);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_5()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_5 	= $_REQUEST['day_login_5'];
			$day_logout_5 	= $_REQUEST['day_logout_5'];
			$day_lunchin_5 	= $_REQUEST['day_lunchin_5'];
			$day_lunchout_5 = $_REQUEST['day_lunchout_5'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_5);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_5);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_5);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_5);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_6()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_6 	= $_REQUEST['day_login_6'];
			$day_logout_6 	= $_REQUEST['day_logout_6'];
			$day_lunchin_6 	= $_REQUEST['day_lunchin_6'];
			$day_lunchout_6 = $_REQUEST['day_lunchout_6'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_6);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_6);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_6);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_6);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_7()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_7 	= $_REQUEST['day_login_7'];
			$day_logout_7 	= $_REQUEST['day_logout_7'];
			$day_lunchin_7 	= $_REQUEST['day_lunchin_7'];
			$day_lunchout_7 = $_REQUEST['day_lunchout_7'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_7);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_7);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_7);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_7);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_8()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_8 	= $_REQUEST['day_login_8'];
			$day_logout_8 	= $_REQUEST['day_logout_8'];
			$day_lunchin_8 	= $_REQUEST['day_lunchin_8'];
			$day_lunchout_8 = $_REQUEST['day_lunchout_8'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_8);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_8);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_8);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_8);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_9()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_9 	= $_REQUEST['day_login_9'];
			$day_logout_9 	= $_REQUEST['day_logout_9'];
			$day_lunchin_9 	= $_REQUEST['day_lunchin_9'];
			$day_lunchout_9 = $_REQUEST['day_lunchout_9'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_9);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_9);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_9);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_9);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_10()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_10 	= $_REQUEST['day_login_10'];
			$day_logout_10 	= $_REQUEST['day_logout_10'];
			$day_lunchin_10 	= $_REQUEST['day_lunchin_10'];
			$day_lunchout_10 = $_REQUEST['day_lunchout_10'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_10);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_10);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_10);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_10);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_11()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_11 	= $_REQUEST['day_login_11'];
			$day_logout_11 	= $_REQUEST['day_logout_11'];
			$day_lunchin_11 	= $_REQUEST['day_lunchin_11'];
			$day_lunchout_11 = $_REQUEST['day_lunchout_11'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_11);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_11);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_11);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_11);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_12()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_12 	= $_REQUEST['day_login_12'];
			$day_logout_12 	= $_REQUEST['day_logout_12'];
			$day_lunchin_12 	= $_REQUEST['day_lunchin_12'];
			$day_lunchout_12 = $_REQUEST['day_lunchout_12'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_12);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_12);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_12);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_12);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_13()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_13 	= $_REQUEST['day_login_13'];
			$day_logout_13 	= $_REQUEST['day_logout_13'];
			$day_lunchin_13 	= $_REQUEST['day_lunchin_13'];
			$day_lunchout_13 = $_REQUEST['day_lunchout_13'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_13);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_13);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_13);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_13);
		
			echo  json_encode($dtr_emp_no) ;
		}
		public function add_dtr_14()
		{
			$emp_no			= $_REQUEST['emp_no'];
			$day_login_14 	= $_REQUEST['day_login_14'];
			$day_logout_14 	= $_REQUEST['day_logout_14'];
			$day_lunchin_14 	= $_REQUEST['day_lunchin_14'];
			$day_lunchout_14 = $_REQUEST['day_lunchout_14'];
			$dtr_emp_no		= $this->mindex_dtr->dtr_emp_info($emp_no);
			$dtr_emp_id 	= $dtr_emp_no->emp_user_id;
			$dtr_emp_no 	= $dtr_emp_no->emp_no;
		
			$qq= $this->mindex_dtr->save_dtr_login($dtr_emp_id,$dtr_emp_no,$day_login_14);
			$this->mindex_dtr->save_dtr_logout($dtr_emp_id,$dtr_emp_no,$day_logout_14);
			$this->mindex_dtr->save_dtr_lunchin($dtr_emp_id,$dtr_emp_no,$day_lunchin_14);
			$this->mindex_dtr->save_dtr_lunchout($dtr_emp_id,$dtr_emp_no,$day_lunchout_14);
		
			echo  json_encode($dtr_emp_no) ;
		}		
		
// 	public function dtr_log()
// 	{
// 		$data['menu_name'] ='main_dtr';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="active";
// 		$data['treeview_dtr'] ="";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$dtr_emp_no = $this->input->post('dtr_emp_id');
// 		$dtr_option = $this->input->post('dtr_txt_option');
// 		$dtr_option_name = $this->input->post('dtr_txt_option_name');
// 		$date = $this->mindex_dtr->dtr_date();
// 		$dtr_date = $date->date;
// 		$dtr_emp_id	= "";
// 		$dtr_emp_fname	= "";
// 		$dtr_emp_lname	= "";
// 		$dtr_emp_midname = "";
// 		$dtr_emp_email= "";
// 		$dtr_check_emp_no = $this->mindex_dtr->show_emp_info($dtr_emp_no);
// 		$dtr_check_dual_remarks = $this->mindex_dtr->check_dual_remarks($dtr_emp_no,$dtr_option_name);

// 		if(count($dtr_check_emp_no)==0)
// 		{
// 			$data['nrf'] = "No Record Found!";
// 			$data['modal_show'] = "";
// 			$data['dtr_update_id'] = "";
// 			$data['dtr_emp_no'] = "";
// 			$data['dtr_full_name'] = "";
// 			$data['dtr_emp_email'] = "";
// 			$data['dtr_emp_position']= "";
// 			$data['dtr_date'] = "";
// 			$data['dtr_option_name']="";
// 			$data['dtr_emp_pic'] = "~/Pictures/default.png";
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$data['dailytimerecord'] = $this->mindex_dtr->dtr_view();
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/dtr',$data);
// 			$this->load->view('footer/footer_admin',$data);
			
// 		}
		
// 		else 
// 		{
// 			if(count($dtr_check_dual_remarks)==0)
// 			{
// 				$get_emp_info = $this->mindex_dtr->get_emp_info($dtr_emp_no);
// 				$dtr_emp_no = $get_emp_info->emp_no;
// 				$dtr_emp_id	= $get_emp_info->emp_user_id;
// 				$dtr_full_name = $get_emp_info->emp_first_name." ".$get_emp_info->emp_last_name;
// 				$dtr_emp_position = $get_emp_info->emp_position;
// 				$dtr_emp_email= $get_emp_info->emp_email;
// 				$dtr_emp_pic= $get_emp_info->emp_picture;
// 				$dtr_save_log = $this->mindex_dtr->save_dtr_log($dtr_emp_id, $dtr_emp_no, $dtr_option, $dtr_option_name);
// 				//$this->mindex_dtr->send_email($dtr_emp_email,$dtr_option_name, $dtr_full_name);
// 				$data['nrf'] = "";
// 				$data['modal_show'] = "";
// 				$data['dtr_emp_no']=$dtr_emp_no;
// 				$data['dtr_update_id'] = "";
// 				$data['dtr_full_name'] = $dtr_full_name;
// 				$data['dtr_emp_email'] = $dtr_emp_email;
// 				$data['dtr_emp_position']= $dtr_emp_position;
// 				$data['dtr_emp_pic'] = $dtr_emp_pic;
// 				$data['dtr_date'] = $dtr_date;
// 				$data['dtr_option_name']=$dtr_option_name;
// 				$data['user_lname']= $this->session->userdata('user_lname');
// 				$data['user_fname'] = $this->session->userdata('user_fname');
// 				$data['user_position']= $this->session->userdata('user_position');
// 				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 				$this->load->view('header/header_admin',$data);
// 				$this->load->view('admin/dtr',$data);
// 				$this->load->view('footer/footer_admin',$data);
// 			}
// 			else 
// 			{
// 				$data['nrf'] = "";
// 				$data['modal_show'] = "$('#myModal').modal('show');";
// 				$data['dtr_update_emp_no']=$dtr_emp_no;
// 				$data['dtr_update_id'] =  $dtr_check_dual_remarks->dtr_id;
// 				$data['dtr_full_name'] = "";
// 				$data['dtr_emp_email'] = "";
// 				$data['dtr_emp_position']= "";
// 				$data['dtr_date'] = "";
// 				$data['dtr_option_name']="";
// 				$data['dtr_emp_pic'] = "~/Pictures/default.png";
// 				$data['chk_dtr_date'] = $dtr_date;
// 				$data['chk_dtr_emp_id'] = $dtr_emp_id;
// 				$data['chk_dtr_option_name']=$dtr_option_name;
// 				$data['user_lname']= $this->session->userdata('user_lname');
// 				$data['user_fname'] = $this->session->userdata('user_fname');
// 				$data['user_position']= $this->session->userdata('user_position');
// 				$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 				$this->load->view('header/header_admin',$data);
// 				$this->load->view('admin/dtr',$data);
// 				$this->load->view('footer/footer_admin',$data);
// 			}
// 		}
		
// 	}
// 	function update_dtr_log()
// 	{
// 		$data['menu_name'] ='main_dtr';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_dtr'] ="";
// 		$data['treeview_main'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$date = $this->mindex_dtr->dtr_date();
// 		$dtr_date = $date->date;
// 		$dtr_option_name =  $this->input->post('dtr_option_name');
// 		$dtr_update_emp_no= $this->input->post('dtr_update_emp_no');	
// 		$get_emp_info = $this->mindex_dtr->get_emp_info($dtr_update_emp_no);
// 		$dtr_emp_no = $get_emp_info->emp_no;
// 		$dtr_emp_id	= $get_emp_info->emp_user_id;
// 		$dtr_full_name = $get_emp_info->emp_first_name." ".$get_emp_info->emp_last_name;
// 		$dtr_emp_position = $get_emp_info->emp_position;
// 		$dtr_emp_email= $get_emp_info->emp_email;
// 		$dtr_emp_pic= $get_emp_info->emp_picture;
// 		if($dtr_option_name)
// 		{
// 			$dtr_update_id = $this->input->post('dtr_update_id');
// 			$this->mindex_dtr->dtr_update($dtr_update_id);
// 			$data['nrf'] = "";
// 			$data['modal_show'] = "";
// 			$data['dtr_emp_no']=$dtr_emp_no;
// 			$data['dtr_update_id'] = "";
// 			$data['dtr_full_name'] = $dtr_full_name;
// 			$data['dtr_emp_email'] = $dtr_emp_email;
// 			$data['dtr_emp_position']= $dtr_emp_position;
// 			$data['dtr_emp_pic'] = $dtr_emp_pic;
// 			$data['dtr_date'] = $dtr_date;
// 			$data['dtr_option_name']=$dtr_option_name;
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/dtr',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else
// 		{
// 			redirect('dtr');
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
// 		$data['menu_name'] = 'dtr_summary';
// 		$data['treeview_main'] ="active";
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_dtr'] ="";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		if($sel_month)
// 		{
// 			$check_current_post_leave = $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 			$check_last_post_leave = $this->mindex_dtr->check_last_post_leave($sel_name,$sel_month,$sel_year);
// 			$data['check_post'] = count($check_current_post_leave);
// 			$data['check_last_post'] = count($check_last_post_leave);
// 			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
// 			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
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
// 			$this->load->view('admin/dtr_summary',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else
// 		{
// 			$get_emp_top_row= $this->mindex_dtr->dtr_get_emp_info_first_row();
// 			$sel_name = $get_emp_top_row->emp_first_name . ' '.$get_emp_top_row->emp_last_name;
// 			$sel_month = date('m');
// 			$sel_year = date('Y');
// 			$check_current_post_leave= $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 			$check_last_post_leave = $this->mindex_dtr->check_last_post_leave($sel_name,$sel_month,$sel_year);
// 			$data['check_post'] = count($check_current_post_leave);
// 			$data['check_last_post'] = count($check_last_post_leave);
// 			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
// 			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
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
// 			$this->load->view('admin/dtr_summary',$data);
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
// 		$data['menu_name'] = 'dtr_summary';
// 		$data['treeview_main'] ="";
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$this->mindex_dtr->deduct_leave($deduct_name, $deduct_year, $deduct_leave);
// 		$sel_name = $deduct_name;
// 		$sel_month = $deduct_month;
// 		$sel_year = $deduct_year;
// 		$check_current_post_leave= $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 		$check_last_post_leave = $this->mindex_dtr->check_last_post_leave($sel_name,$sel_month,$sel_year);
// 		$data['check_post'] = count($check_current_post_leave);
// 		$data['check_last_post'] = count($check_last_post_leave);
// 		$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
// 		$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 		$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 		$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
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
// 		$this->load->view('admin/dtr_summary',$data);
// 		$this->load->view('footer/footer_admin',$data);

// 	}
	
// 	public function view_dtr($dtr_row = 0)
// 	{
		 
// 		$this->session->set_userdata('cur_row',$dtr_row);
		 
// 		$per_page = $this->mindex_dtr->active_dtr_num_rows();
// 		$per_page = $per_page->NumRows;
// 		$dtr_per_page =$per_page;
// 		$total_row= $this->mindex_dtr->count_dtr();
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('dtr/view_dtr/');
// 		$config['total_rows'] = $total_row->count_dtr;
// 		$dtr_total =  $total_row->count_dtr;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
		
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view($dtr_per_page,$dtr_row,$dtr_total);
// 		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['dtr_full_name'] = "";
// 		$data['dtr_emp_email'] = "";
// 		$data['dtr_emp_position']= "";
// 		$data['dtr_date'] = "";
// 		$data['dtr_option_name']="";
// 		$data['dtr_search'] = "";
// 		$data['dtr_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_dtr',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function view_dtr_scan()
// 	{
			
// 		$dtr_row= $this->session->userdata('cur_row');
			
// 		$per_page = $this->input->post('dtr_per_page');
// 		if ($per_page == "")
// 		{
// 			$per_page = $this->mindex_dtr->active_dtr_num_rows();
// 			$per_page = $per_page->NumRows;
// 		}
// 		$dtr_per_page =$per_page;
// 		$this->mindex_dtr->update_dtr_num_rows($dtr_per_page);
// 		$total_row= $this->mindex_dtr->count_dtr();
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('dtr/view_dtr/');
// 		$config['total_rows'] = $total_row->count_dtr;
// 		$dtr_total =  $total_row->count_dtr;
// 		$config['cur_page'] = $dtr_row;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
	
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view($dtr_per_page,$dtr_row,$dtr_total);
// 		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['dtr_full_name'] = "";
// 		$data['dtr_emp_email'] = "";
// 		$data['dtr_emp_position']= "";
// 		$data['dtr_date'] = "";
// 		$data['dtr_option_name']="";
// 		$data['dtr_search'] = "";
// 		$data['dtr_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_dtr',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function view_dtr_search($dtr_row = 0)
// 	{
// 		$dtr_search=$this->session->userdata('dtr_search');
// 		$this->session->set_userdata('cur_row',$dtr_row);
// 		$per_page = $this->mindex_dtr->active_dtr_num_rows();
// 		$per_page = $per_page->NumRows;
// 		$dtr_per_page =$per_page;
// 		$this->mindex_dtr->update_dtr_num_rows($dtr_per_page);
// 		$total_row= $this->mindex_dtr->count_dtr_search($dtr_search);
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('dtr/view_dtr_search/');
// 		$config['total_rows'] = $total_row->count_dtr;
// 		$dtr_total =  $total_row->count_dtr;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
	
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view_search($dtr_per_page,$dtr_search,$dtr_row,$dtr_total);
// 		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['dtr_full_name'] = "";
// 		$data['dtr_emp_email'] = "";
// 		$data['dtr_emp_position']= "";
// 		$data['dtr_date'] = "";
// 		$data['dtr_option_name']="";
// 		$data['dtr_search'] = $dtr_search;
// 		$data['dtr_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_dtr_search',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function view_dtr_searched()
// 	{
// 		$dtr_row= $this->session->userdata('cur_row');
// 		$dtr_search=$this->input->post('hid_dtr_search');
// 		if($dtr_search)
// 		{
// 			$this->session->set_userdata('dtr_search',$dtr_search);
// 		}
// 		else 
// 		{
// 			$dtr_search= $this->session->userdata('dtr_search');
// 		}
		
// 		$per_page = $this->input->post('dtr_per_page_search');
// 		if ($per_page == "")
// 		{
// 			$per_page = $this->mindex_dtr->active_dtr_num_rows();
// 			$per_page = $per_page->NumRows;
// 			$dtr_row= 0;
// 		}
		
// 		$dtr_per_page =$per_page;
// 		$this->mindex_dtr->update_dtr_num_rows($dtr_per_page);
// 		$total_row= $this->mindex_dtr->count_dtr_search($dtr_search);
// 		$this->load->library('pagination');
// 		$config['base_url'] = base_url('dtr/view_dtr_search/');
// 		$config['total_rows'] = $total_row->count_dtr;
// 		$dtr_total =  $total_row->count_dtr;
// 		$config['cur_page'] = $dtr_row;
// 		$config['per_page'] = $per_page;
// 		$this->pagination->initialize($config);
	
// 		$data['links']= $this->pagination->create_links();
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dailytimerecord'] = $this->mindex_dtr->dtr_view_search($dtr_per_page,$dtr_search,$dtr_row,$dtr_total);
// 		$data['dtr_num_rows'] = $this->mindex_dtr->dtr_num_rows();
// 		$data['post_month'] = "";
// 		$data['post_year'] = "";
// 		$data['post_name']= "";
// 		$data['dtr_full_name'] = "";
// 		$data['dtr_emp_email'] = "";
// 		$data['dtr_emp_position']= "";
// 		$data['dtr_date'] = "";
// 		$data['dtr_option_name']="";
// 		$data['dtr_search'] = $dtr_search;
// 		$data['dtr_emp_pic'] = "~/Pictures/default.png";
// 		$data['nrf'] = "";
// 		$data['modal_show'] = "";
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_dtr_search',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function add_dtr()
// 	{
// 		$data['menu_name'] = 'dtr_action';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$btn =  $this->input->post('btn-add');
// 		$dtr_emp_no = $this->input->post('dtr_emp_no');
// 		$dtr_option = $this->input->post('dtr_option');
// 		$dtr_date = $this->input->post('dtr_date');
// 		$get_emp_info = $this->mindex_dtr->get_employees();
// 		$dailytimerecord = $this->mindex_dtr->dtr_view();
// 		$dtr_emp_id = $this->mindex_dtr->dtr_get_emp_id($dtr_emp_no);
// 		$dtr_option_name = "";
// 		$dtr_time=0;
// 		if($btn)
// 		{
// 			if($dtr_option == 1)
// 			{
// 				$dtr_option_name ="Log - IN";
// 			}
// 			elseif ($dtr_option == 2)
// 			{
// 				$dtr_option_name ="Log - OUT";
// 			}
// 			elseif ($dtr_option == 3)
// 			{
// 				$dtr_option_name ="Lunch Break - OUT";
// 			}
// 			elseif ($dtr_option == 4)
// 			{
// 				$dtr_option_name ="Lunch Break - IN";
// 			}
// 			else 
// 			{
// 				$dtr_option_name = '';
// 			}
// 			$dtr_time = substr($dtr_date, 10,12);
// 			$dtr_date = date("Y-m-d", strtotime($dtr_date)).$dtr_time;
// 			$dtr_emp_id=$dtr_emp_id->emp_user_id;
// 			$this->mindex_dtr->dtr_add($dtr_emp_id,$dtr_emp_no,$dtr_date,$dtr_option,$dtr_option_name);
// 			redirect('dtr/added_dtr');
// 		}	
// 		else	
// 		{	
// 			$data['get_emp_info'] = $get_emp_info;
// 			$data['dailytimerecord'] = $dailytimerecord;
// 			$data['dtr_emp_no'] = 03;
// 			$data['dtr_option'] = 1;
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/add_dtr',$data);
// 			$this->load->view('footer/footer_admin',$data);
	
// 		}
// 	}
// 	public function added_dtr()
// 	{
// 		$data['menu_name'] = '';
// 		$dtr_info =  $this->mindex_dtr->dtr_added_info();
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dtr_info']= $dtr_info;
// 		$data['dtr_action'] = 'Added';
// 		$data['btn_r']= 'dtr/view_dtr';
// 		$data['btn_r_name']= 'View DTR';
// 		$data['btn_l']= 'dtr/update_dtr/'.encode($dtr_info->ts_id);
// 		$data['btn_l_name'] = 'Update DTR';
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/info_dtr',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function update_dtr($dtr_id=0)
// 	{
// 		$data['menu_name'] = 'dtr_action';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$dtr_id=decode($dtr_id);
// 		$btn =  $this->input->post('btn-add');
// 		$dtr_emp_no = $this->input->post('dtr_emp_no');
// 		$dtr_option = $this->input->post('dtr_option');
// 		$dtr_date = $this->input->post('dtr_date');
// 		$get_emp_info = $this->mindex_dtr->get_emp_info();
// 		$dailytimerecord = $this->mindex_dtr->dtr_view();
// 		$dtr_emp_id = $this->mindex_dtr->dtr_get_emp_id($dtr_emp_no);
// 		$dtr_option_name = "";
// 		$dtr_time=0;
// 		$data['menu_name'] = 'dtr_action';
// 		$dtr_update_info = $this->mindex_dtr->dtr_update_info($dtr_id);
// 		if($btn)
// 		{
// 			if($dtr_option == 1)
// 			{
// 				$dtr_option_name ="Log - IN";
// 			}
// 			elseif ($dtr_option == 2)
// 			{
// 				$dtr_option_name ="Log - OUT";
// 			}
// 			elseif ($dtr_option == 3)
// 			{
// 				$dtr_option_name ="Lunch Break - OUT";
// 			}
// 			elseif ($dtr_option == 4)
// 			{
// 				$dtr_option_name ="Lunch Break - IN";
// 			}
// 			else
// 			{
// 				$dtr_option_name = '';
// 			}
			
// 			$dtr_time = substr($dtr_date, 10,12);
// 			$dtr_date = date("Y-m-d", strtotime($dtr_date)).$dtr_time;
// 			$this->mindex_dtr->update_dtr($dtr_date,$dtr_option,$dtr_option_name,$dtr_id);
// 			redirect('dtr/updated_dtr/'.encode($dtr_id));
// 		}
// 		else
// 		{
// 			$dtr_date = substr($dtr_update_info->ts_time,0,19);
// 			$dtr_date = date("d-m-Y H:m:s", strtotime($dtr_date));
// 			$data['record'] = array('dtr_full_name' => $dtr_update_info->ts_first_name .' ' .$dtr_update_info->ts_last_name,
// 									'dtr_date'	=> $dtr_date );
// 			$data['dtr_id'] = $dtr_update_info->ts_id;
// 			$data['dailytimerecord'] = $dailytimerecord;
// 			$data['dtr_emp_no'] = 03;
// 			$data['dtr_option'] = $dtr_update_info->ts_option;
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/update_dtr',$data);
// 			$this->load->view('footer/footer_admin',$data);
	
// 		}
// 	}
// 	public function updated_dtr($dtr_id =0)
// 	{
// 		$dtr_id=decode($dtr_id);
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['dtr_info']= $this->mindex_dtr->dtr_updated_info($dtr_id);
// 		$data['dtr_action'] = 'Updated';
// 		$data['btn_r']= 'dtr/view_dtr';
// 		$data['btn_r_name']= 'View DTR';
// 		$data['btn_l']= 'dtr/update_dtr/'.encode($dtr_id);
// 		$data['btn_l_name'] = 'Update DTR';
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/info_dtr',$data);
// 		$this->load->view('footer/footer_admin',$data);
// 	}
// 	public function delete_dtr($dtr_id =0)
// 	{
// 		$dtr_id=decode($dtr_id);
// 		$info_dtr = $this->mindex_dtr->dtr_updated_info($dtr_id);
// 		if(count($info_dtr)>0)
// 		{
// 			$data['menu_name'] = '';
// 			$data['treeview_employee'] ="";
// 			$data['treeview_main'] ="";
// 			$data['treeview_leave'] ="";
// 			$data['treeview_dtr'] ="active";
// 			$data['treeview_holiday'] ="";
// 			$data['treeview_daily_task'] ="";
// 			$data['dtr_info']= $this->mindex_dtr->dtr_updated_info($dtr_id);
// 			$data['dtr_action'] = 'Delete';
// 			$data['btn_l']= 'dtr/view_dtr';
// 			$data['btn_l_name']= 'View DTR';
// 			$data['btn_r']= 'dtr/deleted_dtr/'.encode($dtr_id);
// 			$data['btn_r_name'] = 'Delete DTR';
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/info_dtr',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else 
// 		{
// 			redirect('dtr/view_dtr');
// 		}
		
// 	}
// 	public function deleted_dtr($dtr_id =0)
// 	{
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$dtr_id = decode($dtr_id);
// 		$data['dtr_info']= $this->mindex_dtr->dtr_delete($dtr_id);
// 		redirect('dtr/view_dtr');
// 	}
// 	public function dtr_print_summary()
// 	{
// 		$data['menu_name'] = '';
// 		$data['treeview_employee'] ="";
// 		$data['treeview_main'] ="";
// 		$data['treeview_leave'] ="";
// 		$data['treeview_dtr'] ="active";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$dtr_print = $this->input->post('prn-dtr');
// 		$dtr_emp_name = $this->input->post('users');
// 		$dtr_month = $this->input->post('sel_month');
// 		$dtr_year = $this->input->post('sel_year');
// 		$cutoffdate = 0;
// 		$dtr_full_name = "";
// 		$name="";
// 		$count_user = count($dtr_emp_name);
// 		$data['menu_name'] = 'dtr_print_summary';
// 		if($dtr_month)
// 		{
// 			$this->mindex_dtr_pdf->print_all_summary($dtr_emp_name, $name,$cutoffdate,$dtr_month,$dtr_year,$count_user);

// 		}
// 		else 
// 		{
// 		$data['sel_month'] = date('m');
// 		$data['sel_year'] = date('Y');
// 		$data['user_lname']= $this->session->userdata('user_lname');
// 		$data['user_fname'] = $this->session->userdata('user_fname');
// 		$data['user_position']= $this->session->userdata('user_position');
// 		$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 		$data['dtr_employee'] = $this->mindex_dtr->dtr_get_emp_info();
// 		$this->load->view('header/header_admin',$data);
// 		$this->load->view('admin/view_print_summary',$data);
// 		$this->load->view('footer/footer_admin',$data);
	
// 		}

// 	}
	
// 	public function view_post_dtr()
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
// 		$data['treeview_dtr'] ="";
// 		$data['treeview_holiday'] ="";
// 		$data['treeview_daily_task'] ="";
// 		$data['post_name'] = $sel_name;
// 		$data['post_month'] = $sel_month;
// 		$data['post_year'] = $sel_year;
// 		$check_current_post_leave = $this->mindex_dtr->check_current_post_leave($sel_name,$sel_month,$sel_year);
// 		if (count($check_current_post_leave ) < 1)
// 		{
// 			$data['sel_name'] = $sel_name;
// 			$data['sel_year'] = $sel_year;
// 			$data['sel_month'] = $sel_month;
// 			$data['dtr_get_emp_info'] = $this->mindex_dtr->dtr_get_emp_info();
// 			$data['dtr_emp_header'] = $this->mindex_dtr->dtr_emp_header($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['dtr_emp_rec'] = $this->mindex_dtr->dtr_emp_rec($sel_name,$cutoffdate,$sel_month,$sel_year);
// 			$data['dtr_emp_getleave'] = $this->mindex_dtr->dtr_emp_getleave();
// 			$data['record'] = array('hid_sel_name' => $sel_name,  'hid_sel_month' => $sel_month, 'hid_sel_year' => $sel_year,
// 							'post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/dtr_summary',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 		else 
// 		{

// 			$data['post_disable'] = 0;
// 			$data['record'] = array('post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
// 			$data['post_GetEmpLeaveAvailable']= $this->mindex_dtr->post_GetEmpLeaveAvailable($post_name,$post_month,$post_year);
// 			$data['post_GetCurrentLeaveAvailable']= $this->mindex_dtr->dtr_emp_getleave();
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/view_post_dtr',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 		}
// 	}
// 	public function view_posted_dtr()
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
// 			$data['treeview_dtr'] ="";
// 			$data['treeview_holiday'] ="";
// 			$data['treeview_daily_task'] ="";
// 			$data['post_disable'] = 1;
// 			$data['post_name'] = $post_name;
// 			$data['post_month'] = $post_month;
// 			$data['post_year'] = $post_year;
// 			$data['sel_name'] = $post_name;
// 			$data['sel_year'] = $post_year;
// 			$data['sel_month'] = $post_month;
// 			$this->mindex_dtr->post_InsertCurrentLeaveAvailable();
// 			$data['record'] = array('post_sel_name' => $sel_name,  'post_sel_month' => $sel_month, 'post_sel_year' => $sel_year);
// 			$data['post_GetEmpLeaveAvailable']= $this->mindex_dtr->post_GetEmpLeaveAvailable($post_name,$post_month,$post_year);
// 			$data['post_GetCurrentLeaveAvailable']= $this->mindex_dtr->dtr_emp_getleave();
// 			$data['user_lname']= $this->session->userdata('user_lname');
// 			$data['user_fname'] = $this->session->userdata('user_fname');
// 			$data['user_position']= $this->session->userdata('user_position');
// 			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
// 			$this->load->view('header/header_admin',$data);
// 			$this->load->view('admin/view_post_dtr',$data);
// 			$this->load->view('footer/footer_admin',$data);
// 	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */