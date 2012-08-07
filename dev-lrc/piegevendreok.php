<?php
	include_once("verif.php");
	include_once("pass.php");
	require_once 'PersoController.php';
	
	$i = (int) htmlentities($_GET['i']);
	
	$persoController = new PersoController();
	$perso = $persoController->fetchPerso($_GET['perso']);
	
	$piege = mysql_fetch_array(mysql_query('select * from pieges where image =(select pie'.$i.' from inventaire where id_perso = '.$perso->getId().');'));
	
	$inv = mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId()));
	
	for ($cpt=$i;$cpt<=2;$cpt++)
	{
		$sql="UPDATE inventaire SET pie".$cpt." = '".$inv['pie'.($cpt+1)]."', munp".$cpt." = '".$inv['munp'.($cpt+1)]."' WHERE id_perso = ".$perso->getId()."";
		mysql_query($sql) or die('Erreur SQL ! '.$sql.' '.mysql_error());
	}
	
	$perso->addArgent(floor($piege['prix']/2));
	$persoController->savePerso($perso);
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Inscription</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <meta http-equiv="refresh" content="0; url='index.php?page=perso&perso=<?php echo $perso->getId();?>'" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
</body>
</html>