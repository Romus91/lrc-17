<?php  session_start();
include_once('pass.php');

$log = new Log();
		$login=$_POST['login'];
		$_POST['login']=ucfirst($_POST['login']);
   		$_POST['login']=stripslashes(str_replace("'","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace(" ","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("*","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("/","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("-","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("+","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("$","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("^","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("µ","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace(":","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace(",","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("&","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("?","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("(","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace(")","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("!","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("§","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("|","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("ç","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace(";","_",$_POST['login']));
		$_POST['login']=stripslashes(str_replace("#","_",$_POST['login']));
		$_POST['login']=mysql_real_escape_string($_POST['login']);

		$string = $_POST['login'];
			for ($i = 0, $j = strlen($string); $i < $j; $i++)
			{
				if ($string[$i] == "_")
				{
					 $_SESSION['erreur2']= "<font color='FF0000'><b>Caractère non permis</b></font>";
					 include("loginb.php");
					 $_SESSION['erreur2']="";
					 exit;
				}
			}

if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm'])))
{ //on vérifie qu'il ne sont pas vide
	if (filter_var(mysql_escape_string($_POST['email']), FILTER_VALIDATE_EMAIL))
	{
	   if ($_POST['pass'] != $_POST['pass_confirm'])
	   { // on vérifie que le mot de passe tapé est différent que celui du mot de passe à confirmer
          $_SESSION['erreur1']="<font color='FF0000'><b>Mots de passe pas identique</b></font>"; //on affiche une erreur
		  include("loginb.php");
		  $_SESSION['erreur1']="";
		  exit;
       }
       else
	   {
	   //si ils sont les même on se connecte à la base de donnée


                 //on vérifie que le login n'est pas deja pris
          $sql2 = 'SELECT id FROM membre WHERE email="'.mysql_escape_string($_POST['email']).'"';
          $req2 = mysql_query($sql2) or die('Erreur SQL !'.$sql.''.mysql_error());
          $nb2 = mysql_num_rows($req2);

                 //on vérifie que le login n'est pas deja pris
          $sql = 'SELECT id FROM membre WHERE login="'.mysql_escape_string($_POST['login']).'"';
          $req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
          $nb = mysql_num_rows($req);

          if (($nb == 0) and ($nb2 == 0)) //on insère les nouveau login dans la base de donnée et son mot de passe
		  {
		    if (empty($_POST['email'])) {$email='inconnu';}else{$email=($_POST['email']);}
             $sql = 'INSERT INTO membre (login,pass,date,email) VALUES("'.mysql_escape_string($_POST['login']).'", "'.md5(mysql_escape_string($_POST['pass'])).'",NOW(), "'. mysql_real_escape_string($email).'")';
             mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

             // on récupère l'id de notre nouveau membre
             $id = mysql_insert_id();


             $_SESSION['login'] =$login;
			 $data=mysql_fetch_array(mysql_query("SELECT id FROM membre WHERE login = '".$login."'"));
			 $_SESSION['member_id'] = $data['id'];

             // on stocke cet id dans une variable de session
             $_SESSION['id'] = $id;
             //exit();

			 $log->inserLog("Nouveau membre",$_SESSION['member_id'],"NULL",$_SESSION['login']);
          }
          else
		  { //sinon on affiche un erreur pour le login deja pris
		     $_SESSION['erreur2']= "<font color='FF0000'><b>Quelqu'un a déjà ce login...</b></font>";
             include("loginb.php");
			 $_SESSION['erreur2']="";
             exit;
          }
       }
	}else
	{
		$_SESSION['erreur3']= "<font color='FF0000'><b>Email non valide</b></font>";
        include("loginb.php");
		$_SESSION['erreur3']="";
        exit;
	}
 }
else
{ //si un des champ est vide on affiche une erreur
	 $_SESSION['erreur3']= '<font color="FF0000"><b>Attention, champs vides</b></font>';
	include("loginb.php");
	$_SESSION['erreur3']="";
	exit;
}
//}
if (($_POST['login'] <> 'Administrateur') AND ($_POST['login'] <> 'test')){
    include ("pass.php");
 $sql='select id,nom,url,clic from partenaires '; // Requete sql qui affiche le nom du partanaire et son nombre de clics. Vous pouvez également jeter un coup d'oil sur clause "ORDER BY" qui va vous classer par ordre alphabétique les partenaires.
 $req=mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); // On active la requete sql
 $data = mysql_fetch_array($req);
 mysql_query("UPDATE partenaires SET clic=clic+1 , login='".$_SESSION['login']."' where id='".$data[0]."'");
 }
 $_SESSION['nb']=rand(1,7);
 ?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Inscription</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <meta http-equiv="refresh" content="0; url=index.php" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
</html>