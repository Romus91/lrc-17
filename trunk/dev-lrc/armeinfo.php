<center>
<table class="color1" width='295' height='100%'>

<?php  
	
	$i=$_GET['i'];
							include_once("pass.php");
							$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
							$arm=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inv['arm'.$i]."'"));
							$arme=$inv['arm'.$i];
							
							?>
	
	<tr>
		<td width=250 align=center class='title2'><font size=4><?php echo $arm['nom'];?></font></td>
	</tr>
	<tr height='270' valign=top>
		<td>
				<table class='small' width='100%' height="100%"><!-- On fait un grand formulaire avec toutes les armes, piège, vie que l'on peut achetter -->
					<?php 
					if ($arme <> 'piedbiche')
					{
					?>
					<tr valign=top>
						<td width='100%'>
							<table class='button' width='100%'>
								<tr>
									<td class='color3' width=40>DEGATS</td><td class='small' width='150'><img src='pic/vierge.png' width='<?php echo($arm['force']*10);?>%' height='10'></td><td class='small'><img src='pic/viergec.png' width='<?php echo $inv['degat'.$i]*10;?>%' height='10'></td>
								</tr>
								<tr>
									<td class='color5' width=40>PRECISION</td><td class='small' ><img src='pic/vierge.png' width='<?php echo $arm['precision'];?>%' height='10'></td><td class='small'><img src='pic/viergec.png' width='<?php echo $inv['prec'.$i]*10;?>%' height='10'></td>
								</tr>
								<tr>
									<td class='color3' width=40>CHARGEUR</td><td class='small' ><img src='pic/vierge.png' width='<?php echo(($arm['munmax']/250)*100);?>%' height='10'></td><td class='small'><img src='pic/viergec.png' width='<?php echo $inv['capa'.$i]*10;?>%' height='10'></td>
								</tr>
							<!--	<tr>
									<td class='color5' width=40>&nbsp;</td><td class='small' ><img src='pic/vierge.png' width='0%' height='10'></td><td class='small'><img src='pic/viergec.png' width='<?php echo $inv['vie'.$i]*10;?>%' height='10'></td>
								</tr>-->
							</table>							
							<table class='button' width='100%'>
								<tr>
									<td id='button' align=right>
										<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=arme&i=<?php echo $i;?>' >RECHARGER</a>
										
									</td>
									<td id='button' align=left>
										<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=arme&i=<?php echo $i;?>&part=vendre' >VENDRE</a>
									</td>
									
								</tr>
								<tr>
									<td id='button' align=right>
										<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=arme&i=<?php echo $_GET['i'];?>&part=gene'>AMELIORATION</a>
									</td>
									<td id='button' align=left>
										<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>'>FERMER</a>
									</td>
								</tr>
							</table>
						</td>		
					</tr >
					<?php 
						if (isset($_GET['part']))
						{
							if ($_GET['part'] == 'vendre')
								include ("armeinfovendre.php");
							
							if ($_GET['part'] == 'gene')
								include ("armeinfogene.php");
							
							if ($_GET['part'] == 'rech')
								include ("armeinforecharg.php");
						}else
							include ("armeinforecharg.php");
					?>
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
</center>