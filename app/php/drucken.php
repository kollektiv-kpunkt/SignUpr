<?php
$pdf2 = new FPDF('P','mm','A4');
$pdf2->AddPage();
$pdf2->Image($_SERVER['DOCUMENT_ROOT'] . '/media/pdf/bg_noprint.png',0,0,210);
$address1 = $_POST["fname"] . " " . $_POST["lname"];
$address2 = $_POST["address"];
$address3 = $_POST["plz"] . " " . $_POST["ort"];
$pdf2->SetFont('Helvetica','',12);
$pdf2->Text(125, 58.5, $address1);
$pdf2->Text(125, 63.5, $address2);
$pdf2->Text(125, 68.5, $address3);
$pdf2->Text(36.5, 105.45, $address1);
$pdf2->AddPage();
$pdf2->Image($_SERVER['DOCUMENT_ROOT'] . '/media/pdf/bg.png',0,0,210);
$qrcode2 = new QRcode($_SESSION['bogenQR'], 'H'); // error level : L, M, Q, H
$qrcode2->displayFPDF($pdf2, 10, 118, 20);
$attachment2 = $pdf2->Output($_SESSION['filename'],'S');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/mailer/vendor/autoload.php');

require_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.inc.php";
require $_SERVER['DOCUMENT_ROOT'] . '/config/emailconfig.inc.php';

$messagesjson = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config/emailmessages.inc.json');
$messages = json_decode($messagesjson);
$message = $messages->drucken;
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
    $mail->addAddress($emailAdmin, "Admin SignItNow");     // Add a recipient
    $mail->CharSet  = 'UTF-8'; // the same as 'utf-8'

    // Attachments
    $mail->AddStringAttachment($attachment2, $_SESSION['filename']);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subjfin;
    $mail->Body    = $contentfin;

    $mail->send();
} catch (Exception $e) {
    alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}


?>

?>
