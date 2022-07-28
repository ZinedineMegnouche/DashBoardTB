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

    <?php
echo "<p>Bonjour," . $_SESSION['username'] . "</p>";
?>
    <div id="gauche">
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
            <h1>Sécurité</h1>
            <h2>Modification de mot de passe </h2>
            <form name="changePWD" method="post">
<input type="password" placeholder="Entrer le mot de passe" name="password" required>
<input type="password" placeholder="confirmer le mot de passe" name="confirmpassword" required>
<?php echo formBoutonSubmit('btnSubmit1', 'btnSubmit1', 'OK', 20); ?>
</form>
<?php

if (isset($_POST['btnSubmit1'])) {
    $password = $_REQUEST['password'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    if ($_REQUEST['password'] != $_REQUEST['confirmpassword']) {
        echo "<p style='color:red'>Mot de passe différent</p>";
    } else if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        echo "<p style='color:red'>Le mot de passe doit contenir 8 caractères, avec au moins 1 majuscule et un nombre</p>";
    } else {
        modifpwdClient($_SESSION['id'], $_REQUEST['password']);
    }
}

?>

        </div>
    </body>
</html>