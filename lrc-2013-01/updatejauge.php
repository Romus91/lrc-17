<?php
require_once 'autoload.php';

$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

echo json_encode(array(
	"vie"=>$perso->getVie(),
	"jaugevie"=>($perso->getVie().'%'),
	"eng"=>$perso->getEnergie(),
	"jaugeeng"=> ($perso->getEnergyPercent().'%'),
	"exp"=>($perso->getXp()),
	"jaugeexp"=>($perso->getLevelPercent().'%'),
	"psn"=>$perso->getJaugePoison(),
	"jaugepsn"=>($perso->getPoisonPercent().'%')
));
?>