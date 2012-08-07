<?php 
	if(isset($_GET['onglet'])&&$_GET['onglet']=='levelup'&&isset($_GET['perso'])){
		$perso=$persoController->fetchPerso($_GET['perso']);
		
		if($pourc<100){
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
		}
		if(isset($_GET['stat'])&&$pourc>=100){
		$pourc=100;
			$stat = (int) htmlentities($_GET['stat']);
			$valStat = 0;
			switch($stat){
				case 0 :
					$valStat = $perso->getEndurance();
				break;
				case 1 :
					$valStat = $perso->getDexterite();
				break;
				case 2 :
					$valStat = $perso->getEsquive();
				break;
			}
			if(($valStat+1)>ceil($perso->getLevel()/2)){
				$_SESSION['text']= "<font color='FF0000'><b>Impossible de monter cette carac. actuellement !</b></font>";
				$_SESSION['erreur']=true;
				echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&onglet=levelup&perso=".$perso->getId()."');</script>";
			}else{
				$_SESSION['erreur']=false;
				$perso->levelUp($_GET['stat']);
				$persoController->savePerso($perso);
				echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
			}
		}
	}else{
		echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
	}
?>
<tr class='color1'>
	<td colspan=4>
		<table class='button' width='100%'>
			<tr>
				<td width='5%' align=center class='color3'>VIE</td>
				<td class='small' width='70%'>
					<img src='viergev.png' width='<?php echo $perso->getVie();?>%' height='10'>
				</td>
				<td width='25%' align=right class='color3'><?php echo $perso->getVie();?> | 100</td>
			</tr>
		</table>
		<table class='button' width='100%'>
			<tr>
				<td width='5%' align=center class='color3'>NRG</td><td class='small' width='70%'>
				<img src='viergeb.png' width='<?php echo ($perso->getEnergie()/$perso->getMaxEnergie())*100;?>%' height='10'></td>
				<td width='25%' align=right class='color3'><?php echo ceil($perso->getEnergie());?> | <?php echo $perso->getMaxEnergie();?></td>
			</tr>
		</table>
		<table class='button' width='100%'>
			<tr>
				<td width='5%' align=center class='color3'>EXP</td><td class='small' width='70%'>
				<img src='viergej.png' width='<?php echo $pourc;?>%' height='10'></td>
				<td width='25%' align=right class='color3'><?php echo $perso->getXp();?> | <?php echo ($level[$perso->getLevel()+1]);?></td>
			</tr>
		</table>
	</td>
</tr>
</table>
<table width='100%'>
	<tr>
		<td width='50%' align=right>Endurance :</td>
		<td width='20%' align=center><?php echo $perso->getEndurance();?></td>
		<td width='30%'><a href="index.php?page=perso&onglet=levelup&perso=<?php echo $perso->getId();?>&stat=0"><img src="plus.png" width='20px' height='20px'/></a></td>
	</tr>
	<tr>
		<td width='50%' align=right>Dextérité :</td>
		<td width='20%' align=center><?php echo $perso->getDexterite();?></td>
		<td width='30%'><a href="index.php?page=perso&onglet=levelup&perso=<?php echo $perso->getId();?>&stat=1"><img src="plus.png" width='20px' height='20px'/></a></td>
	</tr>
	<tr>
		<td	width='50%' align=right>Esquive :</td>
		<td width='20%' align=center><?php echo $perso->getEsquive();?></td>
		<td width='30%'><a href="index.php?page=perso&onglet=levelup&perso=<?php echo $perso->getId();?>&stat=2"><img src="plus.png" width='20px' height='20px'/></a></td>
	</tr>
</table>
	