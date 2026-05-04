<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

session_start();
include "db/config.php";

/* Capture your diet page */
ob_start();

/* IMPORTANT → tells page it's PDF mode */
$_GET['pdf'] = 1;

include "diet.php";

$html = ob_get_clean();

/* Create PDF */
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

/* Download */
$dompdf->stream("My_Diet_Plan.pdf", ["Attachment" => true]);
?>