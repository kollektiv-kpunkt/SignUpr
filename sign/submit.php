<?php
include($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
session_start();
getFile("header.php"); 
getFile("nav.php");
require $_SERVER['DOCUMENT_ROOT'] . "/config/config.inc.php";
?>
<link rel="stylesheet" type="text/css" href="/style/form.css">
<link rel="stylesheet" type="text/css" href="/style/submit.css">

<div id="submitscreen">
    <div id="submitinner" class="small-container">
        <h1>Deine Daten werden verarbeitet</h1>
        <p>Habe bitte einen Moment Geduld...</p>
    </div>
</div>

<div id="progress-container">
    <hr id="route">
    <div id="progress-inner">
        <div class="progress-circle" id="progress1">1</div>
        <div class="progress-circle" id="progress2">2</div>
        <div class="progress-circle" id="progress3">3</div>
        <div class="progress-circle active" id="progress4">4</div>
    </div>
</div>

<?php
appFile("bogen.php");
if (isset($_POST['drucken'])) {
    appFile("drucken.php");
} else {}
appFile("db.php");
?>

<script>
setTimeout(() => {
    window.location.href = "/danke";
}, 3000);
</script>

<?php
getFile("footer.php"); 
?>
