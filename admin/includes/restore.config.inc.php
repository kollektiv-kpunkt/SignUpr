<?php
$dbHost = DBSERVER;
$dbUser = DBUSER;
$dbPwd = DBPASS;
$dbTable = DBNAME;
$appURL = APPURL;
$appName = APPNAME;

$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbTable);

if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}