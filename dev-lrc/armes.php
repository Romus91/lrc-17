<?php  if(isset($_GET['arme'])) $act=$_GET['arme'];

	$perso = $persoController->fetchPerso($_GET['perso']);

include_once("level.php");?>
	<tr>
		<td>
			<table class='small' width='100%'><!-- On fait un grand formulaire avec toutes les armes, piège, vie que l'on peut achetter -->
				<?php 
					$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
					$query=mysql_query("SELECT * FROM armes WHERE id > 1");
					
					while ($arme=mysql_fetch_array($query)){
						for ($i=1;($i<=4);$i++){
							if ((strcmp($inventaire['arm'.$i],$arme['image'])) == 0){
								$trueornot=true;
								break;
							}else $trueornot=false;
						
						}
						if ($arme['lvlrequis'] <= $perso->getLevel()){
							if ($trueornot == true){
								echo "
								<tr >
									<td class='color4' align=center>
										<table class='small' width='320'>
											<tr>
												<td align=right class='small' colspan=2 >
													<table class='small' width='100%'>
														<tr>
															<td >".$arme['nom']."</td><td align=right><font color='BC6600'>".$arme['prix']." $</font></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td class='color1' width=40>DEGATS</td><td class='small' ><img src='image.php?img=viergec.png' width='".($arme['force']*10)."%' height='10'></td>
											</tr>
											<tr>
												<td class='color1' width=40>PRECISION</td><td class='small' ><img src='image.php?img=viergec.png' width='".$arme['precision']."%' height='10'></td>
											</tr>
											<tr>
												<td class='color1' width=40>CHARGEUR</td><td class='small' ><img src='image.php?img=viergec.png' width='".(($arme['munmax']/250)*100)."%' height='10'></td>
											</tr>
											<tr>
												<td class='color1' width=40>&nbsp;</td><td class='small' ><img src='image.php?img=viergec.png' width='0%' height='10'></td>
											</tr>
										</table>
									</td>
									<td align=center class='color2'>
										<img src='image.php?img=".$arme['image'].".png' width='80' height='80'><br>
										
									</td>
									<td align=center class='color4'>
										DANS L'INVENTAIRE
									</td>
								</tr>
								";	
							}else{
								echo "
								<tr >
									<td class='color4' align=center>
										<table class='small' width='320'>
											<tr>
												<td align=right class='small' colspan=2 >
													<table class='small' width='100%'>
														<tr>
															<td >".$arme['nom']."</td><td align=right><font color='BC6600'>".$arme['prix']." $</font></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td class='color1' width=40>DEGATS</td><td class='small' ><img src='image.php?img=viergec.png' width='".($arme['force']*10)."%' height='10'></td>
											</tr>
											<tr>
												<td class='color1' width=40>PRECISION</td><td class='small' ><img src='image.php?img=viergec.png' width='".$arme['precision']."%' height='10'></td>
											</tr>
											<tr>
												<td class='color1' width=40>CHARGEUR</td><td class='small' ><img src='image.php?img=viergec.png' width='".(($arme['munmax']/250)*100)."%' height='10'></td>
											</tr>
											<tr>
												<td class='color1' width=40>&nbsp;</td><td class='small' ><img src='image.php?img=viergec.png' width='0%' height='10'></td>
											</tr>
										</table>
									</td>
									<td align=center class='color3'>
										<img src='image.php?img=".$arme['image'].".png' width='80' height='80'><br>
										
									</td>
									<td align=center class='color4'>
										<table class='button'>
											<tr>
												<td id='button' width='100%'>
													<a href='achatarmeok.php?perso=".$perso->getId()."&acheterarme=".$arme['id']."' >ACHETER</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>

								";	
							}
						}else
						{
							echo "
								<tr height=90>
									<td bgcolor='111111' align=center colspan=4> 
										<font color='333333'>NIVEAU REQUIS : <font size=4>".($arme['lvlrequis'])."</font></font>
									</td>
								</tr>";
						}
						
					}
				?>

			</table>
			<table bgcolor=000000 width='100%'>
				<tr>
					<td colspan=3 align=center>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>

