<?php
session_start();
if ($_SESSION["bogen"] == 1) {
    $bogen_status = "success";
    $bogen_icon = "check";
    $bogen_message = "Successfully created!";
} else {
    $bogen_status = "danger";
    $bogen_icon = "x";
    $bogen_message = 'There was a problem creating the Table "bogen". Please check your database setup and then restart the installer.';
}

if ($_SESSION["logins"] == 1) {
    $logins_status = "success";
    $logins_icon = "check";
    $logins_message = "Successfully created!";
} else {
    $logins_status = "danger";
    $logins_icon = "x";
    $logins_message = 'There was a problem creating the Table "logins". Please check your database setup and then restart the installer.';
}

if ($_SESSION["sheet"] == 1) {
    $sheet_status = "success";
    $sheet_icon = "check";
    $sheet_message = "Successfully created!";
} else {
    $sheet_status = "danger";
    $sheet_icon = "x";
    $sheet_message = 'There was a problem creating the Table "sheet". Please check your database setup and then restart the installer.';
}

if ($_SESSION["users"] == 1) {
    $users_status = "success";
    $users_icon = "check";
    $users_message = "Successfully created!";
} else {
    $users_status = "danger";
    $users_icon = "x";
    $users_message = 'There was a problem creating the Table "users". Please check your database setup and then restart the installer.';
}

if ($_SESSION["trigger_calcDONE"] == 1 && $_SESSION["trigger_calcINSERT"] == 1 && $_SESSION["trigger_calcUPDATE"] == 1 && $_SESSION["trigger_deleteNosig"] == 1) {
    $trigger_status = "success";
    $trigger_icon = "check";
    $trigger_message = "Successfully created!";
} else {
    $trigger_status = "danger";
    $trigger_icon = "x";
    $trigger_message = 'There was a problem creating the triggers for your SQL DB. Please check your database setup and then restart the installer.';
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

<h1>Setup Status</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Process</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Database Table <em>"bogen"</em></td>
            <td class="text-<?= $bogen_status ?>"><span data-feather="<?= $bogen_icon ?>"></span>  <?= $bogen_message ?></td>
        </tr>
        <tr>
            <td>Database Table <em>"logins"</em></td>
            <td class="text-<?= $logins_status ?>"><span data-feather="<?= $logins_icon ?>"></span>  <?= $logins_message ?></td>
        </tr>
        <tr>
            <td>Database Table <em>"sheet"</em></td>
            <td class="text-<?= $sheet_status ?>"><span data-feather="<?= $sheet_icon ?>"></span>  <?= $sheet_message ?></td>
        </tr>
        <tr>
            <td>Database Table <em>"users"</em></td>
            <td class="text-<?= $users_status ?>"><span data-feather="<?= $users_icon ?>"></span>  <?= $users_message ?></td>
        </tr>
        <tr>
            <td>Database triggers</td>
            <td class="text-<?= $trigger_status ?>"><span data-feather="<?= $trigger_icon ?>"></span>  <?= $trigger_message ?></td>
        </tr>
        <tr>
            <td>Bogen File</td>
            <td class="text-success"><span data-feather="check"></span>Successfully uploaded!</td>
        </tr>
        <tr>
            <td>Letter File</td>
            <td class="text-success"><span data-feather="check"></span>Successfully uploaded!</td>
        </tr>
        <tr>
            <td>"Thank you" Email</td>
            <td class="text-success"><span data-feather="check"></span>Successfully created!</td>
        </tr>
        <tr>
            <td>No printer Email</td>
            <td class="text-success"><span data-feather="check"></span>Successfully created!</td>
        </tr>
    </tbody>
</table>
<p>If all the processes have been setup succesfully, you can now login to your instances of SignUpr with the credentials <b>admin</b> (Username) and <b>12345</b>. <b class="text-danger"><br>DO NOT FORGET TO CHANGE THAT PASSWORD IMMEDIATELY!</b></p>
<button type="button" onclick="window.location.href='/admin?postinstaller=1'" class="btn btn-lg btn-primary mt-4">Log in</button>


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