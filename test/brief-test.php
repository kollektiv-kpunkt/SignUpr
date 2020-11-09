<?php

//FPDF
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/fpdf/fpdf.php');
//QR Code Generator
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/qrcode/qrcode.class.php');

$pdf2 = new FPDF('P','mm','A4');
$pdf2->AddPage();
$pdf2->Image($_SERVER['DOCUMENT_ROOT'] . '/media/pdf/bg_noprint.png',0,0,210);
$address1 = "Timothy Oesch";
$address2 = "Weinbergstrasse 12";
$address3 = "Buchs ZH";
$pdf2->SetFont('Helvetica','',12);
$pdf2->Text(125, 58.5, $address1);
$pdf2->Text(125, 63.5, $address2);
$pdf2->Text(125, 68.5, $address3);
$pdf2->Text(36.5, 105.45, $address1);
$pdf2->AddPage();
$pdf2->Image($_SERVER['DOCUMENT_ROOT'] . '/media/pdf/bg.jpg',0,0,210);
$qrcode2 = new QRcode("1", 'H'); // error level : L, M, Q, H
$qrcode2->displayFPDF($pdf2, 10, 118, 20);
$attachment2 = $pdf2->Output("test.pdf",'I');