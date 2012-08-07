<?php 

include("verif.php");
	                        
include('pass.php');
require_once 'PersoClass.php';
require_once 'PersoController.php';

$persoController = new PersoController();
$log = new Log();



###----DEBUT----###
include('deb.php');

#########---HOME---#######
	if ((!isset($_GET['page'])) or ($_GET['page'] == 'home'))
		include('home.php');

###########################
########---Citoyen---########
	if (isset($_GET['page'])&&$_GET['page'] == 'planque')
		include('planque.php');
		
	if (isset($_GET['page'])&&$_GET['page'] == 'citoyen')
		include('citoyen.php');
	
	if (isset($_GET['page'])&&$_GET['page'] == 'scores')
		include('scores.php');
		
		if (isset($_GET['page'])&&$_GET['page'] == 'perso')
			include('perso.php');
				
				if (isset($_GET['page'])&&$_GET['page'] == 'vague')
					include ('vague.php');		
				
				if (isset($_GET['page'])&&$_GET['page'] == 'achat')
					include ('achat.php');
							
				if (isset($_GET['page'])&&$_GET['page'] == 'achatok')
					include ('achatok.php');
	
		if (isset($_GET['page'])&&$_GET['page'] == 'citoyencreer')
			include('citoyencreer.php');
		
			if (isset($_GET['page'])&&$_GET['page'] == 'citoyencreerok')
				include('citoyencreerok.php');
		
		if (isset($_GET['page'])&&$_GET['page'] == 'citoyensuppok')
			include('citoyensuppok.php');
###############################
#########---WALL / MAJ---############
	if (isset($_GET['page'])&&$_GET['page'] == 'wall')
		{
		$sql = "UPDATE  membre SET walltimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
		include('wall.php');
		}
	if (isset($_GET['page'])&&$_GET['page'] == 'maj')
		{
		$sql = "UPDATE  membre SET majtimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
		include('maj.php');
		}
###############################
		
include('fin.php');
###----FIN----###
?>
