<?php
include_once("verif.php");
require_once 'autoload.php';

$p=(int)htmlentities($_GET['perso']);
$id = (int)htmlentities($_GET['pack']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);
$log=new Log();
$consoCont = new ConsoController();

$inv=$perso->getInvConso();

$has = false;
$i=0;
for(;$i<count($inv);$i++) if($inv[$i]==$id) $has=true;

if ($has){
	$pack = $consoCont->fetch($id);

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
	$consoCont->useConso($perso, $pack);
	$persoCont->savePerso($perso);
	echo json_encode($result);
}else{
	echo json_encode(array('type'=>'error'));
}
?>