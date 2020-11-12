<?php
include($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
session_start();
getFile("header.php"); 
getFile("nav.php");
?>
<link rel="stylesheet" type="text/css" href="/style/form.css">

<form action="submit.php" method="post" class="small-container">

<div class="step active" id="step1">
    <h2>Persönliche Daten</h2>
    <div class="form__group field">
        <input type="input" class="form__field required" placeholder="Vorname" name="fname" id='fname' required />
        <label for="fname" class="form__label">Vorname</label>
    </div>
    <div class="form__group field">
        <input type="input" class="form__field required" placeholder="Nachname" name="lname" id='lname' required />
        <label for="lname" class="form__label">Nachname</label>
    </div>
    <div class="form__group field">
        <input type="email" class="form__field required" placeholder="E-Mail Adresse" name="email" id='email' required />
        <label for="email" class="form__label">E-Mail Adresse</label>
    </div>
    <div class="form__group field">
        <input type="number" class="form__field" placeholder="Telefon (optional)" name="phone" id='phone' />
        <label for="phone" class="form__label">Telefon (optional)</label>
    </div>
    <div class="formbuttons end">
        <a href="javascript:nextStep(2)" class="button second">Weiter</a>
    </div>
</div>

<div class="step" id="step2">
    <h2>Deine Unterschriften</h2>
    <div class="form__group field">
        <input type="input" class="form__field required" placeholder="Wohnadresse" name="address" id='address' required />
        <label for="address" class="form__label">Wohnadresse</label>
    </div>
    <div class="form__group field">
        <input type="number" class="form__field required" placeholder="PLZ" name="plz" id='plz' required />
        <label for="plz" class="form__label">PLZ</label>
    </div>
    <div class="form__group field">
        <input type="text" class="form__field required" placeholder="Ort" name="ort" id='ort' required />
        <label for="ort" class="form__label">Ort</label>
    </div>
    <div class="form__group field">
        <input type="number" class="form__field required" placeholder="Anzahl Unterschriften" name="nosig" id='nosig' required />
        <label for="nosig" class="form__label">Anzahl Unterschriften</label>
    </div>
    <div class="formbuttons">
        <a href="javascript:nextStep(2)" class="button">Zurück</a>
        <a href="javascript:nextStep(3)" class="button second">Weiter</a>
    </div>
</div>

<div class="step" id="step3">
    <h2>Weiteres</h2>
    <div class="checkbox-container">
        <div style="position:relative; margin-top: 24px;">
            <div class="cbx">
                <input id="cbx1" type="checkbox" name="drucken"/><label for="cbx"></label>
                <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                </svg>
            </div>
        </div>
        <p>Ich habe keinen Drucker, bitte sendet mir einen Unterschriftenbogen zu!</p>
    </div>
    <div class="checkbox-container">
        <div style="position:relative; margin-top: 24px;">
            <div class="cbx">
                <input id="cbx2" type="checkbox" name="optin" checked /><label for="cbx"></label>
                <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                </svg>
            </div>
        </div>
        <p>Ich möchte mehr erfahren.</p>
    </div>
    <div class="formbuttons">
        <a href="javascript:nextStep(3)" class="button">Zurück</a>
        <input type="submit" class="button second" value="Weiter">
    </div>
</div>
</form>

<div id="progress-container">
    <hr id="route">
    <div id="progress-inner">
        <div class="progress-circle active" id="progress1">1</div>
        <div class="progress-circle" id="progress2">2</div>
        <div class="progress-circle" id="progress3">3</div>
        <div class="progress-circle" id="progress4">4</div>
    </div>
</div>

<?php
getFile("footer.php");
?>
