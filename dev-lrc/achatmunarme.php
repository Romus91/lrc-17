<?php include_once ("verif.php");
	include_once ("pass.php");

	$persoController = new PersoController();
	$log = new Log();

	$idperso=(int) htmlentities($_GET['perso']);
	$i=(int) htmlentities($_GET['arme']);

	$perso=$persoController->fetchPerso($idperso);

	$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	$arme=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image ='".$inv["arm".$i]."'"));


	$capa = $munmax = $arme['munmax']+($arme['munmax']*($inv['capa'.$i]/10));
	$mun = $inv['mun'.$i];
	$munachat = $munmax-$mun;
	$totalachat = $munachat*$arme['prixballes'];

	if ($totalachat > $perso->getArgent()){
		$munachat = floor($perso->getArgent()/$arme['prixballes']);
		$munmax = $mun+$munachat;
		$totalachat = $munachat*$arme['prixballes'];
	}

	$sql='UPDATE inventaire SET mun'.$i.' = "'.($munmax).'" WHERE id_perso = '.$perso->getId().' ';
	mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
	$perso->setArgent($perso->getArgent()-$totalachat);
	$persoController->savePerso($perso);
	$log->insertLog("Achat mun arme",$_SESSION['member_id'],$perso->getId()," mun".$i." : ".$munachat."+".$mun."");

	$response = array('type'=>'reloadsuccess','content'=>array('mun'=>$munmax,'capa'=>$capa,'money'=>$perso->getArgent(),'arme'=>$i));

	echo json_encode($response);
?>