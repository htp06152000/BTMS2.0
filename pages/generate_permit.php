<?php if (isset($_GET['view']) ) : ?>


<?php $get_transactions = $DB->prepare("SELECT concat(rs.residentFName,' ',rs.residentMName,' ',rs.residentLName) AS requester, tr.*, s.services AS tod FROM transaction tr JOIN resident rs ON tr.residentID = rs.residentID JOIN services s ON tr.servicesID = s.servicesID WHERE s.servicesID = 3 AND transactionID = ? LIMIT 0, 1");
$get_transactions->execute([ $_GET['view'] ]);  ?>

<?php if ($get_transactions && $get_transactions->rowCount() > 0) :
        $transactions = $get_transactions->fetch(); ?>


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
	$pdf->SetMargins(PDF_MARGIN_LEFT, '2', PDF_MARGIN_RIGHT);  
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
		
		<h2 style="text-align: center;"><b>BARANGAY BUSINESS PERMIT</b></h2>

		<p style="font-size: 12px; text-align: center;">
		<b style="text-transform: uppercase;"><u>'.$transactions["business_name"].'</u></b> <br>
		<i>Name of Business</i> <br>
		<br>
		<b style="text-transform: uppercase;"><u>'.$transactions["requester"].'</u></b> <br>
		<i>Name of Owner</i> <br>
		<br>
		<b style="text-transform: uppercase;"><u>'.$transactions["type_of_business"].'</u></b> <br>
		<i>Type of Business</i> <br>
		<br>
		<b style="text-transform: uppercase;"><u>'.$transactions["business_address"].'</u></b> <br>
		<i>Business Address</i> <br>
		</p>

		<p style="text-indent: 25px; font-size: 13px;">
		
		This clearance is granted in accordance with section 152 of R.A. 7160 of Barangay Tax Ordinance, provided however, 
		that the necessary fees are paid to the Barangay Treasurer.
		
		</p>

		<p style="text-indent: 25px; font-size: 13px;">
		
		This is non-transferable and shall be deemed null and void upon failure by the owner to follow the said rules 
		and regulations set forth by the Local Government Unit of <b>Barangay Calumpang, Molo, Iloilo City</b>.
		
		</p>

		<p></p>
		<p></p>
		<p></p>


		<div style="text-align: right; font-size: 13px;">
		<p>
		Roberto C. Niño Jr.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
		<b>PUNONG BARANGAY</b>
		</p>
		</div>

		

		<p  style="font-size: 13px;">
				<b>C.T.C. Number:</b> &nbsp;________________________________<br>
				<b>O.R. Number:</b> &nbsp;&nbsp;&nbsp;&nbsp;________________________________<br>
				<b>Issued On:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.date('m-d-Y').'<br>
				<b>Issued At:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Barangay Calumpang, Molo, Iloilo City
		</p>
		</p>
		</div>



	









';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$pdf->Output('Business Permit', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>

<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>
<?php endif; ?>