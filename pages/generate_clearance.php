<?php if (isset($_GET['view']) ) : ?>


<?php $get_residents = $DB->prepare("SELECT * FROM resident WHERE residentID = ? LIMIT 0, 1");
$get_residents->execute([ $_GET['view'] ]);  ?>

<?php if ($get_residents && $get_residents->rowCount() > 0) :
        $residents = $get_residents->fetch(); ?>


<?php
require_once('resources/tcpdf/tcpdf.php');

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
	$pdf->SetFont('helvetica', '', 12);  
	$pdf->AddPage(); //default A4


$html = '

<div>
	<h1 style="text-align:center; margin-bottom: -30px; font-size:20px;">Republic of the Philippines</h1><br>
	<h4  style="font-size:12px; text-align:center; margin-bottom: -30px;">Barangay Calumpang</h4><br>
	<h4  style="font-size:12px; text-align:center;">Iloilo City</h4>
</div>




';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$pdf->Output('resident_profile.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>

<?php else : ?>
    <?php error_404(); ?>
<?php endif; ?>
<?php else : ?>
<?php endif; ?>