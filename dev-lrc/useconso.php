<?php
	include_once("verif.php");
	require_once 'PersoController.php';
	require_once 'LogClass.php';
	include_once("pass.php");
	
	$log = new Log();
	$persoController = new PersoController();
	$perso=$persoController->fetchPerso($_GET['perso']);
	$conso=$_GET['conso'];
	
	$inv=mysql_fetch_array(mysql_query("SELECT conso".$_GET['i']." FROM inventaire WHERE id_perso = '".$perso->getId()."'"));
	
	if (isset($inv['conso'.$_GET['i']])){
		if ($conso == 'v10'){
			$perso->addVie(10);
			$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),"V10");
		}else if ($conso == 'v50'){
			$perso->addVie(50);
			$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),"V50");
		}else if ($conso == 'vf'){
			$perso->addVie(100);
			$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),"VF");
		}else if ($conso == 'n20'){
			$perso->addEnergie(20);
			$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),"N20");
		}else if ($conso == 'n70') {
			$perso->addEnergie(70);
			$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),"N70");
		}else if($conso == 'n100'){
			$perso->addEnergie(100);
			$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),"N100");
		}else {
			$_SESSION['text']= "<font color='FF0000'><b>ERROR</b></font>";
			$_SESSION['erreur']=true;
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