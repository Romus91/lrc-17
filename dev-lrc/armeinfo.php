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
	$content['jdeg'] = ($arm['force']/20*100).'%';
	$content['jamdeg'] = (($arm['force']*(1+($inv['degat'.$i]/10)))/20*100).'%';
	$content['libdeg'] = number_format($arm['force']*(1+($inv['degat'.$i]/10)),2);
	$content['tdeg'] = $inv['degat'.$i].' / '.$arm['deg'];

	$content['jpre'] =$arm['precision'].'%';
	$content['jampre'] = number_format(($arm['precision']*(1+($inv['prec'.$i]/10))),2).'%';
	$content['libpre'] = $content['jampre'];
	$content['tpre'] = $inv['prec'.$i].' / '.$arm['pre'];

	$content['jcap'] =($arm['munmax']/500*100).'%';
	$content['jamcap'] =($arm['munmax']*(1+($inv['capa'.$i]/10))/500*100).'%';
	$content['libcap'] = number_format($arm['munmax']*(1+($inv['capa'.$i]/10)),2);
	$content['tcap'] = $inv['capa'.$i].' / '.$arm['cap'];

	echo json_encode(array('type'=>'success','content'=>$content));
}else{
	echo json_encode(array('type'=>'piedbiche'));
}
?>