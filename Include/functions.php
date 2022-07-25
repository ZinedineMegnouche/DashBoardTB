<?php
function isTickAndBox($mail)
{
    $TB = "tickandbox.com";
    if (str_contains($mail, $TB)) {
        return true;
    } else {
        return 0;
    }
}
function createSelect($id, $name, $label, $tabIndex, $requete,$selected = null)
{
    $codeHTML = '<label for="' . $id . '">' . $label . '</label>'
        . '<select name="' . $name . '"id="' . $id . '"tabIndex ="' . $tabIndex . '">' . "\n";
    while (list($id, $name) = mysqli_fetch_array($requete)) {
        if($selected == $id){
        $codeHTML = $codeHTML . '<option value="' . $id . '" selected>' . $name . '</option>' . "\n";
        }
        else{
            $codeHTML = $codeHTML . '<option value="' . $id . '">' . $name . '</option>' . "\n";
        }
    }
    $codeHTML = $codeHTML . '</select>' . "\n";
    return $codeHTML;

}
function isRestraintCheck($id)
{
    $modeRestraint = isModeRestraint($id);
    if ($modeRestraint == 1) {
        return "checked";
    } else {
        return "unchecked";
    }
}
function dayDiff($end,$start){
    //echo $end;
    //echo $start;
    $dateEnd = strtotime($end);
    $dateStart = strtotime($start);
    $diff = ($dateEnd-$dateStart)/60/60/24;
    return $diff;
}
function random_mdp()
{
    $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $combLen = strlen($comb) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $combLen);
        $pass[] = $comb[$n];
    }
    return implode($pass);
}
function getCallsTime($uuid,$start,$end = null)
{
    if($end == null){
        $end = date('Y-m-d');
    }
    $nbCallsT = 0;
    $callDurationT = 0;
    $callTakenT = 0;
    foreach ($uuid as $id) {
        $url = "https://app.dexem.com/api/v2/call_tracking/tracking_numbers/$id/call_history_reports.json?start=$start&end=$end&time_zone=Europe/Paris";

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
        $callJsons = json_decode($response, false);
        $nbCalls = 0;
        $callDuration = 0;
        $callTaken = 0;
        $date = "2000-01-01";
        getNumByUUID($id);
        foreach ($callJsons as $session) {
            $etat = "manqué";
            if ($session->answered == "true") {
                $etat = "décroché";
                $callTaken += 1;
                $callTakenT += 1;
            }
            if($date != $session->started_at_date){
                $date = $session->started_at_date;
                echo "</br><h3>".date("d-m-Y",strtotime($date))."</h3></br>";
            }
            echo '<form name = "callTrack" id = "callTrack" >';
            echo '<p>appel entrant: ' . $session->caller_number . ',  date: ' . $session->started_at_date . ' ' . $session->started_at_time . ', durée: ' . secondFormat($session->talk_duration). ' etat: ' . $etat . ' </p>';
            $nbCalls += 1;
            $nbCallsT += 1;
            echo "</form>";
            //echo $session->session;
            //echo '</br>';
            $callDuration += $session->call_duration;
            $callDurationT += $session->call_duration;
            //echo $session->call_duration;

        }
        echo '<form name = "callTrack" id = "callTrack" >';
        echo 'nombre d\'appel: ' . $nbCalls;
        echo ' | Appel décroché: ' . $callTaken;
        echo ' | Temps d\'appel: ' . secondFormat($callDuration);

        if ($nbCalls > 0) {
            echo ' | Temps d\'appel moyen: ' . secondFormat(round($callDuration / $nbCalls));
            echo ' | % d\'appel repondu: ' . round((($callTaken) * 100) / $nbCalls) . '%';
            echo '</br>';
            echo '</br>';
        } else {
            echo ' | Temps d\'appel moyen: 00:00';
            echo ' | Appel décroché: ' . $callTaken;
            echo ' | % d\'appel repondu: 0%';
            echo '</br>';
            echo '</br>';
        }
        echo "</form>";
    }
    if ($nbCallsT > 1) {
        echo "<h3>TOTAL</h3>";
        echo '</br>';
        echo '<form name = "callTrack" id = "callTrack" >';
        echo 'nombre d\'appel: ' . $nbCallsT;
        echo ' | Appel décroché: ' . $callTakenT;
        echo ' | Temps d\'appel: ' . secondFormat($callDurationT);

        if ($nbCallsT > 0) {
            echo ' | Temps d\'appel moyen: ' . secondFormat(round($callDurationT / $nbCallsT));
            echo ' | % d\'appel repondu: ' . round((($callTakenT) * 100) / $nbCallsT) . '%';
        } else {
            echo ' | Temps d\'appel moyen: 00:00';
            echo ' | Appel décroché: ' . $callTakenT;
            echo '% d\'appel repondu: 0%';
            echo '</br>';
            echo '</br>';
        }
        echo "</form>";
    }   
}
function getCalls($uuid)
{
    $time = date('Y-m-d');
    $nbCallsT = 0;
    $callDurationT = 0;
    $callTakenT = 0;
    foreach ($uuid as $id) {
        $url = "https://app.dexem.com/api/v2/call_tracking//tracking_numbers/$id/call_history_reports/$time.json?time_zone=Europe/Paris";

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
        $callJsons = json_decode($response, false);
        $nbCalls = 0;
        $callDuration = 0;
        $callTaken = 0;
        getNumByUUID($id);
        foreach ($callJsons as $session) {
            $etat = "manqué";
            if ($session->answered == "true") {
                $etat = "décroché";
                $callTaken += 1;
                $callTakenT += 1;
            }
            echo '<form name = "callTrack" id = "callTrack" >';
            echo '<p>appel entrant: ' . $session->caller_number . ',  date: ' . $session->started_at_date . ' ' . $session->started_at_time . ', durée: ' . secondFormat($session->talk_duration). ' etat: ' . $etat . ' </p>';
            $nbCalls += 1;
            $nbCallsT += 1;
            echo "</form>";
            //echo $session->session;
            //echo '</br>';
            $callDuration += $session->call_duration;
            $callDurationT += $session->call_duration;
            //echo $session->call_duration;

        }
        echo '<form name = "callTrack" id = "callTrack" >';
        echo 'nombre d\'appel: ' . $nbCalls;
        echo ' | Appel décroché: ' . $callTaken;
        echo ' | Temps d\'appel: ' . secondFormat($callDuration);

        if ($nbCalls > 0) {
            echo ' | Temps d\'appel moyen: ' . secondFormat(round($callDuration / $nbCalls));
            echo ' | % d\'appel repondu: ' . round((($callTaken) * 100) / $nbCalls) . '%';
            echo '</br>';
            echo '</br>';
        } else {
            echo ' | Temps d\'appel moyen: 00:00';
            echo ' | Appel décroché: ' . $callTaken;
            echo ' | % d\'appel repondu: 0%';
            echo '</br>';
            echo '</br>';
        }
        echo "</form>";
    }
    if ($nbCallsT > 1) {
        echo "<h3>TOTAL</h3>";
        echo '</br>';
        echo '<form name = "callTrack" id = "callTrack" >';
        echo 'nombre d\'appel: ' . $nbCallsT;
        echo ' | Appel décroché: ' . $callTakenT;
        echo ' | Temps d\'appel: ' . secondFormat($callDurationT);

        if ($nbCallsT > 0) {
            echo ' | Temps d\'appel moyen: ' . secondFormat(round($callDurationT / $nbCallsT));
            echo ' | % d\'appel repondu: ' . round((($callTakenT) * 100) / $nbCallsT) . '%';
        } else {
            echo ' | Temps d\'appel moyen: 00:00';
            echo ' | Appel décroché: ' . $callTakenT;
            echo '% d\'appel repondu: 0%';
            echo '</br>';
            echo '</br>';
        }
        echo "</form>";
    }

}
//$start = date('Y-m-d',strtotime("-29 days"));
function secondFormat($second)
{
    if ($second >= 3600) {
       $second = date('h:i:s', $second);
    } else {
        $second = date('i:s', $second);
    }
    return $second;
}

function getUUIDByNum($num)
{
    $url = "https://app.dexem.com/api/v2/call_tracking/tracking_numbers";

    //Your username.
    $username = '17126ca6-8b23-4861-bdd6-5fcde41614c3';

    //Your password.
    $password = '2cce8675f97cfc1e0a55c9ccd183acb7';

    //Initiate cURL.
    $ch = curl_init($url);

    //Specify the username and password using the CURLOPT_USERPWD option.
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Execute the cURL request.
    $response = curl_exec($ch);
    $callJson = json_decode($response, true);
    $items = $callJson['items'];
    $uuid = array();
    foreach ($items as $item) {
        if ($item['redirection_number'] == $num) {
            array_push($uuid, $item['uuid']);
            // echo $item['uuid'];
            // echo "</br>";
            // echo "num ajouté ! </br>";
            // echo "</br>";
        }
    }
    return $uuid;
}
function getNumCallTrackByNum($num)
{
    //$num = "+33" . substr($num, 1, 10);
    //echo "nuuuummm 2    :====$num";
    //echo "num 1 = $num";
    $url = "https://app.dexem.com/api/v2/call_tracking/tracking_numbers";

    //Your username.
    $username = '17126ca6-8b23-4861-bdd6-5fcde41614c3';

    //Your password.
    $password = '2cce8675f97cfc1e0a55c9ccd183acb7';

    //Initiate cURL.
    $ch = curl_init($url);

    //Specify the username and password using the CURLOPT_USERPWD option.
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Execute the cURL request.
    $response = curl_exec($ch);
    $callJson = json_decode($response, true);
    $items = $callJson['items'];
    $numCT = array();
    foreach ($items as $item) {
        if ($item['redirection_number'] == $num) {
            $theNum = "0".substr($item['number'], 3, 13);
            array_push($numCT, $theNum);
            // echo $item['uuid'];
            // echo "</br>";
            // echo "num ajouté ! </br>";
            // echo "</br>";
        }
    }
    return $numCT;
}
function getNumByUUID($UUID)
{
    $url = "https://app.dexem.com/api/v2/call_tracking/tracking_numbers";

    //Your username.
    $username = '17126ca6-8b23-4861-bdd6-5fcde41614c3';

    //Your password.
    $password = '2cce8675f97cfc1e0a55c9ccd183acb7';

    //Initiate cURL.
    $ch = curl_init($url);

    //Specify the username and password using the CURLOPT_USERPWD option.
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //Execute the cURL request.
    $response = curl_exec($ch);
    $callJson = json_decode($response, true);
    $items = $callJson['items'];
    foreach ($items as $item) {
        if ($item['uuid'] == $UUID) {
            echo "<h3>Num Call Tracking " . $item['number'] . " | Libellé : " . $item['source'] . "</h3>";
            //echo "num ajouté ! </br>";
            //echo "</br>";
        }
    }
}
function addNumCallTracking($num,$label,$idClient)
{
    $tel  = "+33" . substr($num, 1, 10);
    $url = "https://app.dexem.com/api/v2/call_tracking/tracking_numbers";

    $username = '17126ca6-8b23-4861-bdd6-5fcde41614c3';
    $password = '2cce8675f97cfc1e0a55c9ccd183acb7';

    $ch = curl_init($url);
    try{
    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
    curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array("mode"=>"single","source"=>$label,"geo_zone"=>"Région Sud-Est","redirection_number"=>$tel));
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
		
	    if (curl_errno($ch)) {
			echo curl_error($ch);
			die();
		}
		
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($http_code == intval(200)){
			echo $response." Erreur api, contactez le developpeur";
		}
		else if($http_code == 201){
            echo "Call traking ajouté";
            addCallTrackingDB($num,$label,$idClient);
		}
        else if($http_code == 400){
            echo "Erreur : Nombre limite de numero atteinte, contactez un développeur|| Numero mal saisie " . $http_code;
        }
	} catch (\Throwable $th) {
		throw $th;
	} finally {
		curl_close($ch);
	}
}