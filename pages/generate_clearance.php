<?php if (isset($_GET['view']) ) : ?>


<?php $get_residents = $DB->prepare("SELECT * FROM resident WHERE residentID = ? LIMIT 0, 1");
$get_residents->execute([ $_GET['view'] ]);  ?>

<?php if ($get_residents && $get_residents->rowCount() > 0) :
        $residents = $get_residents->fetch(); ?>


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
	$pdf->SetMargins('30', '5', '30');  
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
	
	
	$pdf->Image('resources/tcpdf/examples/images/box.jpg', 64, 123, 5, 5, '', '', '', true, 72);
	$pdf->Image('resources/tcpdf/examples/images/box.jpg', 64, 135, 5, 5, '', '', '', true, 72);
	$pdf->Image('resources/tcpdf/examples/images/box.jpg', 64, 146, 5, 5, '', '', '', true, 72);




$html = '


<div>
<p></p>
<span style="text-align: center; font-size: 15;">
Republic of the Philippines <br>
City of Iloilo <br>
Barangay Calumpang, Molo, Iloilo City <br></span>
<b><h3 style="text-align: center;">OFFICE OF THE PUNONG BARANGAY </h3></b>
<hr />
<p></p>


<h1 style="text-align: center;"><b>BARANGAY CLEARANCE</b></h1>

<p></p>
<p style="text-indent: 25px;">

		This is to certify that <b style="text-transform: uppercase;">'.$residents["residentFName"].' '.$residents["residentMName"].' '.$residents["residentLName"].' </b>
		is a resident of our barangay and is of legal age. Subject to the verification of the Lupong Tagamayapa, she/he has been found to have:
</p>
<p style="text-indent: 120px;">
		No Derogatory Case
</p>

<p style="text-indent: 120px;">
		With Derogatory Case
</p>

<p style="text-indent: 120px;">
		Pending Derogatory Case
</p>

<p style="text-indent: 25px;">
		Issued this <b>'.date("jS").'</b> day of <b>'.date("F") .'</b>, <b>'.date("Y").'</b>,
		at Barangay Calumpang, Molo, Iloilo City. Upon request of the interested party for whatever legal purposes this clearance may serve.
</p>
 

<p></p>
<p></p>
<p></p>
<p></p>


<div style="text-align: right;">
<p>
Roberto C. Niño Jr.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<b>PUNONG BARANGAY</b>
</p>
</div>



<p>
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
$pdf->Output('Barangay Clearance', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>

<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>
<?php endif; ?>