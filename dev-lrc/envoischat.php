<?php
include_once("verif.php");
include_once("pass.php");

			$string = $_GET['mess'];
			for ($i = 0,$cpt=0, $j = strlen($string); $i < $j; $i++,$cpt++) 
			{
				
				if ($string[$i] == " ")
				{
					$cpt=0;	
				}else
				if ($cpt > 30)
				{
					$string[$i]=" ";
					$cpt=0;
				}
			}

$query=mysql_query("INSERT INTO chat (message,login) VALUES ('".htmlentities($string)."','".$_SESSION['login']."')");
?>