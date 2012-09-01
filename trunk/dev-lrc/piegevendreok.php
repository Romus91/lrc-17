<?php
require_once 'autoload.php';
include_once("verif.php");
include_once("pass.php");

$i = (int) htmlentities($_GET['i']);
$p = (int) htmlentities($_GET['perso']);

$persoController = new PersoController();
$perso = $persoController->fetchPerso($p);

$piege = mysql_fetch_array(mysql_query('select * from pieges where image =(select pie'.$i.' from inventaire where id_perso = '.$perso->getId().');'));

$inv = mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId()));

for ($cpt=$i;$cpt<2;$cpt++)
{
	$sql="UPDATE inventaire SET pie".$cpt." = '".$inv['pie'.($cpt+1)]."', munp".$cpt." = '".$inv['munp'.($cpt+1)]."' WHERE id_perso = ".$perso->getId()."";
	mysql_query($sql) or die('Erreur SQL ! '.$sql.' '.mysql_error());
}
$sql='update inventaire set pie2=NULL, munp2=0 where id_perso = :id;';
$req = ConnectionSingleton::connect()->prepare($sql);
$req->execute(array('id'=>$perso->getId()));

$perso->addArgent(floor($piege['prix']/2));
$persoController->savePerso($perso);
echo json_encode(array('type'=>'success','content'=>array('money'=>$perso->getArgent(),'piege'=>$i)));

?>