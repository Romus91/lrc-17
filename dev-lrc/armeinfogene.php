

					<?php
						$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
						$arme=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inv['arm'.$i]."'"));
					?>
			<table class='small' width='100%' height='30'>
				<tr>
					<td align=center><font size=3>AMELIORATIONS</font></td>
				</tr>
			</table>
			<table class='button' width='100%'  >
				<tr>
					<td class='color3'>DEGATS</td><td class='small' width=60 align=right><font color="00ff00"> + <?php echo $inv['degat'.$i]*10;?>%</font></td>
					<td align=center class='color3'><a href='ajoutpt.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>&type=deg'><img src="image.php?img=plus.png" width='20px' height='20px'/></a></td>
				</tr>
				<tr>
					<td class='color4'>PRECISION</td><td class='small' width=60 align=right><font color="00ff00" > + <?php echo $inv['prec'.$i]*10;?>%</font></td>
					<td align=center  class='color4'><a href='ajoutpt.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>&type=pre'><img src="image.php?img=plus.png" width='20px' height='20px'/></a></td>
				</tr>
				<tr>
					<td class='color3'>CAPACITE CHARGEUR</td><td class='small' width=60 align=right><font color="00ff00" > + <?php echo $inv['capa'.$i]*10;?>%</font></td>
					<td align=center class='color3'><a href='ajoutpt.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>&type=cap'><img src="image.php?img=plus.png" width='20px' height='20px'/></a></td>
			<!--	<tr>
					<td class='color4' >&nbsp;</td><td class='small' width=35 align=right><font color="00ff00" > + <?php echo $inv['vie'.$i];?></font></td>
					<td align=center  class='color4'><img src="image.php?img=plus.png" width='20px' height='20px'/></td>
				</tr>-->
			</table>
			<table class='title2' width='100%'>
				<tr>
					<td align=center>
						POINTS DISPONIBLES
					</td>
				</tr>
				<tr align=center class='small'>
					<td>
						<font color="00ff00" size=3 ><?php echo $perso->getNbPtsAmDispo();?></font>
					</td>
				</tr>
			</table>
