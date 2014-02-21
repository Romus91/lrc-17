<?php  if(isset($_GET['arme'])) $act=$_GET['arme'];

	$armCont = new ArmeController();
	$armes = $armCont->fetchAll();
	$memCont = new MemberController();
	$membre = $memCont->fetchMembre($_SESSION['member_id']);
?>
<tr>
	<td>
		<table class='small' width='100%'><!-- On fait un grand formulaire avec toutes les armes, pi�ge, vie que l'on peut achetter -->
			<?php
			foreach($armes as $arme):
				$invArme = $perso->getInvArme();
				$trueornot=false;
				foreach($invArme as $armePerso){
					if ($armePerso->getId()==$arme->getId()){
						$trueornot=true;
						break;
					}
				}
				if ($arme->getLvlrequis() <= $perso->getLevel()):?>
				<tr>
					<td align=center class='color3' width="100px">
						<img src='<?php echo convertToCDNUrl('image.php?img='.$arme->getImage().'.png&w=80');?>'><br>
					</td>
					<td class='color4' align=center>
						<table class='small' width="100%">
							<tr>
								<td class='small' colspan="2"><?php echo $arme->getNom()?></td>
								<td width="50px"><font color='ff9900'><?php echo $arme->getPrix()?> $</font></td>
							</tr>
							<tr>
								<td class='color1' width="40">DEGATS</td>
								<td class='small'><img src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='<?php echo $arme->getDamage()/7*100?>%' height='10'></td>
								<td class='color1' width="50px"><?php echo $arme->getDamage()?></td>
							</tr>
							<tr>
								<td class='color1' width="40">PRECISION</td>
								<td class='small'><img src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='<?php echo $arme->getPrecision()?>%' height='10'></td>
								<td class='color1' width="50px"><?php echo number_format($arme->getPrecision())?> %</td>
							</tr>
							<tr>
								<td class='color1' width="40">CHARGEUR</td>
								<td class='small'><img src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='<?php echo $arme->getMunmax()/150*100?>%' height='10'></td>
								<td class='color1' width="50px"><?php echo $arme->getMunmax()?></td>
							</tr>
							<tr>
								<td class='color1' width="40">NB CIBLES</td>
								<td class='small'><img src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='<?php echo $arme->getNbCible($membre->getFragAmelio())/30*100?>%' height='10'></td>
								<td class='color1' width="50px"><?php echo $arme->getNbCible($membre->getFragAmelio())?></td>
							</tr>
						</table>
					</td>

					<?php if ($trueornot == true):?>
					<td align=center class='color4' width="150px">
						DANS L'INVENTAIRE
					</td>
					<?php else:?>
					<td align=center class='color4' width="150px">
						<table class='color1' width="100%">
							<tr>
								<td class='button' width='100%'>
									<a href='achatarmeok.php?perso=<?php echo $perso->getId()?>&acheterarme=<?php echo $arme->getId()?>'>ACHETER</a>
								</td>
							</tr>
						</table>
					</td>
					<?php endif;?>
				</tr>
				<?php else:?>
				<tr height=90>
					<td class='verouille' align=center colspan=4>
						<font size=6>VEROUILLE</font><br>NIVEAU REQUIS : <font size=4><?php echo $arme->getLvlrequis()?></font>
					</td>
				</tr>
				<?php endif;
			endforeach;?>
		</table>
	</td>
</tr>

