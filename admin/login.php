<?php
session_start();
$pagetitle = "Login";
require 'elements/header-logedin.php';
if (isset($_GET["error"])) {
  if ($_GET["error"] == "emptyInput") {
      $message = "Fülle bitte alle Felder aus";
  } else if ($_GET["error"] == "usernoexist") {
      $message = 'Es existiert kein User mit diesen Angaben.';
  } else if ($_GET["error"] == "wrongpwd") {
      $message = "Das Passwort ist falsch.";
  } else if ($_GET["error"] == "pending") {
    $message = "Dein User muss noch freigeschaltet werden.";
  } else if ($_GET["error"] == "timelogout") {
    $message = "Du wurdest ausgeloggt.";
  }
}

if (isset($_GET["message"])) {
  if ($_GET["message"] == "logoutsuccess") {
      $message = "Du wurdest erfolgreich ausgeloggt.";
  }
}
?>
<link rel="stylesheet" type="text/css" href="/admin/style/login.css">


<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Log In </h2>
    <a href="signup.php"><h2 class="inactive underlineHover">Registrieren </h2></a>

    <!-- Login Form -->
    <form method="post" action="includes/login.inc.php">
        <h2 style="color:#232323; margin-top: 1rem;">Admin Panel "Gratis ÖV"</h2>
        <input type="text" class="fadeIn second" name="uid" placeholder="Unsername/E-Mail Adresse">
        <input type="password" id="password" class="fadeIn second" name="pwd" placeholder="Passwort">
        <?php if (isset($_GET["pathPrelogin"])) { echo("<input type='hidden' id='pathPrelogin' name='pathPrelogin' value='" . $_GET["pathPrelogin"] . "'>"); } ?>
        <button type="submit" name="submit" class="fadeIn second">Einloggen</button>
        <?php if (isset($_GET["error"])) { echo("<p style='color: red; font-size: 0.8rem'>" . $message . "</p>"); } ?>
        <?php if (isset($_GET["message"])) { echo("<p style='font-size: 0.8rem'>" . $message . "</p>"); } ?>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>

<?php
require 'elements/footer-logedin.php';
?>