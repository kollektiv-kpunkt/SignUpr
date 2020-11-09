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
        <script src="/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'textarea'});</script>
    </head>
    <body>
    <div class="container pb-5">


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Installer SignUpr</h1>
</div>
<p class="pb-3">This wizard will try to guide you through installing <b>SignUpr</b>. If you run into any problems, please contact <a href="mailto:timothy@kpunkt.ch">Timothy Oesch from K.</a>
<?php 
if (isset($_GET["success"])) { echo('<div class="alert alert-success" role="alert">Database connection can be established!</div>'); } ?>


<form type="submit" action="writeemailconfig.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="emailHost">SMTP Server</label>
    <input type="text" class="form-control" id="emailHost" name="emailHost" value="">
  </div>
  <div class="form-group">
    <label for="emailPort">SMTP Port</label>
    <input type="number" class="form-control" id="emailPort" name="emailPort" value="">
  </div>
  <div class="form-group">
    <label for="emailUser">Email Username</label>
    <input type="text" class="form-control" id="emailUser" name="emailUser" value="">
  </div>
  <div class="form-group">
    <label for="emailPwd">Email Password</label>
    <input type="password" class="form-control" id="emailPwd" name="emailPwd" value="">
  </div>
  <div class="form-group">
    <label for="emailFrom">Sent from (Name)</label>
    <input type="text" class="form-control" id="emailFrom" name="emailFrom" value="">
  </div>
  <div class="form-group">
    <label for="emailFromEmail">Sent from (Email)</label>
    <input type="text" class="form-control" id="emailFromEmail" name="emailFromEmail" value="">
  </div>
  <div class="form-group">
    <label for="emailAdmin">Admin Email</label>
    <input type="text" class="form-control" id="emailAdmin" name="emailAdmin" value="">
  </div>
  <button type="submit" class="btn btn-success">Email Setup</button>
</form>


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