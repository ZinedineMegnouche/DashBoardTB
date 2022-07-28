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
session_start();
/*$_SESSION['id'] = 1;
$_SESSION['username'] = "zinedine";
$_SESSION['mail'] = "zinedine.megnouche@tickandbox.com";
$_SESSION['profil'] = 'tb';*/

require_once 'comDashboard.php';
?>
<h2>Offres Tick and Box</h2>
<?php
getOffresTB();
?>
