<?php
session_start();
require 'Include/helpersLibrary.inc.php';
require 'Include/functionAnalytics.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
         <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
         <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
<a href='principale.php?deconnexion=true'><span>Déconnexion</span></a>
<h1>CLIENT DASHBOARD</h1>
<?php
echo "<p>Bonjour," . $_SESSION['username'] . "</p>";
?>
<div id="gauche">
            <h2></h2>
                <ul>
                    <li>Menu</li>
                        <ul>
                        <li><a href="callTrackingClient.php">CallTracking</a></li>
                        <li><a href="AnalyticsClient.php">Google Analytics</a></li>
						<li><a href="InstagramClient.php">Instagram</a></li>
                        <li><a href="settingClient.php">Paramètre</a></li>
                        </ul>
                </ul>
        </div>
<div id="droite">
    <h2>Google Analytics</h2>
    <h3>Résumé du mois</h3>
<?php
$result = getResults($analytics, $profile, 'users');
/*echo '<pre>';
//var_dump($result);
echo '</pre>';*/
$newSessions = getResults($analytics, $profile, 'percentNewSessions');
$newSessions = printResults($newSessions);
$bounceRate = getResults($analytics, $profile, 'bounceRate');
$bounceRate = printResults($bounceRate);
?>
<div style="width: 100%;height: 200 px;display:flex;padding:5%;justify-content:center;">
    <form style="width:150px;text-align:center;margin-right:5%;">
        <h3>Nombre visiteur</h3>
        <?php echo '<p>' . printResults(getResults($analytics, $profile, 'users')) . '</p>'; ?>
    </form>
    </div>

<div style="width: 100%;height: 300px;display: flex; justify-content:center;">

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
$results = getChartResults($analytics, $profile, 'ga:pageviews,ga:users');
?>
<h3>Nombre de visiteurs</h3>
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
<?php
$results = getChartResults($analytics, $profile, 'ga:avgSessionDuration');
?>
<h3>Temps de sessions</h3>
<div id="avgSession" style="height: 400px; padding:0;text-align: center;">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" style="text-align:center">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
		// Sur la ligne ci-dessous, nous faisons un echo en php (code court) du json retourné par la fonction php buildChartArray
		let data = google.visualization.arrayToDataTable(<?=buildChartArray2($results);?>);
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
		let chart = new google.visualization.LineChart(document.getElementById('avgSession'));
		// Nous dessinons le graphique
		chart.draw(data, options);
	}
</script>
</div>
</body>
</html>
