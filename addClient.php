<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
<?php
require 'Include/SourceDonnees.inc.php';
require 'Include/helpersLibrary.inc.php';
session_start();

if ($_SESSION['restraint'] == 1) {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Commercial") {
        require_once 'comDashboard.php';
    }

} else {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Commercial") {
        require_once 'comDashboard.php';
    }
    ?>

    <h2>Ajout Client</h2>
    <p>Client</p>

    <form name="formAddClient" method="post">
        <?php
echo formInputText2('Nom Complet', 'Name', 'Name', null, 50, 2, 50, 10, false, true);
    echo formInputText2('Nom Entreprise', 'Enterprise', 'Enterprise', null, 50, 2, 200, 20, false, true);
    echo formInputText2('Mail', 'mail', 'mail', null, 50, 2, 150, 30, false, true);
    echo formInputText2('Telephone', 'phone', 'phone', null, 10, 10, 10, 40, false, false);
    echo formInputText2('Adresse', 'adress', 'adress', null, 50, 2, 250, 50, false, false);
    echo formInputText2('Ville', 'localisation', 'localisation', null, 50, 2, 50, 50, false, false);
    echo formInputText2('Google Analytics', 'anaylics', 'analytics', null, 50, 2, 50, 60, false, false);

    //compte GMB
    //compte insta
    //compte analytics
    // mandat sepa
    //cni
    //rib
    //contrat
    //idTB
    echo formInputText2('Siret', 'siret', 'siret', null, 13, 13, 13, 60, false, false);
    echo createSelect('forfait', 'forfait', 'Forfait', 70, getForfait());
    ?>
        <label for="dureeContrat">Durée du contrat:</label>
        <select name= "dureeContrat" id="dureeContrat" tabindex="80">
            <option value="12">12 mois</option>
            <option value="24">24 mois</option>
            <option value="36">36 mois</option>
        </select>
        <?php
echo '<label for="dateSignature">Date de signature :</label><input type="date" id = "dateSignature" name = "dateSignature"></br>';
    echo createSelect('secteurActivite', 'secteurActivite', 'Secteur d\'activité', 50, getSecteurActivite());
    echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 60);
    ?>
    </form>

    <?php

    echo ' <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-5">
                    <form class="form-group" method="POST" action="addpdf.php" enctype="multipart/form-data">
                        <div class="d-grid gap-2 col-6 mx-auto mt-5">
                            <input type="file" class="form-control" name="avatar" id="avatar"  placeholder="">
                        </div>
                        <div class="d-grid gap-2 col-2 mx-auto mt-5">
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>';

    if (isset($_POST["btnSubmit"])) {
        if (isset($_REQUEST['Name']) && isset($_REQUEST['adress']) && isset($_REQUEST['Enterprise']) && isset($_REQUEST['mail']) && isset($_REQUEST['dateSignature']) && isset($_REQUEST['secteurActivite']) && isset($_REQUEST['phone']) && isset($_REQUEST['siret']) && isset($_REQUEST['dureeContrat']) && isset($_REQUEST['forfait']) && isset($_REQUEST['localisation'])) {
            $Name = $_REQUEST['Name'];
            $adresse = $_REQUEST['adress'];
            $Entreprise = $_REQUEST['Enterprise'];
            $mail = $_REQUEST['mail'];
            $dateSignature = $_REQUEST['dateSignature'];
            if ($dateSignature == "") {
                $dateSignature = date('Y-m-d');
            }
            $secteurActivite = $_REQUEST['secteurActivite'];
            $phone = $_REQUEST['phone'];
            $localisation = $_REQUEST['localisation'];
            $dureeEngagement = $_REQUEST['dureeContrat'];
            $compteGMB = ' non';
            $compteAnalytics = $_REQUEST['anaylics'];
            $compteInsta = ' non';
            $mandatSepa = ' non';
            $cni = ' non';
            $rib = ' non';
            $contrat = ' non';
            $photo = ' non';
            $siret = $_REQUEST['siret'];
            $forfait = $_REQUEST['forfait'];
            $secteurActivite = $_REQUEST['secteurActivite'];
            $idTB = $_SESSION['id'];
            addClient($Name, $Entreprise, $mail, $phone, $photo, $localisation, $adresse, $dateSignature, $dureeEngagement, $compteGMB, $compteInsta, $compteAnalytics, $mandatSepa, $cni, $rib, $contrat, $siret, $forfait, $secteurActivite, $idTB);
        }
    }
}
?>
</div>
</body>
</html>