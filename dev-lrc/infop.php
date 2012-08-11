<?php
	$persoController = new PersoController();
	$perso = $persoController->fetchPerso($_GET['perso']);
	$consoController = new ConsoController();


	$_SESSION['erreur']=false;
	if($pourc>=100)
	{
		$divLevel = '<div align="center"><p>Niveau suivant atteind :</p><a href="index.php?page=perso&onglet=levelup&perso='.$perso->getId().'"><h2>Level UP!</h2></a></div>';
		$pourc=100;
	}
	?>
		<tr class='color1'>
			<td colspan=4>
				<?php if($pourc>=100) echo $divLevel;?>
				<table class='button' width='100%'>
					<tr>
						<td width='5%' align=center class='color3'>VIE</td>
						<td class='small' width='70%'>
							<img src='pic/viergev.png' width='<?php echo $perso->getVie();?>%' height='10'>
						</td>
						<td width='25%' align=right class='color3'><?php echo $perso->getVie();?> | 100</td>
					</tr>
				</table>
				<table class='button' width='100%'>
					<tr>
						<td width='5%' align=center class='color3'>NRG</td><td class='small' width='70%'>
						<?php $pourcEn = ($perso->getEnergie()/$perso->getMaxEnergie())*100;?>
						<img src='pic/viergeb.png' width='<?php echo (($pourcEn>100)?100:$pourcEn);?>%' height='10'></td>
						<td width='25%' align=right class='color3'><?php echo floor($perso->getEnergie());?> | <?php echo $perso->getMaxEnergie();?></td>
					</tr>
				</table>
				<table class='button' width='100%'>
					<tr>
						<td width='5%' align=center class='color3'>EXP</td><td class='small' width='70%'>
						<img src='pic/viergej.png' width='<?php echo $pourc;?>%' height='10'></td>
						<td width='25%' align=right class='color3'><?php echo $perso->getXp();?> | <?php echo floor($perso->getXpForNextLevel());?></td>
					</tr>
				</table>
				<table class='button' width='100%'>
					<tr>
						<td align=center class='color1'>
							Endurance : <?php echo $perso->getEndurance();?>
						</td>
						<td align=center class='color1'>
							Dextérité : <?php echo $perso->getDexterite();?>
						</td>
						<td align=center class='color1'>
							Esquive : <?php echo $perso->getEsquive();?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=2 align=center >
				<table bgcolor='111111' width='100%' >
					<tr >
						<td align=center  >
							<img src='pic/crabemini.png' width=55>
						</td>
						<td align=center>
							<img src='pic/zombiemini.png' width=55>
						</td>
						<td align=center>
							<img src='pic/zombiefastmini.png' width=55>
						</td>
						<td align=center>
							<img src='pic/zombiepoisonmini.png' width=55>
						</td>
					</tr>
					<tr>
						<td align=center class='small'><?php echo $perso->getNb_crabe_kill();?></td>

						<td align=center class='small'><?php echo $perso->getNb_zomb_kill();?></td>

						<td align=center class='small'><?php echo $perso->getNb_zfast_kill();?></td>

						<td align=center class='small'><?php echo $perso->getNb_zpois_kill();?></td>
					</tr>
				</table>


			</td>
			<td colspan=2>
				<table class='title2' width='100%' >
					<tr>
						<td align=right>
							<table class='hev'>
								<tr>
									<td align=center>
											NIVEAU<br><font color='CC6600' size=6><?php  echo $perso->getLevel();?></font>
										</font>
									</td>
								</tr>
							</table>
						</td>
						<td align=center>
							<table class='hev'>
								<tr>
									<td align=center>
											VAGUE<br><font color='CC6600' size=6><?php  echo $perso->getNb_vague();?></font>
										</font>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=2 align=center>ARMES</td>
			<td  colspan='4' rowspan=9 align=center valign=top>

					<?php
						if (isset($_GET['type'])&&$_GET['type'] == "arme")
						{
							include("armeinfo.php");
						}else
						if (isset($_GET['type'])&&$_GET['type'] == "piege")
						{
							include("piegeinfo.php");
						}else
							echo "<img src='pic/".$perso->getAvatar().".JPG' width='295'>";

					?>

			</td>
		</tr>
		<tr>
			<td class='title2' colspan=2 align=center>
				<table class='title2'>
					<tr>
						<?php
							$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
							for ($i=1;$i<=2;$i++)
							{
								$arme=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inventaire['arm'.$i]."'"));
								if (!$arme['munmax'])
									$arme['munmax']=0;
								echo "
									<td align=center >
										<table class='hev'>
											<tr>
												<td align=center>";
												if ($inventaire['arm'.$i])
												{?>
													<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=arme&i=<?php echo $i;?>' >
												<?php echo"<img src='pic/".$inventaire['arm'.$i].".png' width='90'></a>";

												}
												echo"
												</td>
											</tr>
										</table>
										<table class='small' width='105'>
											<tr>
												<td align=center>
													".$inventaire['mun'.$i]." | ".($arme['munmax']+($arme['munmax']*($inventaire['capa'.$i]/10)))."
												</td>
											</tr>
										</table>
									</td>
								";
							}
						?>
					</tr>
				</table>
			</td>
		</tr>

		<tr width='25%'>
			<td  class='title2' colspan=2 align=center >
				<table class='title2'>
					<tr>
						<?php
							$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
							for ($i=3;$i<=4;$i++)
							{
								$arme=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inventaire['arm'.$i]."'"));
								if (!$arme['munmax'])
									$arme['munmax']=0;
								echo "
									<td align=center>
										<table class='hev'>
											<tr>
												<td align=center>";
												if ($inventaire['arm'.$i])
												{?>
													<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=arme&i=<?php echo $i;?>' >
												<?php echo"<img src='pic/".$inventaire['arm'.$i].".png' width='90'></a>";

												}
												echo"
												</td>
											</tr>
										</table>
										<table class='small' width='105'>
											<tr>
												<td align=center>
													".$inventaire['mun'.$i]." | ".($arme['munmax']+($arme['munmax']*($inventaire['capa'.$i]/10)))."
												</td>
											</tr>
										</table>
									</td>
								";
							}
						?>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=2 align=center>PIEGES</td>
		</tr>
		<tr>
			<td class='title2' colspan=2 align=center>
				<table class='title2'>
					<tr>
						<?php
							for ($i=1;$i<=2;$i++)
							{
								$piege=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image = '".$inventaire['pie'.$i]."'"));
								if (!$piege['munmax'])
									$piege['munmax']=0;
								echo "
									<td align=center>
										<table class='hev'>
											<tr>
												<td align=center>";
												if ($inventaire['pie'.$i])
												{
													?>
														<a href='index.php?page=perso&perso=<?php echo $perso->getId();?>&type=piege&i=<?php echo $i;?>' >

													<?php
													echo  "<img src='pic/".$inventaire['pie'.$i].".png' width='80'></a>";
												}
												echo"
												</td>
											</tr>
										</table>
										<table class='small' width='105'>
											<tr>
												<td align=center>
													".$inventaire['munp'.$i]." | ".$piege['munmax']."
												</td>
											</tr>
										</table>
									</td>
								";
							}
						?>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=2 align=center>CONSOMMABLES</td>
		</tr>
		<tr>
			<td class='title2' colspan=2 align=center>
				<table class='title2'>
					<tr>
						<?php
							for ($i=1;$i<=2;$i++)
							{
								echo "
									<td align=center>
										<table class='hev'>
											<tr>
												<td align=center>";
												if ($inventaire['conso'.$i])
												{
												?>
													<a href="useconso.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>">
													<?php echo "<img src='".$consoController->fetch($inventaire['conso'.$i])->getImage()."' width='120' height='85'></a>";
												}
												echo"
												</td>
											</tr>
										</table>
									</td>
								";
							}
						?>
					</tr>
				</table>
			</td>
		</tr>
	</table>