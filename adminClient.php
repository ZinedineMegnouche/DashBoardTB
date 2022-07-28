<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
<?php
require 'Include/SourceDonnees.inc.php';
session_start();
if ($_SESSION['restraint'] != 1) {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Chef de projet" || $_SESSION['poste'] == "Producteur") {
        require_once 'prodDashboard.php';
    }
    echo '<h2>Client</h2>';
    getClient();
} else {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Chef de projet" || $_SESSION['poste'] == "Producteur") {
        require_once 'prodDashboard.php';
    }

}
?>
</div>
</body>
</html>