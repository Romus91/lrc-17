<?php
require_once 'autoload.php';
require_once 'verif.php';

$id=(int)htmlentities($_GET['id']);
$p=(int)htmlentities($_GET['perso']);
$dir=htmlentities($_GET['dir']);

$persoController = new PersoController();
$armeCont = new ArmeController();
$log = new Log();
$perso = $persoController->fetchPerso($p);
$armes = $perso->getInvArme();

$j=0;
for(;$j<count($armes) && $armes[$j]->getId()!=$id;$j++);

if($id!=1 && ($dir=='up'||$dir=='down')){
	$ordre = $armes[$j]->getOrdre();
	if($dir=='up' && $j>0){
		$armes[$j]->setOrdre($ordre-1);
		$armes[$j-1]->setOrdre($ordre);
	}else if($dir=='down' && isset($armes[$j+1]) && $armes[$j+1]->getId()!=1){
		$armes[$j]->setOrdre($ordre+1);
		$armes[$j+1]->setOrdre($ordre);
	}else{
		//mauvais déplacement
	}
	$perso->setInvArme($armes);
	$persoController->savePerso($perso);
}else{
	//erreur dir
}