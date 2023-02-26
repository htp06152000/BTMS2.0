

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
	$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
	$pdf->setPrintHeader(false);  
	$pdf->setPrintFooter(false);  
	$pdf->SetAutoPageBreak(TRUE, 10);  

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


	$pdf->SetFont('times', '', 16);  
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
<p></p>


<h1 style="text-align: center;"><b>CERTIFICATE OF INDIGENCY</b></h1>

<p></p>

<p style="text-indent: 25px;">
		TO WHOM IT MAY CONCERN
</p>

<p style="text-indent: 25px;">

		This is to certify that <b style="text-transform: uppercase;">'.$residents["residentFName"].' '.$residents["residentMName"].' '.$residents["residentLName"].', '.$residents["residentAge"].' </b>
		of Barangay Calumpang, Molol, Iloilo City is one of the indigent in our Barangay. 
</p>
<p style="text-indent: 25px;">
		This certification is being issued upon the request of the above-named person gor whatever legal purpose it may serve his/her best.
</p>

<p style="text-indent: 25px;">
		Issued this <b>'.date("jS").'</b> day of <b>'.date("F") .'</b>, <b>'.date("Y").'</b>,
		at the Office of the Punong Barangay, Barangay Calumpang, Molo, Iloilo City, Philippines.
</p>
 

<p></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p></p>


<div style="text-align: center;">
<p>
Roberto C. Niño Jr.<br>
<b>PUNONG BARANGAY</b>
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
$pdf->Output('Certificate of Indigency', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>

<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>
<?php endif; ?>