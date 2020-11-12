<?php
if (!isset($_GET["sheetID"])) {
    header("location: mysheets.php");
}
$sheetID = $_GET["sheetID"];
session_start();
$pagetitle = "Sheet " . $sheetID . " bearbeiten";
require_once '../includes/functions.inc.php';
require '../elements/header-logedin.php';
loggedIn($_COOKIE["userUid"]);
require '../elements/nav-logedin.php';

require $_SERVER['DOCUMENT_ROOT'] . '/config/config.inc.php';

$sql = "SELECT * FROM sheet WHERE sheetID = ?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: mysheets.php?error=stmtError");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $sheetID);
mysqli_stmt_execute($stmt);
$resultData = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultData);

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

if (isset($_GET['sheetupdated'])) {
    if ($_GET['sheetupdated'] == "yes") {
      $msgtype = "success";
      $msg = "Das Sheet wurde erfolgreich erfasst!";
    } else if ($_GET['sheetupdated'] == "yes") {
      $msgtype = "danger";
      $msg = "Das Sheet wurde erfolgreich erfasst!";
    }
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Sheet <?= $sheetID ?> bearbeiten</h1>
</div>

<div class="container p-0 float-left" style="max-width:24cm;">
  <?php
  if (isset($msgtype)) { ?>

  <div class="alert alert-<?= $msgtype ?>" role="alert">
    <?= $msg ?>
  </div>
  
  <?php } ?>
  <form method="post" action="/admin/includes/updatesheet.inc.php">
    <div class="form-group">
      <label for="sheetBogenID">Bogen ID</label>
      <input type="text" class="form-control" id="sheetBogenID" name="sheetBogenID" value="<?php if ($row["sheetType"] == "online") { echo($row["sheetBogenID"]); } ?>" readonly>
      <small class="form-text text-muted">Dieses Feld kannst du nicht bearbeiten: Wenn es ein mal ausgefüllt wurde, musst du das Sheet löschen, um es nochmals zu erfassen.</small>
    </div>
    <div class="form-group">
      <p>Sheet Art</p>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="online" name="sheetType" value="online" <?php if ($row["sheetType"] == "online") { echo("checked"); } else { echo("disabled"); } ?>>
        <label class="form-check-label" for="online">Online-Sheet</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="versand" name="sheetType" value="versand" <?php if ($row["sheetType"] == "online") { echo("disabled"); } else if ($row["sheetType"] == "versand") { echo("checked"); } ?>>
        <label class="form-check-label" for="versand">Versand-Sheet</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="strasse" name="sheetType" value="strasse" <?php if ($row["sheetType"] == "online") { echo("disabled"); } else if ($row["sheetType"] == "strasse") { echo("checked"); } ?>>
        <label class="form-check-label" for="strasse">Strassen-Sheet</label>
      </div>
    </div>
    <div class="form-group">
      <label for="sheetPLZ">PLZ</label>
      <input type="number" class="form-control" id="sheetPLZ" name="sheetPLZ" value="<?= $row["sheetPLZ"]?>">
      <small class="form-text text-danger">Bitte Postleitzahl der politischen Gemeinde angeben!</small>
    </div>
    <div class="form-group">
      <label for="sheetNosig">Anzahl Unterschriften</label>
      <input type="number" class="form-control" id="sheetNosig" name="sheetNosig" value="<?= $row["sheetNosig"]?>">
    </div>
    <div class="form-group">
      <label for="sheetID">Sheet ID</label>
      <input type="text" class="form-control" id="sheetID" name="sheetID" value="<?= $row["sheetID"]?>" readonly>
      <small class="form-text text-muted">Dieses Feld kannst du nicht bearbeiten: Wenn es ein mal ausgefüllt wurde, musst du das Sheet löschen, um es nochmals zu erfassen.</small>
    </div>
    <input type="hidden" name="sheetUser" value="<?= $_COOKIE["userUid"]?>">
    <input type="hidden" name="sheetOldNosig" value="<?= $row["sheetNosig"]?>">
    <button type="submit" name="editsheet" value="update" class="btn btn-primary mr-3">Aktualisieren</button>
    <button type="submit" name="editsheet" value="delete" title="Wirklich löschen?" data-toggle="popover" data-trigger="hover" data-content="Dieser Schritt kann nicht rückgängig gemacht werden." class="btn btn-danger">Sheet löschen</button>
  </form>
</div>



<?php
require '../elements/footer-logedin.php';
?>
