<?php

$sheetBogenID = $_POST['sheetBogenID'];
$sheetType = $_POST['sheetType'];
$sheetPLZ = $_POST['sheetPLZ'];
$sheetNosig = $_POST['sheetNosig'];
$sheetUpdateNosig = $sheetNosig - $_POST['sheetOldNosig'];
$sheetID = $_POST['sheetID'];
$sheetUser = $_POST['sheetUser'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.inc.php';
require_once 'functions.inc.php';

if (!isset($_POST["editsheet"])) {
    header("location: ../sheets/mysheets.php");
    exit();
} else if ($_POST["editsheet"] == "delete") {
    deleteSheet($conn, $sheetID);
    exit();
}



if (erfasenEmpty($sheetType, $sheetPLZ, $sheetNosig, $sheetID) != false) {
    header("location: ../sheets/editsheet.php?error=emptyfields&sheetID=" . $sheetID);
    exit();
}

if ($sheetBogenID != '') {
    if (bogenIDwrong($conn, $sheetBogenID) != false) {
        header("location: ../sheets/editsheet.php?error=bogenIDwrong&sheetID=" . $sheetID);
        exit();
    }
    updateBogen($conn, $sheetBogenID, $sheetUpdateNosig);
}

updateSheet($conn, $sheetPLZ, $sheetType, $sheetNosig, $sheetID, $sheetUser);
