
<table class="color1" width='295' height='100%'>

<?php  
	
	$i=$_GET['i'];
							include_once("pass.php");
							$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
							$arm=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image = '".$inv['pie'.$i]."'"));
							$piege=$inv['pie'.$i];
							
							###Attribution des points pour les armes###
							$prix=$arm['prixballes'];
								

							
							?>
	
	<tr>
		<td width=250 align=center class='title2'><font size=4><?php echo $arm['nom'];?></font></td>
	</tr>
	<tr height='270'>
		<td colspan=2 valign=top>
				<table class='small' width='100%' height="100%"><!-- On fait un grand formulaire avec toutes les armes, piège, vie que l'on peut acheter -->
					<tr valign=top>
						<td width='100%'>
							<table class='button' width='100%'>
								<tr>
									<td class='color3' width=40>DEGATS</td><td class='small' ><img src='vierge.png' width='<?php echo(($arm['force']/20)*100);?>%' height='10'><img src='viergec.png' width='0%' height='10'></td>
								</tr>
								<tr>
									<td class='color5' width=40>PRECISION</td><td class='small' ><img src='vierge.png' width='<?php echo $arm['precision'];?>%' height='10'></td>
								</tr>
								<tr>
									<td class='color3' width=40>CHARGEUR</td><td class='small' ><img src='vierge.png' width='<?php echo(($arm['munmax']/250)*100);?>%' height='10'></td>
								</tr>
								<!--<tr>
									<td class='color5' width=40>&nbsp;</td><td class='small' ><img src='vierge.png' width='0%' height='10'></td>
								</tr>-->
							</table>
							<table class='button' width='100%'>
								<tr>
									<td id='button' align=right>
										<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=piege&i=<?php echo $i;?>' >RECHARGER</a>
										
									</td>
									<td id='button' align=left>
										<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=piege&i=<?php echo $i;?>&part=vendre'>VENDRE</a>
									</td>
								<!--	<td id='button' align=center>
										<a href='piegeinfo.php?perso=<?php echo $perso->getId();?>&i=<?php echo $_GET['i'];?>&onglet=gene'>AMELIORATION</a>
									</td>-->
								</tr>
							</table>
						</td>
					</tr>
					<?php 
						if (isset($_GET['part']))
						{
							if ($_GET['part'] == 'vendre')
								include ("piegeinfovendre.php");
							
							if ($_GET['part'] == 'gene')
								include ("piegeinfogene.php");
							
							if ($_GET['part'] == 'rech')
								include ("piegeinforecharg.php");
								
						}else
							include ("piegeinforecharg.php");
							
					?>
				</table>
		</td>
	</tr>
</table>
</center>
</body>
</html>