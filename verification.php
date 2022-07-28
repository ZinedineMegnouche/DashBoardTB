<?php
require_once 'Include/SourceDonnees.inc.php';
require_once 'Include/functions.php';

session_start();
if (isset($_POST['mail']) && isset($_POST['password'])) {
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);

    if ($mail !== "" && $password !== "") {
        $isTB = isTickAndBox($mail);
        $hashed_password = md5($password);
        if (isConnectionValide($mail, $hashed_password, $isTB)) { // nom d'utilisateur et mot de passe correctes {
            $id = getIdConnexionTB($mail, $hashed_password, $isTB);
            $nameUser = getNameById($id, $isTB);
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $nameUser;
            $_SESSION['mail'] = $mail;
            $_SESSION['restraint'] = isModeRestraint($_SESSION['id']);
            if ($isTB) {
                $_SESSION['profil'] = 'tb';
            } else {
                $_SESSION['profil'] = 'client';
            }
            header('Location: principale.php');
        } else {
            header('Location: connexion.php?erreur=1');
        }
    } else {
        header('Location: connexion.php?erreur=2'); // utilisateur ou mot de passe vide
    }
} else {
    header('Location: login.php');
}
mysqli_close($db); // fermer la connexion
