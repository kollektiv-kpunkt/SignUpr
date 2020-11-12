<?php
session_start();
require '../admin/includes/functions.inc.php';

$emailconfig_code = "<?php \n";
$emailconfig_code .= write_variable("emailHost", $_POST['emailHost']);
$emailconfig_code .= write_variable("emailPort", $_POST['emailPort']);
$emailconfig_code .= write_variable("emailUser", $_POST['emailUser']);
$emailconfig_code .= write_variable("emailPwd", $_POST['emailPwd']);
$emailconfig_code .= write_variable("emailFrom", $_POST['emailFrom']);
$emailconfig_code .= write_variable("emailFromEmail", $_POST['emailFromEmail']);
$emailconfig_code .= write_variable("emailAdmin", $_POST['emailAdmin']);
$emailconfig_code .= "?>";

$fp = fopen('../config/emailconfig.inc.php', 'w');
if(!is_writable("../config/config.inc.php")) {
  $error_msg="<p>Sorry, I can't write to <b>../config/emailconfig.inc.php</b>.
  You will have to edit the file yourself. Here is what you need to insert in that file:<br /><br />
  <textarea rows='5' cols='50' onclick='this.select();'>$emailconfig_code</textarea></p>";
  exit();
} else {
  fwrite($fp,$emailconfig_code);
  fclose($fp);
  chmod('../config/emailconfig.inc.php', 0666);
}

header("location: message_thx.php");
