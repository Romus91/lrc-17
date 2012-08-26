<?php
	require_once 'autoload.php';
	include_once("verif.php");
	include_once("pass.php");

	$i = (int) htmlentities($_GET['i']);
	$p = (int) htmlentities($_GET['perso']);

	$persoController = new PersoController();
	$log = new Log();
	$perso = $persoController->fetchPerso($p);

	$arme = mysql_fetch_array(mysql_query('select * from armes where image =(select arm'.$i.' from inventaire where id_perso = '.$perso->getId().');'));

	$inv = mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId()));

	$perso->addPtsAmDispo(($inv['degat'.$i] + $inv['prec'.$i] + $inv['capa'.$i]));

	for ($cpt=$i;$cpt<4;$cpt++)
	{
		$sql="UPDATE inventaire SET arm".$cpt." = '".$inv['arm'.($cpt+1)]."', mun".$cpt." = '".$inv['mun'.($cpt+1)]."', degat".$cpt." = '".$inv['degat'.($cpt+1)]."', prec".$cpt." = '".$inv['prec'.($cpt+1)]."' , capa".$cpt." = '".$inv['capa'.($cpt+1)]."' WHERE id_perso = ".$perso->getId()."";
		mysql_query($sql) or die('Erreur SQL ! '.$sql.' '.mysql_error());

	}
	$sql='update inventaire set arm4=NULL, mun4=0, degat4=0, prec4=0, capa4=0 where id_perso = :id;';
	$req = ConnectionSingleton::connect()->prepare($sql);
	$req->execute(array('id'=>$perso->getId()));

	$log->insertLog("Vendre arme",$_SESSION['member_id'],$perso->getId()," arm".$i." : ".$arme['image']);

	$perso->addArgent(floor($arme['prix']/2));
	$persoController->savePerso($perso);

	echo json_encode(array('type'=>'success','content'=>array('money'=>$perso->getArgent(),'arme'=>$i)));
?>
