<?php

include_once("verif.php");
include_once('pass.php');
require_once("cdnHelper.php");

$persoController = new PersoController();
$log = new Log();



###----DEBUT----###
include('deb.php');


#########---HOME---#######
if ((!isset($_GET['page'])) or (isset($_GET['page'])&& $_GET['page'] == 'home'))
include('home.php');

else if(isset($_GET['page'])){
	########---Citoyen---########
	if ($_GET['page'] == 'planque')
	include('planque.php');
	else
	if ($_GET['page'] == 'citoyen')
	include('citoyen.php');
	else
	if ($_GET['page'] == 'scores')
	include('scores.php');
	else
	if ($_GET['page'] == 'perso')
	include('perso.php');
	else
	if ($_GET['page'] == 'vague')
	include ('wave.php');
	else
	if ($_GET['page'] == 'achat')
	include ('achat.php');
	else
	if ($_GET['page'] == 'achatok')
	include ('achatok.php');
	else
	if ($_GET['page'] == 'citoyencreer')
	include('citoyencreer.php');
	else
	if ($_GET['page'] == 'citoyencreerok')
	include('citoyencreerok.php');
	else
	if ($_GET['page'] == 'citoyensuppok')
	include('citoyensuppok.php');
	else
	#########---WALL / MAJ---############
	if ($_GET['page'] == 'wall')
	{
		$sql = "UPDATE  membre SET walltimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
		include('wall.php');
	}
	else
	if ($_GET['page'] == 'maj')
	{
		$sql = "UPDATE  membre SET majtimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
		include('maj.php');
	}
	else
	if($_GET['page']=='lexique') include_once 'lexique.php';
}


include('fin.php');
###----FIN----###
?>
