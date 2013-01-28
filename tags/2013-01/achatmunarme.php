<?php include_once ("verif.php");

	$persoController = new PersoController();
	$log = new Log();

	$idperso=(int) htmlentities($_GET['perso']);
	$id=(int) htmlentities($_GET['id']);

	$perso=$persoController->fetchPerso($idperso);

	$armes = $perso->getInvArme();
	$j=0;
	for(;$j<count($armes) && $armes[$j]->getId()!=$id;$j++);
	$arm = $armes[$j];

	$munachat = $arm->getCapacity()-$arm->getMunitions();
	$totalachat = $munachat*$arm->getPrixballes();

	if ($totalachat > $perso->getArgent()){
		$munachat = floor($perso->getArgent()/$arm->getPrixballes());
		$totalachat = $munachat*$arm->getPrixballes();

	}

	$arm->addMunitions($munachat);
	$perso->setArgent($perso->getArgent()-$totalachat);
	$persoController->savePerso($perso);

	$response = array('type'=>'reloadsuccess','content'=>array('mun'=>$arm->getMunitions(),'capa'=>$arm->getCapacity(),'money'=>$perso->getArgent(),'arme'=>$id));

	echo json_encode($response);
?>