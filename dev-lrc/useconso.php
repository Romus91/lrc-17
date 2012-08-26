<?php
include_once("verif.php");
require_once 'autoload.php';

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);
$log=new Log();

include_once("pass.php");

$consoCont = new ConsoController();

$inv=mysql_fetch_array(mysql_query("SELECT conso".$i." FROM inventaire WHERE id_perso = '".$perso->getId()."'"));

if (isset($inv['conso'.$i])){
	$conso = $inv['conso'.$i];
	$pack = $consoCont->fetch($conso);

	$result = '';

	switch($pack->getType()){
		case 1:
			$perso->addVie($pack->getValeurBase());
			$result = array("type"=>"success","content"=>array("type"=>"vie","amount"=>$perso->getVie(),"jauge"=>($perso->getVie().'%')));
			$log->insertLog("Use medipack",$_SESSION['member_id'],$perso->getId(),'Valeur : '.$pack->getValeurBase());
			break;
		case 2:
			$perso->addEnergie($pack->getEnergie($perso->getMaxEnergie()));
			$result = array("type"=>"success","content"=>array("type"=>"eng","amount"=>$perso->getEnergie(),"jauge"=>(floor($perso->getEnergie()*100/$perso->getMaxEnergie()).'%')));
			$log->insertLog("Use nrgpack",$_SESSION['member_id'],$perso->getId(),'Valeur : '.$pack->getValeurBase());
			break;
	}
	mysql_query("UPDATE inventaire SET conso".$i." = NULL WHERE id_perso = '".$perso->getId()."';")or die(mysql_error());
	$persoCont->savePerso($perso);
	echo json_encode($result);
}
?>