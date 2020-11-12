<?php
require $_SERVER['DOCUMENT_ROOT'] . "/config/config.inc.php";

if (!isset($_POST['fname'])) {
    header("location: ../../");
}

$bogenID = $_SESSION['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$plz = $_POST['plz'];
$ort = $_POST['ort'];
if (isset($_POST['drucken'])) {
    $drucker = 1;
} else {
    $drucker = 0;
}
if (isset($_POST['optin'])) {
    $optin = 1;
} else {
    $optin = 0;
}
$nosig = $_POST['nosig'];


$sql = "INSERT INTO bogen (bogenID, fname, lname, email, phone, address, plz, ort, drucker, optin, nosig) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../../error.php?error=dbconn2");
    exit();
}

mysqli_stmt_bind_param($stmt, "sssssssssss", $bogenID, $fname, $lname, $email, $phone, $address, $plz, $ort, $drucker, $optin, $nosig);
mysqli_stmt_execute($stmt);
mysqli_close($conn);
