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
                <ul>
                    <li>Menu</li>
                        <ul>
                        <li><a href="callTrackingClient.php">CallTracking</a></li>
                        <li><a href="AnalyticsClient.php">Google Analytics</a></li>
                        <li><a href="InstagramClient.php">Instagram</a></li>
                        <li><a href="settingClient.php">Paramètres</a></li>
                        </ul>
                </ul>
        </div>
        <div id="droite">
            <h3>Paramètres du compte</h3>
            <?php
        $client = getInfoClient($_SESSION['id']);
        echo '<form name="formAddClient" method="post">';
        echo formInputText2('Nom Complet', 'Name', 'Name', $client['nomComplet'], 50, 2, 50, 10, true, true);
        echo formInputText2('Nom Entreprise', 'Enterprise', 'Enterprise', $client['nomEntreprise'], 50, 2, 200, 20, true, true);
        echo formInputText2('Mail', 'mail', 'mail', $client['mail'], 50, 2, 150, 30, true, true);
        echo formInputText2('Telephone', 'phone', 'phone', $client['telephone'], 10, 10, 10, 40, true, false);
        echo formInputText2('Adresse', 'adress', 'adress', $client['adresse'], 50, 2, 250, 50, true, false);
        echo formInputText2('SIRET', 'siret', 'siret', $client['siret'], 50, 2, 50, 60, true, false);
        echo formInputText2('Date de signature du contrat', 'dateSignature', 'dateSignature', $client['dateSignature'], 50, 2, 50, 70, true, false);
        echo formInputText2('Durée du contrat', 'dureeContrat', 'dureeContrat', $client['contrat'], 50, 2, 50, 80, true, false);
        echo formInputText2('Ville', 'localisation', 'localisation', $client['localisation'], 50, 2, 50, 90, true, false);
        echo formInputText2('Secteur Activité ', 'secteurActivite', 'secteurActivite', $client['secteurActivite'], 50, 2, 50, 100, true, false);
        echo formInputText2('Type de Forfait', 'typeForfait', 'typeForfait', $client['nomForfait'], 50, 2, 50, 110, true, false);
        echo formInputText2('Description de l\'offre', 'descriptionOffre', 'descriptionOffre', $client['description'], 50, 2, 50, 120, true, false);
        echo formInputText2('Tarif du Forfait', 'tarif', 'tarif', $client['tarif'].'€', 50, 2, 50, 130, true, false);

        //compte insta
        // mandat sepa
        //cni
        //rib
        //contrat
        echo '</form>';
            ?>
        </div>
    </body>
</html>