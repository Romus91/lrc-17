<?php
	include_once ("verif.php");
	include_once ("pass.php");
	require_once 'PersoController.php';
	require_once 'ConsoController.php';
	include_once 'LogClass.php';

	$log = new Log();
	$persoController=new PersoController();
	$perso=$persoController->fetchPerso($_GET['perso']);
	$consoCont = new ConsoController();

	$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));

	if (($_GET['type'] == 'JKREJI8HYJ444YT')){
		for ($i=1;$i<=2;$i++) if (($inventaire['conso'.$i] == NULL) OR ($inventaire['conso'.$i] == '')) break;

		if (isset($_GET['pack'])&&($_GET['pack'] > 0 && $_GET['pack'] < 7)){
			$pack = $consoCont->fetch($_GET['pack']);
			if ($perso->getArgent() >=  $pack->getPrix($perso->getLevel())){
				if ($i <= 2){
					$sql = 'UPDATE inventaire SET conso'.$i.'= "'.$pack->getId().'" WHERE id_perso = "'.$perso->getId().'"';
					mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
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
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=perso&onglet=infop&perso=<?php  echo $perso->getId();?>" />
</head>
</html>