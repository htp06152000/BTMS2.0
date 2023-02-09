<?php if (isset($_GET['view']) ) : ?>


<?php $get_blotters = $DB->prepare("SELECT * FROM blotter WHERE blotterID = ? LIMIT 0, 1");
$get_blotters->execute([ $_GET['view'] ]);  ?>

<?php if ($get_blotters && $get_blotters->rowCount() > 0) :
        $blotters = $get_blotters->fetch(); ?>


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




<body>
<nobr><nowrap>
<div class="pos" id="_0:0" style="top:0">
<img name="_1100:850" src="page_001.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
<div class="pos" id="_303:106" style="top:106;left:303">
<span id="_24.5" style=" font-family:Arial; font-size:24.5px; color:#000000">
Republic of Phillipines</span>
</div>
<div class="pos" id="_255:143" style="top:143;left:255">
<span id="_35.3" style=" font-family:Arial; font-size:35.3px; color:#000000">
Barangay Calumpang</span>
</div>
<div class="pos" id="_384:185" style="top:185;left:384">
<span id="_19.0" style=" font-family:Arial; font-size:19.0px; color:#000000">
Iloilo City</span>
</div>
<div class="pos" id="_203:244" style="top:244;left:203">
<span id="_27.2" style=" font-family:Times New Roman; font-size:27.2px; color:#000000">
B A R A N G A Y  C L E A R A N C E</span>
</div>
<div class="pos" id="_100:289" style="top:289;left:100">
<span id="_27.2" style=" font-family:Arial; font-size:27.2px; color:#000000">
To Whom it may concern:</span>
</div>
<div class="pos" id="_150:332" style="top:332;left:150">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
This is to certify that with residence and postal address at , Barangay Calumpang, </span>
</div>
<div class="pos" id="_100:355" style="top:355;left:100">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
Iloilo City has no derogatory record files in our Barangay office.</span>
</div>
<div class="pos" id="_150:422" style="top:422;left:150">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
The aboved-name individual who is a bonafide resident of this barangay is a person </span>
</div>
<div class="pos" id="_100:444" style="top:444;left:100">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
of good moral character, peace-loving and civic minded citizen.</span>
</div>
<div class="pos" id="_150:511" style="top:511;left:150">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
This certification/clearance is hereby issued in connection with the subject&#146;s </span>
</div>
<div class="pos" id="_100:533" style="top:533;left:100">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
application for and for whatever legal purpose it may service him/her best, abd is valid for </span>
</div>
<div class="pos" id="_100:555" style="top:555;left:100">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
six(6) from the date issued</span>
</div>
<div class="pos" id="_100:589" style="top:589;left:100">
<span id="_19.0" style="font-weight:bold; font-family:Arial Narrow; font-size:19.0px; color:#000000">
NOT VALID WITHOUT OFFICIAL SEAL.</span>
</div>
<div class="pos" id="_100:622" style="top:622;left:100">
<span id="_19.0" style=" font-family:Arial Narrow; font-size:19.0px; color:#000000">
Given this Friday, February 10, 2023.</span>
</div>
<div class="pos" id="_550:656" style="top:656;left:550">
<span id="_21.7" style="font-weight:bold; font-family:Arial Narrow; font-size:21.7px; color:#000000">
ROBERTO C. NI&#209;O JR.</span>
</div>
<div class="pos" id="_550:679" style="top:679;left:550">
<span id="_21.7" style="font-weight:bold; font-family:Arial Narrow; font-size:21.7px; color:#000000">
      <span id="_19.0" style="font-weight:normal; font-size:19.0px"> Punong Barangay</span></span>
</div>
<div class="pos" id="_100:704" style="top:704;left:100">
<span id="_21.7" style=" font-family:Arial Narrow; font-size:21.7px; color:#000000">
Specimen Signature of Applicant:</span>
</div>
<div class="pos" id="_100:730" style="top:730;left:100">
<span id="_21.0" style=" font-family:Arial Narrow; font-size:21.0px; color:#000000">
__________________________</span>
</div>
</nowrap></nobr>
</body>


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