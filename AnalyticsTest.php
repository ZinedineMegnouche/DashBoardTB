<?php
require 'Include/functionAnalytics.php';
session_start();
$_SESSION['id'] = 2;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once __DIR__ . '/vendor/autoload.php';

$analytics = initializeAnalytics();
$profile = getFirstProfileId($analytics);


function initializeAnalytics()
{
    //Chemin d'acces au fichier json
    $KEY_FILE_LOCATION = __DIR__ . '/dashboardtb-2acc9286ce5e.json';
    // Creer et configurer
    $client = new Google_Client();
    $client->setApplicationName('Hello Analytics Reporting');
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    $analytics = new Google_Service_Analytics($client);
    return $analytics;
}

function getFirstProfileId($analytics,$_SESSION['id'])
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
            echo "GA = ";
            echo getGoogleAnalytics($_SESSION['id']);
            echo '</br>';
            $compteGA = getGoogleAnalytics($_SESSION['id']);
            $firstPropertyId = null;
            foreach($items as $item){
                if($item->getId() == $compteGA){
                    $firstPropertyId = $item->getId();
                    echo "UTILISATEUR TROUVER";
                }
            }
            if($firstPropertyId != null){
            echo 'propterty = ' . $firstPropertyId . '</br>';
            //recuperer la liste des vues
            $profiles = $analytics->management_profiles->listManagementProfiles($firstAccountId, $firstPropertyId);
            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();
                echo 'item = ' . $items[0]->getId() . '</br>';
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
        $array = [['Date', 'Pages Vues']];
        foreach ($rows as $date) {
            $DateJour = substr($date[0], -2, 2) . '/' . substr($date[0], -4, 2) . '/' . substr($date[0], 0, 4);
            $array[] = [$DateJour, (int) $date[1]];
            echo "-----------";
            echo $date[1];
        }
        return json_encode($array);die;
    } else {
        return 'Pas de résultat';
    }
}
$result = getResults($analytics, $profile, 'users');
/*echo '<pre>';
//var_dump($result);
echo '</pre>';*/
echo "<p>Nouveau Visiteur</p>";
$newSessions = getResults($analytics, $profile, 'percentNewSessions');
$newSessions = printResults($newSessions);
$bounceRate = getResults($analytics, $profile, 'bounceRate');
$bounceRate = printResults($bounceRate);
?>
<div style="width: 100%;height: 150px;display:flex;padding-bottom:5%;justify-content:center;">
    <form style="width:100px;text-align:center;margin-right:5%;">
        <h3>Nombre visiteur</h3>
        <?php echo '<p>'.printResults(getResults($analytics,$profile,'users')).'</p>';?>
    </form>
    <form style="width:100px;text-align:center">
        <h3>Nombre click</h3>
        <?php echo '<p>'.printResults(getResults($analytics,$profile,'users')).'</p>';?>
    </form>
    </div>

<div style="width: 100%;height: 1000px;display: flex; justify-content:center;">
    
    <div style="margin-right: 10%; height: 200px; width: 200px;">
    <form>
    <h3 style="text-align: center;">Nouveau visiteur</h3>
  <canvas id="myChart"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const data = {
  labels: [
    'Nouveaux visiteur en %'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [<?php echo $newSessions; ?>,<?php echo 100 - $newSessions ?>],
    backgroundColor: [
    'rgb(3, 107, 252)',
    'rgb(191, 191, 191)'
    ],
    hoverOffset: 4
  }]
};
const config = {
  type: 'pie',
  data: data,
};
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
</form>
    </div>
<div style="height: 200px; width: 200px;">
<form>
<h3 style="text-align: center;">Taux de rebond</h3>
<canvas id="myChart2"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const data2 = {
  labels: [
    'Taux de rebond en %',
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [<?php echo round($bounceRate, 2); ?>,<?php echo round(100 - $bounceRate, 2); ?>],
    backgroundColor: [
    'rgb(3, 107, 252)',
    'rgb(191, 191, 191)'
    ],
    hoverOffset: 4
  }]
};
const config2 = {
  type: 'pie',
  data: data2,
};
</script>
<script>
  const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );
</script>
</form>
</div>
</div>
<?php
//echo printResults($result).'</br>';

//var_dump($result);
$results = getChartResults($analytics, $profile, 'ga:pageviews,ga:users');
?>
<div id="visites" style="height: 400px; padding:0;text-align: center;">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" style="text-align:center">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		// Sur la ligne ci-dessous, nous faisons un echo en php (code court) du json retourné par la fonction php buildChartArray
		let data = google.visualization.arrayToDataTable(<?=buildChartArray($results);?>);
		// Ci-dessous les options du graphique
		let options = {
			curveType: 'function',
			series: {
				0: {targetAxisIndex:0},
				1:{targetAxisIndex:1},
				//2:{targetAxisIndex:1}
			},
			hAxis : {
				textStyle : {
					fontSize: 10, // or the number you want
					fontName: 'Nunito'
				}
			},
			vAxes: {
				0: {
					gridlines: {color: 'transparent'},
					textStyle : {
						fontSize: 10, // or the number you want
						fontName: 'Nunito'
					}
				},
				1: {
					gridlines: {color: 'transparent'},
					textStyle : {
						fontSize: 10, // or the number you want
						fontName: 'Nunito'
					}
				},
			},
			legend: {
				position: 'bottom',
				textStyle : {
					fontSize: 10, // or the number you want
					fontName: 'Nunito'
				}
			}
		};
		// Nous précisons où le graphique doit être "injecté"
		let chart = new google.visualization.LineChart(document.getElementById('visites'));
		// Nous dessinons le graphique
		chart.draw(data, options);
	}
</script>
</div>
</body>
</html>
