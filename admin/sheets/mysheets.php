<?php
session_start();
$pagetitle = "Meine Sheets";
require_once '../includes/functions.inc.php';
require_once '../elements/header-logedin.php';
loggedIn($_COOKIE["userUid"]);
require_once '../elements/nav-logedin.php';

if (isset($_GET['sheetupdated'])) {
    if ($_GET['sheetupdated'] == "yes") {
      $msgtype = "success";
      $msg = "Das Sheet wurde erfolgreich erfasst!";
    } else if ($_GET['sheetupdated'] == "deleted") {
      $msgtype = "danger";
      $msg = "<strong>Dein Sheet wurde gelöscht</strong>";
    }
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Meine Unterschriften Sheets</h1>
</div>

<div class="container-fluid float-left p-0">
    <p>Hier findest du alle sheets, welche von dir erfasst worden sind, sortiert nach Erfassungsdatum:</p>
    <?php
    if (isset($msgtype)) { ?>
    <div class="alert alert-<?= $msgtype ?>" role="alert">
        <?= $msg ?>
    </div>
    <?php } ?>

    <table id="mysheets" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th scope="col">Sheet ID</th>
            <th scope="col">PLZ</th>
            <th scope="col">Anzahl Unterschriften</th>
            <th scope="col">Datum</th>
            </tr>
        </thead>
        <tbody>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/config/config.inc.php';
    $mysheetsUid = $_COOKIE["userUid"];
    $sql = "SELECT * FROM sheet WHERE sheetUser = ? ORDER BY sheetTimestamp DESC;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: mysheets.php?error=stmtError");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $mysheetsUid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    foreach ($resultData as $result) { 
?>
            <tr>
                <th><a href="editsheet.php?sheetID=<?= $result["sheetID"] ?>"><?= $result["sheetID"] ?> <span data-feather="edit"></span></a></th>
                <td><?= $result["sheetPLZ"] ?></td>
                <td><?= $result["sheetNosig"] ?></td>
                <td><?= date('d.m.Y G:i', strtotime($result["sheetTimestamp"])); ?></td>
            </tr>
<?php } ?>
        </tbody>
        </table>


</div>

<?php
require '../elements/footer-logedin.php';
?>
