<?php
require_once 'autoload.php';

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

include_once("pass.php");
$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
$arm=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inv['arm'.$i]."'"));

$max = $arm['munmax']+($arm['munmax']*($inv['capa'.$i]/10));
$nbmun = $max - $inv['mun'.$i];

echo json_encode(array('type'=>'success','content'=>$nbmun*$arm['prixballes']));
?>