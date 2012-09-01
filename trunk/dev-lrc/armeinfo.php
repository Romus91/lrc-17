<?php
require_once 'autoload.php';

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

include_once("pass.php");
$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
$arm=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inv['arm'.$i]."'"));
$arme=$inv['arm'.$i];
if ($arme!='piedbiche'){
	$content=array();

	$content['nomarme'] = $arm['nom'];
	$content['jdeg'] = ($arm['force']*10).'%';
	$content['jamdeg'] = (($arm['deg']==0)?100:$inv['degat'.$i]*100/$arm['deg']).'%';

	$content['jpre'] =$arm['precision'].'%';
	$content['jampre'] =(($arm['pre']==0)?100:$inv['prec'.$i]*100/$arm['pre']).'%';

	$content['jcap'] =(($arm['munmax']/250)*100).'%';
	$content['jamcap'] =(($arm['cap']==0)?100:$inv['capa'.$i]*100/$arm['cap']).'%';
	echo json_encode(array('type'=>'success','content'=>$content));
}else{
	echo json_encode(array('type'=>'piedbiche'));
}
?>