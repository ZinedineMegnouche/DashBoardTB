<?php
require_once 'Include/functions.php';
/**
 * Connexion a la base de données
 * @return mysqli database
 */
function SGBDConnect()
{
    $db_username = 'root';
    $db_password = 'root';
    $db_name = 'TickAndBox';
    $db_host = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('could not connect to database');
    return $db;
}

/**
 * Verifie si l'identifiant et le mot de passe existe
 * @param String $username adresse mail de connexion
 * @param String $password  mot de passe de connexion
 * @param Bool $isTickAndBox  Type de personne qui se connecte (True si employé de tickandbox sinon false)
 * @return Bool Retourne true si la connexion est valide sinon retourne false
 */
function isConnectionValide($username, $password, $isTickAndBox)
{
    if ($isTickAndBox == true) {
        $table = 'connexionTB';
        $id = 'idTB';
    } else {
        $table = 'connexionClient';
        $id = 'idClient';
    }
    $requete = "SELECT " . $id . " FROM " . $table . " where
    mailConnexion = '" . $username . "' and motDePasse = '" . $password . "' ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $count = $exec_requete->num_rows;
    if ($count == 0) {
        return false;
    }
    return true;
}

/**
 * Récupere l'id de l'utilisateur connecté
 * @param String $username adresse mail de connexion
 * @param String $password  mot de passe de connexion
 * @param Bool $isTickAndBox  Type de personne qui se connecte (True si employé de tickandbox sinon false)
 * @return String id de l'utilisateur connecté, idTB si employé de tickandbox sinon idClient
 */

function getIdConnexionTB($username, $password, $isTickAndBox)
{
    if ($isTickAndBox == true) {
        $table = 'connexionTB';
        $id = 'idTB';
    } else {
        $table = 'connexionClient';
        $id = 'idClient';
    }
    $requete = "SELECT " . $id . " FROM " . $table . " where
    mailConnexion = '" . $username . "' and motDePasse = '" . $password . "' ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $count = $exec_requete->num_rows;
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse[$id];
}

/**
 * Récupere le nom de l'utilisateur à partir de son id (que ce soit un client ou employé tickandbox)
 * @param String $id id de l'utilisateur
 * @param Bool $isTickAndBox  Type de personne qui se connecte (True si employé de tickandbox sinon false)
 * @return String nom de l'utilisateur
 */

function getNameById($id, $isTickAndBox)
{
    if ($isTickAndBox) {
        $table = 'TandB';
        $profil = 'idTB';
    } else {
        $table = 'Client';
        $profil = 'idClient';
    }
    $requete = "SELECT nomComplet FROM " . $table . " where " . $profil . " = " . $id;
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse['nomComplet'];
}

/**
 * Recupere le poste d'un employé TickAndbox à partir de son id
 * @param String $id id le l'utilisateur
 * @return String Poste de l'employé tickandbox
 */
function getPosteById($id)
{
    $requete = "SELECT poste FROM Poste INNER JOIN TandB on Poste.idPoste = TandB.idPoste WHERE idTB =" . $id . ";";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse['poste'];
}

/**
 * Verifie si l'utilisateur est en mode restraint ou non (Mode qui permet de limiter l'accées au dashboard)
 * @param String $id id le l'employé tickandbox
 * @return Bool True si l'employé est en mode Restraint sinon False
 */
function isModeRestraint($id)
{
    $requete = "SELECT modeRestraint FROM TandB WHERE idTB =$id";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse['modeRestraint'];
}

/**
 * Affiche la liste des employés de TickAndBox
 * @return void
 *
 */
function getEmployee()
{
    $requete = "SELECT idTB,nomComplet,poste, mail, telephone FROM TandB INNER JOIN Poste on TandB.idPoste = Poste.idPoste WHERE NOT Poste.idPoste = 5";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);

    while (list($id, $name, $poste, $mail, $tel) = mysqli_fetch_array($exec_requete)) {
        echo '<p>' . $name . ' - ' . $poste . ' - ' . $mail . ' - ' . $tel . ' </p> <input type="checkbox" ' . isRestraintCheck($id) . '></br>';
    }
}

/**
 * Recupere l'id d'un client à partir de son mail
 * @param String $mail mail du client
 * @return String id du client
 */
function getIdClient($mail)
{
    $requete = "SELECT idClient from Client where mail = '$mail'";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse['idClient'];
}

/**
 * Récupere l'id d'un employé TickAndBox à partir de son mail
 * @param String $mail mail de l'employé
 * @return String id de l'employé
 */
function getIdTandB($mail)
{
    $requete = "SELECT idTB from TandB where mail = '$mail'";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse['idTB'];
}

/**
 * Récupere le numéro de CallTracking d'un client à partir de l'id du client
 * @param String $id id du client
 * @return String retourne le numéro de Call tracking ou null si il ne possède aucun numéro
 */
function getNumClientById($id)
{
    $requete = "SELECT CallTracking.numero from CallTracking INNER JOIN Client on CallTracking.idClient = Client.idClient WHERE Client.idClient = $id";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    if ($reponse != null) {
        return "+33" . substr($reponse['numero'], 1, 10);
    } else {
        return null;
    }

}
/**
 * Ajoute un client à la base de données
 * @param String $nomComplet nom et prénom du client
 * @param String $nomEntreprise nom de l'entreprise du client
 * @param String $mail mail du client
 * @param String $telephone telephone du client
 * @param String $photo photo du client
 * @param String $localisation Ville du client
 * @param String $adresse adresse du client
 * @param Date $dateSignature date de signature du client
 * @param Int $dureeEngagement durée d'engagement du client
 * @param String $compteGMB compte Google My Business du client
 * @param String $compteInsta compte Instagram du client
 * @param String $compteAnalytics compte analytics du client
 * @param String $MandatSEPA mandat sepa du client
 * @param String $CNI carte national d'identité du client(pdf)
 * @param String $RIB Rélevé d'identité bancaire (RIB) du client (pdf)
 * @param String $contrat contrat du client (pdf)
 * @param String $SIRET SIRET du client
 * @param String $idForfait Forfait du client
 * @param String $idSecteur Secteur d'activité du client
 * @param String $idTB id de la personne qui ajoute client
 * @return void
 */
function addClient($nomComplet, $nomEntreprise, $mail, $telephone, $photo, $localisation, $adresse, $dateSignature, $dureeEngagement, $compteGMB, $compteInsta, $compteAnalytics, $MandatSEPA, $CNI, $RIB, $contrat, $SIRET, $idForfait, $idSecteur, $idTB)
{
    $requete = "INSERT INTO Client (nomComplet, nomEntreprise, mail, telephone, photo, localisation, adresse, dateSignature, dureeEngagement, compteGMB, compteInsta, compteAnalytics, MandatSEPA, CNI, RIB, contrat, siret, idForfait, idSecteur, idTB) VALUES ('$nomComplet', '$nomEntreprise', '$mail', '$telephone', '$photo', '$localisation', '$adresse', '$dateSignature', '$dureeEngagement', '$compteGMB', '$compteInsta', '$compteAnalytics', '$MandatSEPA', '$CNI', '$RIB', '$contrat', '$SIRET', '$idForfait', '$idSecteur', '$idTB')";
    $db = SGBDConnect();
    mysqli_query($db, $requete);
    echo "<p>Client ajouté avec succès</p>";
    $id = getIdClient($mail);
    addClientConnexion($mail, $id);
    addNumCallTracking($telephone, $nomComplet, $id);
}

/**
 * Ajoute un numero de call tracking a la base de données
 * @param String $num numero de redirection (numero du proprietaire)
 * @param String $libelle libelle du numero de call tracking
 * @param String $idClient id du client qui veut ajouter un numero de call tracking
 * @return void
 */
function addCallTrackingDB($num, $libelle, $idClient)
{
    $requete = "INSERT into CallTracking(numero,libelle,idClient) VALUES ('$num','$libelle',$idClient)";
    $db = SGBDConnect();
    mysqli_query($db, $requete);
}

/**
 * Inscription d'un client dans la base de données par un employé tickandbox
 * @param String $mail mail du nouveau client
 * @param String $id id du nouveau client
 * @return void
 */
function addClientConnexion($mail, $id)
{
    $mdp = random_mdp();
    $requete = "INSERT INTO `connexionClient` (mailConnexion, motDePasse, idClient) VALUES ('$mail', '$mdp', '$id')";
    $db = SGBDConnect();
    mysqli_query($db, $requete);
}

/**
 * Inscription d'un employé tickandbox dans la base de données
 * @param String $mail mail du nouvel employé
 * @param String $id id du nouvel employé
 * @return void
 */
function addTandBConnexion($mail, $id)
{
    $mdp = random_mdp();
    $requete = "INSERT INTO `connexionTB` (mailConnexion, motDePasse, idTB) VALUES ('$mail', '$mdp', '$id')";
    $db = SGBDConnect();
    mysqli_query($db, $requete);
}
/**
 * Ajoute un employé a la base de données
 * @param String $nomComplet nom et prenom de l'employé
 * @param String $mail mail de l'employé
 * @param String $telephone telephone de l'employé
 * @param String $typeContrat type de contrat de l'employé (CDI,CDD...)
 * @param String $adresse adresse de l'employé
 * @param String $dateSignature date de signature de l'employé
 * @param String $poste poste de l'employé dans l'entreprise
 * @return void
 */
function addEmploye($nomComplet, $mail, $telephone, $typeContrat, $adresse, $dateSignature, $poste)
{
    $requete = "INSERT INTO TandB (idTB, nomComplet, mail, telephone, photo, adresse, typeContrat, DateSignature, modeRestraint, idPoste) VALUES (NULL, '$nomComplet', '$mail', '$telephone', 'non', '$adresse', '$typeContrat', '$dateSignature', '0', '$poste')";
    $db = SGBDConnect();
    mysqli_query($db, $requete);
    echo "<p>Client ajouté avec succès</p>";
    $id = getIdTandB($mail);
    addTandBConnexion($mail, $id);
}
/**
 * Récupere la liste des forfaits proposés par TickAndBox
 * @return Array tableau contenant tout les forfaits
 */
function getForfait()
{
    $requete = "SELECT idForfait,nomForfait FROM Forfait";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    return $exec_requete;
}

/**
 * Affiche la liste des clients d'un commercial à partir de son id
 * @param String $id id du commercial
 * @return void
 */
function getClientByIdCom($id)
{
    $requete = "SELECT Client.idClient, Client.nomComplet, Client.nomEntreprise, Client.mail, Client.adresse FROM Client inner join TandB on Client.idTB = TandB.idTB WHERE Client.idTB = $id";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    while (list($id, $name, $enterprise, $mail, $adress) = mysqli_fetch_array($exec_requete)) {
        echo "<div id='client'><p>$name - $enterprise  </p></div></br>";
    }
}

/**
 * Modifié un employé dans la base de données
 * @param String $nomComplet nom et prenom de l'employé
 * @param String $mail mail de l'employé
 * @param String $telephone telephone de l'employé
 * @param String $typeContrat type de contrat de l'employé (CDI,CDD...)
 * @param String $adresse adresse de l'employé
 * @param String $dateSignature date de signature de l'employé
 * @param String $poste poste de l'employé dans l'entreprise
 * @return void
 */
function modifyEmploye($idTB, $nomComplet, $mail, $telephone, $typeContrat, $adresse, $dateSignature, $poste)
{
    $requete = "UPDATE TandB set nomComplet='$nomComplet',mail='$mail',telephone= '$telephone',photo= '', adresse='$adresse', typeContrat='$typeContrat',DateSignature='$dateSignature',idPoste= $poste, modeRestraint=0 where idTB = $idTB";
    $db = SGBDConnect();
    mysqli_query($db, $requete);
    echo "<p>Client modifié avec succès</p>";
}

/**
 * Modifie un client dans la base de données
 * @param String $nomComplet nom et prénom du client
 * @param String $nomEntreprise nom de l'entreprise du client
 * @param String $mail mail du client
 * @param String $telephone telephone du client
 * @param String $photo photo du client
 * @param String $localisation Ville du client
 * @param String $adresse adresse du client
 * @param Date $dateSignature date de signature du client
 * @param Int $dureeEngagement durée d'engagement du client
 * @param String $compteGMB compte Google My Business du client
 * @param String $compteInsta compte Instagram du client
 * @param String $compteAnalytics compte analytics du client
 * @param String $MandatSEPA mandat sepa du client
 * @param String $CNI carte national d'identité du client(pdf)
 * @param String $RIB Rélevé d'identité bancaire (RIB) du client (pdf)
 * @param String $contrat contrat du client (pdf)
 * @param String $SIRET SIRET du client
 * @param String $idForfait Forfait du client
 * @param String $idSecteur Secteur d'activité du client
 * @param String $idTB id de la personne qui ajoute client
 * @return void
 */
function modifyClient($id, $nomComplet, $nomEntreprise, $mail, $telephone, $photo, $localisation, $adresse, $dateSignature, $dureeEngagement, $compteGMB, $compteInsta, $compteAnalytics, $MandatSEPA, $CNI, $RIB, $contrat, $SIRET, $idForfait, $idSecteur)
{
    //Ajouter les pdf et photo
    $requete = "UPDATE Client set nomComplet='$nomComplet', nomEntreprise ='$nomEntreprise',telephone= '$telephone',photo= '',compteGMB = '', compteInsta = '', compteAnalytics = '', MandatSEPA= '',CNI = '', RIB = '', contrat = '', mail = '$mail', localisation = '$localisation', adresse= '$adresse', dateSignature = '$dateSignature', dureeEngagement = $dureeEngagement,siret= '$SIRET', idSecteur = $idSecteur, idForfait = $idForfait where idClient = $id";
    $db = SGBDConnect();
    mysqli_query($db, $requete);
    echo "<p>Client modifié avec succès</p>";
}
/**
 * Affiche le commercial d'un clien
 * @param String $id id du client
 * @return void
 */
function getCommercialClient($id)
{
    $requete = "SELECT TandB.nomComplet, TandB.mail FROM TandB INNER JOIN Client on TandB.idTB = Client.idTB WHERE Client.idClient = $id";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    while (list($name, $mail) = mysqli_fetch_array($exec_requete)) {
        echo '<p>' . $name . ' - ' . $mail . ' - </p>';
    }
}
/**
 * Affiche la liste des commerciaux avec leurs clients attitré
 * @return void
 */
function getCommercial()
{
    $requete = "SELECT idTB, nomComplet, mail, telephone FROM TandB WHERE idPoste = 1";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    while (list($id, $name, $mail, $tel) = mysqli_fetch_array($exec_requete)) {
        echo "<form><h3>$name </h3></br>";
        echo "Client ----------------------------------------";
        getClientByIdCom($id);
        echo "</form></br>";
    }
}
/**
 * Recupere les informations d'un client à partir de son id
 * @param String $id id du client recherché
 * @return Array Tableau contenant les informations d'un client
 */
function getClientById($id)
{
    $requete = "SELECT nomComplet, nomEntreprise, mail, telephone, photo, localisation, adresse, dateSignature, dureeEngagement, compteGMB, compteInsta, compteAnalytics, MandatSEPA, CNI, RIB, contrat, siret, idForfait, idSecteur FROM Client WHERE idClient = $id";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $Client = [];
    while (list($name, $enterprise, $mail, $tel, $photo, $localisation, $adress, $dateSignature, $dureeEngagement, $GMB, $insta, $analytics, $MandatSEPA, $CNI, $RIB, $contrat, $SIRET, $idForfait, $idSecteur) = mysqli_fetch_array($exec_requete)) {
        $Client['name'] = $name;
        $Client['enterprise'] = $enterprise;
        $Client['mail'] = $mail;
        $Client['tel'] = $tel;
        $Client['photo'] = $photo;
        $Client['localisation'] = $localisation;
        $Client['adress'] = $adress;
        $Client['dateSignature'] = $dateSignature;
        $Client['dureeEngagement'] = $dureeEngagement;
        $Client['GMB'] = $GMB;
        $Client['insta'] = $insta;
        $Client['analytics'] = $analytics;
        $Client['MandatSEPA'] = $MandatSEPA;
        $Client['CNI'] = $CNI;
        $Client['RIB'] = $RIB;
        $Client['contrat'] = $contrat;
        $Client['SIRET'] = $SIRET;
        $Client['idForfait'] = $idForfait;
        $Client['idSecteur'] = $idSecteur;
    }
    return $Client;
}
/**
 * Recupere les informations d'un employe tickandbox à partir de son id
 * @param String $id id du client recherché
 * @return Array Tableau contenant les informations d'un client
 */
function getEmployeeById($id)
{
    $requete = "SELECT nomComplet, mail, telephone, photo, adresse, dateSignature, modeRestraint, idPoste, typeContrat FROM TandB where idTB = $id ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $Employe = [];
    while (list($name, $mail, $tel, $photo, $adress, $dateSignature, $restraint, $poste, $typeContrat) = mysqli_fetch_array($exec_requete)) {
        $Employe['name'] = $name;
        $Employe['mail'] = $mail;
        $Employe['tel'] = $tel;
        $Employe['photo'] = $photo;
        $Employe['adress'] = $adress;
        $Employe['dateSignature'] = $dateSignature;
        $Employe['restraint'] = $restraint;
        $Employe['poste'] = $poste;
        $Employe['typeContrat'] = $typeContrat;
    }
    return $Employe;
}

/**
 * Affiche tous les clients avec toutes les informations ainsi que leurs commerciaux attitrés (vues pour administrateur)
 * @return void
 */
function getClient()
{
    $requete = "SELECT idClient, nomComplet, nomEntreprise, mail, adresse, telephone, idClient FROM Client";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    while (list($id, $name, $enterprise, $mail, $adress, $tel, $id) = mysqli_fetch_array($exec_requete)) {
        echo '<form>';
        echo "<p><strong>$name - $enterprise - $mail - $adress</strong></p>";
        echo "<p>Commercial attitré: </p>";
        getCommercialClient($id);
        $num = "+33" . substr($tel, 1, 10);
        $numCT = getNumCallTrackByNum($num);
        if ($numCT != null) {
            echo "<p>Numéros de call tracking</p>";
            echo "<ul>";
            foreach ($numCT as $numC) {
                echo "<li>$numC</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Pas de numéro de CallTracking</p>";
        }
        echo "</form>";
    }
}
/**
 * Récupère la liste des secteur d'activités
 * @return Array Tabeau contenant la liste des secteur d'activité
 */
function getSecteurActivite()
{
    $requete = "SELECT idSecteur,secteurActivite FROM secteurActivite";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    return $exec_requete;
}
/**
 * Recupere la liste des client d'un employé
 * @param String $idTB id de l'employé tickandbox
 * @return Array Tabeau contenant la liste des clients d'un employé tickandbox
 */
function getListClient($idTB)
{
    $requete = "SELECT idClient, nomComplet FROM Client WHERE idTB = $idTB";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    return $exec_requete;
}

/**
 * Recupere la liste des client
 * @return Array Tabeau contenant la liste des clients
 */
function getListClientAdmin()
{
    $requete = "SELECT idClient, nomComplet FROM Client ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    return $exec_requete;
}

/**
 * Recupere la liste des employés tickandbox
 * @return Array Tabeau contenant la liste des employés tickandbox
 */
function getListEmploye()
{
    $requete = "SELECT idTB, nomComplet FROM TandB";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    return $exec_requete;
}

/**
 * Récupere la liste des poste au sein de tickandbox
 * @return Array tableau contenant la liste des postes
 */
function getPoste()
{
    $requete = "SELECT `idPoste`,`poste` FROM `poste` ";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    return $exec_requete;
}

/**
 * Recupere les informations complete d'un client
 * @param String $idClient id du client
 * @return Array Tabeau contenant les informations d'un client
 */
function getInfoClient($idClient)
{
    // On créé la requête
    $req = "SELECT * FROM Client inner join SecteurActivite on Client.idSecteur = SecteurActivite.idSecteur inner join Forfait on Client.idForfait = Forfait.idForfait WHERE idClient = $idClient";
    $db = SGBDConnect();
    $res = mysqli_query($db, $req);
    return mysqli_fetch_assoc($res);
}
function getSecteurActiviteById($idSecteur)
{
    // On créé la requête
    $requete = "SELECT secteurActivite from SecteurActivite where idSecteur = '$idSecteur'";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse['secteurActivite'];

}

/**
 * Recupere le compte Google Analytics d'un client
 * @param String $id id du client
 * @return String Compte Analytics du client
 */
function getGoogleAnalytics($id)
{
    $requete = "SELECT compteAnalytics from Client where idClient = '$id'";
    $db = SGBDConnect();
    $exec_requete = mysqli_query($db, $requete);
    $reponse = mysqli_fetch_array($exec_requete);
    return $reponse['compteAnalytics'];
}
