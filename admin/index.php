<?php
if (isset($_GET["postinstaller"])) {
  function delete_files($target) {
    if(is_dir($target)){
      $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
      
      foreach( $files as $file ){
        delete_files( $file );      
      }
      
      rmdir( $target );
    } elseif(is_file($target)) {
      unlink( $target );  
    }
  }
  delete_files('../install/');
  header("location: index.php");
  exit();
}
session_start();
$pagetitle = "Home";
require_once 'includes/functions.inc.php';
loggedIn($_COOKIE["userUid"]);
require 'elements/header-logedin.php';
require 'elements/nav-logedin.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Hallo, <?=$_COOKIE["userUid"]?>!</h1>
</div>
<p class="lead">Willkommen zum Admin Panel deiner Initiative!</p>
<p>Hier die wichtigsten Funktionen dieser App:</p>

<div class="mt-5 container p-0 float-left" style="max-width:24cm">
  <div class="row">
    <div class="col-sm">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Statistiken</h5>
          <p class="card-text">Schau dier hier umfassende Statistiken zu den bereits gesammelten und versprochenen Unterschriften an.</p>
          <a class="btn btn-primary" href="/admin/stats" role="button">Start</a>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Sheets erfassen</h5>
          <p class="card-text">Hier kannst du Unterschriften-Sheets, welche zurückgesendet wurden, erfassen.</p>
          <a class="btn btn-primary" href="/admin/sheets/" role="button">Start</a>
        </div>
      </div>
    </div>
    <div class="col-sm">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Bogendaten exportieren</h5>
          <p class="card-text">Möchtest du die Daten der Bögen (beispielsweise für Mailchimp) exportieren? Das kannst du hier tun.</p>
          <a class="btn btn-primary" href="/admin/export/" role="button">Start</a>
        </div>
      </div>
    </div>
  </div>
</div>


        

<?php
require 'elements/footer-logedin.php';
?>
