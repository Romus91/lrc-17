<?php
require_once 'autoload.php';
include_once("verif.php");
include_once("pass.php");

$string = htmlentities($_GET['mess']);
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

$sql="INSERT INTO chat (message,login) VALUES (:message,:login);";
$req = ConnectionSingleton::connect()->prepare($sql);
$req->execute(array("message"=>$string,"login"=>$_SESSION['login']));

?>