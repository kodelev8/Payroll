<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class dtr_pdf extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model( array( 'mindex_dtr_pdf') );  
		$this->load->library('pdf'); // Load library
		$this->pdf->fontpath = 'font/'; // Specify font folder
	}

	public function index()
	{
		$name =  $this->input->post('hid_sel_name');
		$month =  $this->input->post('hid_sel_month');
		$year =  $this->input->post('hid_sel_year');
		$cutoffdate = "0";
		$emp_no = $this->input->post('emp_no');		
		$dtr_emp_header = $this->mindex_dtr_pdf->dtr_emp_header($name, $cutoffdate, $month, $year);
		$dtr_emp_rec = $this->mindex_dtr_pdf->dtr_emp_rec($name, $cutoffdate, $month, $year);
		$dtr_emp_getleave = $this->mindex_dtr_pdf->dtr_emp_getleave();
	
		 $this->mindex_dtr_pdf->print_dtr($dtr_emp_header,$dtr_emp_rec,$dtr_emp_getleave,$cutoffdate,$year,$month,$name) ;
	}
}
?>