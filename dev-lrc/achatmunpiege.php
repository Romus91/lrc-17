<?php include_once ("verif.php");
	include_once ("pass.php");

	$persoController = new PersoController();
	$log = new Log();

	$idperso=(int) htmlentities($_GET['perso']);
	$i=(int) htmlentities($_GET['piege']);

	$perso=$persoController->fetchPerso($idperso);

	$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	$arme=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image ='".$inv["pie".$i]."'"));


	$capa = $munmax = $arme['munmax'];
	$mun = $inv['munp'.$i];
	$munachat = $munmax-$mun;
	$totalachat = $munachat*$arme['prixballes'];

	if ($totalachat > $perso->getArgent()){
		$munachat = floor($perso->getArgent()/$arme['prixballes']);
		$munmax = $mun+$munachat;
		$totalachat = $munachat*$arme['prixballes'];
	}

	$sql='UPDATE inventaire SET munp'.$i.' = "'.($munmax).'" WHERE id_perso = '.$perso->getId().' ';
	mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
	$perso->setArgent($perso->getArgent()-$totalachat);
	$persoController->savePerso($perso);
	$log->insertLog("Achat mun piege",$_SESSION['member_id'],$perso->getId()," munp".$i." : ".$munachat."+".$mun."");

	$response = array('type'=>'reloadsuccess','content'=>array('munp'=>$munmax,'capa'=>$capa,'money'=>$perso->getArgent(),'piege'=>$i));

	echo json_encode($response);
?>