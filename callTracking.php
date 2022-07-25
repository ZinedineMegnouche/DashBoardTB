<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
require 'Include/functions.php';
require 'Include/SourceDonnees.inc.php';
require 'Include/helpersLibrary.inc.php';

/*$numCT = getNumCallTrackByNum('0634476943');
foreach($numCT as $num){
    echo $num;
    echo "</br>";
}
echo 'oui';*/

?>
<form id="testcheckbox" method="POST">
<label for ="test">Test 1: </label><input id = "test" type="checkbox" checked>
<input type="submit" value="OK">
</form>
<?php
if(isset($_REQUEST['test'])){
    echo 'le bouton est appuyé';
}
else{
    echo 'la d ';
}
// $str = "0634476943";
//$str = "+33".substr($str,1,10);
//echo $str;
//echo '</br>';
//$num = getNumClientById(2);
//echo $num;
//echo '</br>';
//$datetime1 = strtotime('2022-03-16');
//$datetime2 = strtotime('2021-03-16');
//echo "date diff = ";
 //echo ($datetime1-$datetime2)/60/60/24;
 //echo "</br>"
//The URL of the resource that is protected by Basic HTTP Authentication.
/*$url = 'https://app.dexem.com/api/v2/call_tracking/tracking_numbers';

//Your username.
$username = '17126ca6-8b23-4861-bdd6-5fcde41614c3';

//Your password.
$password = '2cce8675f97cfc1e0a55c9ccd183acb7';

//Initiate cURL.
$ch = curl_init($url);

//Specify the username and password using the CURLOPT_USERPWD option.
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);

//Tell cURL to return the output as a string instead
//of dumping it to the browser.

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Execute the cURL request.
$response = curl_exec($ch);

//Check for errors.
if(curl_errno($ch)){
//If an error occured, throw an Exception.
throw new Exception(curl_error($ch));
}
 */
//Print out the response.
?>
<?php
//addNumCallTracking("+33634476943","w");
//echo $response;
//echo 'bonjour';
/*$callJson = json_decode($response,true);
$items = $callJson['items'];
$links = $callJson['links'];
foreach($items as $item){
echo 'Nom du call tracking = '.$item['source'].'</br>';
echo 'Numero du call tracking = '.$item['number'].'</br>';
echo 'Numero de redirection = '.$item['redirection_number'].'</br>';
}

foreach($links as $link){
}*/
//echo 'au revoir';
/*$num = getNumClientById(1);
if ($num != null) {
    echo "num = $num </br></br> ";
    $uuid = getUUIDByNum($num);
    getCalls($uuid);
}
else {
    echo "<h2>Pas de numéro de CallTracking</h2>";
}*/

//echo $response;
//echo "<a href=$response>Testtttttt</a>";
?>
</body>
</html>