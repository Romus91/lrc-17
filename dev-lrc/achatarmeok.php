<?php include_once ("verif.php");
	include_once ("pass.php");

	$persoController = new PersoController();
	$log = new Log();
	$perso = $persoController->fetchPerso($_GET['perso']);

	$arme_id = htmlentities($_GET['acheterarme']);

	/*
	$sql = 'SELECT argent,vie,id,level FROM perso WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$nom.'"'; //on sélèctionne l'argent, arme, pige, vie du perso du membre connecté
	$res = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());//On vérifie si il n'y a pas d'erreurs
	$t = mysql_fetch_array($res);//On stocke les resultats dans une variable t
	*/

	//Chaque if correspond à chaque objets
	//On vérifie si le POST de la page précédente correspond a l'objet, si l'argent est suffisant, et si il ne le possède pas déjà.
	//Dans ce cas, on modifie dans la base de donnée (table perso) l'arme, ou le piege, ou la vie du perso du membre connecté
	//Ensuite, son argent
	//On vérifie toujours si il n'y a pas d'erreurs
	$arme=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE id = '".$arme_id."'"));
	$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	if (!isset($_GET['acheterarme'])){
			$_SESSION['erreur']= "<font color='FF0000'><b>Tu as oublié de sélectionner !</b></font>";
	}else{
		for ($i=1;$i<=4;$i++){
			if ($inventaire['arm'.$i] == NULL){
				if ($perso->getArgent() >= $arme['prix']){
					if ($perso->getLevel() >= $arme['lvlrequis']){
						$sql = 'UPDATE inventaire SET arm'.$i.' = "'.$arme['image'].'" , mun'.$i.' = '.(ceil($arme['munmax']/5)).' WHERE id_perso = "'.$perso->getId().'" ';
						mysql_query($sql) ;

						$perso->addArgent(-$arme['prix']);
						$persoController->savePerso($perso);
						$log->insertLog("Achat arme",$_SESSION['member_id'],$perso->getId()," arm".$i." : ".$arme['image']."<br>mun".$i." = ".(ceil($arme['munmax']/5)));
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
		if ($i > 4){
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