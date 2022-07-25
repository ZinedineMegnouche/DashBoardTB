<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
         <a href="./principale.php">connexion direct</a>
        <a href="./connexion.php">Formulaire de connexion</a>
        <a href="./addClient.php">Formulaire d'ajout d'un client</a>
        <a href="./addEmploye.php">Formulaire d'ajout d'un employé</a>
        <a href="./callTracking.php">callTracking API</a>
        <a href="./AnalyticsTest.php">Google Analytics API</a>
        <a href="./testAddPdf.php">Add PDF</a>
        <?php 
        $isTickAndBox = 0;
        if($isTickAndBox == true){
            $table = 'connexionTB';
            $id = 'idTB';
        }
        else{
            $table = 'connexionClient';
            $id = 'idClient';
        }
        ?>
    </body>
</html>