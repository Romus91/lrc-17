<?php
require_once 'autoload.php';
require_once 'verif.php';

$t = (int) htmlentities($_GET['type']);

if($t==AmelioCompte::AM_PIERCE || $t==AmelioCompte::AM_FRAG){
	$amCont = new AmelioCompteController();
	$memCont = new MemberController();
	$mem = $memCont->fetchMembre($_SESSION['member_id']);

	if($t==AmelioCompte::AM_PIERCE) $level = $mem->getPierceLevel();
	else $level = $mem->getFragLevel();

	$am = $amCont->fetchAmelio($level,$t);

	if($am!=null){
		if($mem->getLevel()>=$am->getLevelRequis()){
			if($mem->getArgent()>=$am->getPrix()){
				$mem->addArgent(-$am->getPrix());
				if($t==AmelioCompte::AM_PIERCE)	$mem->setPierceLevel($mem->getPierceLevel()+1);
				else $mem->setFragLevel($mem->getFragLevel()+1);

				$memCont->saveMember($mem);
			}else{
				$_SESSION['shop_error'] = "Pas assez d'argent pour effectuer l'achat !";
			}
		}else{
			$_SESSION['shop_error'] = "Niveau insuffisant !";
		}
	}else{
		$_SESSION['shop_error'] = "Vous avez atteind le niveau maximum !";
	}
}else{
	$_SESSION['shop_error'] = "Type d'amélioration inconnu !";
}
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=citoyen" />
</head>
</html>