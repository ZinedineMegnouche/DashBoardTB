<?php
//require_once 'Include/SourceDonnees.inc.php';
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
<h1>ADMIN DASHBOARD</h1>

<div id="gauche">
            <h2></h2>
                <ul>
                    <li>Menu</li>
                        <ul>
                            <li><a href="adminClient.php">Client</a></li>
                            <li><a href="adminEmploye.php">Employe</a></li>
                            <li><a href="adminCom.php">Commercial</a></li>
                            <li><a href="addClient.php">Ajouter un client</a></li>
                            <li><a href="modifClient.php">Modifier un client</a></li>
                            <li><a href="addEmploye.php">Ajouter un employé</a></li>
                            <li><a href="modifEmploye.php">Modifier un employé</a></li>
                            <li><a href="modifOffre.php">Modifier une offre</a></li>
                            <li><a href="profilTB.php">Mon profil</a></li>
                            <li><a href="changepwd.php">Sécurité</a></li>
                        </ul>
                </ul>
        </div>
<div id="droite">
