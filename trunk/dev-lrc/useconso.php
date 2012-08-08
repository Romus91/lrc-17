<?php
	include_once("verif.php");
	require_once 'PersoController.php';
	require_once 'LogClass.php';
	require_once 'ConsoClass.php';
	require_once 'ConsoController.php';
	include_once("pass.php");

	$log = new Log();
	$persoController = new PersoController();
	$perso=$persoController->fetchPerso($_GET['perso']);
	$consoCont = new ConsoController();

	$inv=mysql_fetch_array(mysql_query("SELECT conso".$_GET['i']." FROM inventaire WHERE id_perso = '".$perso->getId()."'"));

	if (isset($inv['conso'.$_GET['i']])){
		$conso = $inv['conso'.$_GET['i']];
		$pack = $consoCont->fetch($conso);

		switch($pack->getType()){
			case 1:
				$perso->addVie($pack->getValeurBase());
				$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),'Valeur : '.$pack->getValeurBase());
				break;
			case 2:
				$perso->addEnergie($pack->getEnergie($perso->getMaxEnergie()));
				$log->insertLog("Use nrgpack",$_SESSION['member_id'],$perso->getId(),'Valeur : '.$pack->getValeurBase());
				break;
		}

	}else {
		$_SESSION['text']= "<font color='FF0000'><b>CHEATER</b></font>";
		$_SESSION['erreur']=true;
	}
	mysql_query("UPDATE inventaire SET conso".$_GET['i']." = NULL WHERE id_perso = '".$perso->getId()."'")or die(mysql_error());
	$persoController->savePerso($perso);
?>

<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=perso&onglet=infop&perso=<?php  echo $perso->getId();?>" />
</head>
</html>