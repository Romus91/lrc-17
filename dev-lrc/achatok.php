<?php 
	include_once ("verif.php");
	include_once ("pass.php");
	require_once 'PersoController.php';
	include_once 'LogClass.php';
	
	$log = new Log();
	$persoController=new PersoController();
	$perso=$persoController->fetchPerso($_GET['perso']);	
	
	$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	
	if (($_GET['type'] == 'JKREJI8HYJ444YT')){ 						      
		for ($i=1;$i<=2;$i++) if (($inventaire['conso'.$i] == NULL) OR ($inventaire['conso'.$i] == '')) break;

		if (isset($_GET['medipack'])&&$_GET['medipack'] == 10){
			if (($perso->getArgent() >=  (ceil($perso->getLevel()/4)*200)) AND ($perso->getLevel() >=5 )){
				if ($i <= 2){
					$sql = 'UPDATE inventaire SET conso'.$i.'= "v10" WHERE id_perso = "'.$perso->getId().'"'; 
					mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
					$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),"V10");
				}else{
					$perso->addVie(10);
					$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),"V10 --> Directe");
				}
				$perso->addArgent(-(ceil($perso->getLevel()/4)*200));
			}else{
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}else if (isset($_GET['medipack'])&&$_GET['medipack'] == 50){
			if (($perso->getArgent() >=  (ceil($perso->getLevel()/4)*500)) AND ($perso->getLevel() >=7 )){
				if ($i <= 2){
					$sql = 'UPDATE inventaire SET conso'.$i.'= "v50" WHERE id_perso = "'.$perso->getId().'"'; 
					mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
					$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),"V50");
				}else{
					$perso->addVie(50);
					$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),"V50 --> Directe");
				}
				$perso->addArgent(-(ceil($perso->getLevel()/4)*500));
			}else{
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}else if (isset($_GET['medipack'])&&$_GET['medipack'] == 'full'){
			if (($perso->getArgent() >=(ceil($perso->getLevel()/4)*800)) AND ($perso->getLevel() >=10 )){
				if ($i <= 2){
					$sql = 'UPDATE inventaire SET conso'.$i.'= "vf" WHERE id_perso = "'.$perso->getId().'"'; 
					mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
					$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),"VF");
				}else{
					$perso->addVie(100);
					$log->insertLog("Achat medipack",$_SESSION['member_id'],$perso->getId(),"VF --> Directe");
				}
				$perso->addArgent(-(ceil($perso->getLevel()/4)*800));
			}else{
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}else if (isset($_GET['nrgpack'])&&$_GET['nrgpack'] == '20'){
			if (($perso->getArgent() >=(ceil($perso->getLevel()/4)*300)) AND ($perso->getLevel() >=6 )){
				if ($i <= 2){
					$sql = 'UPDATE inventaire SET conso'.$i.' = "n20" WHERE id_perso = "'.$perso->getId().'"'; 		
					mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
					$log->insertLog("Achat NrgPack",$_SESSION['member_id'],$perso->getId(),"N20");
				}else{
					$perso->addEnergie(20);
					$log->insertLog("Achat NrgPack",$_SESSION['member_id'],$perso->getId(),"N20 --> directe");
				}					
				$perso->addArgent(-(ceil($perso->getLevel()/4)*300));
			}else{
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}else if (isset($_GET['nrgpack'])&&$_GET['nrgpack'] == '70'){
			if (($perso->getArgent() >=(ceil($perso->getLevel()/4)*700)) AND ($perso->getLevel() >=8 )){
				if ($i <= 2){
					$sql = 'UPDATE inventaire SET conso'.$i.' = "n70" WHERE id_perso = "'.$perso->getId().'"'; 		
					mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
					$log->insertLog("Achat NrgPack",$_SESSION['member_id'],$perso->getId(),"N70");
				}else{
					$perso->addEnergie(70);
					$log->insertLog("Achat NrgPack",$_SESSION['member_id'],$perso->getId(),"N70 --> Directe");
				}	
				$perso->addArgent(-(ceil($perso->getLevel()/4)*700));
			}else{
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}else if (isset($_GET['nrgpack'])&&$_GET['nrgpack'] == '100'){
			if (($perso->getArgent() >=(ceil($perso->getLevel()/4)*1000)) AND ($perso->getLevel() >=10 )){
				if ($i <= 2){
					$sql = 'UPDATE inventaire SET conso'.$i.' = "n100" WHERE id_perso = "'.$perso->getId().'"'; 		
					mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
					$log->insertLog("Achat NrgPack",$_SESSION['member_id'],$perso->getId(),"N100");
				}else{
					$perso->addEnergie(100);
					$log->insertLog("Achat NrgPack",$_SESSION['member_id'],$perso->getId(),"N100 --> Directe");
				}	
				$perso->addArgent(-(ceil($perso->getLevel()/4)*1000));
			}else{
				$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
				$_SESSION['erreur']=true;
			}
		}else{
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