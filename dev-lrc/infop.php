<?php
	$persoController = new PersoController();
	$perso = $persoController->fetchPerso($_GET['perso']);
	$consoController = new ConsoController();


	$_SESSION['erreur']=false;
	if($pourc>=100)
	{
		echo '<tr><td align="center" colspan=4><p>Niveau suivant atteind :</p><a href="index.php?page=perso&onglet=levelup&perso='.$perso->getId().'"><h2>Level UP!</h2></a></td></tr>';
		$pourc=100;
	}
	?>
		<tr class='color1'>
			<td rowspan=2 valign=bottom><img src="image.php?img=<?php echo $perso->getAvatar()?>.JPG&h=174&l=<?php echo$perso->getLevel()?>"/></td>
			<td colspan=3 valign=bottom bgcolor=000000 style="border: 1px solid #333333">

				<table class='button' width='100%'>
					<tr>
						<td width='20' align=center class='color3'>VIE</td>
						<td class='small'><img id="jaugevie" src='image.php?img=viergev.png&h=10&d=1' width='<?php echo $perso->getVie();?>%' height='10'></td>
						<td width='135' align=right class='color3'><span id="vie"><?php echo $perso->getVie();?></span> | 100</td>
					</tr>
					<tr>
						<td width='20' align=center class='color3'>NRG</td>
						<td class='small'>
							<?php $pourcEn = ($perso->getEnergie()/$perso->getMaxEnergie())*100;?>
							<img id="jaugeeng" src='image.php?img=viergeb.png&h=10&d=1' width='<?php echo (($pourcEn>100)?100:$pourcEn);?>%' height='10'>
						</td>
						<td width='135' align=right class='color3'><span id="eng"><?php echo floor($perso->getEnergie());?></span> | <?php echo $perso->getMaxEnergie();?></td>
					</tr>
					<tr>
						<td width='20' align=center class='color3'>EXP</td>
						<td class='small'><img src='image.php?img=viergej.png&h=10&d=1' width='<?php echo $pourc;?>%' height='10'></td>
						<td width='135' align=right class='color3'><?php echo $perso->getXp();?> | <?php echo floor($perso->getXpForNextLevel());?></td>
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
					<tr>
						<td align="center" class='color1'>Comfort : <?php echo $perso->getComfort()*2?>%</td>
						<td align=center class='color1'>
							Precision : <?php echo $perso->getPrecision();?>%
						</td>
						<td align=center class='color1'>
							Taux Esq. : <?php echo $perso->getTauxEsquive();?>%
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
							<img src='image.php?img=crabemini.png&w=55'>
						</td>
						<td align=center>
							<img src='image.php?img=zombiemini.png&w=55'>
						</td>
						<td align=center>
							<img src='image.php?img=zombiefastmini.png&w=55'>
						</td>
						<td align=center>
							<img src='image.php?img=zombiepoisonmini.png&w=55'>
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
			<td align=center>
				<table class='hev'>
					<tr>
						<td align=center>
								<font color='CC6600' size=6><?php  echo $perso->getNb_vague();?></font><br>VAGUE
						</td>
					</tr>
				</table>
			</td>
		<!-- 	<td align=center>
				<table class='hev'>
					<tr>
						<td align=center>
								VAGUE<br><font color='CC6600' size=6><?php  //echo $perso->getNb_vague();?></font>
							</font>
						</td>
					</tr>
				</table>
			</td>-->

		</tr>
		<tr>
			<td colspan=4 align=center>ARMES</td>
		</tr>
		<tr>
			<?php
				$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
				for ($i=1;$i<=4;$i++):
					$arme=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inventaire['arm'.$i]."'"));
					if (!$arme['munmax'])
						$arme['munmax']=0;?>
						<td align=center>
							<div align=center class='hev arme' perso='<?php echo $perso->getId()?>' arme='<?php echo $i?>'>
								<a href='<?php if ($inventaire['arm'.$i]) echo 'armeinfo.php?perso='.$perso->getId().'&i='.$i;else echo '#'?>'>
									<?php if ($inventaire['arm'.$i]) echo"<img src='image.php?img=".$inventaire['arm'.$i].".png&w=90'>";?>
								</a>
							</div>

							<div align=center class='munarme'>
								<?php echo $inventaire['mun'.$i]." | ".($arme['munmax']+($arme['munmax']*($inventaire['capa'.$i]/10)))?>
							</div>
						</td>

			<?php endfor;?>
		</tr>
		<tr id="armeinfo"><td colspan=4></td></tr>
		<tr>
			<td colspan=2 align=center>PIEGES</td>
			<td colspan=2 align=center>CONSOMMABLES</td>
		</tr>
		<tr>

						<?php
							for ($i=1;$i<=2;$i++)
							{
								$piege=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image = '".$inventaire['pie'.$i]."'"));
								if (!$piege['munmax'])
									$piege['munmax']=0;
								echo "
									<td align=center>
										<table style='background: none'>
											<tr>
												<td align=center class='hev piege' perso='".$perso->getId()."' piege='".$i."'>";
												if ($inventaire['pie'.$i])
												{
													?>
														<a href='piegeinfo.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>'>

													<?php
													echo  "<img src='image.php?img=".$inventaire['pie'.$i].".png&w=80'></a>";
												}
												echo"
												</td>
											</tr>
											<tr>
												<td align=center>
													".$inventaire['munp'.$i]." | ".$piege['munmax']."
												</td>
											</tr>
										</table>
									</td>
								";
							}
							for ($i=1;$i<=2;$i++)
							{
								echo "
									<td align=center>
										<table style='background: none'>
											<tr>
												<td align=center class='hev conso' perso='".$perso->getId()."' conso='".$i."'>";
												if ($inventaire['conso'.$i])
												{
												?>
													<a href="useconso.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>">
													<?php echo "<img src='image.php?img=".$consoController->fetch($inventaire['conso'.$i])->getImage()."&w=120' width='120' height='85'></a>";
												}
												echo"
												</td>
											</tr>
											<tr>
											<td>&nbsp;</td>
											</tr>
										</table>
									</td>
								";
							}
						?>

		</tr>
		<tr id="piegeinfo"><td colspan=4></td></tr>
	</table>
	<div id="error"></div>
	<script type="text/javascript" language="javascript" src="infop.js"></script>