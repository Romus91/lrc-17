<?php 

include("verif.php");
	                        
include('pass.php');
###---ONLINE---###
$loginOnline=mysql_fetch_array(mysql_query("SELECT id FROM online WHERE login =  '".$_SESSION['login']."'"));
$time=date("Y-m-j H:i:s");
if ($loginOnline['id'])
{
	mysql_query("UPDATE online SET timestamp = '".$time."' WHERE login = '".$_SESSION['login']."'");
}else
	mysql_query("INSERT INTO online (login) VALUES ('".$_SESSION['login']."')");
	
$query=mysql_query("SELECT * FROM online");
while($delOnline=mysql_fetch_array($query))
{
	if (((strtotime($time))-(strtotime($delOnline['timestamp']))) > 800)
		mysql_query("DELETE FROM online WHERE id = ".$delOnline['id']."");
}


###----DEBUT----###
include('deb.php');

#########---HOME---#######
	if (($_GET['page'] == '') or ($_GET['page'] == 'home'))
		include('home.php');

###########################
########---Citoyen---########
	if ($_GET['page'] == 'planque')
		include('planque.php');
		
	if ($_GET['page'] == 'citoyen')
		include('citoyen.php');
	
	if ($_GET['page'] == 'scores')
		include('scores.php');
		
		if ($_GET['page'] == 'perso')
			include('perso.php');
				
				if ($_GET['page'] == 'vague')
					include ('vague.php');		
				
				if ($_GET['page'] == 'achat')
					include ('achat.php');
							
				if ($_GET['page'] == 'achatok')
					include ('achatok.php');
	
		if ($_GET['page'] == 'citoyencreer')
			include('citoyencreer.php');
		
			if ($_GET['page'] == 'citoyencreerok')
				include('citoyencreerok.php');
		
		if ($_GET['page'] == 'citoyensuppok')
			include('citoyensuppok.php');
###############################
#########---WALL / MAJ---############
	if ($_GET['page'] == 'wall')
		{
		$sql = "UPDATE  membre SET walltimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
		include('wall.php');
		}
	if ($_GET['page'] == 'maj')
		{
		$sql = "UPDATE  membre SET majtimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
		include('maj.php');
		}
###############################
		
include('fin.php');
###----FIN----###
?>
