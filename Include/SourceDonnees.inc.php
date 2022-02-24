<?php
function SGBDConnect()
{
    $db_username = 'root';
    $db_password = 'root';
    $db_name     = 'TickAndBox';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');
    return $db;
}
function isConnectionValide($username,$password,$isTickAndBox){
    if($isTickAndBox == true){
        $table = 'connexionTB';
        $id = 'idTB';
    }
    else{
        $table = 'connexionClient';
        $id = 'idClient';
    }
    $requete = "SELECT ".$id." FROM ".$table." where 
    mailConnexion = '".$username."' and motDePasse = '".$password."' ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db,$requete);
    $count = $exec_requete->num_rows;
    if($count == 0){
        return false;
    }
    return true;
}
function getIdConnexionTB($username,$password,$isTickAndBox){
    if($isTickAndBox == true){
        $table = 'connexionTB';
        $id = 'idTB';
    }
    else{
        $table = 'connexionClient';
        $id = 'idClient';
    }
    $requete = "SELECT ".$id." FROM ".$table." where 
    mailConnexion = '".$username."' and motDePasse = '".$password."' ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db,$requete);
    $count = $exec_requete->num_rows;
    $reponse      = mysqli_fetch_array($exec_requete);
    return $reponse[$id];
}
function getNameById($id,$isTickAndBox){
    if($isTickAndBox){
        $table = 'TandB';
        $profil = 'idTB';
    }
    else{
        $table = 'Client';
        $profil = 'idClient';
    }
    $requete = "SELECT nomComplet FROM ".$table." where ".$profil." = ".$id;
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db,$requete);
    $reponse      = mysqli_fetch_array($exec_requete);
    return $nameUser = $reponse['nomComplet'];
}
?>
