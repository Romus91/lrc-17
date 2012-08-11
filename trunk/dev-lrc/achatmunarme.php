<?php include_once ("verif.php");
	include_once ("pass.php");

	$persoController = new PersoController();
	$log = new Log();

	$idperso=(int) htmlentities($_GET['perso']);
	$mun=(int) htmlentities($_GET['mun']);
	$munarme=(int) htmlentities($_GET['munarme']);

	$perso=$persoController->fetchPerso($idperso);

	$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	$arme=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image ='".$inv["arm".$munarme]."'"));

	if ($mun > ($arme['munmax']+($arme['munmax']*($inv['capa'.$munarme]/10)))) $mun=$arme['munmax']+($arme['munmax']*($inv['capa'.$munarme]/10));

	$perso->setArgent($perso->getArgent()-($mun*$arme['prixballes']));
	$mun+=$inv['mun'.$munarme];
	$sql='UPDATE inventaire SET mun'.$munarme.' = "'.($mun).'" WHERE id_perso = '.$perso->getId().' ';
	mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

	$persoController->savePerso($perso);
	$log->insertLog("Achat mun arme",$_SESSION['member_id'],$perso->getId()," mun".$munarme." : ".$_GET['mun']."+".$inv['mun'.$munarme]."");

?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0; url='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=arme&i=<?php echo $munarme;?>'" />
</head>
</html>