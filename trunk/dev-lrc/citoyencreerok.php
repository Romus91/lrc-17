<?php
	if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['photo']) && !empty($_POST['photo']))) {
	//on vérifie qu'il ne sont pas vide
		$_POST['nom']=ucfirst($_POST['nom']);
		$_POST['nom']=stripslashes(str_replace("'","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(" ","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("*","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("/","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("-","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("+","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("$","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("^","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("µ","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(":","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(",","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("&","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("?","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("(","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(")","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("!","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("§","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("|","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("ç","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(";","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("#","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("ù","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("=","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("¨","_",$_POST['nom']));

		$_POST['nom']=mysql_real_escape_string($_POST['nom']);

		$name = htmlentities($_POST['nom']);

		for ($i = 0, $j = strlen($name); $i < $j; $i++){
			if ($name[$i] == "_"){
				 $erreur= "<font color='FF0000'><b>Caractère non permis</b></font>";
				 include("citoyencreer.php");
				 $erreur="";
				 exit;
			}
		}

		//on vérifie que le login n'est pas deja pris
		$sql = 'SELECT * FROM perso WHERE id_membre="'.$_SESSION['member_id'].'" AND nom="'.$name.'"';
		$req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
		$nb = mysql_num_rows($req);


		if($nb > 0){
			$erreur= "<font color='FF0000'><b>Perso deja existant !</b></font>";
			include("citoyencreer.php");
			$erreur="";
			exit;
		}

		$persoController->createPerso($name, $_POST['photo'], $_SESSION['member_id']);
		$tabPerso=$persoController->fetchMembre($_SESSION['member_id']);
		$log=new Log();
		$log->insertLog("Perso Créé",$_SESSION['member_id'],$tabPerso[count($tabPerso)-1]->getId(),"Nom : ".$name);
		/*
		$localtime=localtime(time(), true);
		$annee=(1900+$localtime[tm_year]);
		$mktime=mktime(0, 0, 0, ($localtime[tm_mon]+1), $localtime[tm_mday], $annee);
		$sql = 'INSERT INTO perso (id_membre,nom,photo,date,vie) VALUES("'.$_SESSION['login'].'","'.mysql_escape_string($_POST['nom']).'","'.(mysql_escape_string($_POST['photo'])).'","'.$mktime.'",100)';
        mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
		*/


		/*$id=mysql_fetch_array(mysql_query("SELECT id FROM perso WHERE nom = '".$name."' AND id_membre='".$_SESSION['member_id']."'"));
		$sql = 'INSERT INTO inventaire (id_perso) VALUES("'.$id['id'].'")';
        mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());*/
    }
    else
	{ //si un des champ est vide on affiche une erreur
        $erreur="<font color='FF0000'><b>ERREUR : Champ vide</b></font>";
        include('citoyencreer.php');
        exit();
    }
?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Citoyen</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=citoyen" />
</head>
</html>