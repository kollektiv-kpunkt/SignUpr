<?php
if (!file_exists("admin/includes/config.inc.php")) {
    header("location: /install");
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
getFile("header.php"); 
getFile("nav.php");
?>

<div id="hero">
    <div class="small-container" id="heroinner">
        <h1>Unterschreibe unsere Initiative!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div class="buttongrid twobuttons">
            <a class="button" href="/sign">Unterschreiben</a>
            <a class="button second" href="/">Mehr Infos</a>
        </div>
    </div>
</div>

<?php
getFile("footer.php");
?>