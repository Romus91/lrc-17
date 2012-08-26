<?php
require_once 'autoload.php';

$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

$pourcEn = floor(($perso->getEnergie()/$perso->getMaxEnergie())*100);

echo json_encode(array(
	"vie"=>$perso->getVie(),
	"jaugevie"=>($perso->getVie().'%'),
	"eng"=>$perso->getEnergie(),
	"jaugeeng"=> ((($pourcEn>100)?100:$pourcEn).'%')));
?>