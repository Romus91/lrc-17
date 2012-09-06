<?php
require_once 'autoload.php';

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

include_once("pass.php");
$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
$arm=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image = '".$inv['pie'.$i]."'"));

$max = $arm['munmax'];
$nbmun = $max - $inv['munp'.$i];
echo json_encode(array('type'=>'success','content'=>$nbmun*$arm['prixballes']));

?>