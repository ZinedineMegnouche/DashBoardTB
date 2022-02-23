<?php
function SGBDConnect()
{
    try {
       $connexion = new PDO('mysql:host=localhost;dbname=library', 'root', 'root'); 
       $connexion->query('SET NAMES UTF8');
       $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
    } catch (PDOException $e) {
        echo 'Erreur !: ' . $e->getMessage() . '<br />';
        exit();
    }
    return $connexion;
}
?>