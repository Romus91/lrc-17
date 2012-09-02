<?php  session_start();
require_once('pass.php');
require_once('autoload.php');

$_SESSION['erreur']= "";
$log = new Log();

if(isset($_POST['login']) && isset($_POST['pass']) && !empty($_POST['login']) && !empty($_POST['pass'])){
	$login=Member::purifyLogin($_POST['login']);
	$pass= md5(mysql_escape_string($_POST['pass']));

	$memCont = new MemberController();
	try {
		$member = $memCont->findByLogin($login);

		if($member->getPass()==$pass){
			session_regenerate_id();

			$_SESSION['login'] = $login;
			$_SESSION['member_id'] = $member->getId();

			$req = ConnectionSingleton::connect()->prepare('insert into chat (id_membre, login,timestamp) values (:id,:login,:t);');
			$req->execute(array('id'=>$member->getId(),'login'=>("<font color='#0F0'>+ ".$login."</font>"),"t"=>microtime(true)));

			$req = ConnectionSingleton::connect()->prepare('insert into activity (id_membre, date) values (:id,NOW());');
			$req->execute(array('id'=>$member->getId()));

			$log->insertLog("Connecté",$member->getId(),"NULL",$_SESSION['login']);

			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php');</script>";
		}else{
			throw new Exception();
		}
	}catch (Exception $e){
		$_SESSION['erreur'] = '<center><font color="#FF0000"><b>Mauvais login/mot de passe...</b></font></center>';
		include("loginb.php");
		$_SESSION['erreur'] = "";
	}
}else{
	include("loginb.php");
}?>