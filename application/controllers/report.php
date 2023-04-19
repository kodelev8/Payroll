<?php
class report extends CI_Controller
{
	function __construct() 
	{		
		parent::__construct();
		$this->load->model( array( 'mindex_report','mglobal') );     
	}

	function index()
	{
		include ('system/excel/PHPExcel.php');					
		include('system/excel/PHPExcel/Writer/Excel5.php');
		$enddate  = $this->input->post('enddate');
		$startdate  = $this->input->post('startdate');
		$report_emp_position = $this->input->post('report_emp_position');
		$report_emp_no = $this->input->post('report_emp_no');
		$option = $this->input->post('option');
		$report = $this->input->post('btn-report');
		$list_emp_position = $this->mindex_report->list_emp_position();
		$list_emp_no = $this->mindex_report->list_emp_no();
		
		
		
		if(!$report)
		{
			$data['report_emp_no'] = $list_emp_no[0]->emp_no;
			$data['list_emp_no']=$list_emp_no;
			$data['list_emp_position']=$list_emp_position;
			$data['menu_name'] = "report";
			$data['get_treeview'] = $this->mindex_report->get_treeview('treeview_reports');
			$data['post_month'] = "";
			$data['post_year'] = "";
			$data['post_name']= "";
			$data['user_lname']= $this->session->userdata('user_lname');
			$data['user_fname'] = $this->session->userdata('user_fname');
			$data['user_position']= $this->session->userdata('user_position');
			$data['user_picture'] = substr($this->session->userdata('user_picture'), 1);
			$this->load->view('header/header_admin',$data);
			$this->load->view('admin/view_reports',$data);
			$this->load->view('footer/footer_admin',$data);
		}
		else 
		{
			
			if($option == 'employee_no')
			{
				$timesheets_report = $this->mindex_report->timesheets_report_emp_no($report_emp_no,$startdate,$enddate);
				$payslips_report = $this->mindex_report->payslips_report_emp_no($report_emp_no,$startdate,$enddate);
				$deduction_report_emp_position = $this->mindex_report->deduction_report_emp_no($report_emp_no,$startdate,$enddate);
			}
			elseif ($option ='employee_position')
			{
				$timesheets_report = $this->mindex_report->timesheets_report_emp_position($report_emp_position,$startdate,$enddate);
				$payslips_report = $this->mindex_report->payslips_report_emp_position($report_emp_position,$startdate,$enddate);
				$deduction_report_emp_position = $this->mindex_report->deduction_report_emp_position($report_emp_position,$startdate,$enddate);
			}
 


			// 		$objReader = PHPExcel_IOFactory::createReader('Excel5');
			
			// 		$objPHPExcel = $objReader->load("templates/temp/report.xlxs");
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->getActiveSheet()->setTitle(" ");
			
			// Set default style
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
			
			// Set printing options
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
			
			// Set row height
			//		$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(61.5);
			//		$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(22.5);
			
			//Modify cell's style
			$fontstyle1 = array( 'name'   => 'Calibri', 'bold'   => true, 'size'   => 10 );
			$fontstyle2 = array( 'bold'   => true );
			$fontstyle3 = array( 'bold'   => true, 'size'   => 18 );
			$fontstyle4 = array( 'name'   => 'Book Antiqua', 'bold'   => false, 'size'   => 10 );
			$fontstyle4 = array( 'underline'  => true, 'bold'   => true, 'size'   => 12 );
			
			$align_left   = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap'       => false );
			
			$align_right  = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap'       => false );
			
			$align_center = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'wrap'       => false );
			
			$styleArray = array(
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
									'color' => array('rgb' => 'a4a4a4'),
							)
					)
			);
			
			$styleArray2 = array(
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
									'color' => array('rgb' => '000000'),
							)
					)
			);
			
			$styleArray3 = array(
					'borders' => array(
							'top' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
									'color' => array('rgb' => '000000'),
							)
					)
			);
			
			$styleArray4 = array(
					'borders' => array(
							'left' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
									'color' => array('rgb' => '669999'),
							)
					)
			);
			
			$styleArray5 = array(
					'borders' => array(
							'bottom' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
									'color' => array('rgb' => '000000'),
							)
					)
					);
			//style
			$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) ); 
			//Set column width
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(48.56);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.14); 
			
			//Color Cells
			//		$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
			//		$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
			//		$objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
			//		$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
			//Format cells
// 					$objPHPExcel->getActiveSheet()->getStyle('D2:D10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('E2:E10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('F2:F10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('G2:G10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('H2:H10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('I2:I10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('J2:J10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('K2:K10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('L2:L10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('M2:M10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('N2:N10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('O2:O10000')->getNumberFormat()->setFormatCode('0.000');
// 					$objPHPExcel->getActiveSheet()->getStyle('P2:P10000')->getNumberFormat()->setFormatCode('YYYY-MM-DD');
// 					$objPHPExcel->getActiveSheet()->getStyle('Q2:Q10000')->getNumberFormat()->setFormatCode('YYYY-MM-DD');
			$objPHPExcel->getActiveSheet()->freezePane('A3');

			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Timesheet Date: '.$startdate.' - '.$enddate);
			$objPHPExcel->getActiveSheet()->SetCellValue('A2','EMPLOYEE NAME');
			$objPHPExcel->getActiveSheet()->SetCellValue('B2','DESCRIPTION');
			$objPHPExcel->getActiveSheet()->SetCellValue('C2','DEDUCTION AMOUNT');
			$objPHPExcel->getActiveSheet()->SetCellValue('D2','DATE'); 
			//contents
			//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->getRGB('FF0000');
				
			$a= 3; 
			foreach ($deduction_report_emp_position as $deduct_report)
			{
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a,$deduct_report['Deduction_Emp_Name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a,$deduct_report['Deduction_Description']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a,number_format((float)$deduct_report['Deduction_Amount'], 2, '.', ''));
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a,DATE('d-m-Y',strtotime($deduct_report['Deduction_Date']))); 
				$a=$a+1;
			}
			$a=$a-1;
			$objPHPExcel->getActiveSheet()->getStyle("A2:A".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("B2:B".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("C2:C".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("D2:D".$a)->applyFromArray($styleArray2);  
			$objPHPExcel->getActiveSheet()->setTitle("DEDUCTIONS");
			// 		$objPHPExcel = new PHPExcel();
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(1);
			
			$objPHPExcel->getActiveSheet(1)->setTitle(" ");
			
			// Set default style
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
			//style
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('O1:O100')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('T1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('U1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('V1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
// 			$objPHPExcel->getActiveSheet()->getStyle('O9')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
			//Set column width
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(48.56);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15.00);

			// 		$objPHPExcel->getActiveSheet()->getStyle('E2:E10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('F2:F10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('G2:G10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('H2:H10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('I2:I10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('J2:J10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('K2:K10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('L2:L10000')->getNumberFormat()->setFormatCode('YYYY-MM-DD');
			// 		$objPHPExcel->getActiveSheet()->getStyle('M2:M10000')->getNumberFormat()->setFormatCode('YYYY-MM-DD');
			// Set printing options
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
			$objPHPExcel->getActiveSheet()->freezePane('A2');
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','EMP NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','EMP NAME');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','POSITION');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','RATE/ DAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','NO OF DAYS');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','DEDUCTION');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','ALLOWANCE');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','SUB NET PAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','OVERTIME');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','NIGHT OVERTIME');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','TOTAL OT PAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','TOTAL NET PAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','DATE FROM');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1','DATE TO');
			//contents
			//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->getRGB('FF0000');
				
			$a= 2;
			$total_wages = 0; 
			$ps_report_datefrom ='';
			$ps_report_dateto ='';
			foreach ($payslips_report as $ps_report)
			{
				$ps_report_date_from =date('d-m-Y',strtotime($ps_report->Ps_Date_From));
				$ps_report_date_to =date('d-m-Y',strtotime($ps_report->Ps_Date_To));
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a,$ps_report->Ps_Emp_No);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a,$ps_report->Ps_Emp_Name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a,$ps_report->Ps_Emp_Position);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a,$ps_report->Ps_Emp_wages);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$a,number_format((float)$ps_report->Ps_Total_Hours, 2, '.', '')/8);
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$a,$ps_report->Ps_Sub);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$a,$ps_report->Ps_Add);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a,$ps_report->Ps_Base_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$a,$ps_report->Ps_OT_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$a,$ps_report->Ps_Night_OT_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$a,$ps_report->Ps_Total_OT_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$a,$ps_report->Ps_Total_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('M'.$a,$ps_report_date_from);
				$objPHPExcel->getActiveSheet()->SetCellValue('N'.$a,$ps_report_date_to);
					
				$a=$a+1;
				$total_wages= $total_wages +$ps_report->Ps_Total_Pay;
			}
			$a=$a-1;
			$objPHPExcel->getActiveSheet()->getStyle("A1:A".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("B1:B".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("C1:C".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("D1:D".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("E1:E".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("F1:F".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("G1:G".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("H1:H".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("I1:I".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("J1:J".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("K1:K".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("L1:L".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("M1:M".$a)->applyFromArray($styleArray2); 
			$objPHPExcel->getActiveSheet()->getStyle("N1:N".$a)->applyFromArray($styleArray2);
 			$objPHPExcel->getActiveSheet()->getStyle("O9")->applyFromArray($styleArray5);
 			$objPHPExcel->getActiveSheet()->getStyle("O14")->applyFromArray($styleArray5);
 			$objPHPExcel->getActiveSheet()->getStyle("O19")->applyFromArray($styleArray5);
 			
 			

 			$objPHPExcel->getActiveSheet()->SetCellValue('O10','PREPARED BY:');

 			$objPHPExcel->getActiveSheet()->SetCellValue('O15','CHECKED BY:');
 			$objPHPExcel->getActiveSheet()->SetCellValue('O20','APPROVED BY:');
 			$objPHPExcel->getActiveSheet()->SetCellValue('O25','TOTAL AMOUNT:');
			$objPHPExcel->getActiveSheet()->SetCellValue('O26',$total_wages);
			$objPHPExcel->getActiveSheet()->setTitle("PAYROLL");
			
// 			// Rename sheet
// 			$objPHPExcel->setActiveSheetIndex(0);
			// Save Excel 2003 file
			
			
			
			
			
			
			
			
			
			$objPHPExcel->createSheet(); 
			$objPHPExcel->setActiveSheetIndex(2);
				
			$objPHPExcel->getActiveSheet()->setTitle(" ");
				
			// Set default style
			  
			$objPHPExcel->getActiveSheet()->freezePane('A3');
			
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Timesheet Date: '.$startdate.' - '.$enddate);
			$objPHPExcel->getActiveSheet()->SetCellValue('A2','EMP NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('B2','EMP NAME');
			$objPHPExcel->getActiveSheet()->SetCellValue('C2','POSITION');
			$objPHPExcel->getActiveSheet()->SetCellValue('D2','MONDAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('E2','TUESDAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('F2','WEDNESDAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('G2','THURSDAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('H2','FRIDAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('I2','SATURDAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('J2','SUNDAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('K2','NORMAL HOURS');
			$objPHPExcel->getActiveSheet()->SetCellValue('L2','OT HOURS');
			$objPHPExcel->getActiveSheet()->SetCellValue('M2','NIGHT OT HOURS');
			$objPHPExcel->getActiveSheet()->SetCellValue('N2','TOTAL OT HOURS');
			$objPHPExcel->getActiveSheet()->SetCellValue('O2','TOTAL HOURS');
			$objPHPExcel->getActiveSheet()->SetCellValue('P2','STARTDATE');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q2','ENDDATE'); 
			//contents
			//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->getRGB('FF0000');
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(48.56);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20.00); 
			$a= 3;
			foreach ($timesheets_report as $ts_report)
			{
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a,$ts_report->emp_no);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a,$ts_report->emp_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a,$ts_report->emp_position);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a,$ts_report->monday);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$a,$ts_report->tuesday);
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$a,$ts_report->wednesday);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$a,$ts_report->thursday);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a,$ts_report->friday);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$a,$ts_report->saturday);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$a,$ts_report->sunday);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$a,$ts_report->normal_hours);
				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$a,$ts_report->ot_hours);
				$objPHPExcel->getActiveSheet()->SetCellValue('M'.$a,$ts_report->night_ot_hours);
				$objPHPExcel->getActiveSheet()->SetCellValue('N'.$a,$ts_report->total_ot_hours);
				$objPHPExcel->getActiveSheet()->SetCellValue('O'.$a,$ts_report->total_hours);
				$objPHPExcel->getActiveSheet()->SetCellValue('P'.$a,date('d-m-Y',strtotime($ts_report->startdate)));
				$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$a,date('d-m-Y',strtotime($ts_report->enddate))); 
				$a=$a+1;
			}
			$a=$a-1;
			$objPHPExcel->getActiveSheet()->getStyle("A2:A".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("B2:B".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("C2:C".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("D2:D".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("E2:E".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("F2:F".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("G2:G".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("H2:H".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("I2:I".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("J2:J".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("K2:K".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("L2:L".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("M2:M".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("N2:N".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("O2:O".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("P2:P".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("Q2:Q".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->setTitle("TIMESHEETS");
			// 		$objPHPExcel = new PHPExcel();
			$objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex(3);
				
			$objPHPExcel->getActiveSheet(3)->setTitle(" ");
				
			// Set default style
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Calibri');
			//style
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('M1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('N1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('O1:O100')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('P1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('Q1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('R1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('S1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('T1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('U1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			$objPHPExcel->getActiveSheet()->getStyle('V1')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle1 ) );
			// 			$objPHPExcel->getActiveSheet()->getStyle('O9')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
			//Set column width
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(48.56);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12.14);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20.00);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15.00);
			
			// 		$objPHPExcel->getActiveSheet()->getStyle('E2:E10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('F2:F10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('G2:G10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('H2:H10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('I2:I10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('J2:J10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('K2:K10000')->getNumberFormat()->setFormatCode('0.000');
			// 		$objPHPExcel->getActiveSheet()->getStyle('L2:L10000')->getNumberFormat()->setFormatCode('YYYY-MM-DD');
			// 		$objPHPExcel->getActiveSheet()->getStyle('M2:M10000')->getNumberFormat()->setFormatCode('YYYY-MM-DD');
			// Set printing options
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
			$objPHPExcel->getActiveSheet()->freezePane('A2');
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','EMP NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','EMP NAME');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','POSITION');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','RATE/ DAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','NO OF DAYS');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','DEDUCTION');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','ALLOWANCE');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','SUB NET PAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','OVERTIME');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','NIGHT OVERTIME');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','TOTAL OT PAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','TOTAL NET PAY');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','DATE FROM');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1','DATE TO');
			//contents
			//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->getRGB('FF0000');
			
			$a= 2;
			$total_wages = 0;
			$ps_report_datefrom ='';
			$ps_report_dateto ='';
			foreach ($payslips_report as $ps_report)
			{
				$ps_report_date_from =date('d-m-Y',strtotime($ps_report->Ps_Date_From));
				$ps_report_date_to =date('d-m-Y',strtotime($ps_report->Ps_Date_To));
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a,$ps_report->Ps_Emp_No);
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a,$ps_report->Ps_Emp_Name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a,$ps_report->Ps_Emp_Position);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a,$ps_report->Ps_Emp_wages);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$a,number_format((float)$ps_report->Ps_Total_Hours, 2, '.', '')/8);
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$a,$ps_report->Ps_Sub);
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$a,$ps_report->Ps_Add);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a,$ps_report->Ps_Base_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$a,$ps_report->Ps_OT_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$a,$ps_report->Ps_Night_OT_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$a,$ps_report->Ps_Total_OT_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$a,$ps_report->Ps_Total_Pay);
				$objPHPExcel->getActiveSheet()->SetCellValue('M'.$a,$ps_report_date_from);
				$objPHPExcel->getActiveSheet()->SetCellValue('N'.$a,$ps_report_date_to);
					
				$a=$a+1;
				$total_wages= $total_wages +$ps_report->Ps_Total_Pay;
			}
			$a=$a-1;
			$objPHPExcel->getActiveSheet()->getStyle("A1:A".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("B1:B".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("C1:C".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("D1:D".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("E1:E".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("F1:F".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("G1:G".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("H1:H".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("I1:I".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("J1:J".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("K1:K".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("L1:L".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("M1:M".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("N1:N".$a)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("O9")->applyFromArray($styleArray5);
			$objPHPExcel->getActiveSheet()->getStyle("O14")->applyFromArray($styleArray5);
			$objPHPExcel->getActiveSheet()->getStyle("O19")->applyFromArray($styleArray5);
			
			
			
			$objPHPExcel->getActiveSheet()->SetCellValue('O10','PREPARED BY:');
			
			$objPHPExcel->getActiveSheet()->SetCellValue('O15','CHECKED BY:');
			$objPHPExcel->getActiveSheet()->SetCellValue('O20','APPROVED BY:');
			$objPHPExcel->getActiveSheet()->SetCellValue('O25','TOTAL AMOUNT:');
			$objPHPExcel->getActiveSheet()->SetCellValue('O26',$total_wages);
			$objPHPExcel->getActiveSheet()->setTitle("PAYROLL");
				
			// Rename sheet
			$objPHPExcel->setActiveSheetIndex(0);
			
 
			
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$filename="PLiwanag_Reports_".$ps_report_date_from."-".$ps_report_date_to.".xlsx";
			header("Content-type: application/excel");
			header("Content-Disposition: attachment; filename=$filename");
			header("Pragma: no-cache");
			header("Expires: 0");
			
			//Flush excel file
			echo $objWriter->save('php://output');
			
			
			
		}
		
		
		
		
	}	
	
}