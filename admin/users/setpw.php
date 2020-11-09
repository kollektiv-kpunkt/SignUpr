<?php
session_start();
$pagetitle = "Passwort ändern";
require_once '../includes/functions.inc.php';
require '../elements/header-logedin.php';
loggedIn($_COOKIE["userUid"]);
require '../elements/nav-logedin.php';

if (isset($_GET)) {
    if (isset($_GET["error"])) {
        $msgtype = "danger";
        if ($_GET["error"] == "stmterror") {
            $msg = "Es gab einen Datenbankfehler. Bitte versuche es erneut.";
        } else if ($_GET["error"] == "fieldEmpty") {
            $msg = "Bitte fülle alle Felder aus!";
        } else if ($_GET["error"] == "noMatch") {
            $msg = "Die Passwörter stimmen nicht überein!";
        } else if ($_GET["error"] == "pwWrong") {
            $msg = "<b>Das eingegebene Passwort stimmt nicht!</b>";
        } else {
            $msg = "Es gab einen unbekannten Fehler. Sorry!";
        }
    } else if (isset($_GET["success"])) {
        $msgtype = "success";
        $msg = "Das Passwort für den User " . $_GET["success"] . " wurde erfolgreich geändert!";
    }
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Passwort ändern</h1>
</div>

<div class="container p-0 float-left" style="max-width:24cm;">
  <?php
  if (isset($msgtype)) { ?>

  <div class="alert alert-<?= $msgtype ?>" role="alert">
    <?= $msg ?>
  </div>
  
  <?php } ?>
  <form method="post" action="/admin/includes/setpw.inc.php">
    <input type="hidden" class="form-control" id="userUid" name="userUid" value="<?= $_COOKIE["userUid"] ?>">
    <div class="form-group">
      <label for="currPW">Aktuelles Passwort</label>
      <input type="password" class="form-control" id="currPW" name="currPW">
    </div>
    <div class="form-group">
      <label for="newPW">Neues Passwort</label>
      <input type="password" class="form-control" id="newPW" name="newPW">
    </div>
    <div class="form-group">
      <label for="newPWre">Neues Passwort (bestätigen)</label>
      <input type="password" class="form-control" id="newPWre" name="newPWre">
    </div>
    <button type="submit" name="setpw" value="update" class="btn btn-primary mr-3">Passwort wechseln</button>
  </form>
</div>


<?php
require '../elements/footer-logedin.php';
?>