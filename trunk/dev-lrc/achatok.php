<?php
	include_once ("verif.php");
	include_once ("pass.php");

	$log = new Log();
	$persoController=new PersoController();
	$perso=$persoController->fetchPerso((int)intval(htmlentities($_GET['perso'])));
	$consoCont = new ConsoController();

	if (($_GET['type'] == 'JKREJI8HYJ444YT')){
		if (isset($_GET['pack'])&&($_GET['pack'] > 0 && $_GET['pack'] < 7)){
			$pack = $consoCont->fetch((int) intval(htmlentities($_GET['pack'])));
			if ($perso->getArgent() >=  $pack->getPrix($perso->getLevel())){
				if ($consoCont->addConso($perso, $pack)){
					switch($pack->getType()){
						case 1:
							$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),"Valeur : ".$pack->getValeurBase()); break;
						case 2:
							$log->insertLog("Achat nrgpack",$_SESSION['member_id'],$perso->getId(),"Valeur : ".$pack->getValeurBase()); break;
					}
				}else{
					switch($pack->getType()){
						case 1:
							$perso->addVie($pack->getValeurBase());
							$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),'Valeur : '.$pack->getValeurBase().'--> Directe');
							break;
						case 2:
							$perso->addEnergie($pack->getEnergie($perso->getMaxEnergie()));
							$log->insertLog("Achat nrgpack",$_SESSION['member_id'],$perso->getId(),'Valeur : '.$pack->getValeurBase().'--> Directe');
							break;
					}
				}
				$perso->addArgent(-($pack->getPrix($perso->getLevel())));
			}else{
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}
		else{
			$_SESSION['text']= "<font color='FF0000'><b>ERREUR PACK</b></font>";
			$_SESSION['erreur']=true;
		}
		$persoController->savePerso($perso);
	}else{
	//Sinon, on affiche un message
	$_SESSION['text']= "<font color='FF0000'><b>ERREUR CODE</b></font>";
	$_SESSION['erreur']=true;
	//On inclu la page 'achat'
	//On quitte la page courante
	}
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo date("dmYH");?>" />
  <meta http-equiv="refresh" content="0; url=index.php?page=perso&onglet=infop&perso=<?php  echo $perso->getId();?>" />
</head>
</html>