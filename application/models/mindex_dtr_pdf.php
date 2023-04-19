<?php
/**
 * -------------------------------------------------------------------
 * mIndex Model
 * -------------------------------------------------------------------
 * This file is for the sql queries.
 * Author:  
 */
class mindex_dtr_pdf extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Function ...
	 * This function ...
	 */

   	function dtr_emp_rec($name= '', $cutoffdate = 0, $month = 0, $year = 0)
   	{
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("spGetEmpDTR @EMPNAME='$name', @CUTOFFDATE='$cutoffdate', @MONTH='$month',  @YEAR='$year' ");
		return $query->result_array();
	}
   	function dtr_emp_header($name= '', $cutoffdate = 0, $sel_month = 0, $sel_year = 0)
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("spGetEmpHeaderDTR @EMPNAME='$name', @CUTOFFDATE='$cutoffdate', @MONTH='$sel_month',  @YEAR='$sel_year' ");
	 	return $query->result_array();
	 	
	}	
 	function dtr_emp_getleave()
    {
    	$this->dbAll = $this->load->database('default', TRUE);
  		$query = $this->dbAll->query("spGetCurrentLeaveAvailable ");
	 	return $query->result_array();
	 	
	}
	function print_dtr($dtr_emp_header="",$dtr_emp_rec="",$dtr_emp_getleave="",$cutoffdate ="",$year ="",$month ="",$name ="")
	{
		foreach($dtr_emp_header as $header):
		endforeach; 
		
		foreach($dtr_emp_getleave as $getleave):
		endforeach; 

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false, true);  
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('courierBI', 'B', 20);
		$pdf->AddPage();
		$pdf->SetFont('helvetica', '', 8);
		$html1 = "";
		if ($pdf->PageNo() == 1) 
 		 {		
 		 	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$html1 .= '<table>';
					$html1 .= '<tr>';
						$html1 .= '<td width="100">';
						$html1 .="Employee Name";
						$html1 .= "</td>";
						$html1 .= '<td width="8">';
						$html1 .=":";
						$html1 .= "</td>";
						$html1 .= '<td>';
						$html1 .=$header['Employee Name'];
						$html1 .= "</td>";
					$html1 .= "</tr>";
					$html1 .= '<tr>';
						$html1 .= '<td width="100">';
						$html1 .="Month";
						$html1 .= "</td>";
						$html1 .= '<td width="8">';
						$html1 .=":";
						$html1 .= "</td>";
						$html1 .= '<td>';
						$html1 .=$header['Month'];
						$html1 .= "</td>";
					$html1 .= "</tr>";
					$html1 .= '<tr>';
						$html1 .= '<td width="100">';
						$html1 .="Year";
						$html1 .= "</td>";
						$html1 .= '<td width="8">';
						$html1 .=":";
						$html1 .= "</td>";
						$html1 .= '<td>';
						$html1 .=$header['Year'];
						$html1 .= "</td>";
					$html1 .= "</tr>";
				$html1 .= "</table>";
							$html1 .= "<br></br>";	
				$html1 .= '<table border=".5">';
					$html1 .= '<tr bgcolor="#C0C2CF">';
						$html1 .= '<td style="font-weight:bold;" width="150">';
						$html1 .=" Date";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="150" >';
						$html1 .= " Log In";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="150">';
						$html1 .= " Log Out";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="150">';
						$html1 .= " Total Log";
						$html1 .= "</td>";
					$html1 .= "</tr>";
					foreach($dtr_emp_rec as $rec):		
					$html1 .= "<tr>";
						$html1 .= "<td> " .$rec['DATE']. "</td>";
						$html1 .= "<td> " .$rec['LOG IN']. "</td>";
						$html1 .= "<td> " .$rec['LOG OUT']."</td>";
						$html1 .= "<td> " .$rec['TOTAL HRS LOG']. "</td>";
					$html1 .= "</tr> ";
					endforeach;
					$html1 .= "</table> ";
					$html1 .= "<br></br>";
	

			$html1 .= '<br></br>';
				$html1 .= '<table>';
					$html1 .= '<tr>';
						$html1 .= '<td> Employee';
						$html1 .= '</td>';
						$html1 .= '<td>Signed By:';
						$html1 .= '</td>';
					$html1 .= '</tr>';
					$html1 .= '<tr>';
						$html1 .= '<td>____________________';
						$html1 .= '</td>';
						$html1 .= '<td>__________________________';
						$html1 .= '</td>';
					$html1 .= '</tr>';
					$html1 .= '<tr>';
						$html1 .= '<td>'.$header['Employee Name'];;
						$html1 .= '</td>';
						$html1 .= '<td>Percival Liwanag';
						$html1 .= '</td>';
					$html1 .= '</tr>';
				$html1 .= '</table>';
		
			$x = $pdf->PageNo() + 1;
			$pdf->writeHTML($html1, true, false, false, false, '');
	 	 }
						  
			$filename= $header['Employee Name'];
			$filedate = date("mdY_his");
			  
			$pdffilename = "$filename".'_'."$filedate.pdf";
			
			$pdf->Output("$filename".'_'."$filedate.pdf","D");
	}

	function print_all_summary($dtr_emp_name="",$name ="",$cutoffdate ="",$dtr_month ="",$dtr_year ="",$count_user="")
	{
		$dtr_emp_header="";
		$dtr_emp_rec="";
		$dtr_emp_getleave="";
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false, true);  
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->SetFont('courierBI', 'B', 20);
		$pdf->AddPage();
		$pdf->SetFont('helvetica', '', 8);
		$html1 = "";
		if ($pdf->PageNo() != 0) 
			{				
		  	foreach($dtr_emp_name as $get_user):
		  		$name =$get_user;
				$dtr_emp_rec = $this->mindex_dtr_pdf->dtr_emp_rec($name, $cutoffdate, $dtr_month, $dtr_year);
				$dtr_emp_header = $this->mindex_dtr_pdf->dtr_emp_header($name, $cutoffdate, $dtr_month, $dtr_year);		
				$dtr_emp_getleave = $this->mindex_dtr_pdf->dtr_emp_getleave($name, $cutoffdate, $dtr_month, $dtr_year);
				foreach($dtr_emp_header as $header):
				foreach($dtr_emp_getleave as $getleave):
				endforeach; 
				endforeach; 
				$html1 .= '<table>';
					$html1 .= '<tr>';
						$html1 .= '<td width="100">';
						$html1 .="Employee Name";
						$html1 .= "</td>";
						$html1 .= '<td width="8">';
						$html1 .=":";
						$html1 .= "</td>";
						$html1 .= '<td> <br\>';
						$html1 .= $name;
						$html1 .= "</td>";
					$html1 .= "</tr>";
						$html1 .= '<tr>';
						$html1 .= '<td width="100">';
						$html1 .="Cut Off Date";
						$html1 .= "</td>";
						$html1 .= '<td width="8">';
						$html1 .=":";
						$html1 .= "</td>";
						$html1 .= '<td>';
						$html1 .=$header['Cut Off Date'];
						$html1 .= "</td>";
					$html1 .= "</tr>";
					$html1 .= '<tr>';
						$html1 .= '<td width="100">';
						$html1 .="Month";
						$html1 .= "</td>";
						$html1 .= '<td width="8">';
						$html1 .=":";
						$html1 .= "</td>";
						$html1 .= '<td>';
						$html1 .=$header['Month'];
						$html1 .= "</td>";
					$html1 .= "</tr>";
					$html1 .= '<tr>';
						$html1 .= '<td width="100">';
						$html1 .="Year";
						$html1 .= "</td>";
						$html1 .= '<td width="8">';
						$html1 .=":";
						$html1 .= "</td>";
						$html1 .= '<td>';
						$html1 .=$header['Year'];
						$html1 .= "</td>";
					$html1 .= "</tr>";
				$html1 .= "</table>";
				$html1 .="<table><tr><td></td></tr></table>";
				$html1 .= '<table border=".5">';
					$html1 .= '<tr bgcolor="#C0C2CF">';
						$html1 .= '<td style="font-weight:bold;" width="60">';
						$html1 .=" Date";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="60" >';
						$html1 .= " Log In";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="60">';
						$html1 .= " Log Out";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="60">';
						$html1 .= " Total Log";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="60">';
						$html1 .= " Lunch-Out";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="60">';
						$html1 .= " Lunch-In";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="60">';
						$html1 .= " Total Lunch";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="68">';
						$html1 .= " Total Worked";
						$html1 .= "</td>";
						$html1 .= '<td style="font-weight:bold;" width="150">';
						$html1 .= " Remarks";
						$html1 .= "</td>";
					$html1 .= "</tr>";
					foreach($dtr_emp_rec as $rec):		
					$html1 .= "<tr>";
						$html1 .= "<td> " .$rec['DATE']. "</td>";
						$html1 .= "<td> " .$rec['LOG IN']. "</td>";
						$html1 .= "<td> " .$rec['LOG OUT']."</td>";
						$html1 .= "<td> " .$rec['TOTAL HRS LOG']. "</td>";
						$html1 .= "<td> " .$rec['LUNCH BREAK - OUT']."</td>";
						$html1 .= "<td> " .$rec['LUNCH BREAK - IN']."</td>";
						$html1 .= "<td> " .$rec['TOTAL HRS BREAK']."</td>";
						$html1 .= "<td> " .$rec['TOTAL HRS WORKED']."</td>";
						$html1 .= "<td> " .substr($rec['REMARKS'],0,28). "</td>";
					$html1 .= "</tr> ";
					endforeach;
					$html1 .= "<tr>";
						$html1 .= '<td style="font-weight:bold;"> Total</td>';
						$html1 .= '<td style="font-weight:bold;"> </td>';
						$html1 .= '<td style="font-weight:bold;"> </td>';
						$html1 .= '<td style="font-weight:bold;"> '.$header['Total Log'].'</td>';
						$html1 .= '<td style="font-weight:bold;"></td>';
						$html1 .= '<td style="font-weight:bold;"></td>';
						$html1 .= '<td style="font-weight:bold;"> '.$header['Total Lunch'].'</td>';
						$html1 .= '<td style="font-weight:bold;"> '.$header['Total Worked'].'</td>';
						$html1 .= '<td style="font-weight:bold;"> </td>';
					$html1 .= "</tr> ";
			$html1 .= "</table>";
				$html1 .="<table><tr><td></td></tr></table>";
			$html1 .= '<table align="center" style="width:90%; margin: 50px;"  >';
				$html1 .= '	<tr>';
					$html1 .= '<td>';
						$html1 .= '<div>';
							$html1 .= '<fieldset style= "margin-top:-85px; border: 0px;">';
								 $html1 .= '<h4>Computation Hrs Worked</h4>';
								$html1 .= '<div>';
									$html1 .= '<table class="tbl-dtr-hrs" border=".5">';
										$html1 .= '<tbody>';
											$html1 .= '<tr align="right">';
												$html1 .= '<td align="left" style="width:200px;">Total Hrs Log</td><td style="width:60px; text-align:right;">'.$header['Total Hrs Log'].'</td>';
											$html1 .= '</tr>';
											$html1 .= '<tr align="right">';
												$html1 .= '<td align="left" style="font-style:italic;width:200px;">less</td><td>&nbsp;</td>';
											$html1 .= '</tr>';
											$html1 .= '<tr>';
												$html1 .= '<td align="left" style="width:200px;">-   Total Hrs Lunch</td><td style="width:60px; text-align:right;">'.$header['Total Hrs Lunch'].'</td>';
											$html1 .= '</tr>';
											$html1 .= '<tr align="right">';
												$html1 .= '<td align="left">Total Hrs Worked</td><td id="total" style="width:60px; text-align:right;">'.$header['Total Hrs Worked'].'</td>';
											$html1 .= '</tr>';
										$html1 .= '</tbody>';
									$html1 .= '</table>';
								$html1 .= '</div>';
							$html1 .= '</fieldset>';
						$html1 .= '</div><!--end of table -->';
					$html1 .= '</td>';
					$html1 .= '<td>';
						$html1 .= '<div >';
							$html1 .= ' <fieldset style="border: 0px;">';
								$html1 .= '<h4>Computation of Target Days &amp; Hrs</h4>';
			 					 $html1 .= '<div>';
									$html1 .= '<table  class="tbl-dtr-hrs" border=".5">';
										$html1 .= '<tbody>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">Total No of Days</td><td style="width:60px; text-align:right;">'.$header['Total No of Days'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="font-style:italic;width:200px;">less</td>';
											$html1 .= '<td></td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">-  Total No of Day Off</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'.$header['Total No of Day Off'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">-  Total No of Holidays</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'.$header['Total No of Holidays'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;" class="subtotal">Total No of Target Days</td>';
											$html1 .= '<td class="subtotal" style="width:60px; text-align:right;">'.$header['Total No of Target Days'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="font-style:italic;width:200px;">multiply by</td>';
											$html1 .= '<td></td>';
										$html1 .= '</tr><tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">*  Total No of Working Hrs/Day</td>';
											$html1 .= '<td style="width:60px; text-align:right;"> 8 </td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left">Total No of Target Hrs</td>';
											$html1 .= '<td id="total" style="width:60px; text-align:right;">'. $header['Total No of Target Hrs'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '</tbody>';
									$html1 .= '</table>';
								$html1 .= '</div>';
						$html1 .= '</fieldset>';
					$html1 .= '</div><!--end of table -->';
					$html1 .= '</td>';
				$html1 .= '</tr>';
				$html1 .= '<tr>';
					$html1 .= '<td>';
						$html1 .= '<div>';
							$html1 .= '<fieldset style="border: 0px;" >';
								$html1 .= '<h4>Computation of Over/Under Time in Hrs &amp; Days</h4>';
								$html1 .= '<div>';
									$html1 .= '<table class="tbl-dtr-hrs" border=".5">';
										$html1 .= '<tbody>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">Total Hrs Worked</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'.$header['Total Hrs Worked'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="font-style:italic;width:200px;">less</td>';
											$html1 .= '<td>&nbsp;</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">- Total No of Target Hrs</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'. $header['Total No of Target Hrs'] .'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;" class="subtotal">Over/Under Time in Hrs</td>';
											$html1 .= '<td class="subtotal" style="width:60px; text-align:right;">'.$header['Total Leave This Month in Hrs'].' </td>';
										$html1 .= '</tr><tr align="right">';
											$html1 .= '<td align="left" style="font-style:italic;width:200px;">divide by</td>';
											$html1 .= '<td></td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;"> &divide;  Total No of Working Hrs/Day</td>';
											$html1 .= '<td style="width:60px; text-align:right;">8</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" tyle="width:200px;">Over/Under Time in Days</td>';
											$html1 .= '<td id="total" style="width:60px; text-align:right;">'.$header['Total Leave This Month in Days'] .'</td>';
										$html1 .= '</tr>';
										$html1 .= '</tbody>';
									$html1 .= '</table>';
								$html1 .= '</div>';
							$html1 .= '</fieldset>';
						$html1 .= '</div><!--end of table -->';	
					$html1 .= '</td>';
					$html1 .= '<td>';
						$html1 .= '<div>';
							$html1 .= '<fieldset style="border: 0px;">';
								$html1 .= '<h4>Computation Available Leave</h4>';
								$html1 .= '<div>';
									$html1 .= '<table class="tbl-dtr-hrs" border=".5">';
										$html1 .= '<tbody>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">Total Leave Awarded</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'.$header['Total Leave Awarded'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
										$html1 .= '	<td align="left" style="font-style:italic;width:200px;">add</td>';
										$html1 .= '	<td></td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">+  Last Year Leave Available</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'.$getleave['LAST YEAR LEAVE'].'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="font-style:italic;width:200px;">less</td>';
											$html1 .= '<td></td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">-  Total Leave Taken</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'.$header['Total Leave Taken'] .'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" style="width:200px;">-  Over/Under Time in Days</td>';
											$html1 .= '<td style="width:60px; text-align:right;">'. $header['Total Leave This Month in Days'] .'</td>';
										$html1 .= '</tr>';
										$html1 .= '<tr align="right">';
											$html1 .= '<td align="left" id="total">Total Leave Available</td>';
											$html1 .= '<td id="total" style="width:60px; text-align:right;" >'. $header['Total Leave Available'] .'</td>';
										$html1 .= '</tr>';
										$html1 .= '</tbody>';
									$html1 .= '</table><!--end of table -->	';
								$html1 .= '</div>';
							$html1 .= '</fieldset>';
						$html1 .= '</div>';
					$html1 .= '</td>';
				$html1 .= '</tr>';
			$html1 .= '</table>';
			$html1 .="<table><tr><td></td></tr></table>";
				$html1 .= '<table>';
					$html1 .= '<tr>';
						$html1 .= '<td> Employee';
						$html1 .= '</td>';
						$html1 .= '<td>Signed By:';
						$html1 .= '</td>';
					$html1 .= '</tr>';
					$html1 .= '<tr>';
						$html1 .= '<td>____________________';
						$html1 .= '</td>';
						$html1 .= '<td>__________________________';
						$html1 .= '</td>';
					$html1 .= '</tr>';
					$html1 .= '<tr>';
						$html1 .= '<td>'.$header['Employee Name'];;
						$html1 .= '</td>';
						$html1 .= '<td>Hans Sikkel / Peter Everaert';
						$html1 .= '</td>';
					$html1 .= '</tr>';
				$html1 .= '</table>';
				$html1 .= '</body>';
				$html1 .= '</html>';
					$count_user = $count_user -1;
					if ($count_user > 0)
					{
						$html1 .= '<br pagebreak="true" />';				
					}
					else{
						
					}
			endforeach;	
		
			 $pdf->PageNo() + 1;
			$pdf->writeHTML($html1, true, 0, true, 0, '');
		}
		 
		$filename= 'DTR_';
		$filedate = date("mdY_his");
		  
		$pdffilename = "$filename".'_'."$filedate.pdf";
		
		$pdf->Output("$filename".'_'."$filedate.pdf","D");
		 
	}
}