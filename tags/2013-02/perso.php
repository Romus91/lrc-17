<?php
include_once ("verif.php");

$idMembre = $_SESSION['member_id'];
$idPerso = (int) htmlentities($_GET['perso']);
$perso=$persoController->fetchPerso($idPerso);

if($idMembre!=$perso->getId_membre()){
	echo '<script language="javascript" type="text/javascript">
				window.location.replace("deconnexion.php");
			</script>';
	exit;
}

include_once 'pass.php';

if ($perso->getVie()==0){
	echo '<script language="javascript" type="text/javascript">
				window.location.replace("index.php?page=citoyen");
			</script>';
}

if ($_SESSION['erreur'] == false)
{
	if ((!isset($_GET['onglet'])) OR ($_GET['onglet'] == 'infop'))
	$_SESSION['text']="INFOS GENERALE";
	else if (isset($_GET['onglet'])){
		if($_GET['onglet'] == 'achat'){
			if(isset($_GET['cat'])&&(($_GET['cat'] == 'armes') OR ($_GET['cat'] == 'pieges') OR ($_GET['cat'] == 'mun')))
			$_SESSION['text']="ARMURERIE";
			if(isset($_GET['cat'])&&$_GET['cat'] == 'vie')
			$_SESSION['text']="SOINS";
		}
		else if ($_GET['onglet'] == 'levelup') $_SESSION['text']="LEVEL UP";
		else if ($_GET['onglet']=='vague') $_SESSION['text']="VAGUE";
	}

}

function isSelectedMenu($name){
	return isset($_GET['onglet']) && $_GET['onglet'] == $name;
}
?>
<input type="hidden" id="idPerso" value="<?php echo $perso->getId();?>" />
<table class='small' align=center width='100%'>
	<tr>
		<td colspan=2>
			<table class='small' width='100%'>
				<tr>
					<td class='small'><font class="error" size=3> <?php echo $_SESSION['text'];?> </font>
					</td>
					<td class='small' align=right><font size=5> <span id='prix'><?php  echo $perso->getArgent();?> </span> <font color=1EB117>$</font> </font>
					</td>
				</tr>
			</table>
			<div id="menuperso">
				<ul>
					<li><a href="index.php?page=citoyen"><-</a></li>
					<li><a class="<?php echo ((!isset($_GET['onglet']))?'current':'');?>" href='index.php?page=perso&perso=<?php  echo $perso->getId();?>'><?php echo $perso->getNom();?></a></li>
					<li><a class="<?php echo ((isSelectedMenu('achat'))?'current':'');?>">ACHAT</a>
						<ul>
							<li><a href="index.php?page=perso&onglet=achat&cat=armes&perso=<?php echo $perso->getId();?>">ARMES</a></li>
							<li><a href="index.php?page=perso&onglet=achat&cat=vie&perso=<?php echo $perso->getId();?>">CONSO</a></li>
						</ul>
					</li>
					<li><a class="<?php echo ((isSelectedMenu('vague'))?'current':'');?>">VAGUE</a>
						<ul>
							<li><a href="index.php?page=perso&onglet=vague&perso=<?php echo $perso->getId();?>">GO !</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</td>
	</tr>
	<?php if($perso->getLevelPercent()>=100):?>
	<tr>
		<td colspan=2><table width='100%' class='small'>
				<tr>
					<td align="center"><p>Niveau suivant atteind !</p></td>
				</tr>
				<tr>
					<td class='title2' align=center>Vous gagnez <font color='00FF00' size=3> 2 </font> points d'amélioration...</td>
				</tr>
				<tr>
					<td align=center><font size="4">... Et un point de compétence !</font>
					</td>
				</tr>
			</table>
			<table width='100%' class='small'>
				<tr>
					<td width='50%' align=right class='title2'>Endurance :</td>
					<td width='20%' align=center><?php echo $perso->getEndurance();?></td>
					<td width='30%' class='title2'><a href="levelup.php?perso=<?php echo $perso->getId();?>&stat=0"><img src="<?php echo convertToCDNUrl('pic/plus.png');?>" /> </a>
					</td>
				</tr>
				<tr>
					<td width='50%' align=right class='title2'>Dextérité :</td>
					<td width='20%' align=center><?php echo $perso->getDexterite();?></td>
					<td width='30%' class='title2'><a href="levelup.php?perso=<?php echo $perso->getId();?>&stat=1"> <img src="<?php echo convertToCDNUrl('pic/plus.png');?>" /> </a>
					</td>
				</tr>
				<tr>
					<td width='50%' align=right class='title2'>Esquive :</td>
					<td width='20%' align=center><?php echo $perso->getEsquive();?></td>
					<td width='30%' class='title2'><a href="levelup.php?perso=<?php echo $perso->getId();?>&stat=2"> <img src="<?php echo convertToCDNUrl('pic/plus.png');?>" /> </a>
					</td>
				</tr>
			</table></td>
	</tr>
	<?php endif;?>
	<tr>
		<td valign='top'><img src="ava/<?php echo $perso->getId()?>.png?<?php echo $perso->getLevel();?>" height="135" /></td>
		<td class='color1' valign=bottom bgcolor=000000 style="border: 1px solid #333333" width="100%">

			<table id="jaugeperso" width='100%' style="background:#111">
				<tr>
					<td>
						<div class='jauge'>
							<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>"> <img class='barre' id="jaugevie" src='<?php echo convertToCDNUrl('pic/jvert.png');?>' width='<?php echo $perso->getVie();?>%'>
							<div class='lib'>VIE</div>
							<div class="texte">
								<span id="vie"><?php echo $perso->getVie();?> </span> | 100
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class='jauge'>
							<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>"> <img class='barre' id="jaugeeng" src='<?php echo convertToCDNUrl('pic/jbleu.png');?>'
								width='<?php echo $perso->getEnergyPercent();?>%'
							>
							<div class='lib'>NRG</div>
							<div class="texte">
								<span id="eng"><?php echo floor($perso->getEnergie());?> </span> | <span id="maxeng"><?php echo $perso->getMaxEnergie();?> </span>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class='jauge'>
							<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>">
							<img class='barre' src='<?php echo convertToCDNUrl('pic/jjaune.png');?>' id="jaugeexp" width='<?php echo $perso->getLevelPercent();?>%'>
							<div class='lib'>EXP</div>
							<div class="texte">
							<span id="exp"><?php echo $perso->getXp();?></span>
								|
								<?php echo floor($perso->getXpForNextLevel());?>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class='jauge'>
							<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>"> <img class='barre' id="jaugepsn" src='<?php echo convertToCDNUrl('pic/jvert.png');?>'
								width='<?php echo $perso->getPoisonPercent();?>%'
							>
							<div class='lib'>PSN</div>
							<div class="texte">
								<span id="psn"><?php echo $perso->getJaugePoison();?> </span> | <?php echo Perso::MAX_JAUGE_POISON;?>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<table width='100%' style="background:#111">
				<tr>
					<td align=center class='color1'>Endurance : <?php echo $perso->getEndurance();?></td>
					<td align=center class='color1'>Dextérité : <?php echo $perso->getDexterite();?></td>
					<td align=center class='color1'>Esquive : <?php echo $perso->getEsquive();?></td>
				</tr>
				<tr>
					<td align="center" class='color1'>Regen NRG : <?php echo $perso->getAbsoluteRegen();?> / min</td>
					<td align=center class='color1'>Precision : <?php if($perso->getEnergyPercent()>=5): echo $perso->getPrecision(); else:?><font color="red"><?php echo $perso->getPrecision();?></font><?php endif;?> %</td>
					<td align=center class='color1'>Taux Esquive : <?php if($perso->getEnergyPercent()>=5): echo $perso->getTauxEsquive(); else:?><font color="red"><?php echo $perso->getTauxEsquive();?></font><?php endif;?> %</td>
				</tr>
				<tr>
					<td align="center" class="color1" colspan=3>Points d'amélioration disponibles : <font id="ptam" color="00ff00"><?php echo $perso->getNbPtsAmDispo();?>
					</font>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript" language="javascript" src="perso.js?<?php echo date("dmYH");?>"></script>
<link rel="stylesheet" type="text/css" href="css/perso.css?<?php echo date("dmYH");?>" />
<?php
if ((!isset($_GET['onglet'])) OR ($_GET['onglet'] == 'infop')) include ("infop.php");
if (isset($_GET['onglet'])){
	if($_GET['onglet'] == 'achat') include ("achat.php");
	else if($_GET['onglet']=='vague') include ('wave.php');
}
?>
