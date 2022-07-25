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
echo "<p>Bonjour,".$_SESSION['username']."</p>";
?>
<div id="gauche">
            <h2></h2>
                <ul>
                    <li>Menu</li>
                        <ul>
                        <li><a href="callTrackingClient.php">CallTracking</a></li>
                        <li><a href="AnalyticsClient.php">Google Analytics</a></li>
                        <li><a href="InstagramClient.php">Instagram</a></li>
                        <li><a href="settingClient.php">Paramètre</a></li>
                        </ul>
                </ul>
        </div>
<div id="droite">
    <form id= "conseiller" name="conseiller">
        <h1>Votre conseiller</h1>
<?php 
echo getCommercialClient($_SESSION['id']);
?>
</form>
</div>
</body>
</html>