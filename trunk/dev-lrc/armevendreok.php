<?php
	include_once("verif.php");
	include_once("pass.php");

	$i = (int) htmlentities($_GET['i']);

	$persoController = new PersoController();
	$log = new Log();
	$perso = $persoController->fetchPerso($_GET['perso']);

	$arme = mysql_fetch_array(mysql_query('select * from armes where image =(select arm'.$i.' from inventaire where id_perso = '.$perso->getId().');'));

	$inv = mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId()));

	$perso->addPtsAmDispo(($inv['degat'.$i] + $inv['prec'.$i] + $inv['capa'.$i]));

	for ($cpt=$i;$cpt<=4;$cpt++)
	{
		$sql="UPDATE inventaire SET arm".$cpt." = '".$inv['arm'.($cpt+1)]."', mun".$cpt." = '".$inv['mun'.($cpt+1)]."', degat".$cpt." = '".$inv['degat'.($cpt+1)]."', prec".$cpt." = '".$inv['prec'.($cpt+1)]."' , capa".$cpt." = '".$inv['capa'.($cpt+1)]."' WHERE id_perso = ".$perso->getId()."";
		mysql_query($sql) or die('Erreur SQL ! '.$sql.' '.mysql_error());

	}
	$log->insertLog("Vendre arme",$_SESSION['member_id'],$perso->getId()," arm".$i." : ".$arme['image']);

	$perso->addArgent(floor($arme['prix']/2));
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