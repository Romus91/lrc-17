<?php
	if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['photo']) && !empty($_POST['photo']))) {
	//on v�rifie qu'il ne sont pas vide
		$_POST['nom']=ucfirst($_POST['nom']);
		$_POST['nom']=stripslashes(str_replace("'","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(" ","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("*","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("/","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("-","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("+","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("$","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("^","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("�","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(":","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(",","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("&","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("?","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("(","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(")","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("!","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("�","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("|","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("�","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace(";","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("#","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("�","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("=","_",$_POST['nom']));
		$_POST['nom']=stripslashes(str_replace("�","_",$_POST['nom']));

		$_POST['nom']=mysql_real_escape_string($_POST['nom']);

		$name = htmlentities($_POST['nom']);

		for ($i = 0, $j = strlen($name); $i < $j; $i++){
			if ($name[$i] == "_"){
				 $erreur= "<font color='FF0000'><b>Caract�re non permis</b></font>";
				 include("citoyencreer.php");
				 $erreur="";
				 exit;
			}
		}

		//on v�rifie que le login n'est pas deja pris
		$sql = 'SELECT * FROM perso WHERE id_membre="'.$_SESSION['member_id'].'" AND nom="'.$name.'"';
		$req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
		$nb = mysql_num_rows($req);


		if($nb > 0){
			$erreur= "<font color='FF0000'><b>Perso deja existant !</b></font>";
			include("citoyencreer.php");
			$erreur="";
			exit;
		}

		$perso = $persoController->createPerso($name, $_POST['photo'], $_SESSION['member_id']);
		imagepng(genImg($perso->getAvatar().'.JPG',207,0,$perso->getLevel(),0),'ava/'.$perso->getId().'.png');
		$log=new Log();
		$log->insertLog("Perso Cr��",$_SESSION['member_id'],$perso->getId(),"Nom : ".$name);
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