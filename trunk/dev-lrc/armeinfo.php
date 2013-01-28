<?php
require_once 'autoload.php';

$id=(int)htmlentities($_GET['id']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

$armes=$perso->getInvArme();
$i=0;
for(;$i<count($armes) && $armes[$i]->getId()!=$id;$i++);

if ($armes[$i]->getImage()!='piedbiche'){
	$content=array();

	$content['nomarme'] = $armes[$i]->getNom();

	$content['jdeg'] = ($armes[$i]->getForce()/15*100).'%';
	$content['jamdeg'] = ($armes[$i]->getDamage()/15*100).'%';
	$content['libdeg'] = number_format($armes[$i]->getDamage(),2);
	$content['tdeg'] = $armes[$i]->getAmForce().' / '.$armes[$i]->getAmDegMax();

	$content['jpre'] =$armes[$i]->getPrecision().'%';
	$content['jampre'] = number_format($armes[$i]->getHitChance(),2).'%';
	$content['libpre'] = $content['jampre'];
	$content['tpre'] = $armes[$i]->getAmPreci().' / '.$armes[$i]->getAmPreMax();

	$content['jcap'] =($armes[$i]->getMunmax()/500*100).'%';
	$content['jamcap'] =($armes[$i]->getCapacity()/500*100).'%';
	$content['libcap'] = number_format($armes[$i]->getCapacity(),2);
	$content['tcap'] = $armes[$i]->getAmCapa().' / '.$armes[$i]->getAmCapMax();

	echo json_encode(array('type'=>'success','content'=>$content));
}else{
	echo json_encode(array('type'=>'piedbiche'));
}
$persoCont=null;
$perso=null;
?>