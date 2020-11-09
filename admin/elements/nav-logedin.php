<?php
require $_SERVER["DOCUMENT_ROOT"] . '/admin/includes/config.inc.php';
?>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/"><?= $appName ?></a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/admin/includes/logout.inc.php">Ausloggen</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/"><span data-feather="home"></span>Home</a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">Statistiken</h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/stats/"><span data-feather="bar-chart"></span>Sammelstand</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="/admin/stats/gemeinden.php"><span data-feather="map-pin"></span>Gemeinden</a>
                    </li>-->
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">Sheets</h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/sheets/"><span data-feather="file-plus"></span>Sheets erfassen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/sheets/mysheets.php"><span data-feather="file"></span>Meine Sheets</a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">Funktionen</h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/functions/"><span data-feather="folder"></span>Exportieren</a>
                    </li>
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">User Verwaltung</h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users/"><span data-feather="settings"></span>Users verwalten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users/setpw.php"><span data-feather="lock"></span>Passwort wechseln</a>
                    </li>
                </ul>
            </div>
        </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">