<table class="color1" width="100%">
<?php
require_once 'autoload.php';

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

include_once("pass.php");
$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
$arm=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inv['arm'.$i]."'"));
$arme=$inv['arm'.$i];
?>
	<tr>
		<td align=center class='title2'><font size=4><?php echo $arm['nom'];?>
		</font></td>
	</tr>
	<tr valign=top>
		<td>
			<table class='small' width='100%'>
				<!-- On fait un grand formulaire avec toutes les armes, piège, vie que l'on peut achetter -->
			<?php
			if ($arme <> 'piedbiche')
			{
				?>
				<tr valign=top>
					<td width='100%' colspan=4>
						<table class='button' width='100%'>
							<tr>
								<td class='color3' width=60>DEGATS</td>
								<td class='small'><img src='image.php?img=vierge.png&h=10&d=1' width='<?php echo($arm['force']*10);?>%' height='10'></td>
								<td class='small' width=100><img id="jamdeg" src='image.php?img=viergec.png&h=10&d=1' width='<?php if($arm['deg']==0)echo 100;else echo $inv['degat'.$i]*100/$arm['deg'];?>%' height='10'></td>
							</tr>
							<tr>
								<td class='color5' width=60>PRECISION</td>
								<td class='small'><img src='image.php?img=vierge.png&h=10&d=1' width='<?php echo $arm['precision'];?>%' height='10'></td>
								<td class='small' width=100><img id="jampre" src='image.php?img=viergec.png&h=10&d=1' width='<?php if($arm['pre']==0)echo 100;else echo $inv['prec'.$i]*100/$arm['pre'];?>%' height='10'></td>
							</tr>
							<tr>
								<td class='color3' width=60>CHARGEUR</td>
								<td class='small'><img src='image.php?img=vierge.png&h=10&d=1' width='<?php echo(($arm['munmax']/250)*100);?>%' height='10'></td>
								<td class='small' width=100><img id="jamcap" src='image.php?img=viergec.png&h=10&d=1' width='<?php if($arm['cap']==0)echo 100;else echo $inv['capa'.$i]*100/$arm['cap'];?>%' height='10'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td id='button' class="armeaction">
						<a href='armeinforecharg.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>'>RECHARGER</a>
					</td>
					<td id='button' class="armeaction">
						<a href='armeinfovendre.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>'>VENDRE</a>
					</td>
					<td id='button' class="armeaction">
						<a href='armeinfogene.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>'>AMELIORATION</a>
					</td>
					<td id='button' class="armeaction" action="close">
						<a href='#'>FERMER</a>
					</td>
				</tr>
				<tr>
					<td id="armedetail" colspan=4 align=center bgcolor=333333>
					<?php include ("armeinforecharg.php"); ?>
					</td>
				</tr>
				<?php
			}else
			{	echo "
				<tr >
					<td align=center >
						INDISPONIBLE
					</td>
				</tr>";
			}
			?>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript" language="javascript" src="armeinfo.js"></script>