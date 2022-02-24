<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body style='background:#fff;'>
        <div id="content">
            
            <a href='principale.php?deconnexion=true'><span>Déconnexion</span></a>
            
            <!-- tester si l'utilisateur est connecté -->
            <?php
                session_start();
                echo "le mail est : ";
                echo $_SESSION['mail'];
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:connexion.php");
                   }
                }
               // echo $_SESSION['mail'];
                else if($_SESSION['mail'] !== ""){
                    //echo "wooow!!!";
                   // if(str_contains($_SESSION['mail'],'tickandbox.com')){
                        
                     //}
                    if($_SESSION['profil'] == 'tb'){
                        echo '<h1>TickAndBox</h1>';
                    }
                    else{
                        echo '<h1>Client</h1>';
                    }
                    
                    $user = $_SESSION['username'];
                    // afficher un message
                    echo "<br>Bonjour $user, vous êtes connectés";
                }
            ?>
            
        </div>
    </body>
</html>