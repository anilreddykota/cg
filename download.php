<?php
$filepath = 'controllers/badges.php';
if (!file_exists($filepath)) {
    die("File not found: " . $filepath);
}
require_once $filepath;

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    die("Certificate ID is required");
}

$certificateDetails = getCertificateDeatils($id);

if (!$certificateDetails) {
    die("Certificate not found");
}

// Set headers for PDF download
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="certificate_' . $certificateDetails['unique_id'] . '.pdf"');

// Use a PDF library like TCPDF, FPDF, or mPDF to generate the PDF
// This is a simplified example using TCPDF (you need to install it first)
require_once('vendor/autoload.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Engineering - What to Learn ?');
$pdf->SetAuthor('Anil Kumar Reddy Kota');
$pdf->SetTitle('Certificate of Achievement');
$pdf->SetSubject('Certificate for ' . $certificateDetails['holder']);

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margins
$pdf->SetMargins(15, 15, 15);

// Add a page
$pdf->AddPage();

// Get the badge image path
$badgeImagePath = 'certificates/' . str_replace(" ", "", $certificateDetails['badge_name']) . '.png';

// Create verification URL for QR code
// Create verification URL for QR code with full server URL
$serverUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$verificationUrl = $serverUrl . '/verify?id=' . $certificateDetails['unique_id'];

// HTML content for certificate
$html = '
<div style="text-align: center;">
    <div>
        <img src="assets/logo.png" style="width: 100px;">
        <p>LinkedIn Series Certification</p>
    </div>
    
    <h1>Certificate of Achievement</h1>
    
    <div>
        <img src="' . $badgeImagePath . '" style="width: 150px;">
    </div>
    
    <div>
        <p>This is to certify that</p>
        <h2>' . htmlspecialchars($certificateDetails['holder']) . '</h2>
        <p>has been awarded the badge</p>
        <p><strong>' . htmlspecialchars($certificateDetails['badge_name']) . '</strong></p>
        <p>for demonstrating excellence in</p>
        <h3>' . htmlspecialchars($certificateDetails['badge_type']) . '</h3>
        
        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <p>Issued on: <strong>' . date('Y-m-d', strtotime($certificateDetails['issue_date'])) . '</strong></p>
            <p>Badge ID: <strong>' . htmlspecialchars($certificateDetails['unique_id']) . '</strong></p>
        </div>
    </div>
</div>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Add QR code to the bottom right corner
$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'module_width' => 1,
    'module_height' => 1
);

// Position for QR code (adjust as needed)
$pdf->write2DBarcode($verificationUrl, 'QRCODE,L', 140, 220, 40, 40, $style, 'N');
$pdf->SetXY(140, 265); // Adjust text position
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(40, 5, 'Scan to verify', 0, 0, 'C');

// Close and output PDF document
$pdf->Output('certificate_' . $certificateDetails['unique_id'] . '.pdf', 'D');
exit;
?>