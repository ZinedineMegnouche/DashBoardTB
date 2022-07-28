<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
<?php
require 'Include/functions.php';
require 'Include/SourceDonnees.inc.php';
session_start();
if ($_SESSION['restraint'] != 1) {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Ressource Humaines") {
        require_once 'rhDashboard.php';
    }
    echo '<h2>Employé</h2>';
    getEmployee();
} else {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Ressource Humaines") {
        require_once 'rhDashboard.php';
    }

    echo '<h2>Employé</h2>';
}
?>
</div>
</body>
</html>
</div>
<!--<script>

var divderoulante = document.getElementById('com');
divderoulante.addEventListener("click"){

}

</script>-->
</body>
</html>