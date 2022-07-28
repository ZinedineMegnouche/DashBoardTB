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
    } else if ($_SESSION['poste'] == "Ressource Humaines") {
        require_once 'rhDashboard.php';
    }
} else {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Ressource Humaines") {
        require_once 'rhDashboard.php';
    }

    if (isset($_GET['id'])) {
        $_SESSION['id'] = $_GET['id'];}
    $id = $_SESSION['id'];
    ?>

    <h2>Ajout Employé</h2>
    <p>Employé</p>

    <form name="formeAddEmploye" method="post">
        <?php
echo formInputText2('Nom Complet', 'name', 'name', null, 50, 2, 50, 10, false, true);
    echo formInputText2('Mail', 'mail', 'mail', null, 50, 2, 150, 20, false, true);
    echo formInputText2('Telephone', 'phone', 'phone', null, 10, 10, 10, 30, false, false);
    echo formInputText2('Adresse', 'adress', 'adress', null, 50, 2, 150, 40, false, true);
    echo createSelect('poste', 'poste', 'Poste', 50, getPoste());
    ?>
        <label for="typeContrat">Type de contrat:</label>
        <select name= "typeContrat" id="typeContrat" tabindex="60">
            <option value="Alternance">Alternant</option>
            <option value="CDI">CDI</option>
            <option value="CDD">CDD</option>
        </select>
        <?php
echo '<label for="dateSignature">Date de signature :</label><input type="date" id = "dateSignature" name = "dateSignature"></br>';
    //photo

    echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 60);
    ?>
    </form>
    <?php
if (isset($_POST["btnSubmit"])) {
        if (isset($_REQUEST['name']) && isset($_REQUEST['mail']) && isset($_REQUEST['phone']) && isset($_REQUEST['adress']) && isset($_REQUEST['poste']) && isset($_REQUEST['typeContrat']) && isset($_REQUEST['dateSignature'])) {
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
            addEmploye($name, $mail, $phone, $typeContrat, $adress, $dateSignature, $poste);
        }
    }
}
?>
</div>
</body>
</html>