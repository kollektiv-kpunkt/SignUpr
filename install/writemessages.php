<?php
session_start();
require '../admin/includes/functions.inc.php';

$emailthx = array('subject' => $_POST["emailThxSubj"], 'content' => $_POST["emailThxContent"]);
$emaildrucken = array('subject' => $_POST["emailDruckenSubj"], 'content' => $_POST["emailDruckenContent"]);
$nachrichten = array('thx' => $emailthx, 'drucken' => $emaildrucken);

$nachrichtenjson = json_encode($nachrichten);

$fp = fopen('../config/emailmessages.inc.json', 'w');
if(!is_writable("../config/emailmessages.inc.json")) {
  $error_msg="<p>Sorry, I can't write to <b>/admin/includes/emailmessages.inc.json</b>.
  You will have to edit the file yourself. Here is what you need to insert in that file:<br /><br />
  <textarea rows='5' cols='50' onclick='this.select();'>$nachrichtenjson</textarea></p>";
  exit();
} else {
  fwrite($fp,$nachrichtenjson);
  fclose($fp);
  chmod('../config/emailmessages.inc.json', 0666);
}

header("location: done.php");
