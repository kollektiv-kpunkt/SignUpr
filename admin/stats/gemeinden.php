<?php
session_start();
$pagetitle = "Gemeinden";
require_once '../includes/functions.inc.php';
require '../elements/header-logedin.php';
require '../elements/nav-logedin.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Unterschriften nach Gemeinden</h1>
</div>
<em><p>Folgt...</p></em>

<?php
require '../elements/footer-logedin.php';
?>