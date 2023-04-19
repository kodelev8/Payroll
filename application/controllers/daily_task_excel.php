<?php
class daily_task_excel extends CI_Controller
{
	function __construct() 
	{		
		parent::__construct();
		$this->load->model( array( 'mindex_daily_task','mglobal') );     
	}

	function index()
	{
		include ('system/excel/PHPExcel.php');					
		include('system/excel/PHPExcel/Writer/Excel5.php');
		
		$dt_emp_no = $this->input->post('hid_dt_emp_no');
		$dt_date_from = $this->input->post('hid_dt_from');
		$dt_date_to = $this->input->post('hid_dt_to');
		$dt_week = $this->input->post('hid_dt_week');
		$dt_emp_name = $this->mindex_daily_task->get_emp_name($dt_emp_no);
		$vw_daily_task = $this->mindex_daily_task ->get_daily_task($dt_emp_no,$dt_date_from,$dt_date_to);
		$get_total_hrs = $this->mindex_daily_task ->get_dt_totalhours($dt_emp_no,$dt_date_from,$dt_date_to);
		$countdt = count($vw_daily_task);
		$row_num = $countdt -1;
		$objPHPExcel = new PHPExcel();			
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->setTitle("$dt_emp_name->dt_emp_name");
		
		// Set default style
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setName('Book Antiqua');			
		
		// Set printing options
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
		
		// Set row height
//		$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(61.5);
//		$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(22.5);

		//Modify cell's style			
		$fontstyle1 = array( 'name'   => 'Book Antiqua', 'bold'   => true, 'size'   => 10 );			
		$fontstyle2 = array( 'bold'   => true );			
		$fontstyle3 = array( 'bold'   => true, 'size'   => 18 );
		$fontstyle4 = array( 'name'   => 'Book Antiqua', 'bold'   => false, 'size'   => 10 );
	
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
		//style
		$objPHPExcel->getActiveSheet()->getStyle('A5:A5')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('A6:A1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('B6:B1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('C6:C1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('D6:D1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('E6:E1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('F6:F1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('G6:G1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('H6:H1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('I6:I1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('J6:J1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('K6:K1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('L6:L1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('M6:M1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('N6:N1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('O6:O1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		$objPHPExcel->getActiveSheet()->getStyle('P6:P1000')->applyFromArray( array( 'alignment' => $align_center,'font' => $fontstyle4 ) );
		//Set column width
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12.14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12.14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30.29);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15.29);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17.86);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.14);			
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15.14);						
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15.14);
		//Color Cells
//		$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
//		$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
//		$objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
//		$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => '#CCFFFF')));
		//Format cells
		$objPHPExcel->getActiveSheet()->getStyle('A7:A1000')->getNumberFormat()->setFormatCode('YYYY-MM-DD');
		$objPHPExcel->getActiveSheet()->getStyle('B2:B3')	->getNumberFormat()->setFormatCode('YYYY-MM-DD');
		$objPHPExcel->getActiveSheet()->getStyle('B7:B1000')->getNumberFormat()->setFormatCode('HH:MM:SS AM/PM');
		$objPHPExcel->getActiveSheet()->getStyle('C7:C1000')->getNumberFormat()->setFormatCode('HH:MM:SS AM/PM');
		$objPHPExcel->getActiveSheet()->getStyle('G7:G1000')->getNumberFormat()->setFormatCode('HH:MM:SS');
		$objPHPExcel->getActiveSheet()->getStyle('H7:H1000')->getNumberFormat()->setFormatCode('HH:MM:SS');
		$objPHPExcel->getActiveSheet()->getStyle('I7:I1000')->getNumberFormat()->setFormatCode('HH:MM:SS');
		//contents
		//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->getRGB('FF0000');
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name:');
// 		$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Date From:');
// 		$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Date To:');
		$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Week '.$dt_week);
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', $dt_emp_name->dt_emp_name);
// 		$objPHPExcel->getActiveSheet()->SetCellValue('B2', date('Y-m-d',strtotime($dt_date_from)));
// 		$objPHPExcel->getActiveSheet()->SetCellValue('B3', date('Y-m-d',strtotime($dt_date_to)));
		$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle('A6:I6')->applyFromArray( array('font' => $fontstyle1 ));
		$objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('B6', 'In');
		$objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Out');
		$objPHPExcel->getActiveSheet()->SetCellValue('D6', 'Remarks/Specific');
		$objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Non Billable');
		$objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Billable');
		$objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Hours Log');
		$objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Hours per day');
		$objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Hours per week');
		
		$a = 7;
		$b=1;
		$dt_date = "";
		foreach($vw_daily_task as $dt)
		{	
			
			$dt_date = $dt->dt_date;
			$objPHPExcel->getActiveSheet()->getStyle("A4:A5")->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle("A6:I6")->applyFromArray($styleArray2);
			if($countdt== $b)	
			{
				$dt_date = $dt->dt_date;
				$dt_hours_per_day = $this->mindex_daily_task->get_dt_totalhours_per_day($dt_emp_no,$dt_date);
				$objPHPExcel->getActiveSheet()->getStyle("A".$a.":I".$a)->applyFromArray($styleArray2);
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a, date('Y-m-d',strtotime($vw_daily_task[$row_num]->dt_date)));
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a, $dt->dt_in);
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a, $dt->dt_out);
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a, $dt->dt_remarks);
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$a, '');
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$a, '');
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$a, $dt->dt_total_log);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a, '');
				$a=$a+1;
				$objPHPExcel->getActiveSheet()->getStyle('H'.$a)->applyFromArray( array('font' => $fontstyle1 ));
				$objPHPExcel->getActiveSheet()->getStyle("A".$a.":I".$a)->applyFromArray($styleArray2);
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a, $dt_hours_per_day->dt_total_log_per_day);
				$a=$a+1;
				$objPHPExcel->getActiveSheet()->getStyle('I'.$a)->applyFromArray( array('font' => $fontstyle1 ));
				$objPHPExcel->getActiveSheet()->getStyle("A".$a.":I".$a)->applyFromArray($styleArray2);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$a, $get_total_hrs->dt_total_log);
			}
			else
			{
				if($vw_daily_task[$b]->dt_date == $dt_date )
				{
					
					$objPHPExcel->getActiveSheet()->getStyle("A".$a.":I".$a)->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a, date('Y-m-d',strtotime($dt->dt_date)));
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a, $dt->dt_in);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a, $dt->dt_out);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a, $dt->dt_remarks);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$a, $dt->dt_total_log);
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a, '');
				}
				else
				{
					$dt_date = $dt->dt_date;
					$dt_hours_per_day = $this->mindex_daily_task->get_dt_totalhours_per_day($dt_emp_no,$dt_date);
					$objPHPExcel->getActiveSheet()->getStyle("A".$a.":I".$a)->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a,date('Y-m-d',strtotime( $dt->dt_date)));
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a, $dt->dt_in);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a, $dt->dt_out);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a, $dt->dt_remarks);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$a,  $dt->dt_total_log);
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a, '');
					$a=$a+1;
					$objPHPExcel->getActiveSheet()->getStyle('H'.$a)->applyFromArray( array('font' => $fontstyle1 ));
					$objPHPExcel->getActiveSheet()->getStyle("A".$a .":I".$a)->applyFromArray($styleArray2);
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$a, '');
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$a, $dt_hours_per_day->dt_total_log_per_day);
				}
			}
		$b=$b+1;
		$a=$a+1;
		}
			$objPHPExcel->getActiveSheet()->getStyle('I'.$a)->applyFromArray( array('font' => $fontstyle1));
			
  			

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle("$dt_emp_name->dt_first_name $dt_emp_name->dt_last_name");
		
		// Save Excel 2003 file
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);			
		$filename="Week(".$dt_week.")_".$dt_emp_name->dt_first_name.$dt_emp_name->dt_last_name.".xls";			
		header("Content-type: application/excel");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");			
		header("Expires: 0");

		//Flush excel file
		echo $objWriter->save('php://output');
	}	
	
}