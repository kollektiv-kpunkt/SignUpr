<?php
session_start();
$pagetitle = "Mailchimp";
require_once '../includes/functions.inc.php';
require '../elements/header-logedin.php';
loggedIn($_COOKIE["userUid"]);
require '../elements/nav-logedin.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Datenexport</h1>
</div>

<div class="container-fluid float-left p-0">
    <p>Hier kannst du die Daten der Bögen exportieren:</p>

    <table id="allbogen" class="table table-striped table-bordered" style="width: 100%">
        <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Bogen ID</th>
              <th scope="col">Erstelldatum</th>
              <th scope="col">Vorname</th>
              <th scope="col">Nachname</th>
              <th scope="col">E-Mail Addresse</th>
              <th scope="col">Telefonnummer</th>
              <th scope="col">Adresse</th>
              <th scope="col">PLZ</th>
              <th scope="col">Ort</th>
              <th scope="col">opt-in</th>
              <th scope="col">#Unterschriften</th>
              <th scope="col">#Retour</th>
              <th scope="col">#Fehlend</th>
              <th scope="col">Fertig?</th>
              <th scope="col">Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/config/config.inc.php';
    $sql = "SELECT * FROM bogen";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: mailchimp.php?error=stmtError");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    foreach ($resultData as $result) { 
?>
            <tr>
                <th scope="row"><?= $result["ID"] ?></th>
                <td><a href="/media/pdf/bogen-<?= $result["bogenID"] ?>.pdf" target="_blank"><?= $result["bogenID"] ?></td>
                <td><?= date('d.m.Y G:i', strtotime($result["bogenTimestamp"])) ?></td>
                <td><?= $result["fname"] ?></td>
                <td><?= $result["lname"] ?></td>
                <td><?= $result["email"] ?></td>
                <td><?= $result["phone"] ?></td>
                <td><?= $result["address"] ?></td>
                <td><?= $result["plz"] ?></td>
                <td><?= $result["ort"] ?></td>
                <td><?php if ($result["optin"] == 1) {echo("<span class='text-success'>Ja</span>"); } else {echo("<span class='text-danger'>Nein</span>"); } ?></td>
                <td><?= $result["nosig"] ?></td>
                <td><?= $result["returned"] ?></td>
                <td><?= $result["notreturned"] ?></td>
                <td><?php if ($result["done"] == 1) {echo("<span class='text-success'>Ja</span>"); } else {echo("<span class='text-danger'>Nein</span>"); } ?></td>
                <td>
                <select class="form-control form-control-sm actionselect" id="actionselect">
                    <option><em>Option Wählen...</em></option>
                    <option value="/admin/includes/generateletter.inc.php?usersID=<?= $result["bogenID"] ?>">Brief generieren</option>
                    <option value="/admin/includes/deletebogen.inc.php?usersID=<?= $result["bogenID"] ?>">Löschen</option>
                </select>
                </td>
            </tr>
<?php } ?>
        </tbody>
        </table>

</div>

<script>
$(document).ready( function () {
    $('#allbogen').DataTable( {
        "pagingType": "full_numbers",
        searchPanes:{
            cascadePanes: true,
            viewTotal: true,
        },
        "columnDefs": [
            { "visible": false, "targets": [1, 2, 5, 6, 7, 8, 10, 12]}
        ],
        buttons: [
            'colvis',
            'csv',
            'excel'
        ],
        <?php if (isset($_GET["sheetBogenID"])) { echo('"oSearch": {"sSearch": "' . $_GET["sheetBogenID"] . '"},'); } ?>
        "order": [[ 0, 'desc' ]],
        dom: 
            "<'row'<'col-sm-12 col-md-6'Q><'col-sm-12 col-md-6'>>" +
            "<'row'<'col-sm-12 col-md-6 mb-4'B><'col-sm-12 col-md-6'>>" +
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
    });
} );
</script>

<?php
require '../elements/footer-logedin.php';
?>
