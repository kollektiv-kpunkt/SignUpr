<?php
if (!isset($_POST["setpw"]) || $_POST["setpw"] != "update") {
    header("logout.inc.php");
}

require_once 'functions.inc.php';
loggedIn($_COOKIE["userUid"]);

$userUid = $_POST["userUid"];
$currPW = $_POST["currPW"];
$newPW = $_POST["newPW"];
$newPWre = $_POST["newPWre"];

if (fieldEmptyPW($currPW, $newPW, $newPWre) !== false) {
    header("location: ../users/setpw.php?error=fieldEmpty");
    exit();
}

if (noMatch($newPW, $newPWre) !== false) {
    header("location: ../users/setpw.php?error=noMatch");
    exit();
}

require 'config.inc.php';

if (pwWrong($conn, $currPW, $userUid) !== false) {
    header("location: ../users/setpw.php?error=pwWrong");
    exit();
}

updatePW($conn, $userUid, $newPW);