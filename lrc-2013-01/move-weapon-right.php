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

	$arm=$armes[$j];

	$armeCont->moveArmeRight($perso, $arm);