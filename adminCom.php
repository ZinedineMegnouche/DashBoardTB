
<html>
    <head>
        <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
<?php
require 'Include/SourceDonnees.inc.php';
session_start();
if($_SESSION['restraint'] != 1){
require_once 'adminDashboard.php';
echo '<h2>Commercial</h2>';
getCommercial();
}
else{
    require_once 'adminDashboard.php';
    echo '<h2>Commercial</h2>';
}
?>
</div>
</body>
</html>