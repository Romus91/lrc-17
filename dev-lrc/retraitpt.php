<?php session_start();
require_once'autoload.php';
include_once("pass.php");

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);
$t=htmlentities($_GET['type']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

if (isset($_GET['type']) && !empty($_GET['type']) &&($t == 'deg' || $t == 'pre' || $t == 'cap'))
{
	if ($t == 'deg') $type = "degat".$i;
	else
	if ($t == 'pre') $type = "prec".$i;
	else
	if ($t == 'cap') $type = "capa".$i;

	$inv = mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	$req = ConnectionSingleton::connect()->prepare('select * from armes;');
	$req->execute();
	$data = $req->fetchAll();

	$arme = $inv['arm'.$_GET['i']];
	$j=0;
	for(;$data[$j]['image']!=$arme;$j++);

	if ($inv[$type] > 0)
	{
		$munitions=0;
		if($t=="cap"){
			$munitions = "0 | ".($data[$j]['munmax']+($data[$j]['munmax']*(($inv[$type]-1)/10)));
			$perso->addArgent($inv['mun'.$i]*$data[$j]['prixballes']);
			$inv['mun'.$i]=0;
		}

		mysql_query("UPDATE inventaire SET ".$type." = ".($inv[$type]-1).", mun".$i." = ".$inv['mun'.$i]." WHERE id_perso = ".$perso->getId()."")
		or die (mysql_error());
		$perso->addPtsAmDispo(1);
		$persoCont->savePerso($perso);

		$response = array(
					"type"=>"success",
					"content"=>array(
							"message"=>"<font color = '00FF00'>Point d'am&eacute;lioration retir&eacute;</font>",
							"type"=>$_GET['type'],
							"ampct"=>'+ '.floor(($inv[$type]-1)*10).'%',
							"jauge"=>floor(($inv[$type]-1)*100/$data[$j][$t]).'%',
							"ptam"=>$perso->getNbPtsAmDispo(),
							"munitions"=>$munitions,
							"argent"=>$perso->getArgent()
		)
		);
	}else
	{
		$response = array("type"=>"success","content"=>array("message"=>"<font color = 'FF0000'>D&eacute;j&#224; au minimum</font>"));
	}
}else
{
	$response = array("type"=>"success","content"=>array("message"=>"<font color = 'FF0000'>Erreur type</font>"));
}

echo json_encode($response);