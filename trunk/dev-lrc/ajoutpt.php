<?php session_start();
include_once("pass.php");
require_once 'PersoController.php';
require_once 'PersoClass.php';

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($_GET['perso']);

$inv = mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));

if ($perso->getNbPtsAmDispo() > 0)
{
	if ($_GET['type'])
	{
		if ($_GET['type'] == 'deg') $type = "degat".$_GET['i'];
		else
		if ($_GET['type'] == 'pre') $type = "prec".$_GET['i'];
		else
		if ($_GET['type'] == 'cap') $type = "capa".$_GET['i'];

		if ($inv[$type] < 10)
		{
			mysql_query("UPDATE inventaire SET ".$type." = ".($inv[$type]+1)." WHERE id_perso = ".$perso->getId()."")
				or die (mysql_error());
			$perso->addPtsAmDispo(-1);
			$persoCont->savePerso($perso);

			$_SESSION['erreur']=true;
			$_SESSION['text']="<font color = '00FF00'>Point d'amélioration ajouté</font>";
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."&type=arme&i=".$_GET['i']."&part=gene');</script>";
		}else
		{
			$_SESSION['erreur']=true;
			$_SESSION['text']="<font color = 'FF0000'>Amélioration déjà pleine</font>";
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."&type=arme&i=".$_GET['i']."&part=gene');</script>";
		}
	}else
	{
		$_SESSION['erreur']=true;
		$_SESSION['text']="<font color = 'FF0000'>Erreur type</font>";
		echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."&type=arme&i=".$_GET['i']."&part=gene');</script>";
	}
}else
{
	$_SESSION['erreur']=true;
	$_SESSION['text']="<font color = 'FF0000'>Pas assez de points d'amélioration</font>";
	echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."&type=arme&i=".$_GET['i']."&part=gene');</script>";
}