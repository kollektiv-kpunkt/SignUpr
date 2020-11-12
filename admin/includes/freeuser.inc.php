<?php
session_start();
require_once 'functions.inc.php';
loggedIn($_COOKIE["userUid"]);
if (!isset($_GET["usersID"])) {
    header("location: ../users/");
    exit();
}


$usersID = $_GET["usersID"];

require $_SERVER['DOCUMENT_ROOT'] . '/config.inc.php';

if (userNoexist($conn, $usersID) !== false) {
    header("location: ../users/?error=userNoexist");
    exit();
}

freeUser($conn, $usersID);
