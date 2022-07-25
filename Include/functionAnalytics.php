<?php
require 'Include/SourceDonnees.inc.php';

require_once 'vendor/autoload.php';

$analytics = initializeAnalytics();
$profile = getFirstProfileId($analytics);

function initializeAnalytics()
{
    //Chemin d'acces au fichier json
    $KEY_FILE_LOCATION = 'dashboardtb-2acc9286ce5e.json';
    // Creer et configurer
    $client = new Google_Client();
    $client->setApplicationName('Hello Analytics Reporting');
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    $analytics = new Google_Service_Analytics($client);
    return $analytics;
}

function getFirstProfileId($analytics)
{
    //recuperer la liste des comptes
    $accounts = $analytics->management_accounts->listManagementAccounts();
    //var_dump($accounts);die;
    if (count($accounts->getItems()) > 0) {
        $items = $accounts->getItems();
        $firstAccountId = $items[0]->getId();

        //recuperer la liste des propriétés
        $properties = $analytics->management_webproperties->listManagementWebproperties($firstAccountId);
        if (count($properties->getItems()) > 0) {
            $items = $properties->getItems();
            //$firstPropertyId = $items[0]->getId();
            //foreach($)
            $i = 0;
            /*echo "GA = ";
            echo getGoogleAnalytics($_SESSION['id']);
            echo '</br>';*/
            $compteGA = getGoogleAnalytics($_SESSION['id']);
            $firstPropertyId = null;
            foreach($items as $item){
                if($item->getId() == $compteGA){
                    $firstPropertyId = $item->getId();
                    //echo "UTILISATEUR TROUVER";
                }
            }
            if($firstPropertyId != null){
            //echo 'propterty = ' . $firstPropertyId . '</br>';
            //recuperer la liste des vues
            $profiles = $analytics->management_profiles->listManagementProfiles($firstAccountId, $firstPropertyId);
            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();
                //echo 'item = ' . $items[0]->getId() . '</br>';
                return $items[0]->getId();
            } else {
                throw new Exception('No view (profiles) found for this users.');
            }
        } else {
            throw new Exception('No properties found for this users.');
        }
    } else {
        throw new Exception('No account found for this users.');
    }
    }
}

function getResults($analytics, $profileId, $metric)
{
    return $analytics->data_ga->get(
        'ga:' . $profileId,
        '30daysAgo',
        'today',
        'ga:' . $metric
    );
}

function printResults($result)
{
    if (count($result->getRows()) > 0) {
        $rows = $result->getRows();
        $value = $rows[0][0];
        return $value;
    } else {
        return 'Pas de résultat';
    }
}

function getChartResults($analytics, $profileId, $metric)
{
    return $analytics->data_ga->get(
        'ga:' . $profileId,
        '30daysAgo',
        'today',
        $metric,
        [
            'dimensions' => 'ga:Date',
        ]
    );
}
/**
 * Fonction qui permet de creer un tableau 
 * @param
 * @return
 */
function buildChartArray($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows();
        //$array = [['Date','Pages Vues','Visiteur','Visites']];
        $array = [['Date', 'Pages Vues']];
        foreach ($rows as $date) {
            $DateJour = substr($date[0], -2, 2) . '/' . substr($date[0], -4, 2) . '/' . substr($date[0], 0, 4);
            $array[] = [$DateJour, (int) $date[1]];
        }
        return json_encode($array);
    } else {
        return 'Pas de résultat';
    }
}

function buildChartArray2($results)
{
    if (count($results->getRows()) > 0) {
        $rows = $results->getRows();
        //$array = [['Date','Pages Vues','Visiteur','Visites']];
        $array = [['Date', 'Temps de session (en seconde)']];
        foreach ($rows as $date) {
            $DateJour = substr($date[0], -2, 2) . '/' . substr($date[0], -4, 2) . '/' . substr($date[0], 0, 4);
            $array[] = [$DateJour, (int) $date[1]];
        }
        return json_encode($array);
    } else {
        return 'Pas de résultat';
    }
}
