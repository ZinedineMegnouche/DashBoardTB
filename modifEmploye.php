<?php
require 'Include/functions.php';
require 'Include/SourceDonnees.inc.php';
require 'Include/helpersLibrary.inc.php';
session_start();
/*$_SESSION['id'] = 1;
$_SESSION['username'] = "zinedine";
$_SESSION['mail'] = "zinedine.megnouche@tickandbox.com";
$_SESSION['profil'] = 'tb';
$_SESSION['restraint'] = isModeRestraint($_SESSION['id']);*/
if ($_SESSION['restraint'] == 1) {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
        $isAdmin = true;
    } else if ($_SESSION['poste'] == "Ressource Humaines") {
        require_once 'rhDashboard.php';
    }

//require_once 'adminDashboard.php';
} else {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
        $isAdmin = true;
    } else if ($_SESSION['poste'] == "Ressource Humaines") {
        require_once 'rhDashboard.php';
    }
    ?>

    <h2>Modif Employé</h2>
    <p>Employé</p>
    <form name="lstClient" method="post">
    <?php
if (!isset($_POST['btnSubmit1'])) {
        echo createSelect('lstEmploye', 'lstEmploye', 'Liste employés : ', 10, getListEmploye());
    } else {
        echo createSelect('lstEmploye', 'lstEmploye', 'Liste employés : ', 10, getListEmploye(), $_REQUEST['lstEmploye']);
    }
    echo formBoutonSubmit('btnSubmit1', 'btnSubmit1', 'OK', 20);
    echo '</form>';
    if (isset($_POST['btnSubmit1'])) {
        $idEmploye = $_REQUEST['lstEmploye'];
        $employe = getEmployeeById($idEmploye);
        echo '<form name="formeModifEmploye" method="post">';
        //$employe['photo'] = $photo;
        // = $poste;
        echo formInputText2('Nom Complet', 'name', 'name', $employe['name'], 50, 2, 50, 10, false, true);
        echo formInputText2('Mail', 'mail', 'mail', $employe['mail'], 50, 2, 150, 20, false, true);
        echo formInputText2('Telephone', 'phone', 'phone', $employe['tel'], 10, 10, 10, 30, false, false);
        echo formInputText2('Adresse', 'adress', 'adress', $employe['adress'], 50, 2, 150, 40, false, true);
        echo createSelect('poste', 'poste', 'Poste', 50, getPoste(), $employe['poste']);
        echo formInputHidden('idEmploye', 'idEmploye', $_REQUEST['lstEmploye']);
        echo '<label for="typeContrat">Type de contrat:</label>
        <select name= "typeContrat" id="typeContrat" tabindex="60">';
        echo '<option value="Alternant"';
        if ($employe['typeContrat'] == 'Alternance') {
            echo ' selected>Alternance</option>';
        } else {
            echo '>Alternance</option>';
        }
        echo '<option value="CDI"';
        if ($employe['typeContrat'] == 'CDI') {
            echo ' selected>CDI</option>';
        } else {
            echo ' >CDI</option>';
        }
        echo '<option value="CDD"';
        if ($employe['typeContrat'] == 'CDD') {
            echo ' selected>CDD</option>';
        } else {
            echo ' >CDD</option>';
        }

        echo '</select>';

        echo '<label for="dateSignature">Date de signature :</label><input type="date" id = "dateSignature" value ="' . $employe['dateSignature'] . '" name = "dateSignature"></br>';
        //photo
        echo '<label for= "restraintMode">Mode restraint: </label><input id= "restraintMode" name= "restraintMode" type="checkbox" ' . isRestraintCheck($idEmploye) . '></br>';

        echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 60);
        echo '</form>';
    }

    ?>

    <?php
if (isset($_POST["btnSubmit"])) {
        if (isset($_REQUEST['name']) && isset($_REQUEST['mail']) && isset($_REQUEST['phone']) && isset($_REQUEST['adress']) && isset($_REQUEST['poste']) && isset($_REQUEST['typeContrat']) && isset($_REQUEST['dateSignature'])) {
            $idTB = $_REQUEST['idEmploye'];
            $name = $_REQUEST['name'];
            $mail = $_REQUEST['mail'];
            $phone = $_REQUEST['phone'];
            $adress = $_REQUEST['adress'];
            $poste = $_REQUEST['poste'];
            $typeContrat = $_REQUEST['typeContrat'];
            $dateSignature = $_REQUEST['dateSignature'];
            if ($dateSignature == "") {
                $dateSignature = date('Y-m-d');
            }
            // echo "modeRestraint = ";
            $modeRestraint = 0;
            if (isset($_REQUEST['restraintMode'])) {
                $modeRestraint = 1;
            }
            modifyEmploye($idTB, $name, $mail, $phone, $typeContrat, $adress, $dateSignature, $poste, $modeRestraint);
        }

    }
}
?>
</div>
</body>
</html>