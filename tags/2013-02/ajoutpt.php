<?php session_start();
require_once'autoload.php';

$id=(int)htmlentities($_GET['id']);
$p=(int)htmlentities($_GET['perso']);
$t=htmlentities($_GET['type']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

if ($perso->getNbPtsAmDispo() > 0){
	if (isset($_GET['type']) && !empty($_GET['type']) &&($t == 'deg' || $t == 'pre' || $t == 'cap')){
		$armes = $perso->getInvArme();
		$i=0;
		for(;$i<count($armes) && $armes[$i]->getId()!=$id;$i++);

		if($t=="cap" && $armes[$i]->getAmCapa()<$armes[$i]->getAmCapMax()){
			$armes[$i]->addAmCapa();
			$perso->addPtsAmDispo(-1);
			$persoCont->savePerso($perso);
			$content = array();
			$content['message']="<font color = '00FF00'>Point d'am&eacute;lioration ajout&eacute;</font>";
			$content['type']=$t;
			$content['ptam']=$perso->getNbPtsAmDispo();
			$content['munitions'] = $armes[$i]->getMunitions()." | ".$armes[$i]->getCapacity();
			$content['jauge'] = number_format($armes[$i]->getCapacity()/375*100,2).'%';
			$content['lib'] = number_format($armes[$i]->getCapacity(),2);
			$content['texte'] = $armes[$i]->getAmCapa().' / '.$armes[$i]->getAmCapMax();
			$response = array("type"=>"success", "content"=>$content);
		}else if($t=='deg' && $armes[$i]->getAmForce()<$armes[$i]->getAmDegMax()){
			$armes[$i]->addAmForce();
			$perso->addPtsAmDispo(-1);
			$perso->setInvArme($armes);
			$persoCont->savePerso($perso);
			$content = array();
			$content['message']="<font color = '00FF00'>Point d'am&eacute;lioration ajout&eacute;</font>";
			$content['type']=$t;
			$content['ptam']=$perso->getNbPtsAmDispo();
			$content['jauge'] = number_format($armes[$i]->getDamage()/20*100,2).'%';
			$content['lib'] = number_format($armes[$i]->getDamage(),2);
			$content['texte'] = $armes[$i]->getAmForce().' / '.$armes[$i]->getAmDegMax();
			$response = array("type"=>"success", "content"=>$content);
		}else if($t=='pre' && $armes[$i]->getAmPreci()<$armes[$i]->getAmPreMax()){
			$armes[$i]->addAmPreci();
			$perso->addPtsAmDispo(-1);
			$persoCont->savePerso($perso);
			$content = array();
			$content['message']="<font color = '00FF00'>Point d'am&eacute;lioration ajout&eacute;</font>";
			$content['type']=$t;
			$content['ptam']=$perso->getNbPtsAmDispo();
			$content['jauge'] = number_format($armes[$i]->getHitChance(),2).'%';
			$content['texte'] = $armes[$i]->getAmPreci().' / '.$armes[$i]->getAmPreMax();
			$response = array("type"=>"success", "content"=>$content);
		}else{
			$response = array("type"=>"success","content"=>array("message"=>"<font color = 'FF0000'>Am&eacute;lioration d&eacutej&#224; pleine</font>"));
		}
	}else{
		$response = array("type"=>"success","content"=>array("message"=>"<font color = 'FF0000'>Erreur type</font>"));
	}
}else{
	$response = array("type"=>"success","content"=>array("message"=>"<font color = 'FF0000'>Pas assez de points d'am&eacute;lioration</font>"));
}
echo json_encode($response);
$persoCont=null;
$perso=null;
