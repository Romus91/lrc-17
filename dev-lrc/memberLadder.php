<?php
include_once 'verif.php';
include_once 'cdnHelper.php';
include_once 'pagination.php';
$data = mysql_fetch_assoc(mysql_query('select count(*) as nbMem from membre'));

$nbMembre = $data['nbMem'];
$perPage = 10;
$nbPage = ceil($nbMembre /$perPage);

if(isset($_GET['nb']) && $_GET['nb']>0 && $_GET['nb']<=$nbPage){
	$cPage = $_GET['nb'];
} else {
	$cPage = 1;
}?>
		<tr>
			<td colspan=4>
				<?php echo pagination($perPage,$cPage,'index.php?page=ladder&tab=members&nb=',$nbMembre);?>
			</td>
		</tr>
		<tr>
			<td align=center width="50">&nbsp;</td>
			<td align=center>MEMBRE</td>
			<td align=center>EXP</td>
			<td align=center width="50">NIVEAU</td>
		</tr>

		<?php
			$memArray = $memCont->fetchRange((($cPage-1)*$perPage), $perPage);
			$len=count($memArray);

			for($i=0;$i<$len;$i++):
				$rank = (($cPage-1)*10+$i+1);?>
			<tr class="ladder-row">
				<td bgcolor="<?php echo (($rank==1)?'ffc600':(($rank==2)?'aaaaaa':(($rank==3)?'ab7604':'222222')));?>" align=center>
					<font size=4><?php echo $rank;?></font>
				</td>
				<td class='color4' align="center"><?php echo $memArray[$i]->getLogin()?></td>
				<td class='color3' align="center"><font color='FFFF00' size=3><?php echo $memArray[$i]->getXp();?></font></td>
				<td class='color4' align="center"><font color='CC6600' size=4><?php echo $memArray[$i]->getLevel();?></font></td>
			</tr>
			<tr class="stats">
				<td align=center class='color4' style='background: #555 url(<?php echo convertToCDNUrl('pic/piercingammo.png')?>) no-repeat center center; background-size: contain;'>
					<div style="position: relative;width:100%;height:100%;margin:0;padding:0;">
						<img style='position: absolute; bottom:0; right:0;' src='<?php echo convertToCDNUrl('pic/red_badge.png')?>' height="25">
						<span style='position: absolute; bottom:7; right:7;'><?php echo $memArray[$i]->getPierceLevel()?></span>
					</div>
				</td>
				<td align="center" class='color4' colspan='2'>
				<?php $persoCont =  new PersoController();
				$persArray = $persoCont->fetchMembreAlive($memArray[$i]->getId());
				foreach ($persArray as $perso):?>
					<img src="ava/<?php echo $perso->getId();?>.png" height="50px"/>
				<?php endforeach;?>
				</td>
				<td align=center class='color4' style='background: #555 url(<?php echo convertToCDNUrl('pic/fragammo.png')?>) no-repeat center center; background-size: contain;'>
					<div style="position: relative;width:100%;height:100%;margin:0;padding:0;">
						<img style='position: absolute; bottom:0; right:0;' src='<?php echo convertToCDNUrl('pic/red_badge.png')?>' height="25">
						<span style='position: absolute; bottom:7; right:7;'><?php echo $memArray[$i]->getFragLevel()?></span>
					</div>
				</td>

			</tr>
		<?php endfor;?>
		<tr>
		<td colspan=4>
				<div class='pagination-wrapper'><ul class='pagination pages'><li><a href="#top">Haut de la page</a></li></ul></div>
			</td>
		</tr>