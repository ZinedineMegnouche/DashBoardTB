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
if ($_SESSION['restraint'] != 1) {
    require_once 'comDashboard.php';
    echo '<h2>Mes client Client</h2>';
    getClientByIdCom($_SESSION['id']);
} else {
    require_once 'adminDashboard.php';
    echo '<h2>Mes Clients</h2>';
    echo '<p>Vous n\'avez pas de clients</p>';
}
?>

<form name="lstClient" method="post">
    <?php

if (isset($_REQUEST['lstClient'])) {
    echo createSelect('lstClient', 'lstClient', 'Mes clients: ', 10, getListClient($_SESSION['id']), $_REQUEST['lstClient']);
    echo formBoutonSubmit('btnSubmit1', 'btnSubmit1', 'OK', 20);
} else {
    echo createSelect('lstClient', 'lstClient', 'Mes clients: ', 10, getListClient($_SESSION['id']));
    echo formBoutonSubmit('btnSubmit1', 'btnSubmit1', 'OK', 20);
}

?>
    </form>
    <?php

if (isset($_POST['btnSubmit1'])) {
    $idClient = $_REQUEST['lstClient'];
    $client = getClientById($idClient);
    echo '<form name="formAddClient" method="post">';
    echo formInputText2('Nom Complet', 'Name', 'Name', $client['name'], 50, 2, 50, 10, false, true);
    echo formInputText2('Nom Entreprise', 'Enterprise', 'Enterprise', $client['enterprise'], 50, 2, 200, 20, false, true);
    echo formInputText2('Mail', 'mail', 'mail', $client['mail'], 50, 2, 150, 30, false, true);
    echo formInputText2('Telephone', 'phone', 'phone', $client['tel'], 10, 10, 10, 40, false, false);
    echo formInputText2('Adresse', 'adress', 'adress', $client['adress'], 50, 2, 250, 50, false, false);
    echo formInputText2('Ville', 'localisation', 'localisation', $client['localisation'], 50, 2, 50, 50, false, false);
    //compte GMB
    //compte insta
    //compte analytics
    // mandat sepa
    //cni
    //rib
    //contrat
    //idTB
    echo formInputText2('Siret', 'siret', 'siret', $client['SIRET'], 13, 13, 13, 60, false, false);
    echo createSelect('forfait', 'forfait', 'Forfait', 70, getForfait(), $client['idForfait']);
    echo '<label for="dureeContrat">Durée du contrat:</label>
        <select name= "dureeContrat" id="dureeContrat" tabindex="60">';
    echo '<option value="12" ';
    if ($client['dureeEngagement'] == '12') {
        echo ' selected>12 mois</option>';
    } else {
        echo '>12 mois</option>';
    }
    echo '<option value="24" ';
    if ($client['dureeEngagement'] == '24') {
        echo ' selected>24 mois</option>';
    } else {
        echo ' >24 mois</option>';
    }
    echo '<option value="36" ';
    if ($client['dureeEngagement'] == '36') {
        echo ' selected>36 mois</option>';
    } else {
        echo ' >36 mois</option>';
    }

    echo '</select>';
    echo '<label for="dateSignature">Date de signature :</label><input type="date" id = "dateSignature" value ="' . $client['dateSignature'] . '" name = "dateSignature"></br>';
    echo createSelect('secteurActivite', 'secteurActivite', 'Secteur d\'activité', 50, getSecteurActivite(), $client['idSecteur']);
    echo formInputHidden('idClient', 'idClient', $_REQUEST['lstClient']);
    echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 60);
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
    echo '</form>';
}

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
        $compteAnalytics = ' non';
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
        echo "name = " . $Name . "</br>";
        echo "adresse = " . $adresse . "</br>";
        echo "Entreprise = " . $Entreprise . "</br>";
        echo "mail = " . $mail . "</br>";
        echo "dateSignature = " . $dateSignature . "</br>";
        echo "secteurActivite = " . $secteurActivite . "</br>";
        echo "phone = " . $phone . "</br>";
        echo "localisation = " . $localisation . "</br>";
        echo "dureeEngagement = " . $dureeEngagement . "</br>";
        echo "compteGMB = " . $compteGMB . "</br>";
        echo "compteAnalytics = " . $compteAnalytics . "</br>";
        echo "compteInsta = " . $compteInsta . "</br>";
        echo "mandatSepa = " . $mandatSepa . "</br>";
        echo "cni = " . $cni . "</br>";
        echo "rib = " . $rib . "</br>";
        echo "contrat = " . $contrat . "</br>";
        echo "photo = " . $photo . "</br>";
        echo "siret = " . $siret . "</br>";
        echo "forfait = " . $forfait . "</br>";
        echo "secteurActivite = " . $secteurActivite . "</br>";
        echo "idTB = " . $idTB . "</br>";
        $idClient = $_REQUEST['idClient'];
        echo "idClient = " . $idClient;
        modifyClient($idClient, $Name, $Entreprise, $mail, $phone, $photo, $localisation, $adresse, $dateSignature, $dureeEngagement, $compteGMB, $compteInsta, $compteAnalytics, $mandatSepa, $cni, $rib, $contrat, $siret, $forfait, $secteurActivite);
        //addClient($Name, $Entreprise, $mail, $phone, $photo, $localisation, $adresse, $dateSignature, $dureeEngagement, $compteGMB, $compteInsta, $compteAnalytics, $mandatSepa, $cni, $rib, $contrat, $siret, $forfait, $secteurActivite, $idTB);
    }
}
?>
</div>
</body>
</html>