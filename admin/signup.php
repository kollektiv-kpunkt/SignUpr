<?php
session_start();
$pagetitle = "Registrieren";
require 'elements/header-logedin.php';
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyInput") {
        $message = "Fülle bitte alle Felder aus";
    } else if ($_GET["error"] == "invalidUid") {
        $message = 'Benutze für deinen Username bitte nur Buchstaben, Zahlen und gewisse Sonderzeichen ("_, -, !").';
    } else if ($_GET["error"] == "invalidEmail") {
        $message = "Benutze bitte eine echte E-Mail Adresse.";
    } else if ($_GET["error"] == "pwdNomatch") {
        $message = "Die eingegebenen Passwörter stimmen nicht überein.";
    } else if ($_GET["error"] == "pwdNotstrong") {
        $message = "Dein Passwort muss mindestens 8 Zeichen lang sein.";
    } else if ($_GET["error"] == "uidExists") {
        $message = "Diese*r Username/E-Mail Adresse ist bereits vergeben.";
    } else if ($_GET["error"] == "invalidUid") {
        $message = "Benutze für deinen Username bitte nur Gross- und Kleinbuchstaben und Zahlen.";
    }
}

if (isset($_GET["usercreated"])) {
    if ($_GET["usercreated"] == "yes") {
        $message = "Dein User wurde erfolgreich registriert. Bitte warte bis wir ihn freischalten. Du wirst per Mail informiert, sobald es soweit ist. Danke für deine Geduld.";
    }
}

?>
<link rel="stylesheet" type="text/css" href="/admin/style/login.css">

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <a href="login.php"><h2 class="inactive underlineHover">Einloggen</h2></a>
    <h2 class="active">Registrieren </h2>

    <!-- Login Form -->
    <form method="post" action="includes/signup.inc.php">
        <h2 style="color:#232323; margin-top: 1rem;">Registrieren</h2>
        <input type="text" id="name" class="fadeIn second" name="name" placeholder="Namne">
        <input type="text" id="uid" class="fadeIn second" name="uid" placeholder="Username">
        <input type="email" id="email" class="fadeIn second" name="email" placeholder="E-Mail Adresse">
        <input type="password" id="pwd" class="fadeIn second" name="pwd" placeholder="Passwort">
        <input type="password" id="pwdrepeat" class="fadeIn second" name="pwdrepeat" placeholder="Wiederholen">
        <button type="submit" class="fadeIn second" name="submit" value="Log In">Registrieren</a></button>
        <?php if (isset($_GET["error"])) { echo("<p style='color: red; font-size: 0.8rem'>" . $message . "</p>"); } ?>
        <?php if (isset($_GET["usercreated"])) { echo("<p style='color: green; font-size: 0.8rem'>" . $message . "</p>"); } ?>
    </form>
  </div>
</div>

<?php
require 'elements/footer-logedin.php';
?>