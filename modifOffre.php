<?php
require 'Include/functions.php';
require 'Include/SourceDonnees.inc.php';
require 'Include/helpersLibrary.inc.php';
session_start();
if ($_SESSION['restraint'] == 1) {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    }
} else {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    }
    ?>

    <h2>Modif Offres</h2>
    <p>Employé</p>
    <form name="lstClient" method="post">
    <?php
if (!isset($_POST['btnSubmit1'])) {
        echo createSelect('lstOffre', 'lstOffre', 'Liste offres : ', 10, getOffresTBListe());
    } else {
        echo createSelect('lstOffre', 'lstOffre', 'Liste offres : ', 10, getOffresTBListe(), $_REQUEST['lstOffre']);
    }
    echo formBoutonSubmit('btnSubmit1', 'btnSubmit1', 'OK', 20);
    echo '</form>';
    if (isset($_POST['btnSubmit1'])) {
        $idOffre = $_REQUEST['lstOffre'];
        $offre = getOffreById($idOffre);
        echo '<form name="formModifOffre" method="post">';
        echo formInputText2('Nom ', 'nomForfait', 'nomForfait', $offre['nomForfait'], 50, 2, 50, 10, false, true);
        echo formInputText2('Description', 'description', 'description', $offre['description'], 50, 2, 150, 20, false, true);
        echo formInputText2('Tarif', 'tarif', 'tarif', $offre['tarif'], 50, 2, 150, 30, false, false);
        echo formInputHidden('idOffre', 'idOffre', $_REQUEST['lstOffre']);
        echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 60);
        echo '</form>';
    }

    ?>

    <?php
if (isset($_POST["btnSubmit"])) {
        if (isset($_REQUEST['nomForfait']) && isset($_REQUEST['description']) && isset($_REQUEST['tarif'])) {
            $idOffre = $_REQUEST['idOffre'];
            $name = $_REQUEST['nomForfait'];
            $description = $_REQUEST['description'];
            $tarif = $_REQUEST['tarif'];
            // echo "tarif = $tarif, description =  $description, nom = $name";
            modifyoffre($idOffre, $name, $tarif, $description);
            //addoffre($name,$mail,$phone,$typeContrat,$adress,$dateSignature,$poste);
            // $resultat = addClient($isbn,$title, $author, $id, null, null);
        }
        //echo '<script language="Javascript">
        //document.location.replace("myBooks.php");
        //</script>';

    }
}
?>
</div>
</body>
</html>