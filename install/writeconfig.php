<?php
session_start();
require '../admin/includes/functions.inc.php';

$config_code = "<?php \n";
$config_code .= write_variable("dbHost", $_POST['dbHost']);
$config_code .= write_variable("dbUser", $_POST['dbUser']);
$config_code .= write_variable("dbPwd", $_POST['dbPwd']);
$config_code .= write_variable("dbTable", $_POST['dbTable']);
$config_code .= write_variable("appURL", $_POST['appURL']);
$config_code .= write_variable("appName", $_POST['appName']);
$config_code .= "$" . "conn" . " = " . "mysqli_connect($" . "dbHost, $" . "dbUser, $" . "dbPwd, $" . "dbTable); \n";
$config_code .= "?>";

$fp = fopen('../admin/includes/config.inc.php', 'w');
if(!is_writable("../admin/includes/config.inc.php")) {
  $error_msg="<p>Sorry, I can't write to <b>inc/db_connect.php</b>.
  You will have to edit the file yourself. Here is what you need to insert in that file:<br /><br />
  <textarea rows='5' cols='50' onclick='this.select();'>$config_code</textarea></p>";
} else {
  fwrite($fp,$config_code);
  fclose($fp);
  chmod('../admin/includes/config.inc.php', 0666);
}

$dbHost = $_POST['dbHost'];
$dbUser = $_POST['dbUser'];
$dbPwd = $_POST['dbPwd'];
$dbTable = $_POST['dbTable'];

$db = new PDO("mysql:host=$dbHost;dbname=$dbTable", $dbUser, $dbPwd);
$query = file_get_contents("sql/createbogen.sql");
$stmt = $db->prepare($query);
if ($stmt->execute()){
  $_SESSION["bogen"] = 1;
}else{ 
  $_SESSION["bogen"] = 0;
}

$db = new PDO("mysql:host=$dbHost;dbname=$dbTable", $dbUser, $dbPwd);
$query = file_get_contents("sql/createlogins.sql");
$stmt = $db->prepare($query);
if ($stmt->execute()){
  $_SESSION["logins"] = 1;
}else{ 
  $_SESSION["logins"] = 0;
}

$db = new PDO("mysql:host=$dbHost;dbname=$dbTable", $dbUser, $dbPwd);
$query = file_get_contents("sql/createsheet.sql");
$stmt = $db->prepare($query);
if ($stmt->execute()){
  $_SESSION["sheet"] = 1;
}else{ 
  $_SESSION["sheet"] = 0;
}

$db = new PDO("mysql:host=$dbHost;dbname=$dbTable", $dbUser, $dbPwd);
$query = file_get_contents("sql/createusers.sql");
$stmt = $db->prepare($query);
if ($stmt->execute()){
  $_SESSION["users"] = 1;
}else{ 
  $_SESSION["users"] = 0;
}

$conn = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbTable);
$sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, usersFree) VALUES (?, ?, ?, ?, ?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtError1");
    exit();
}
$name = "admin";
$email = "";
$uid = "admin";
$hashedPwd = password_hash("12345", PASSWORD_DEFAULT);
$usersFree = "1";
mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $uid, $hashedPwd, $usersFree);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$target_dir = "../media/pdf/";
$target_file = $target_dir . basename($_FILES["bogenFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["bogenFile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
    exit();
  }
}

// Check if file already exists
if (file_exists("../media/pdf/bg.png")) {
  echo "Somehow the file already exists. Please navigate to '/media/pdf/bg.png' and delete it.";
  $uploadOk = 0;
  exit();
}

// Check file size
if ($_FILES["bogenFile"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
  exit();
}

// Allow certain file formats
if($imageFileType != "png") {
  echo "Sorry, only PNG files are allowed.";
  $uploadOk = 0;
  exit();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded. Try again";
  exit();
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["bogenFile"]["tmp_name"], "../media/pdf/bg.png")) {
    move_uploaded_file($_FILES["bogenFile"]["tmp_name"], "../media/pdf/bg.png");
  } else {
    echo "Sorry, there was an error uploading your file. Try again.";
  }
}

$target_dir = "../media/pdf/";
$target_file = $target_dir . basename($_FILES["druckenFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["druckenFile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
    exit();
  }
}

// Check if file already exists
if (file_exists("../media/pdf/bg_noprint.png")) {
  echo "Somehow the file already exists. Please navigate to '/media/pdf/bg_noprint.png' and delete it.";
  $uploadOk = 0;
  exit();
}

// Check file size
if ($_FILES["druckenFile"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
  exit();
}

// Allow certain file formats
if($imageFileType != "png") {
  echo "Sorry, only PNG files are allowed.";
  $uploadOk = 0;
  exit();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded. Try again";
  exit();
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["druckenFile"]["tmp_name"], "../media/pdf/bg_noprint.png")) {
    move_uploaded_file($_FILES["druckenFile"]["tmp_name"], "../media/pdf/bg_noprint.png");
  } else {
    echo "Sorry, there was an error uploading your file. Try again.";
  }
}

header("location: emailconfig.php");