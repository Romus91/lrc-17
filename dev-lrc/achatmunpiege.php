<?php include_once ("verif.php");
	include_once ("pass.php");
	require_once 'PersoController.php';
	require_once 'LogClass.php';
	
	$persoController = new PersoController();
	$log = new Log();
	
	$idperso= (int) htmlentities($_GET['perso']);
	$mun= (int) htmlentities($_GET['mun']);
	$munpiege= (int) htmlentities($_GET['munpiege']);
	
	$perso=$persoController->fetchPerso($idperso);
	
	$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	$piege=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image ='".$inv["pie".$munpiege]."'"));
	
	if ($mun > $piege['munmax']) $mun=$piege['munmax'];
	$perso->setArgent($perso->getArgent()-($mun*$piege['prixballes']));
	
	$mun+=$inv['munp'.$munpiege];
	$sql='UPDATE inventaire SET munp'.$munpiege.' = '.$mun.' WHERE id_perso = '.$perso->getId().' ';
	mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
	
	$persoController->savePerso($perso);
	$log->insertLog("Achat mun arme",$_SESSION['member_id'],$perso->getId()," munp".$munpiege." : ".$_GET['mun']."+".$inv['munp'.$munpiege]."");
?>	
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0;  url='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=piege&i=<?php echo $munpiege;?>'"/>
</head>
</html>