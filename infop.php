<?php
$consoController = new ConsoController();


$_SESSION['erreur']=false;?>
<table class='small' align=center width='100%'>
<tr><td colspan=4 align=center>TABLEAU DE CHASSE</td><td colspan=2 align=center>CONSOMMABLES</td></tr>
<tr>
	<td class="hev" align=center><font color='CC6600' size=6><?php  echo $perso->getNb_vague();?></font><br>VAGUES</td>
	<td colspan=3 align=center>
		<table id="palmares">
			<tr>

				<td><img src='<?php echo convertToCDNUrl('image.php?img=crabemini.png&w=50');?>'></td>
				<td><img src='<?php echo convertToCDNUrl('image.php?img=zombiemini.png&w=50');?>'></td>
				<td><img src='<?php echo convertToCDNUrl('image.php?img=zombiefastmini.png&w=50');?>'></td>
				<td><img src='<?php echo convertToCDNUrl('image.php?img=zombiepoisonmini.png&w=50');?>'></td>
			</tr>
			<tr>
				<td class='small'><?php echo $perso->getNb_crabe_kill();?></td>
				<td class='small'><?php echo $perso->getNb_zomb_kill();?></td>
				<td class='small'><?php echo $perso->getNb_zfast_kill();?></td>
				<td class='small'><?php echo $perso->getNb_zpois_kill();?></td>
			</tr>
		</table>
	</td>
	<?php
	$conso = $perso->getInvConso();
	for ($i=0;$i<2;$i++):?>
		<td align="center">
			<div align=center class='hev conso'>
				<?php if($conso[$i]!=null):
					$pack = $consoController->fetch($conso[$i]);?>
					<a href="useconso.php?perso=<?php echo $perso->getId();?>&pack=<?php echo $pack->getId();?>"><img src="<?php echo convertToCDNUrl('pic/'.$pack->getImage());?>" width="91" height="63"></a>
				<?php endif;?>
			</div>
		</td>
	<?php endfor;?>
</tr>
<tr>
	<td colspan=6 align=center>ARMES</td>
</tr>
<tr>
<?php
$armes = $perso->getInvArme();
$j=0;
do{?>
	<td align=center class='arme'>
		<div align=center class='hev arme' perso='<?php echo $perso->getId()?>' arme='<?php if (isset($armes[$j])) echo $armes[$j]->getId()?>'>
		<?php if(isset($armes[$j])):?>
			<a href='armeinfo.php?perso=<?php echo $perso->getId()?>&id=<?php echo $armes[$j]->getId()?>'>
				<img src='<?php echo convertToCDNUrl('image.php?img='.$armes[$j]->getImage().'.png&h=63');?>'>
			</a>
		<?php else:?>
			<a href='javascript:void(0);'>&nbsp;</a>
		<?php endif;?>
		</div>
		<div align=center class='munarme'>
		<?php if (isset($armes[$j])) echo $armes[$j]->getMunitions()." | ".$armes[$j]->getCapacity();else echo '0 | 0';?>
		</div>
	</td>
<?php $j++;}while($j<Perso::MAX_WEAP)?>
</tr>
<tr id="armeinfo">
	<td colspan=6>
		<table class="color1" width="100%">
			<tr align="center">
				<td class="armeaction move-left" width="60px"><a href="move-weapon-left.php?perso=<?php echo $perso->getId();?>"><img src='<?php echo convertToCDNUrl('pic/arrow-left.png');?>'></a></td>
				<td class="armeaction sell" width="60px"><a href='armeinfovendre.php?perso=<?php echo $perso->getId();?>&id='><img src='<?php echo convertToCDNUrl('pic/money_dollar.png');?>'></a></td>
				<td><font id="nomarme" size=4>arme</font></td>
				<td class="armeaction" width="60px"><a href='javascript:hideArmeinfo(true);'><img src='<?php echo convertToCDNUrl('pic/close-armeinfo.png');?>'></a></td>
				<td class="armeaction move-right" width="60px"><a href="move-weapon-right.php?perso=<?php echo $perso->getId();?>"><img src='<?php echo convertToCDNUrl('pic/arrow-right.png');?>'></a></td>
			</tr>
			<tr valign=top>
				<td colspan=5>
					<table class='small' width='100%'>
						<tr valign=top>
							<td width='100%' colspan=4>
								<table class='button' width='100%'>
									<tr>
										<td class='color3' width=60>DEGATS</td>
										<td class='small' width="100%">
											<div class="jauge">
												<img class="barre" id="jdeg" src='<?php echo convertToCDNUrl('pic/jgris.png');?>' width='0%'>
												<img class="grid" id="jamdeg" src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='0%'>
												<div class='lib' id="libdeg">0</div>
												<div class="texte" id="tdeg">0/0</div>
											</div>
										</td>
										<td align=center class='color3 plusam'><a href='ajoutpt.php?perso=<?php echo $perso->getId();?>&type=deg&id='><img src="<?php echo convertToCDNUrl('pic/plus.png');?>"/></a></td>
										<td align=center class='color3 moinsam'><a href='retraitpt.php?perso=<?php echo $perso->getId();?>&type=deg&id='><img src="<?php echo convertToCDNUrl('pic/minus.png');?>"/></a></td>
									</tr>
									<tr>
										<td class='color5' width=60>PRECISION</td>
										<td class='small' width="100%">
											<div class="jauge">
												<img class="barre" id="jpre" src='<?php echo convertToCDNUrl('pic/jgris.png');?>' width='0%'>
												<img class="grid" id="jampre" src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='0%'>
												<div class='lib' id="libpre">0</div>
												<div class="texte" id="tpre">0/0</div>
											</div>
										</td>
										<td align=center class='color5 plusam'><a href='ajoutpt.php?perso=<?php echo $perso->getId();?>&type=pre&id='><img src="<?php echo convertToCDNUrl('pic/plus.png');?>"/></a></td>
										<td align=center class='color5 moinsam'><a href='retraitpt.php?perso=<?php echo $perso->getId();?>&type=pre&id='><img src="<?php echo convertToCDNUrl('pic/minus.png');?>"/></a></td>
									</tr>
									<tr>
										<td class='color3' width=60>CHARGEUR</td>
										<td class='small' width="100%">
											<div class="jauge">
												<img class="barre" id="jcap" src='<?php echo convertToCDNUrl('pic/jgris.png');?>' width='0%'>
												<img class="grid" id="jamcap" src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='0%'>
												<div class='lib' id="libcap">0</div>
												<div class="texte" id="tcap">0/0</div>
											</div>
										</td>
										<td align=center class='color3 plusam'><a href='ajoutpt.php?perso=<?php echo $perso->getId();?>&type=cap&id='><img src="<?php echo convertToCDNUrl('pic/plus.png');?>"/></a></td>
										<td align=center class='color3 moinsam'><a href='retraitpt.php?perso=<?php echo $perso->getId();?>&type=cap&id='><img src="<?php echo convertToCDNUrl('pic/minus.png');?>"/></a></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td id='button' class="armeaction reload">
								<a href='achatmunarme.php?perso=<?php echo $perso->getId();?>&id='>RECHARGER</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr id="piedbiche">
	<td colspan=6>
		<table class="color1" width="100%">
			<tr align="center">
				<td><font size=4>Pied de biche</font></td>
				<td class="armeaction" width="30px"><a href='javascript:hideArmeinfo(true);'><img src='<?php echo convertToCDNUrl('pic/close-armeinfo.png');?>'></a></td>
			</tr>
			<tr>
				<td colspan=2>
					<table class='small' width='100%'>
						<tr>
							<td align=center class='small'>
								<p>INDISPONIBLE POUR CETTE ARME</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
<div id="error"></div>
<script type="text/javascript" language="javascript" src="infop.js"></script>
<script type="text/javascript" language="javascript" src="infop-arme.js"></script>
