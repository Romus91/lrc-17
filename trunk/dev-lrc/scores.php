
<?php
include_once("verif.php");
include_once 'pagination.php';

$data=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as nbArticle FROM perso"));

//Affiche 30 logs et calcule le nombre de log par page
$nbArticle = $data['nbArticle'];
$perPage = 10;
$nbPage = ceil($nbArticle /$perPage);

// p = numéro de la page
$cPage=1;
if(isset($_GET['nb']) && $_GET['nb']>0 && $_GET['nb']<=$nbPage){
	$cPage = $_GET['nb'];
}?>
		<tr>
			<td colspan=7>
				<?php echo pagination($perPage,$cPage,'index.php?page=ladder&nb=',$nbArticle);?>
			</td>
		</tr>
		<tr>
			<td align=center>&nbsp;</td>
			<td align=center>&nbsp;</td>
			<td align=center>RIP</td>
			<td align=center>PERSONNAGE</td>
			<td align=center>MEMBRE</td>
			<td align=center>EXP</td>
			<td align=center>NIVEAU</td>
		</tr>
	<?php
	$persoCont =  new PersoController();
	$memCont = new MemberController();
	$persArray = $persoCont->fetchRange((($cPage-1)*$perPage), $perPage);

	for($i=0;$i<count($persArray);$i++):
		$rank = (($cPage-1)*10+$i+1);?>

	<tr class='ladder-row'>
		<td bgcolor="<?php echo (($rank==1)?'ffc600':(($rank==2)?'aaaaaa':(($rank==3)?'ab7604':'222222')));?>" align=center>
			<font size=4><?php echo $rank;?></font>
		</td>
		<?php if ($persArray[$i]->isDead()):?>
			<td align=center bgcolor='AA0000' width="30">
				<img src='<?php echo convertToCDNUrl('image.php?img='.$persArray[$i]->getAvatar().'.JPG&h=50');?>' height='50'>
			</td>
			<td class='color3' align=center width='20'>
				<img src='<?php echo convertToCDNUrl('image.php?img=mort.png');?>' width='20'>
			</td>
		<?php else:?>
			<td align=center bgcolor='999999' width="30">
				<img src='<?php echo convertToCDNUrl('image.php?img='.$persArray[$i]->getAvatar().'.JPG&h=50');?>' height='50'>
			</td>
			<td class='color3' align=center width='20'>&nbsp;</td>
		<?php endif;?>

		<td class='color4' align=center width='25%'><?php echo $persArray[$i]->getNom()?></td>
		<td class='color3' align=center width='25%'><?php echo $memCont->fetchMembre($persArray[$i]->getId_membre())->getLogin()?></td>
		<td class='color4' align=center width='20%'><font color='FFFF00' size=3><?php echo $persArray[$i]->getXp()?></font></td>
		<td class='color3' align=center width='10%'><font color='CC6600' size=4><?php echo $persArray[$i]->getLevel()?></font></td>
	</tr>
	<tr class='stats'>
		<td colspan=3 class='color3'>&nbsp;</td>
		<td class='color4' style='padding-left:3px;'>
			<div>Endurance : <?php echo $persArray[$i]->getEndurance()?></div>
			<div>Dexterite : <?php echo $persArray[$i]->getDexterite()?></div>
			<div>Esquive : <?php echo $persArray[$i]->getEsquive()?></div>
		</td>
		<td colspan=3 class='color3'>
		<?php foreach ($persArray[$i]->getInvArme() as $arm):?>
			<img src='<?php echo convertToCDNUrl('image.php?img='.$arm->getImage().'.png&h=40');?>' height='40'>
		<?php endforeach;?>
		</td>
	</tr>
	<?php endfor;?>
	<tr>
		<td colspan=7>
			<div class='pagination-wrapper'><ul class='pagination pages'><li><a href="#top">Haut de la page</a></li></ul></div>
		</td>
	</tr>
