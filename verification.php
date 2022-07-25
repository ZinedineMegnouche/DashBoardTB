<?php
require_once 'Include/SourceDonnees.inc.php';
require_once 'Include/functions.php';

session_start();
if(isset($_POST['mail']) && isset($_POST['password']))
{
    // connexion à la base de données
  //  $db_username = 'root';
  //  $db_password = 'root';
  //  $db_name     = 'TickAndBox';
   // $db_host     = 'localhost';
   // $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
         //  or die('could not connect to database');
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS

    //$username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    //$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    
    if($mail !== "" && $password !== "")
    {
        $isTB = isTickAndBox($mail);
        //$count = $reponse['count(*)'];
        if(isConnectionValide($mail,$password,$isTB)) // nom d'utilisateur et mot de passe correctes
        {
        $id = getIdConnexionTB($mail,$password,$isTB);
        $nameUser = getNameById($id,$isTB);
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $nameUser;
        $_SESSION['mail'] = $mail;
        $_SESSION['restraint'] = isModeRestraint($_SESSION['id']);
        if ($isTB){
            $_SESSION['profil'] = 'tb';
        }
        else{
            $_SESSION['profil'] = 'client';
        }
        header('Location: principale.php');
        }
        else
        {
           header('Location: connexion.php?erreur=1');
        }
    }
    else
    {
       header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
?>