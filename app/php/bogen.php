<?php
$fullname = $_POST['fname'] . " " . $_POST['lname'];
if ($_POST['nosig'] == 1) {
    $nosig = "eine Unterschrift";
} else {
    $nosig = $_POST['nosig'] . " Unterschriften";
}

require "../admin/includes/config.inc.php";

//FPDF
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/fpdf/fpdf.php');
//QR Code Generator
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/qrcode/qrcode.class.php');


$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/media/pdf/bg.png',0,0,210);
$id = uniqid() . "-" . rand(1000,9999) . "-" . rand(1000,9999) . "-" . rand(1000,9999);
$_SESSION['id'] = $id;
$filename = "bogen-" . $id . ".pdf";
$_SESSION['filename'] = $filename;
$bogenQR = $appURL . "admin/erfassen/?sheetBogenID=" . $id;
$_SESSION['bogenQR'] = $bogenQR;
$qrcode = new QRcode($bogenQR, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($pdf, 10, 118, 20);
$filepath = $_SERVER['DOCUMENT_ROOT'] . "/media/pdf/" . $filename;
$pdf->Output($filepath,'F');
$attachment = $pdf->Output($filename,'S');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/mailer/vendor/autoload.php');

require_once '../admin/includes/emailconfig.inc.php';

$messagesjson = file_get_contents('../admin/includes/emailmessages.inc.json');
$messages = json_decode($messagesjson);
$message = $messages->thx;
$msgsubject = $message->subject;
$msgcontent = $message->content;

$tags = array("[fname]", "[lname]", "[appname]", "[nosig]", "[bogenlink]");
$replace = array($_POST['fname'], $_POST['lname'], $appName, $nosig, $appURL . 'media/pdf/' . $filename);

$subjfin = str_replace($tags, $replace, $msgsubject);
$contentfin = str_replace($tags, $replace, $msgcontent);


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $emailHost;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $emailUser;                     // SMTP username
    $mail->Password   = $emailPwd;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $emailPort;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($emailFromEmail, $emailFrom);
    $mail->addAddress($_POST['email'], $fullname);     // Add a recipient
    $mail->CharSet  = 'UTF-8'; // the same as 'utf-8'

    // Attachments
    $mail->AddStringAttachment($attachment, $filename);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subjfin;
    $mail->Body    = $contentfin;

    $mail->send();
} catch (Exception $e) {
    alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}