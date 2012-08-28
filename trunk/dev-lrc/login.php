<?php  session_start();// on commence la session
//les données viennent de index.htm
// on se connecte à la base de donnée
   include_once('pass.php');
   require_once('autoload.php');
   $_SESSION['erreur']= "";
   $log = new Log();

	if(isset($_POST['login']) && isset($_POST['pass']) && !empty($_POST['login']) && !empty($_POST['pass'])){
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

   //on vérifie que les champ ne sont pas vide
    // extract($_POST);
     // on recupère le password qui correspond au login du visiteur
     $pass= md5(mysql_escape_string($_POST['pass']));
     //echo $_POST,"<br>",$pass,"<br>",$_POST['pass'];
     $sql = "SELECT id FROM membre where login='".mysql_real_escape_string($_POST['login'])."' and pass='".mysql_real_escape_string($pass)."'";//on va chercher le login et le mot de passe du visiteur
     $req = mysql_query($sql) ;
     $data = mysql_fetch_array($req);
	 $nb = mysql_num_rows($req);


	 //echo "<br>",$data[0],"<br>",$nb,"<br>",$sql;
//si il n'est pas correct, on affiche une erreur

     if(!$data['id']){
       $_SESSION['erreur']= '<center><font color="#FF0000"><b>Mauvais login/mot de passe...</b></font></center>';
       include("loginb.php");
	   $_SESSION['erreur']="";// On inclut la page index.htm
       exit;
     }
     else {//sinon
       $_SESSION['login'] = $_POST['login'];
	   $_SESSION['member_id'] = $data['id'];
      // on stocke ce login dans une variable de session

	   $req = ConnectionSingleton::connect()->prepare('insert into chat (id_membre, login,timestamp) values (:id,:login,:t);');
	   $req->execute(array('id'=>$data['id'],'login'=>("<font color='#0F0'>+ ".$_POST['login']."</font>"),"t"=>microtime(true)));

	   $req = ConnectionSingleton::connect()->prepare('insert into activity (id_membre, date) values (:id,NOW());');
	   $req->execute(array('id'=>$data['id']));

	  $log->insertLog("Connecté",$_SESSION['member_id'],"NULL",$_SESSION['login']);
     }
   }
   else
   {//si un champ est vide on affiche une erreur
		include("loginb.php");
		exit;
   }
 $_SESSION['nb']=mt_rand(1,7);

?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Login</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <meta http-equiv="refresh" content="0;url=index.php">
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
</html>
