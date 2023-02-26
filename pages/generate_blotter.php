<?php if (isset($_GET['view']) ) : ?>
    

	<?php $get_blotters = $DB->prepare("SELECT * FROM blotter WHERE blotterID = ? LIMIT 0, 1");
		$get_blotters->execute([ $_GET['view'] ]);  ?>
		
	<?php if ($get_blotters && $get_blotters->rowCount() > 0) :
		$blotters = $get_blotters->fetch(); ?>
	
	
	<?php
	require_once('resources/tcpdf/examples/tcpdf_include.php');
	
	
	// create new PDF document
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);  
		//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
		$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
		$pdf->SetDefaultMonospacedFont('helvetica');  
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
		$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
		$pdf->setPrintHeader(false);  
		$pdf->setPrintFooter(false);  
		$pdf->SetAutoPageBreak(TRUE, 10);  
		$pdf->SetFont('times', '', 13);  
		$pdf->AddPage(); //default A4
	
		// set alpha to semi-transparency
		$pdf->setAlpha(0.1);
	
	
		// draw jpeg image
		$pdf->Image('resources/tcpdf/examples/images/calumpang.jfif', 30, 80, 150, 150, '', '', '', true, 72);
	
		// restore full opacity
		$pdf->setAlpha(1);
	
		$pdf->Image('resources/tcpdf/examples/images/calumpang.jfif', 20, 20, 30, 30, '', '', '', true, 72);
		$pdf->Image('resources/tcpdf/examples/images/sk.jpg', 160, 20, 25, 30, '', '', '', true, 72);
			
		$html = '
	
	
	<div>
	<p></p>
	<span style="text-align: center; font-size: 15;">
	Republic of the Philippines <br>
	City of Iloilo <br>
	Barangay Calumpang, Molo, Iloilo City <br></span>
	<b><h3 style="text-align: center;">OFFICE OF THE PUNONG BARANGAY </h3></b>
	
	<hr />
	<h3 style="text-align: center;"><b>BLOTTER REPORT</b></h3>
	<hr />
	<p>
	</p>
	
	<p>
	LOCATION OF INCIDENCE: <b> '.$blotters["location_of_incidence"].' </b><br>
	DATE OF INCIDENCE: <b> '.date('F d, Y', strtotime($blotters["date_recorded"])).'</b><br>
	STATUS: <b> '.$blotters["complaint_status"].'</b>
	</p>
	
	<hr />
	<b>COMPLAINANT DETAILS</b>
	<hr />
	<p>
	NAME: <b>'.$blotters["complainant"].' </b><br>
	ADDRESS: <b>'.$blotters["c_address"].' </b><br>
	CONTACT NUMBER: <b>'.$blotters["c_contact"].' </b>
	</p>
	
	
	<hr />
	<b>COMPLAINEE DETAILS</b>
	<hr />
	<p>
	NAME: <b>'.$blotters["person_to_complain"].' </b><br>
	CONTACT NUMBER: <b>'.$blotters["p_contact"].' </b><br>
	ADDRESS: <b>'.$blotters["p_address"].'</b>
	</p>
	
	<hr />
	<b>REPORT DETAILS</b>
	<hr />
	<p style="text-indent: 25px;">
	'.$blotters["complaint"].'
	</p>
	
	<hr />
	<b>ACTION TAKEN</b>
	<hr />
	<p style="text-indent: 25px;">
	'.$blotters["action_taken"].'
	</p>
	
	
	';
	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// reset pointer to the last page
	$pdf->lastPage();
	
	// ---------------------------------------------------------
	
	//Close and output PDF document
	ob_end_clean();
	$pdf->Output('Blotter Report', 'I');
	
	//============================================================+
	// END OF FILE
	//============================================================+
	
	?>
	
	<?php else : ?>
		<?php error_404(); ?>
	<?php endif; ?>
	<?php else : ?>
	<?php endif; ?>