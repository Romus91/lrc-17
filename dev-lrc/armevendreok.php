<?php
	require_once 'autoload.php';
	include_once("verif.php");

	$id = (int) htmlentities($_GET['id']);
	$p = (int) htmlentities($_GET['perso']);

	$persoController = new PersoController();
	$armeCont = new ArmeController();
	$log = new Log();
	$perso = $persoController->fetchPerso($p);
	$armes = $perso->getInvArme();

	$j=0;
	for(;$j<count($armes) && $armes[$j]->getId()!=$id;$j++);

	$perso->addPtsAmDispo($armes[$j]->getAmPreci()+$armes[$j]->getAmForce()+$armes[$j]->getAmCapa());

	$armeCont->deleteArme($perso, $armes[$j]);
	$perso->addArgent(floor($armes[$j]->getPrix()/2));
	unset($armes[$j]);
	$armes=array_values($armes);

	$ordre=1;
	foreach ($armes as $arm) {
		if($arm->getId()!=1){
			$arm->setOrdre($ordre);
			$ordre++;
		}else{
			$arm->setOrdre(Perso::MAX_WEAP);
		}
	}

	$perso->setInvArme($armes);
	$persoController->savePerso($perso);

	echo json_encode(array('type'=>'success','content'=>array('money'=>$perso->getArgent(),'arme'=>$id)));
?>
