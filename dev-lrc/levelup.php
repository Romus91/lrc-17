<?php
require_once 'autoload.php';
require_once 'pass.php';
require_once 'verif.php';
require_once 'image.php';

if(isset($_GET['perso'])){
	$persoController = new PersoController();
	$perso=$persoController->fetchPerso((int)htmlentities($_GET['perso']));
	$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
	if(isset($_GET['stat'])&&$perso->getLevelPercent()>=100){

		$stat = (int) htmlentities($_GET['stat']);
		$valStat = 0;

		switch($stat){
			case 0 :
				$valStat = $perso->getEndurance();
				$statChosen = 'endu';
				break;
			case 1 :
				$valStat = $perso->getDexterite();
				$statChosen = 'dext';
				break;
			case 2 :
				$valStat = $perso->getEsquive();
				$statChosen = 'esq';
				break;
		}
		if(($valStat+1)>ceil($perso->getLevel()/2)){
			$_SESSION['text']= "<font color='FF0000'><b>Impossible de monter cette carac. actuellement !</b></font>";
			$_SESSION['erreur']=true;
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
			exit;
		}else{
			$_SESSION['erreur']=false;
			$perso->levelUp($stat);
			$persoController->savePerso($perso);
			imagepng(genImg($perso->getAvatar().'.JPG',176,0,$perso->getLevel(),0),'ava/'.$perso->getId().'.png');
			$log=new Log();
			$log->insertLog("Level up",$_SESSION['member_id'],$perso->getId(),"+1 ".$statChosen);
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
			exit;
		}
	}else{
		echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
		exit;
	}
}else{
	echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php');</script>";
	exit;
}
?>
