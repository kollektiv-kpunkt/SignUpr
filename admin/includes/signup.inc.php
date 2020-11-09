<?php
if (!isset($_POST['submit'])) {
    header("location: /admin/signup.php");
    exit();
}

$name = $_POST['name'];
$uid = $_POST['uid'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwdrepeat = $_POST['pwdrepeat'];

require_once 'config.inc.php';
require_once 'functions.inc.php';

if (emptyInput($name, $uid, $email, $pwd, $pwdrepeat) !== FALSE) {
    header("location: ../signup.php?error=emptyInput");
    exit();
}

if (invalidUid($uid) !== FALSE) {
    header("location: ../signup.php?error=invalidUid");
    exit();
}

if (invalidEmail($email) !== FALSE) {
    header("location: ../signup.php?error=invalidEmail");
    exit();
}

if (pwdNomatch($pwd, $pwdrepeat) !== FALSE) {
    header("location: ../signup.php?error=pwdNomatch");
    exit();
}

if (pwdNotstrong($pwd) !== FALSE) {
    header("location: ../signup.php?error=pwdNotstrong");
    exit();
}

if (uidExists($conn, $uid, $email) !== FALSE) {
    header("location: ../signup.php?error=uidExists");
    exit();
}

createUser($conn, $name, $email, $uid, $pwd);