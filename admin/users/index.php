<?php
session_start();
$pagetitle = "Users verwalten";
require_once '../includes/functions.inc.php';
require_once '../elements/header-logedin.php';
loggedIn($_COOKIE["userUid"]);
require_once '../elements/nav-logedin.php';

if (isset($_GET)) {
    if (isset($_GET["error"])) {
        $msgtype = "danger";
        if ($_GET["error"] == "stmterror") {
            $msg = "Es gab einen Datenbankfehler. Bitte versuche es erneut.";
        } else if ($_GET["error"] == "userNoexist") {
            $msg = "Dieser User existiert nicht!";
        } else {
            $msg = "Es gab einen unbekannten Fehler. Sorry!";
        }
    } else if (isset($_GET["freed"])) {
        $msgtype = "success";
        $msg = "Der User mit der ID " . $_GET["freed"] . " wurde freigeschaltet!";
    } else if (isset($_GET["deleted"])) {
        $msgtype = "warning";
        $msg = "Der User mit der ID " . $_GET["deleted"] . " <strong>wurde gelöscht!</strong>";
    }
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Users verwalten</h1>
</div>

<div class="container float-left p-0" style="max-width: 21cm">
    <p>Hier kannst du die Benutzer*innen der App verwalten:</p>
<?php if (isset($msgtype)) { ?><div class="alert-<?= $msgtype ?> alert" role="alert"><?= $msg ?></div> <?php } ?>
    <table id="users" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th scope="col">User ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
<?php
    require '../includes/config.inc.php';
    $sql = "SELECT * FROM users";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?error=stmtError");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    foreach ($resultData as $result) { 
?>
            <tr>
                <th><?= $result["usersID"] ?></th>
                <td><?= $result["usersUid"] ?></td>
                <td><?= $result["usersEmail"] ?></td>
                <td>
                <select class="form-control form-control-sm actionselect" id="actionselect">
                    <option><em>Option Wählen...</em></option>
                    <option value="/admin/includes/freeuser.inc.php?usersID=<?= $result["usersID"] ?>">Freischalten</option>
                    <option value="/admin/includes/deleteuser.inc.php?usersID=<?= $result["usersID"] ?>">Löschen</option>
                </select>
                </td>
            </tr>
<?php } ?>
        </tbody>
        </table>


</div>

<?php
require '../elements/footer-logedin.php';
?>