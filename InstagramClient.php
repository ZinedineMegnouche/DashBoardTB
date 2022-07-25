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
<!--
    window.fbAsyncInit = function() {
    FB.init({
      appId      : '957545824955777', //Changer l'appID (actuellement test App)
      cookie     : true,
      xfbml      : true,
      version    : 'v3.2'
    });
    -->

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '961071297935514',
      cookie     : true,
      xfbml      : true,
      version    : 'v13.0'
    });

    FB.AppEvents.logPageView();

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<script>

FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
    var tokenFB = response.authResponse.accessToken;
    document.write(tokenFB);
    print(tokenFB);
});
</script>
<script>
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
    var tokenFB = response.authResponse.accessToken;
    document.write(tokenFB);
    print(tokenFB);
  });

}</script>
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
    <h2>Instagram</h2>
    <h3>Résumé du mois</h3>

<fb:login-button
  scope="public_profile,email,instagram_basic,pages_show_list,instagram_manage_insights"
  onlogin="checkLoginState();">
</fb:login-button>
<script>
  document.write("Ceci est un test");
</script>
</div>
    </body>
</html>
