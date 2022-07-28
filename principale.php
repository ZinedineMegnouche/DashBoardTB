<?php require 'Include/SourceDonnees.inc.php';
//require('Include/functions.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="content">

           <!--  <a href='principale.php?deconnexion=true'><span>Déconnexion</span></a> -->

            <!-- tester si l'utilisateur est connecté -->
            <?php
session_start();
/* --------------------------A supprimer -------------------------- */
/*$_SESSION['id'] = 1;
$_SESSION['username'] = "zinedine";
$_SESSION['mail'] = "zinedine.megnouche@tickandbox.com";
$_SESSION['profil'] = 'tb';
$_SESSION['restraint'] = isModeRestraint($_SESSION['id']);
echo "mode restraint =";*/
// echo isModeRestraint($_SESSION['id']);

/*$_SESSION['id'] = 4;
$_SESSION['username'] = "alisée";
$_SESSION['mail'] = "alise.berutti@tickandbox.com";
$_SESSION['profil'] = 'tb';
$_SESSION['restraint'] = isModeRestraint($_SESSION['id']);*/
//echo "mode restraint =";
//echo isModeRestraint($_SESSION['id']);

/* ------------------------------------------------------------------- */
//  echo "le mail est : ";
//  echo $_SESSION['mail'];
if (isset($_GET['deconnexion'])) {
    if ($_GET['deconnexion'] == true) {
        session_unset();
        header("location:connexion.php");
    }
}
// echo $_SESSION['mail'];
else if ($_SESSION['mail'] !== "") {
    //echo "wooow!!!";
    // if(str_contains($_SESSION['mail'],'tickandbox.com')){

    //}
    if ($_SESSION['profil'] == 'tb') {
        //echo '<h1>TickAndBox</h1>';
        $_SESSION['poste'] = getPosteById($_SESSION['id']);
        $poste = $_SESSION['poste'];
        //echo 'Poste:'.$_SESSION['poste'];
        if ($poste == 'Administrateur') {
            header("location:adminDashboard.php");
        } else if ($poste == 'Commercial') {
            header("location:comDashboard.php");
        } else if ($poste == "Ressource Humaines") {
            header("location:rhDashboard.php");
        } else if ($_SESSION['poste'] == "Producteur") {
            header("location:prodDashboard.php");
        } else if ($_SESSION['poste'] == "Chef de projet") {
            header("location:prodDashboard.php");
        }
    } else {
        header("location:clientDashboard.php");
    }

    $user = $_SESSION['username'];
    // afficher un message
    $poste = $_SESSION['poste'];
    echo "<p>Poste : $poste</p>";
    echo "<br>Bonjour $user, vous êtes connectés";

}

?>

        </div>
    </body>
</html>