<?php
session_start();
$pagetitle = "Bogen erfassen";
require_once '../includes/functions.inc.php';
require '../elements/header-logedin.php';
loggedIn($_COOKIE["userUid"]);
require '../elements/nav-logedin.php';

if (isset($_GET['error'])) {
  $msgtype = "danger";
  if ($_GET['error'] == "emptyfields") {
    $msg = "Bitte fülle alle Felder aus!";
  }
  else if ($_GET['error'] == "sheetIDexists") {
    $msg = "Diese Sheet ID existiert bereits.";
  }
  else if ($_GET['error'] == "bogenIDwrong") {
    $msg = "<strong>Diese Bogen ID existiert nicht.</strong> Hast du einen Fehler beim Scannen des QR Codes gemacht? (Bogen ID: " . $_GET["sheetBogenID"] . ")";
  }
  else if ($_GET['error'] == "stmtError") {
    $msg = "Es gab ein Problem mit der Datenbank Verbindung. Bitte kontaktiere Timothy.";
  }
  else {
    $msg = "Es gab einen unbekannten Fehler... Bitte versuche es nochmals oder kontaktiere Timothy.";
  }
}

if (isset($_GET['sheetadded']) && $_GET['sheetadded'] == "yes") {
  $msgtype = "success";
  $msg = "Das Sheet wurde erfolgreich erfasst!";
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Unterschriften-Sheet erfassen</h1>
</div>

<div class="container p-0 float-left" style="max-width:24cm;">
  <?php
  if (isset($msgtype)) { ?>

  <div class="alert alert-<?= $msgtype ?>" role="alert">
    <?= $msg ?>
  </div>
  
  <?php } ?>
  <form method="post" action="/admin/includes/erfassen.inc.php">
    <h3>Formular zum erfassen</h3>
    <div class="form-group">
      <label for="sheetBogenID">Bogen ID</label>
      <input type="text" class="form-control" id="sheetBogenID" name="sheetBogenID" value="<?php if (isset($_GET["sheetBogenID"])) { echo($_GET["sheetBogenID"]); } ?>" readonly>
      <small id="emailHelp" class="form-text text-muted">Dieses Feld wird automatisch ausgefüllt, wenn es sich um ein Online-Sheet handelt.</small>
    </div>
    <div class="form-group">
      <p>Sheet Art</p>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="online" name="sheetType" value="online" <?php if (isset($_GET["sheetBogenID"])) { echo("checked"); } else { echo("disabled"); } ?>>
        <label class="form-check-label" for="online">Online-Sheet</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="versand" name="sheetType" value="versand" <?php if (isset($_GET["sheetBogenID"])) { echo("disabled"); } ?>>
        <label class="form-check-label" for="versand">Versand-Sheet</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="strasse" name="sheetType" value="strasse" <?php if (isset($_GET["sheetBogenID"])) { echo("disabled"); } ?>>
        <label class="form-check-label" for="strasse">Strassen-Sheet</label>
      </div>
    </div>
    <div class="form-group">
      <label for="sheetPLZ">PLZ</label>
      <input type="number" class="form-control" id="sheetPLZ" name="sheetPLZ">
      <small class="form-text text-danger">Bitte Postleitzahl der politischen Gemeinde angeben!</small>
    </div>
    <div class="form-group">
      <label for="sheetNosig">Anzahl Unterschriften</label>
      <input type="number" class="form-control" id="sheetNosig" name="sheetNosig">
    </div>
    <div class="form-group">
      <label for="sheetID">Sheet ID</label>
      <input type="text" class="form-control" id="sheetID" name="sheetID">
      <small class="form-text text-muted">Gib diesem Sheet bitte eine eindeutige Nummer. Dies dient zur Identifikation später.</small>
    </div>
    <input type="hidden" name="sheetUser" value="<?= $_COOKIE["userUid"]?>">
    <button type="submit" name="submitsheet" class="btn btn-primary mr-3">Erfassen</button>
    <?php if (isset($_GET["sheetBogenID"])) { ?> <a class="btn btn-outline-primary" href="/admin/functions?sheetBogenID=<?=$_GET["sheetBogenID"] ?>" target="_blank">Bogendetails</a> <?php } ?>
  </form>
</div>


<?php
require '../elements/footer-logedin.php';
?>