<?php session_start();
require_once'autoload.php';
include_once("pass.php");

$id=(int)htmlentities($_GET['id']);
$p=(int)htmlentities($_GET['perso']);
$t=htmlentities($_GET['type']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

if (isset($_GET['type']) && !empty($_GET['type']) &&($t == 'deg' || $t == 'pre' || $t == 'cap')){
	$armes = $perso->getInvArme();

	$i=0;
	for(;$i<count($armes) && $armes[$i]->getId()!=$id;$i++);

	if($t=="cap" && $armes[$i]->getAmCapa()>0){
		$armes[$i]->remAmCapa();
		if($armes[$i]->getMunitions()>$armes[$i]->getCapacity()){
			$surplus = $armes[$i]->getMunitions()-$armes[$i]->getCapacity();
			$armes[$i]->setMunitions($armes[$i]->getCapacity());
			$perso->addArgent($surplus*$armes[$i]->getPrixballes());
		}
		$perso->addPtsAmDispo(1);
		$perso->setInvArme($armes);
		$persoCont->savePerso($perso);
		$content = array();
		$content['message']="<font color = '00FF00'>Point d'am&eacute;lioration retir&eacute;</font>";
		$content['type']=$t;
		$content['ptam']=$perso->getNbPtsAmDispo();
		$content['munitions'] = $armes[$i]->getMunitions()." | ".$armes[$i]->getCapacity();
		$content['jauge'] = number_format($armes[$i]->getCapacity()/225*100,2).'%';
		$content['lib'] = number_format($armes[$i]->getCapacity(),2);
		$content['texte'] = $armes[$i]->getAmCapa().' / '.$armes[$i]->getAmCapMax();
		$content['argent'] = $perso->getArgent();
		$response = array("type"=>"success", "content"=>$content);
	}else if($t=='deg' && $armes[$i]->getAmForce()>0){
		$armes[$i]->remAmForce();
		$perso->addPtsAmDispo(1);
		$persoCont->savePerso($perso);
		$content = array();
		$content['message']="<font color = '00FF00'>Point d'am&eacute;lioration retir&eacute;</font>";
		$content['type']=$t;
		$content['ptam']=$perso->getNbPtsAmDispo();
		$content['jauge'] = number_format($armes[$i]->getDamage()/20*100,2).'%';
		$content['lib'] = number_format($armes[$i]->getDamage(),2);
		$content['texte'] = $armes[$i]->getAmForce().' / '.$armes[$i]->getAmDegMax();
		$response = array("type"=>"success", "content"=>$content);
	}else if($t=='pre' && $armes[$i]->getAmPreci()>0){
		$armes[$i]->remAmPreci();
		$perso->addPtsAmDispo(1);
		$persoCont->savePerso($perso);
		$content = array();
		$content['message']="<font color = '00FF00'>Point d'am&eacute;lioration retir&eacute;</font>";
		$content['type']=$t;
		$content['ptam']=$perso->getNbPtsAmDispo();
		$content['jauge'] = number_format($armes[$i]->getHitChance(),2).'%';
		$content['texte'] = $armes[$i]->getAmPreci().' / '.$armes[$i]->getAmPreMax();
		$response = array("type"=>"success", "content"=>$content);
	}else{
		$response = array("type"=>"success","content"=>array("message"=>"<font color = 'FF0000'>D&eacute;j&#224; au minimum</font>"));
	}
}else{
	$response = array("type"=>"success","content"=>array("message"=>"<font color = 'FF0000'>Erreur type</font>"));
}
echo json_encode($response);