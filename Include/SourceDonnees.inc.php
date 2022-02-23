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
function isConnectionValide($username,$password){
    $requete = "SELECT idTB FROM connexionTB where 
    mailConnexion = '".$username."' and motDePasse = '".$password."' ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db,$requete);
    $count = $exec_requete->num_rows;
    if($count == 0){
        return false;
    }
    return true;
}
function getIdConnexionTB($username,$password){
    $requete = "SELECT idTB FROM connexionTB where 
    mailConnexion = '".$username."' and motDePasse = '".$password."' ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db,$requete);
    $count = $exec_requete->num_rows;
    $reponse      = mysqli_fetch_array($exec_requete);
    return $reponse['idTB'];
}
function getNameTBById($id){
    $requete = "SELECT nomComplet FROM TandB where idTB = ".$id;
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db,$requete);
    $reponse      = mysqli_fetch_array($exec_requete);
    return $nameUser = $reponse['nomComplet'];
}
?>
