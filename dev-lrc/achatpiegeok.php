<?php
	include_once ("verif.php");
	include_once ("pass.php");

	$persoController = new PersoController();
	$log = new Log();
	$perso = $persoController->fetchPerso($_GET['perso']);

	$piege_id = htmlentities($_GET['acheterpiege']);
	/*
	$nom=$_GET['perso'];
	$_POST['acheterpiege']=$_GET['acheterpiege'];
	$sql = 'SELECT argent,vie,id FROM perso WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$nom.'"'; //on s�l�ctionne l'argent, arme, pige, vie du perso du membre connect�
	$res = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());//On v�rifie si il n'y a pas d'erreurs
	$t = mysql_fetch_array($res);//On stocke les resultats dans une variable t
	*/

	//Chaque if correspond � chaque objets
	//On v�rifie si le POST de la page pr�c�dente correspond a l'objet, si l'argent est suffisant, et si il ne le poss�de pas d�j�.
	//Dans ce cas, on modifie dans la base de donn�e (table perso) l'arme, ou le piege, ou la vie du perso du membre connect�
	//Ensuite, son argent
	//On v�rifie toujours si il n'y a pas d'erreurs
	$piege=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE id = '".$piege_id."'"));
	$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));

	if (!isset($_GET['acheterpiege'])){
			$_SESSION['erreur']= "<font color='FF0000'><b>Tu as oubli� de s�lectionner !</b></font>";
	}else{
		for ($i=1;$i<=2;$i++){
			if ($inventaire['pie'.$i] == NULL){
				if ($perso->getArgent() >= $piege['prix']){
					if ($perso->getLevel() >= $arme['lvlrequis']){
						$sql = 'UPDATE inventaire SET pie'.$i.' = "'.$piege['image'].'" , munp'.$i.' = '.(ceil($piege['munmax']/5)).' WHERE id_perso = '.$perso->getId().' ';
						mysql_query($sql);

						$perso->addArgent(-$piege['prix']);
						$persoController->savePerso($perso);
						$log->insertLog("Achat piege",$_SESSION['member_id'],$perso->getId()," pie".$i." : ".$piege['image']."<br>munp".$i." = ".(ceil($piege['munmax']/5)));
					}else{
						$_SESSION['text']= "<font color='FF0000'><b>CHEATEUR !</b></font>";
						$_SESSION['erreur']=true;
					}
				}else{
					//Sinon, on affiche un message
					$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
					$_SESSION['erreur']=true;
				}
				break;
			}
		}
		if ($i > 2){
			$_SESSION['text']= "<font color='FF0000'><b>Plus de place dans l'inventaire</b></font>";
			$_SESSION['erreur']=true;
		}

	}
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=perso&onglet=infop&perso=<?php  echo $perso->getId();?>" />
</head>
</html>