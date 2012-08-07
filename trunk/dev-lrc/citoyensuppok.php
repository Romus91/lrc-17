<?php include ("verif.php");
   $nom = $_GET['perso'];  
   $sql = "UPDATE perso SET enterrer = 1 WHERE perso.id_membre = '".$_SESSION['login']."' and perso.nom = '".$nom."' "; 
   $req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error()); 
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Supp</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=citoyen" />
</head>
</html>