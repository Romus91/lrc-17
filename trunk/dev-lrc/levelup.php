<?php
require_once 'autoload.php';
if(isset($_GET['onglet'])&&$_GET['onglet']=='levelup'&&isset($_GET['perso'])){
	$perso=$persoController->fetchPerso((int)htmlentities($_GET['perso']));
	$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));

	if($pourc<100){
		echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
		exit;
	}
	if(isset($_GET['stat'])&&$pourc>=100){

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
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&onglet=levelup&perso=".$perso->getId()."');</script>";
			exit;
		}else{
			$_SESSION['erreur']=false;
			$perso->levelUp($stat);
			$persoController->savePerso($perso);
			$log=new Log();
			$log->insertLog("Level up",$_SESSION['member_id'],$perso->getId(),"+1 ".$statChosen);
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
			exit;
		}
	}
}else{
	echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
	exit;
}
?>
<table width='100%' class='small'>
	<tr>
		<td class='title2' align=center><font color='00FF00' size=3> 2 </font>
			points d'am�lioration gagn� !</td>
	</tr>
</table>
<table width='100%' class='small'>
	<tr>
		<td colspan=3 align=center><font size="4">Une nouvelle comp�tence !</font>
		</td>
	</tr>
	<tr>
		<td width='50%' align=right class='title2'>Endurance :</td>
		<td width='20%' align=center><?php echo $perso->getEndurance();?></td>
		<td width='30%' class='title2'><a
			href="index.php?page=perso&onglet=levelup&perso=<?php echo $perso->getId();?>&stat=0"><img
				src="pic/plus.png" /> </a></td>
	</tr>
	<tr>
		<td width='50%' align=right class='title2'>Dext�rit� :</td>
		<td width='20%' align=center><?php echo $perso->getDexterite();?></td>
		<td width='30%' class='title2'><a
			href="index.php?page=perso&onglet=levelup&perso=<?php echo $perso->getId();?>&stat=1"><img
				src="pic/plus.png" /> </a></td>
	</tr>
	<tr>
		<td width='50%' align=right class='title2'>Esquive :</td>
		<td width='20%' align=center><?php echo $perso->getEsquive();?></td>
		<td width='30%' class='title2'><a
			href="index.php?page=perso&onglet=levelup&perso=<?php echo $perso->getId();?>&stat=2"><img
				src="pic/plus.png" /> </a></td>
	</tr>
</table>
