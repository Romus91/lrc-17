<?php  if(isset($_GET['arme'])) $act=$_GET['arme'];

	$perso = $persoController->fetchPerso($_GET['perso']);

include_once("level.php");?>
<tr>
	<td>
		<table class='small' width='100%'><!-- On fait un grand formulaire avec toutes les armes, piège, vie que l'on peut achetter -->
			<?php
			$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
			$query=mysql_query("SELECT * FROM armes WHERE id > 1");

			while ($arme=mysql_fetch_array($query)):
				for ($i=1;($i<=4);$i++){
					if ((strcmp($inventaire['arm'.$i],$arme['image'])) == 0){
						$trueornot=true;
						break;
					}else $trueornot=false;

				}
				if ($arme['lvlrequis'] <= $perso->getLevel()):?>
				<tr>
					<td class='color4' align=center>
						<table class='small' width='320'>
							<tr>
								<td class='small' colspan=2>
									<div style="width: 49%;display: inline-block;text-align: left;"><?php echo $arme['nom']?></div>
									<div style="width: 49%;display: inline-block;text-align: right;"><font color='BC6600'><?php echo $arme['prix']?> $</font></div>
								</td>
							</tr>
							<tr>
								<td class='color1' width=40>DEGATS</td><td class='small'><img src='pic/jblanc.png' width='<?php echo $arme['force']/10*100?>%' height='10'></td>
							</tr>
							<tr>
								<td class='color1' width=40>PRECISION</td><td class='small'><img src='pic/jblanc.png' width='<?php echo $arme['precision']?>%' height='10'></td>
							</tr>
							<tr>
								<td class='color1' width=40>CHARGEUR</td><td class='small'><img src='pic/jblanc.png' width='<?php echo $arme['munmax']/250*100?>%' height='10'></td>
							</tr>
							<tr>
								<td class='color1' width=40>&nbsp;</td><td class='small'><img src='pic/jblanc.png' width='0%' height='10'></td>
							</tr>
						</table>
					</td>
					<td align=center class='color3'>
						<img src='image.php?img=<?php echo $arme['image']?>.png&w=80'><br>

					</td>
					<?php if ($trueornot == true):?>
					<td align=center class='color4'>
						DANS L'INVENTAIRE
					</td>
					<?php else:?>
					<td align=center class='color4'>
						<table class='button'>
							<tr>
								<td id='button' width='100%'>
									<a href='achatarmeok.php?perso=<?php echo $perso->getId()?>&acheterarme=<?php echo $arme['id']?>'>ACHETER</a>
								</td>
							</tr>
						</table>
					</td>
					<?php endif;?>
				</tr>
				<?php else:?>
				<tr height=90>
					<td class='verouille' align=center colspan=4>
						<font size=6>VEROUILLE</font><br>NIVEAU REQUIS : <font size=4><?php echo $arme['lvlrequis']?></font>
					</td>
				</tr>
				<?php endif;
			endwhile;?>
		</table>
		<table bgcolor=000000 width='100%'>
			<tr>
				<td colspan=3 align=center>&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>

