<?php  session_start();
require_once 'autoload.php';
include_once('pass.php');

$log = new Log();

if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm'])) && (isset($_POST['email']) && !empty($_POST['email']))){
	$login=Member::purifyLogin($_POST['login']);
	$mail=mysql_real_escape_string($_POST['email']);

	for($i = 0, $j = strlen($login); $i < $j; $i++){
		if ($login[$i] == "_"){
			$_SESSION['erreur2']= "<font color='FF0000'><b>Caract&egrave;re non permis</b></font>";
			include("loginb.php");
			$_SESSION['erreur2']="";
			exit;
		}
	}

	if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
		if ($_POST['pass'] != $_POST['pass_confirm']){
			$_SESSION['erreur1']="<font color='FF0000'><b>Mots de passe pas identique</b></font>";
			include("loginb.php");
			$_SESSION['erreur1']="";
		}else{
			$memCont = new MemberController();
			try {
				$memCont->checkLoginAndMail($login, $mail);

				session_regenerate_id();
				$pass = md5(mysql_real_escape_string(htmlentities($_POST['pass'])));
				$memCont->createMember($login, $pass, $mail);
				$mem = $memCont->findByLogin($login);

				$_SESSION['member_id'] = $mem->getId();
				$_SESSION['login'] = $mem->getLogin();

				$req = ConnectionSingleton::connect()->prepare('insert into chat (id_membre,login,timestamp) values (:id,:login,:t);');
				$req->execute(array('id'=>$mem->getId(),'login'=>("<font color='#0F0'>+ ".$login."</font>"),"t"=>microtime(true)));

				$req = ConnectionSingleton::connect()->prepare('insert into activity (id_membre, date) values (:id,NOW());');
				$req->execute(array('id'=>$mem->getId()));

				$log->insertLog("Nouveau membre",$_SESSION['member_id'],"NULL",$_SESSION['login']);

				echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php');</script>";
			} catch (Exception $e) {
				$_SESSION['erreur2']= "<font color='FF0000'><b>Quelqu'un a d&eacute;j&agrave; ce login ou cet email...</b></font>";
				include("loginb.php");
				$_SESSION['erreur2']="";
			}
		}
	}else{
		$_SESSION['erreur3']= "<font color='FF0000'><b>Email non valide</b></font>";
		include("loginb.php");
		$_SESSION['erreur3']="";
	}
}else{
	$_SESSION['erreur3']= '<font color="FF0000"><b>Attention, champs vides</b></font>';
	include("loginb.php");
	$_SESSION['erreur3']="";
}?>
