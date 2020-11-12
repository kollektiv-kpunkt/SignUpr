<?php
if (!isset($_POST['submit'])) {
    header("location: /admin/login.php");
    exit();
}

$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$pathPrelogin = $_POST['pathPrelogin'];

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.inc.php';
require_once 'functions.inc.php';

if (emptyInputLogin($uid, $pwd) !== FALSE) {
    header("location: ../login.php?error=emptyInput");
    exit();
}

loginUser($conn, $uid, $pwd, $stay, $pathPrelogin);
