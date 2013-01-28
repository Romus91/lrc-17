<?php include_once ("verif.php");
	include_once ("pass.php");

	$persoController = new PersoController();
	$log = new Log();
	$perso = $persoController->fetchPerso((int)htmlentities($_GET['perso']));
	$arme_id = (int)htmlentities($_GET['acheterarme']);
	$armCont = new ArmeController();
	$arme = $armCont->fetchArme($arme_id);

	$inv = $perso->getInvArme();


	//Chaque if correspond à chaque objets
	//On vérifie si le POST de la page précédente correspond a l'objet, si l'argent est suffisant, et si il ne le possède pas déjà.
	//Dans ce cas, on modifie dans la base de donnée (table perso) l'arme, ou le piege, ou la vie du perso du membre connecté
	//Ensuite, son argent
	//On vérifie toujours si il n'y a pas d'erreurs
	if (!isset($_GET['acheterarme'])){
			$_SESSION['erreur']= "<font color='FF0000'><b>Tu as oublié de sélectionner !</b></font>";
	}else{
		if (count($inv) >= 6){
			$_SESSION['text']= "<font color='FF0000'><b>Plus de place dans l'inventaire</b></font>";
			$_SESSION['erreur']=true;
		}else{
			if ($perso->getArgent() >= $arme->getPrix()){
				if ($perso->getLevel() >= $arme->getLvlrequis()){
					$arme->setMunitions(ceil($arme->getCapacity()/5));
					if($armCont->addArme($perso->getId(), $arme)){
						$perso->addArgent(-$arme->getPrix());
						$persoController->savePerso($perso);
					}else{
						$_SESSION['text']= "<font color='FF0000'><b>Erreur inconnue</b></font>";
						$_SESSION['erreur']=true;
					}
				}else{
					$_SESSION['text']= "<font color='FF0000'><b>Pas le niveau !</b></font>";
					$_SESSION['erreur']=true;
				}
			}else{
				//Sinon, on affiche un message
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}
	}
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=perso&onglet=infop&perso=<?php  echo $perso->getId();?>" />
</head>
</html>