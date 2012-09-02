<?php
$persoController = new PersoController();
$perso = $persoController->fetchPerso($_GET['perso']);
$consoController = new ConsoController();


$_SESSION['erreur']=false;
if($perso->getLevelPercent()>=100):?>
<tr>
	<td colspan=4><table width='100%' class='small'>
			<tr>
				<td align="center"><p>Niveau suivant atteind !</p></td>
			</tr>
			<tr>
				<td class='title2' align=center>Vous gagnez <font color='00FF00'
					size=3> 2 </font> points d'amélioration...</td>
			</tr>
			<tr>
				<td align=center><font size="4">... Et un point de compétence !</font>
				</td>
			</tr>
		</table>
		<table width='100%' class='small'>
			<tr>
				<td width='50%' align=right class='title2'>Endurance :</td>
				<td width='20%' align=center><?php echo $perso->getEndurance();?></td>
				<td width='30%' class='title2'><a
					href="levelup.php?perso=<?php echo $perso->getId();?>&stat=0"> <img
						src="pic/plus.png" /> </a>
				</td>
			</tr>
			<tr>
				<td width='50%' align=right class='title2'>Dextérité :</td>
				<td width='20%' align=center><?php echo $perso->getDexterite();?></td>
				<td width='30%' class='title2'><a
					href="levelup.php?perso=<?php echo $perso->getId();?>&stat=1"> <img
						src="pic/plus.png" /> </a>
				</td>
			</tr>
			<tr>
				<td width='50%' align=right class='title2'>Esquive :</td>
				<td width='20%' align=center><?php echo $perso->getEsquive();?></td>
				<td width='30%' class='title2'><a
					href="levelup.php?perso=<?php echo $perso->getId();?>&stat=2"> <img
						src="pic/plus.png" /> </a>
				</td>
			</tr>
		</table></td>
</tr>
<?php endif;?>
<tr class='color1'>
	<td rowspan=2 valign=bottom><img
		src="image.php?img=<?php echo $perso->getAvatar()?>.JPG&h=197&l=<?php echo$perso->getLevel()?>" />
	</td>
	<td colspan=3 valign=bottom bgcolor=000000
		style="border: 1px solid #333333" width="100%">

		<table class='button' width='100%'>
			<tr>
				<td>
					<div class='jauge'>
						<img class='grid' src="pic/fond-jauge.png">
						<img class='barre' id="jaugevie" src='pic/jvert.png' width='<?php echo $perso->getVie();?>%'>
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
						<img class='grid' src="pic/fond-jauge.png">
						<img class='barre' id="jaugeeng" src='pic/jbleu.png' width='<?php echo $perso->getEnergyPercent();?>%'>
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
						<img class='grid' src="pic/fond-jauge.png">
						<img class='barre' src='pic/jjaune.png' width='<?php echo $perso->getLevelPercent();?>%'>
						<div class='lib'>EXP</div>
						<div class="texte">
							<?php echo $perso->getXp();?> | <?php echo floor($perso->getXpForNextLevel());?>
						</div>
					</div>
				</td>
			</tr>
		</table>
		<table class='button' width='100%'>
			<tr>
				<td align=center class='color1'>Endurance : <?php echo $perso->getEndurance();?>
				</td>
				<td align="center" class='color1'>Comfort : <?php echo $perso->getComfort()*2?>%</td>
			</tr>
			<tr>
				<td align=center class='color1'>Dextérité : <?php echo $perso->getDexterite();?>
				</td>
				<td align=center class='color1'>Precision : <?php echo $perso->getPrecision();?>%
				</td>
			</tr>
			<tr>
				<td align=center class='color1'>Esquive : <?php echo $perso->getEsquive();?>
				</td>
				<td align=center class='color1'>Taux Esquive : <?php echo $perso->getTauxEsquive();?>%
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan=2 align=center>
		<table bgcolor='111111' width='100%'>
			<tr>
				<td align=center><img src='image.php?img=crabemini.png&w=55'>
				</td>
				<td align=center><img src='image.php?img=zombiemini.png&w=55'>
				</td>
				<td align=center><img src='image.php?img=zombiefastmini.png&w=55'>
				</td>
				<td align=center><img src='image.php?img=zombiepoisonmini.png&w=55'>
				</td>
			</tr>
			<tr>
				<td align=center class='small'><?php echo $perso->getNb_crabe_kill();?>
				</td>

				<td align=center class='small'><?php echo $perso->getNb_zomb_kill();?>
				</td>

				<td align=center class='small'><?php echo $perso->getNb_zfast_kill();?>
				</td>

				<td align=center class='small'><?php echo $perso->getNb_zpois_kill();?>
				</td>
			</tr>
		</table>
	</td>
	<td align=center>
		<table class='hev'>
			<tr>
				<td align=center><font color='CC6600' size=6><?php  echo $perso->getNb_vague();?>
				</font><br>VAGUE</td>
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
	<td align=center class='arme'>
		<div align=center class='hev arme'
			perso='<?php echo $perso->getId()?>' arme='<?php echo $i?>'>
			<a
				href='<?php if ($inventaire['arm'.$i]) echo 'armeinfo.php?perso='.$perso->getId().'&i='.$i;else echo '#'?>'>
				<?php if ($inventaire['arm'.$i]) echo"<img src='image.php?img=".$inventaire['arm'.$i].".png&h=79'>";?>
			</a>
		</div>

		<div align=center class='munarme'>
		<?php echo $inventaire['mun'.$i]." | ".($arme['munmax']+($arme['munmax']*($inventaire['capa'.$i]/10)))?>
		</div>
	</td>

	<?php endfor;?>
</tr>
<tr id="armeinfo">
	<td colspan=4>
		<table class="color1" width="100%">
			<tr>
				<td align=center class='title2'><font id="nomarme" size=4>arme</font>
				</td>
			</tr>
			<tr valign=top>
				<td>
					<table class='small' width='100%'>
						<tr valign=top>
							<td width='100%' colspan=4>
								<table class='button' width='100%'>
									<tr>
										<td class='color3' width=60>DEGATS</td>
										<td class='small'><img id="jdeg" src='pic/jgris.png'
											width='0%' height='10'></td>
										<td class='small' width=100><img id="jamdeg"
											src='pic/jblanc.png' width='0%' height='10'></td>
									</tr>
									<tr>
										<td class='color5' width=60>PRECISION</td>
										<td class='small'><img id="jpre" src='pic/jgris.png'
											width='0%' height='10'></td>
										<td class='small' width=100><img id="jampre"
											src='pic/jblanc.png' width='0%' height='10'></td>
									</tr>
									<tr>
										<td class='color3' width=60>CHARGEUR</td>
										<td class='small'><img id="jcap" src='pic/jgris.png'
											width='0%' height='10'>
										</td>
										<td class='small' width=100><img id="jamcap"
											src='pic/jblanc.png' width='0%' height='10'></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td id='button' class="armeaction"><a
								href='armeinforecharg.php?perso=<?php echo $perso->getId();?>&i='>RECHARGER</a>
							</td>
							<td id='button' class="armeaction"><a
								href='armeinfovendre.php?perso=<?php echo $perso->getId();?>&i='>VENDRE</a>
							</td>
							<td id='button' class="armeaction"><a
								href='armeinfogene.php?perso=<?php echo $perso->getId();?>&i='>AMELIORATION</a>
							</td>
							<td id='button' class="armeaction" action="close"><a href='#'>FERMER</a>
							</td>
						</tr>
						<tr>
							<td id="armedetail" colspan=4 align=center bgcolor=333333></td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr id="piedbiche">
	<td colspan=4>
		<table class="color1" width="100%">
			<tr>
				<td align=center class='title2'><font size=4>Pied de biche</font>
				</td>
			</tr>
			<tr>
				<td>
					<table class='small' width='100%'>
						<tr>
							<td align=center>
								<p>INDISPONIBLE POUR CETTE ARME</p>
							</td>
						</tr>
						<tr>
							<td id='button' class="armeaction" action="close"><a
								href='javascript:void(0);'>FERMER</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan=2 align=center>PIEGES</td>
	<td colspan=2 align=center>CONSOMMABLES</td>
</tr>
<tr>
<?php
for ($i=1;$i<=2;$i++):
$piege=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image = '".$inventaire['pie'.$i]."'"));
if (!$piege['munmax'])
$piege['munmax']=0;?>
	<td align="center" class="piege">
		<div align=center class='hev piege'
			perso='<?php echo $perso->getId()?>' piege='<?php echo $i;?>'>
			<a
				href='<?php if ($inventaire['pie'.$i]) echo 'piegeinfo.php?perso='.$perso->getId().'&i='.$i;else echo '#'?>'>
				<?php if ($inventaire['pie'.$i]) echo"<img src='image.php?img=".$inventaire['pie'.$i].".png&h=79'>";?>
			</a>
		</div>
		<div align=center class='munpiege'>
		<?php echo $inventaire['munp'.$i]." | ".$piege['munmax']?>
		</div>
	</td>
	<?php endfor;
	for ($i=1;$i<=2;$i++):?>
	<td align="center">
		<div align=center class='hev conso'
			perso='<?php echo $perso->getId();?>' conso='<?php echo $i?>'>
			<?php if($inventaire['conso'.$i]) echo '<a href="useconso.php?perso='.$perso->getId().'&i='.$i.'"><img src="pic/'.$consoController->fetch($inventaire['conso'.$i])->getImage().'" width="114" height="79"></a>';?>
		</div>
		<div align="center">&nbsp;</div>
	</td>
	<?php endfor;?>
</tr>
<tr id="piegeinfo">
	<td colspan=4>
		<table class="color1" width="100%">
			<tr>
				<td align=center class='title2'><font id="nompiege" size=4>piege</font>
				</td>
			</tr>
			<tr valign=top>
				<td>
					<table class='small' width='100%'>
						<tr valign=top>
							<td width='100%' colspan=4>
								<table class='button' width='100%'>
									<tr>
										<td class='color3' width=60>DEGATS</td>
										<td class='small'><img id="pjdeg" src='pic/jgris.png'
											width='0%' height='10'></td>
									</tr>
									<tr>
										<td class='color5' width=60>PRECISION</td>
										<td class='small'><img id="pjpre" src='pic/jgris.png'
											width='0%' height='10'></td>
									</tr>
									<tr>
										<td class='color3' width=60>CHARGEUR</td>
										<td class='small'><img id="pjcap" src='pic/jgris.png'
											width='0%' height='10'>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td id='button' class="piegeaction"><a
								href='piegeinforecharg.php?perso=<?php echo $perso->getId();?>&i='>RECHARGER</a>
							</td>
							<td id='button' class="piegeaction"><a
								href='piegeinfovendre.php?perso=<?php echo $perso->getId();?>&i='>VENDRE</a>
							</td>
							<td id='button' class="piegeaction" action="close"><a
								href='javascript:void(0);'>FERMER</a>
							</td>
						</tr>
						<tr>
							<td id="piegedetail" colspan=4 align=center bgcolor=333333></td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
<div id="error"></div>
<script
	type="text/javascript" language="javascript" src="infop.js"></script>
