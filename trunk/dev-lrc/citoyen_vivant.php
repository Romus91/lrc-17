<?php
$levels = array(1,3,10,20,35);
$i=0;
for(;$i<count($tabPersos);$i++):
	$perso=$tabPersos[$i];
	$perso->regenEnergie()->regenVie();
	$persoController->savePerso($perso);?>
	<tr valign=bottom>
		<td width='100%' align=center valign=bottom colspan=2>
			<table class='color1' width='100%'>
				<tr>
					<td align=center>
						<font size =4><?php echo $perso->getNom()?></font>
					</td>
				</tr>
			</table>
			<table class='button' width='100%'>
				<tr>
					<td id='button' align=center>
					<?php if($perso->getVie() > 0 ):?>
						<a href='index.php?page=perso&perso=<?php echo $perso->getId()?>'>GESTION</a>
					<?php else:?>
						<a href='index.php?page=citoyensuppok&perso=<?php echo $perso->getId()?>'>ENTERRER</a>
					<?php endif;?>
					</td>
				</tr>
			</table>
		</td>
		<td rowspan='2' align=center background='<?php echo convertToCDNUrl('pic/'.$perso->getAvatar().'.JPG');?>' width='130' style='background-size:cover;'>
			<?php if ($perso->getVie() == 0):?>
				<img src='<?php echo convertToCDNUrl('pic/rouge.png');?>' width='185' height='150'>
			<?php else:?>
				<a href='index.php?page=perso&perso=<?php echo $perso->getId()?>'><img src='<?php echo convertToCDNUrl('pic/blanc.png');?>' width='185' height='140'></a>
			<?php endif;?>
		</td>
	</tr>
	<tr >
		<td width="90" align="center">
			<table class='hev'>
				<tr>
					<td align=center>NIVEAU<br><font color='CC6600' size=6><?php echo $perso->getLevel()?></font></td>
				</tr>
			</table>
		</td>
		<td width="100%">
			<table class='button perso' width='100%' id="<?php echo $perso->getId()?>">
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
								<span id="psn"><?php echo $perso->getJaugePoison();?> </span> | 30
							</div>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan=3 align=center bgcolor=BC6600></td>
	</tr>
	<?php endfor;
	for(;$i<count($levels);$i++):?>

	<tr>
		<td class="verouilleh" colspan=6 width=550 height=140 align=center valign=middle>
			<?php if($mem->getLevel()<$levels[$i]):?>
			<font size=7>VERROUILLE</font><br><font size=3>NIVEAU REQUIS : <?php echo $levels[$i];?></font>
			<?php else:?>
			<a href="index.php?page=citoyencreer" style="text-align: center;display: block;width: 100%;height: 100%;vertical-align: middle;padding: 35px 0;"><img src='<?php echo convertToCDNUrl('pic/plus-orange.png')?>' height=70></a>
			<?php endif;?>
		</td>
	</tr>
	<tr>
		<td colspan=6 align=center bgcolor=BC6600></td>
	</tr>

	<?php endfor;?>
	<script type="text/javascript" language="javascript" src="citoyen.js?<?php echo date("dmYH");?>"></script>