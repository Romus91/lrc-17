<?php
foreach($tabDead as $perso):?>
	<tr valign=bottom>
		<td width='100%' align=center valign=bottom colspan=3>
			<table class='color1' width='100%'>
				<tr>
					<td align=center>
						<font size =5><?php echo $perso->getNom()?></font>
					</td>
				</tr>
			</table>
		</td>
		<td rowspan='2' align=center background='<?php echo convertToCDNUrl('pic/'.$perso->getAvatar().'.JPG');?>' style="background-position:center top;background-size: cover;" width='185' height='135'>
			<img src='<?php echo convertToCDNUrl('pic/rouge.png');?>' width='185' height='135'>
		</td>
	</tr>
	<tr >
		<td align='center'>
			<table class='hev'>
				<tr>
					<td align=center>
						<b>A SURVECUS<br><font color='CC6600' size=6><?php echo $perso->getNb_vague()?></font><br>VAGUE</b>
					</td>
				</tr>
			</table>
		</td>
		<td width='200' align=center>
			<table class='hev'>
				<tr>
					<td align=center>
						<font size=6><b>EXP</b></font><br><font color=FFFF00 size=4><b><?php echo $perso->getXp()?></b></font>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table class='hev perso' id='".$perso->getId()."'>
				<tr align=center>
					<td>
						<table width='100%' style="margin-bottom:5px;">
							<tr>
								<td class='small' width='100%'>
									<img class='jaugevie' src='<?php echo convertToCDNUrl('pic/jvert.png');?>' width='<?php echo $perso->getVie()?>%' height='10'>
								</td>
							</tr>
						</table>
						<table width='100%' style="margin-bottom:5px;">
							<tr>
								<td class='small' width='100%'>
									<img class='jaugeeng' src='<?php echo convertToCDNUrl('pic/jbleu.png');?>' width='<?php echo $perso->getEnergyPercent()?>%' height='10'>
								</td>
							</tr>
						</table>
						<table width='100%'>
							<tr>
								<td class='small' width='100%'>
									<img src='<?php echo convertToCDNUrl('pic/jjaune.png');?>' width='<?php echo $perso->getLevelPercent()?>%' height='10'>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan=6 align=center bgcolor=BC6600></td>
	</tr>
	<?php endforeach;?>