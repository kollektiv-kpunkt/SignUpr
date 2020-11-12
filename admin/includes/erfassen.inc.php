<?php
if (!isset($_POST["submitsheet"])) {
    header("location: ../erfassen/");
    exit();
}

$sheetBogenID = $_POST['sheetBogenID'];
$sheetType = $_POST['sheetType'];
$sheetPLZ = $_POST['sheetPLZ'];
$sheetNosig = $_POST['sheetNosig'];
$sheetID = $_POST['sheetID'];
$sheetUser = $_POST['sheetUser'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.inc.php';
require_once 'functions.inc.php';


if (erfasenEmpty($sheetType, $sheetPLZ, $sheetNosig, $sheetID) != false) {
    header("location: ../sheets/?error=emptyfields");
    exit();
}

if (sheetIDexists($conn, $sheetID) != false) {
    header("location: ../sheets/?error=sheetIDexists");
    exit();
}

if ($sheetBogenID != '') {
    if (bogenIDwrong($conn, $sheetBogenID) != false) {
        header("location: ../sheets/?error=bogenIDwrong&sheetBogenID=" . $sheetBogenID);
        exit();
    }
    calcBogen($conn, $sheetBogenID, $sheetNosig);
}

addSheet($conn, $sheetBogenID, $sheetPLZ, $sheetType, $sheetNosig, $sheetID, $sheetUser);
