<?php  if(isset($_GET['piege']))$act=$_GET['piege'];

include_once("level.php");?>
	<tr>
		<td>
				<table class='small' width='100%'>
					<?php 
						$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
						$query=mysql_query("SELECT * FROM pieges");
						
						while ($piege=mysql_fetch_array($query))
						{
							
							for ($i=1;($i<=2);$i++)
							{
								if ((strcmp($inventaire['pie'.$i],$piege['image'])) == 0)
								{
									$trueornot=true;
									break;
								}
								else
									$trueornot=false;
							
							}
							if ($piege['lvlrequis'] <= $perso->getLevel())
							{
								if ($trueornot == true)
								{
									
									echo "
									<tr >
										<td class='color4' align=center>
											<table class='small' width='320'>
												<tr>
													<td align=right class='small' colspan=2 >
														<table class='small' width='100%'>
															<tr>
																<td >".$piege['nom']."</td><td align=right><font color='BC6600'>".$piege['prix']." $</font></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td class='color1' width=40>DEGATS</td><td class='small' ><img src='image.php?img=viergec.png' width='".(($piege['force']/20)*100)."%' height='10'></td>
												</tr>
												<tr>
													<td class='color1' width=40>PRECISION</td><td class='small' ><img src='image.php?img=viergec.png' width='".$piege['precision']."%' height='10'></td>
												</tr>
												<tr>
													<td class='color1' width=40>CHARGEUR</td><td class='small' ><img src='image.php?img=viergec.png' width='".(($piege['munmax']/250)*100)."%' height='10'></td>
												</tr>
												<tr>
													<td class='color1' width=40>&nbsp;</td><td class='small' ><img src='image.php?img=viergec.png' width='0%' height='10'></td>
												</tr>
											</table>
										</td>
										<td align=center class='color2'>
											<img src='image.php?img=".$piege['image'].".png' width='80' height='80'><br>
											
										</td>
										<td align=center class='color4'>
											DANS L'INVENTAIRE
										</td>
									</tr>
									";	
								}else
								{
									echo "
									<tr >
										<td class='color4' align=center>
											<table class='small' width='320'>
												<tr>
													<td align=right class='small' colspan=2 >
														<table class='small' width='100%'>
															<tr>
																<td >".$piege['nom']."</td><td align=right><font color='BC6600'>".$piege['prix']." $</font></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td class='color1' width=40>DEGATS</td><td class='small' ><img src='image.php?img=viergec.png' width='".(($piege['force']/20)*100)."%' height='10'></td>
												</tr>
												<tr>
													<td class='color1' width=40>PRECISION</td><td class='small' ><img src='image.php?img=viergec.png' width='".$piege['precision']."%' height='10'></td>
												</tr>
												<tr>
													<td class='color1' width=40>CHARGEUR</td><td class='small' ><img src='image.php?img=viergec.png' width='".(($piege['munmax']/250)*100)."%' height='10'></td>
												</tr>
												<tr>
													<td class='color1' width=40>&nbsp;</td><td class='small' ><img src='image.php?img=viergec.png' width='0%' height='10'></td>
												</tr>
											</table>
										</td>
										<td align=center class='color3'>
											<img src='image.php?img=".$piege['image'].".png' width='80' height='80'><br>
											
										</td>
										<td align=center class='color4'>
											<table class='button'>
												<tr>
													<td id='button' width='100%'>
														<a href='achatpiegeok.php?perso=".$perso->getId()."&acheterpiege=".$piege['id']."' >ACHETER</a>
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
											<font color='333333'>NIVEAU REQUIS : <font size=4>".($piege['lvlrequis'])."</font></font>
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
			</form>	
		</td>
	</tr>
