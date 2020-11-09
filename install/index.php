<?php
$php_version=phpversion();
if ($php_version<7) {
    $php_type="danger";
    $php_icon="x";
    $php_message="PHP version is $php_version - too old!";
    $error = true;
} else {
    $php_type="success";
    $php_icon="check";
    $php_message="PHP version is $php_version - that's good!";
}

// declare MySQL
$mysql_icon="help-circle";
$mysql_type = "info";
$mysql_message="MySQL version will be checked at the next step.";

if(!function_exists('mail')) {
    $mail_type = "danger";
    $mail_icon="x";
    $mail_message="PHP Mail function is not enabled!";
    $error = true;
} else {
    $mail_type = "success";
    $mail_icon="check";
    $mail_message="PHP Mail function is enabled!";
}

if( ini_get("safe_mode") ) {
    $safe_mode_type="danger";
    $safe_mode_icon="x";
    $safe_mode_message="Please switch of PHP Safe Mode";
    $error=true;
} else {
    $safe_mode_type="success";
    $safe_mode_icon="check";
    $safe_mode_message="PHP Safe Mode is switched off";
}

$_SESSION['myscriptname_sessions_work']=1;
if(empty($_SESSION['myscriptname_sessions_work'])) {
    $session_type="danger";
    $session_icon="x";
    $session_message="Sessions and Cookies must be enabled!";
    $error=true;
} else {
    $session_type="success";
    $session_icon="check";
    $session_message="Sessions and Cookies are enabled!";
}
?>

<!DOCTYPE html>
<html lang="de" xml:lang="de" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>SignUpr Installer</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <!-- FAVICON -->
        <link rel="apple-touch-icon" sizes="180x180" href="/media/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/media/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/media/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="/media/img/favicon/site.webmanifest">
        <link rel="mask-icon" href="/media/img/favicon/safari-pinned-tab.svg" color="#1d96cd">
        <link rel="shortcut icon" href="/media/img/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#1d96cd">
        <meta name="msapplication-config" content="/media/img/favicon/browserconfig.xml">
        <meta name="theme-color" content="#1d96cd">
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
    <div class="container pb-5">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Installer SignUpr</h1>
</div>
<p class="pb-3">This wizard will try to guide you through installing <b>SignUpr</b>. If you run into any problems, please contact <a href="mailto:timothy@kpunkt.ch">Timothy Oesch from K.</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Function</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>PHP Version (Must be 7 or higher)</td>
            <td class="text-<?= $php_type ?>"><span data-feather="<?= $php_icon ?>"></span>  <?= $php_message ?></td>
        </tr>
        <tr>
            <td>MySQL Version (Must be 5 or higher)</td>
            <td class="text-<?= $mysql_type ?>"><span data-feather="<?= $mysql_icon ?>"></span>  <?= $mysql_message ?></td>
        </tr>
        <tr>
            <td>PHP "mail" function</td>
            <td class="text-<?= $mail_type ?>"><span data-feather="<?= $mail_icon ?>"></span>  <?= $mail_message ?></td>
        </tr>
        <tr>
            <td>PHP "safe mode"</td>
            <td class="text-<?= $safe_mode_type ?>"><span data-feather="<?= $safe_mode_icon ?>"></span>  <?= $safe_mode_message ?></td>
        </tr>
        <tr>
            <td>PHP Session and Cookies</td>
            <td class="text-<?= $session_type ?>"><span data-feather="<?= $session_icon ?>"></span>  <?= $session_message ?></td>
        </tr>
    </tbody>
</table>
<button type="button" onclick="window.location.href='dbconfig.php'" class="btn btn-lg btn-primary">Next Step</button>
<?php if(isset($error) && $error == true) {echo('<button type="button" class="btn btn-lg btn-primary" title="Configuration error" data-toggle="popover" data-trigger="hover" data-content="To continue, all the above configurations have to pass.">Next Step</button>'); } ?>


    </div>
    <script src="/admin/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script>
        (function () {
        'use strict'
        feather.replace()
        })()
        
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>
    </body>
</html>