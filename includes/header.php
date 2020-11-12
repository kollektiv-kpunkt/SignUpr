<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config/config.inc.php';
?>
<!DOCTYPE html>
<html lang="de" xml:lang="de" xmlns="http://www.w3.org/1999/xhtml">
    <head>
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

        <!-- Primary Meta Tags -->
        <title><?= $appName ?> - Jetzt unterschreiben!</title>
        <meta name="title" content="<?= $appName ?> - Jetzt unterschreiben!">
        <meta name="description" content="Unterschreibe unsere Initiative hier!">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://sign.kpunkt.ch/">
        <meta property="og:title" content="<?= $appName ?> - Jetzt unterschreiben!">
        <meta property="og:description" content="Unterschreibe unsere Initiative hier!">
        <meta property="og:image" content="/media/img/og.png">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://sign.kpunkt.ch/">
        <meta property="twitter:title" content="<?= $appName ?> - Jetzt unterschreiben!">
        <meta property="twitter:description" content="Unterschreibe unsere Initiative hier!">
        <meta property="twitter:image" content="/media/img/og.png">

        <link rel="stylesheet" type="text/css" href="/style/style.css">
        
        <script src="/vendor/jquery/jquery-3.5.1.min.js"></script>

    </head>

<body>
<div id="page-content">
