<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <a href="./connexion.php">Formulaire de connexion</a>
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
        echo 'table= '.$table;
        echo 'id= '.$id;
        ?>
    </body>
</html>