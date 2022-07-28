<?php
require 'Include/functions.php';
require 'Include/SourceDonnees.inc.php';
require 'Include/helpersLibrary.inc.php';
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
         <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
         <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
<a href='principale.php?deconnexion=true'><span>Déconnexion</span></a>
<h1>CLIENT DASHBOARD</h1>
<?php
echo "<p>Bonjour," . $_SESSION['username'] . "</p>";
?>
<div id="gauche">
            <h2></h2>
                <ul>
                    <li>Menu</li>
                        <ul>
                        <li><a href="clientDashboard.php">Accueil</a></li>
                        <li><a href="callTrackingClient.php">CallTracking</a></li>
                        <li><a href="AnalyticsClient.php">Google Analytics</a></li>
                        <li><a href="InstagramClient.php">Instagram</a></li>
                        <li><a href="settingClient.php">Profil</a></li>
                        <li><a href="changepwdClient.php">Sécurité</a></li>
                        </ul>
                </ul>
        </div>
<div id="droite">
<form id = "date" name = "date" method="POST">
    <?php
if (isset($_REQUEST['startDate']) && isset($_REQUEST['endDate'])) {
    echo '<label for="startDate">De :</label><input type="date" id = "startDate" name = "startDate" value =' . $_REQUEST['startDate'] . '>';
    echo '<label for="endDate">a :</label><input type="date" id = "endDate" name = "endDate" value =' . $_REQUEST['endDate'] . '>';
} else {
    echo '<label for="startDate">De :</label><input type="date" id = "startDate" name = "startDate">';
    echo '<label for="endDate">a :</label><input type="date" id = "endDate" name = "endDate">';
}
?>
    <?php
echo formBoutonSubmit('btnSubmit', 'btnSubmit', 'OK', 30);
?>
</form>
<?php
$num = getNumClientById($_SESSION['id']);
if ($num != null) {
    //echo "num1 ======= $num";
    $numCT = getNumCallTrackByNum($num);
    echo "<h3>Vos numéros call tracking</h3></br>";
    echo "<ul>";
    foreach ($numCT as $numC) {
        echo "<li>$numC</li>";
    }
    echo "</ul>";
    $uuid = getUUIDByNum($num);
    if (!isset($_REQUEST['btnSubmit'])) {
        echo "<h2>Aujourd'hui</h2></br>";
        getCalls($uuid);
    }
    //getCalls($uuid);
} else {
    echo "<h2>Pas de numéro de CallTracking</h2>";
}
if (isset($_REQUEST['btnSubmit'])) {
    if (isset($_REQUEST['startDate']) && isset($_REQUEST['endDate'])) {
        $end = $_REQUEST['endDate'];
        $start = $_REQUEST['startDate'];
        if ($end == "" && $start != "") {
            $end = date('Y-m-d', strtotime($start . ' + 30 days'));
        } else if ($start == "" && $end != "") {
            $start = date('Y-m-d', strtotime($start . ' - 30 days'));
        } else if ($start != "" && $end != "") {
            if (dayDiff($end, $start) > 30) {
                echo "Vous ne pouvez pas voir les stat de plus de 30 jours";
                $end = date('Y-m-d', strtotime($start . ' + 30 days'));
                echo "new end = $end ";
            }
        } else {
            $end = date('Y-m-d');
            $start = date('Y-m-d');
        }
        $_REQUEST['startDate'] = $start;

        echo getCallsTime($uuid, $start, $end);
    }
}
?>
</div>
</body>
</html>