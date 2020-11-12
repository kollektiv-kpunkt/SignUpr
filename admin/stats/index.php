<?php
session_start();
$pagetitle = "Statistiken";
require_once '../includes/functions.inc.php';
require '../elements/header-logedin.php';
require '../elements/nav-logedin.php';
?>

<div id="load">
  <?php
  require $_SERVER['DOCUMENT_ROOT'] . '/config/config.inc.php';
  //Benötigte Unterschriften
  $benot = 3000;

  //Erhaltene Versand
  $sql = "SELECT SUM(sheetNosig) FROM sheet WHERE sheetType = 'versand';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: mailchimp.php?error=stmtError");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($resultData);
    if ($result["SUM(sheetNosig)"] != "" && $result["SUM(sheetNosig)"] != NULL) {
      $erhVer = $result["SUM(sheetNosig)"];
    } else {
      $erhVer = 0;
    }

  //Erhaltene Strasse
  $sql = "SELECT SUM(sheetNosig) FROM sheet WHERE sheetType = 'strasse';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: mailchimp.php?error=stmtError");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($resultData);
    if ($result["SUM(sheetNosig)"] != "" && $result["SUM(sheetNosig)"] != NULL) {
      $erhStr = $result["SUM(sheetNosig)"];
    } else {
      $erhStr = 0;
    }

  //Erhaltene Online
  $sql = "SELECT SUM(returned) FROM bogen;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: mailchimp.php?error=stmtError");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($resultData);
    if ($result["SUM(returned)"] != "" && $result["SUM(returned)"] != NULL) {
      $erhOnl = $result["SUM(returned)"];
    } else {
      $erhOnl = 0;
    }

  //Versprochene Online fehlend
  $sql = "SELECT SUM(notreturned) FROM bogen;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: mailchimp.php?error=stmtError");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($resultData);
    if ($result["SUM(notreturned)"] != "" && $result["SUM(notreturned)"] != NULL) {
      $fehOnl = $result["SUM(notreturned)"];
    } else {
      $fehOnl = 0;
    }

  //Total erhaltene Unterschriften = Erhaltene Versand + Erhaltene Strasse + Erhaltene Online
  $totErh = $erhVer + $erhStr + $erhOnl;

  //Anteil Erhaltene = Erhaltene / Benötigte * 100 (+ runden)
  $AntErh = round((($totErh / $benot) * 100), 2); 

  //Total Unterschriften = Erhaltene + Fehlende
  $tot = $totErh + $fehOnl;

  // Anteil Fehlende + Erhaltene = Total / Benötigte * 100 (+ runden)
  $AntTot = round((($tot / $benot) * 100), 2);

  if ($AntErh <= 50 && $AntErh > 75) {
    $stand = "warning";
  } else if ($AntErh >= 75) {
    $stand = "success";
  } else {
    $stand = "danger";
  }
  ?>


  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Statistiken</h1>
  </div>

  <div class="container p-0" style="max-width:24cm; margin: auto auto auto 0">
    <p class="lead">Diese Seite soll eine Liste der bisher gesamelten Unterschriften darstellen. Die Ergebnisse hinken den realen Zahlen bis zu 10 Minuten hinterher.</p>
    <h3>Sammelstand effektiv: <span class="text-<?= $stand ?>"><?= $AntErh ?>%</span></h3>
    <div class="progress mt-2" style="transition: 0.5s;">
      <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="<?= $erhVer / $benot * 100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $erhVer / $benot * 100 ?>%"></div>
      <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="<?= $erhStr / $benot * 100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $erhStr / $benot * 100 ?>%"></div>
      <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" aria-valuenow="<?= $erhOnl / $benot * 100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $erhOnl / $benot * 100 ?>%"></div>
      <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="<?= $fehOnl / $benot * 100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $fehOnl / $benot * 100 ?>%"></div>
    </div>
  </div>
  <div class="container p-0" style="max-width:24cm; margin: 3rem auto auto 0">
    <h4 class="mb-3">Zugrunde liegende Daten</h4>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Bogenart</th>
          <th scope="col">#Unterschriften</th>
          <th scope="col">Anteil</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row" class="text-info">Erhaltene Versandunterschriften</th>
          <td class="text-info"><?= $erhVer ?></td>
          <td class="text-info"><?= $erhVer / $benot * 100 ?>%</td>
        </tr>
        <tr>
          <th scope="row" class="text-primary">Erhaltene Strassenunterschriften</th>
          <td class="text-primary"><?= $erhStr ?></td>
          <td class="text-primary"><?= $erhStr / $benot * 100 ?>%</td>
        </tr>
        <tr>
          <th scope="row" class="text-dark">Erhaltene Onlineunterschriften</th>
          <td class="text-dark"><?= $erhOnl ?></td>
          <td class="text-dark"><?= $erhOnl / $benot * 100 ?>%</td>
        </tr>
        <tr>
          <th scope="row" class="text-warning">Fehlende Onlineunterschriften</th>
          <td class="text-warning"><?= $fehOnl ?></td>
          <td class="text-warning"><?= $fehOnl / $benot * 100 ?>%</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="container p-0" style="max-width:24cm; margin: 1rem auto auto 0">
    <h6>Legende</h6>
    <div class="container">
      <div class="row mb-1">
        <div class="col-sm p-0">
          <div style="display: flex;">
            <div class="progress" style="width:20px; height: 20px">
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <span style="margin-left: 14px;">Erhaltene Versandunterschriften</span>
          </div>
        </div>
        <div class="col-sm p-0">
          <div style="display: flex;">
            <div class="progress" style="width:20px; height: 20px">
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <span style="margin-left: 14px;">Erhaltene Strassenunterschriften</span>
          </div>
        </div>
      </div>
      <div class="row mb-1">
        <div class="col-sm p-0">
          <div style="display: flex;">
            <div class="progress" style="width:20px; height: 20px">
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <span style="margin-left: 14px;">Erhaltene Onlineunterschriften</span>
          </div>
        </div>
        <div class="col-sm p-0">
          <div style="display: flex;">
            <div class="progress" style="width:20px; height: 20px">
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <span style="margin-left: 14px;">Fehlende Onlineunterschriften</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
setInterval(() => {
  $("#load").load("/admin/stats/load.php");
}, 10000);
</script>

<?php
require '../elements/footer-logedin.php';
?>
