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
if ($_SESSION['poste'] == "Administrateur") {
    require_once 'adminDashboard.php';
} else if ($_SESSION['poste'] == "Commercial") {
    require_once 'comDashboard.php';
} else if ($_SESSION['poste'] == "Ressource Humaines") {
    require_once 'rhDashboard.php';
} else if ($_SESSION['poste'] == "Chef de projet" || $_SESSION['poste'] == "Producteur") {
    require_once 'prodDashboard.php';
}
?>
<h2>Mon profil</h2>
 <?php
$employe = getInfoTB($_SESSION['id']);
echo '<form name="formAddClient" method="post">';
echo formInputText2('Nom Complet', 'Name', 'Name', $employe['nomComplet'], 50, 2, 50, 10, true, true);
echo formInputText2('Mail', 'mail', 'mail', $employe['mail'], 50, 2, 150, 30, true, true);
echo formInputText2('Telephone', 'phone', 'phone', $employe['telephone'], 10, 10, 10, 40, true, false);
echo formInputText2('Adresse', 'adress', 'adress', $employe['adresse'], 50, 2, 250, 50, true, false);
echo formInputText2('Type de contrant', 'contrat', 'contrat', $employe['typeContrat'], 50, 2, 50, 60, true, false);
echo formInputText2('Date de signature du contrat', 'dateSignature', 'dateSignature', $employe['DateSignature'], 50, 2, 50, 70, true, false);
echo formInputText2('Poste', 'poste', 'poste', $employe['poste'], 50, 2, 50, 80, true, false);

?>


</div>
</body>
</html>