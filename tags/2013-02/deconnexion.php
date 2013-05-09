<?php
session_start();
include('pass.php');
mysql_query("DELETE FROM online WHERE login = '".$_SESSION['login']."'");

session_destroy();//on commence la session
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Accueil</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo date("dmYH");?>" />
  <meta http-equiv="refresh" content="0; url=login.php" />
</head>
</html>