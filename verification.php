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
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    
    if($mail !== "" && $password !== "")
    {
        $isTB = isTickAndBox($mail);
        //$count = $reponse['count(*)'];
        if(isConnectionValide($mail,$password,$isTB)) // nom d'utilisateur et mot de passe correctes
        {
        $id = getIdConnexionTB($mail,$password,$isTB);
        $nameUser = getNameById($id,$isTB);
        //echo '<h1>ID= '.$id.'</h1>';
          //  $requete = "SELECT nomComplet FROM TandB where idTB = ".$id;
           // $exec_requete = mysqli_query($db,$requete);
          //  $reponse      = mysqli_fetch_array($exec_requete);
           // $nameUser = $reponse['nomComplet'];
        //echo '<h1>ID= '.$nameUser.'</h1>';

        //SELECT nomComplet FROM TandB WHERE idTB = 1
       // $requete = "SELECT count(*) FROM connexionTB where 
        //mailConnexion = '".$username."' and motDePasse = '".$password."' ";
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $nameUser;
        $_SESSION['mail'] = $mail;
        if ($isTB){
            $_SESSION['profil'] = 'tb';
        }
        else{
            $_SESSION['profil'] = 'client';
        }
       // echo 'id = '.$_SESSION['id'];
        //echo 'username = '.$_SESSION['username'];
       // echo 'mail = '.$_SESSION['mail'];
       // echo '<h2></h2>';
        //if(str_contains($username,'tickandbox.com')){
           // echo '<h1>TICK AND BOX </h1>';
        //}
       // else{
         //   echo '<h1>CLIENT</h1>';
        //}
        header('Location: principale.php');
        }
        else
        {
           header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
           //echo 'mail ='.$mail;
          // echo ' pwd ='.$password;
          // echo ' istb ='.isTickAndBox($mail);
           //echo ' isConnection valide ='.isConnectionValide($mail,$password,$isTB);
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