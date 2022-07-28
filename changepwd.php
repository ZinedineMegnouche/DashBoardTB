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
//require 'Include/functions.php';
if (!isset($_SESSION)) {
    session_start();
}
/*$_SESSION['id'] = 1;
$_SESSION['username'] = "zinedine";
$_SESSION['mail'] = "zinedine.megnouche@tickandbox.com";
$_SESSION['profil'] = 'tb';*/

if ($_SESSION['profil'] == "tb") {
    if ($_SESSION['poste'] == "Administrateur") {
        require_once 'adminDashboard.php';
    } else if ($_SESSION['poste'] == "Commercial") {
        require_once 'comDashboard.php';
    } else if ($_SESSION['poste'] == "Ressource Humaines") {
        require_once 'rhDashboard.php';
    } else if ($_SESSION['poste'] == "Chef de projet" || $_SESSION['poste'] == "Producteur") {
        require_once 'prodDashboard.php';
    }
}
?>
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
        modifpwdTB($_SESSION['id'], $_REQUEST['password']);
    }
}

?>