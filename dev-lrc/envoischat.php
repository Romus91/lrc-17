<?php
require_once 'autoload.php';
include_once("verif.php");
include_once("pass.php");

$string = htmlspecialchars($_POST['mess'], ENT_QUOTES, 'UTF-8');
for ($i = 0,$cpt=0, $j = strlen($string); $i < $j; $i++,$cpt++)
{
	if ($string[$i] == " ")
	{
		$cpt=0;
	}else
	if ($cpt >30)
	{
		$string=substr($string,0,$i)." ".substr($string,$i,$j);
		$cpt=0;
	}
}

$sql="INSERT INTO chat (id_membre,message,login,timestamp) VALUES (:id,:message,:login,:t);";
$req = ConnectionSingleton::connect()->prepare($sql);
$req->execute(array("id"=>$_SESSION['member_id'],"message"=>$string,"login"=>$_SESSION['login'],"t"=>microtime(true)));

?>