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

	if($mem->getArgent()>=$am->getPrix()){
		$mem->addArgent(-$am->getPrix());
		if($t==AmelioCompte::AM_PIERCE)	$mem->setPierceLevel($mem->getPierceLevel()+1);
		else $mem->setFragLevel($mem->getFragLevel()+1);

		$memCont->saveMember($mem);
	}else{
		$_SESSION['shop_error'] = "Pas assez d'argent pour effectuer l'achat !";
	}
}else{
	$_SESSION['shop_error'] = "Type d'amיlioration inconnu";
}
?>