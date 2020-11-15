<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
getFile("header.php"); 
getFile("nav.php");
?>
<link rel="stylesheet" type="text/css" href="/style/submit.css">

<div id="submitscreen">
    <div id="submitinner" class="small-container">
        <h1>Danke, für deine Unterstützung!</h1>
        <p>Du hast gerade eine Email mit deinem Unterschriftenbogen bekommen. Schau kurz in dein Postfach!</p>
    </div>
</div>

<?php
getFile("footer.php");
?>
