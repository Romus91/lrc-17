<?php
require_once 'autoload.php';

$log = new Log();

function armesEmpty($armes){
	$sum=0;
	foreach ($armes as $wep) {
		$sum+=$wep->getMunitions();
	}
	if($sum>0) return false;
	else return true;
}
function damagePerso(Perso $perso, Monster $z, WaveRecorder $wRec){
	if(!$z instanceof PoisonZombie){
		$vieperdue = $perso->damage($z->getDamage());

		$e=new Event();
		$e->_source = get_class($z);
		$e->_target = 'player';
		if($vieperdue>0){
			$e->_type = 'dégats';
			$e->_value = -$vieperdue;
			$perso->addVie(-$vieperdue);
		}else{
			$e->_type = 'esquive';
		}
		$wRec->addEvent($e);
	}else{
		if($perso->poison($z->getDamage())){
			$e = new Event();
			$e->_source = 'psn';
			$e->_target = 'player';
			$e->_type = 'psndmg';
			$e->_value = -Perso::POISON_DAMAGE_PER_TICK;
			$wRec->addEvent($e);
		}
	}
}
function selectMonster(&$wave){
	$count=count($wave);
	$rand_zomb = mt_rand(0,$count-1);
	$z=$wave[$rand_zomb];
	while($z->getLife()<=0 && $count>0){
		unset($wave[$rand_zomb]);
		$wave = array_values($wave);
		$count--;
		$rand_zomb = mt_rand(0,$count-1);
		$z=$wave[$rand_zomb];
	}
	return $rand_zomb;
}
function selectArme(&$armes){
	do{
		$rand_arme = mt_rand(1,100000);
		if($rand_arme>=71425){
			$i=0;
		}elseif($rand_arme>=47620){
			$i=1;
		}elseif($rand_arme>=28575){
			$i=2;
		}elseif($rand_arme>=14290){
			$i=3;
		}elseif($rand_arme>=4765){
			$i=4;
		}else{
			$i=5;
		}
	}while(!isset($armes[$i]) || $armes[$i]->getMunitions()<=0);
	return $i;
}
function piercingDamage($pierceChance,WaveRecorder $wRec,Perso $perso,$dmg,&$wave){
	$rand_zomb = selectMonster($wave);
	$z=$wave[$rand_zomb];
	$savedmg=$dmg;
	if($dmg>=$z->getLife()){
		$dmg-=$z->getLife();
		$savedmg-=$dmg;

		$perso->addXP($z->getExp());

		$e=new Event();
		$e->_source = 'player';
		$e->_target = get_class($z);
		$e->_type = 'tue';
		$e->_value = -$savedmg;

		unset($wave[$rand_zomb]);
		$wave = array_values($wave);

		$rand=mt_rand(1,100);
		if($dmg>0 && count($wave)>0 && $rand<=$pierceChance){
			$e->_type = 'empale';
			$wRec->addEvent($e);
			piercingDamage($pierceChance, $wRec, $perso, $dmg, $wave);
		}else
			$wRec->addEvent($e);
	}else{
		$z->hit($dmg);

		$e=new Event();
		$e->_source = 'player';
		$e->_target = get_class($z);
		$e->_type = 'touche';
		$e->_value = -$dmg;
		$wRec->addEvent($e);
	}
}

$persoController = new PersoController();
$memCont = new MemberController();
$membre = $memCont->fetchMembre($_SESSION['member_id']);
$log = new Log();

$perso=$persoController->fetchPerso((int)htmlentities($_GET['perso']));

if($perso->getLevelPercent()>=100) exit("<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>");
if($perso->getEnergie()<1) exit("<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>");

$wGen = new WaveGenerator($perso->getLevel());
$wRec = new WaveRecorder();

$wave = $wGen->getWave();

$armes = $perso->getInvArme();

$shothit=0;$shotmiss=0;
$savenrg = $perso->getEnergie();
$savevie = $perso->getVie();
$saveexp = $perso->getXp();

$savemun = array();

foreach ($armes as $key => $value) {
	$savemun[$key] = $value->getMunitions();
}

while(count($wave)>0 && $perso->getVie()>0 && !armesEmpty($armes)){
	//inflige les dégats de poisons au perso
	if($perso->poison()){
		$e = new Event();
		$e->_source = 'psn';
		$e->_target = 'player';
		$e->_type = 'psndmg';
		$e->_value = -Perso::POISON_DAMAGE_PER_TICK;
		$wRec->addEvent($e);
	}

	//choisi une arme ayant encore des munitions
	$rand_arme = selectArme($armes);
	$e = new Event();
	$e->_source = 'player';
	$e->_type = 'armselect';
	$e->_target = $armes[$rand_arme]->getImage();
	$wRec->addEvent($e);

	//sélectionne un monstre aléatoirement
	$rand_zomb = selectMonster($wave);
	$z=$wave[$rand_zomb];

	//tente d'attaquer le(s) montre(s)
	$nbCibles=$armes[$rand_arme]->getNbCible($membre->getFragAmelio());
	if($nbCibles==1){
		$rand_hit = mt_rand(1,100);
		if($rand_hit <= (($armes[$rand_arme]->getHitChance())+($perso->getPrecision()))/2){
			$shothit++;
			$dmg=$armes[$rand_arme]->getDamage();
			$savedmg = $dmg;
			if($dmg>=$z->getLife()){
				$dmg-=$z->getLife();
				$savedmg-=$dmg;

				$perso->addXP($z->getExp());

				$e=new Event();
				$e->_source = 'player';
				$e->_target = get_class($z);
				$e->_type = 'tue';
				$e->_value = -$savedmg;


				unset($wave[$rand_zomb]);
				$wave = array_values($wave);

				$rand=mt_rand(1,100);
				if($dmg>0 && count($wave)>0 && $armes[$rand_arme]->getId()!=1 && $rand<=$membre->getPierceChance()){
					$e->_type = 'empale';
					$wRec->addEvent($e);
					piercingDamage($membre->getPierceChance(), $wRec, $perso, $dmg, $wave);
				}else
					$wRec->addEvent($e);
			}else{
				$z->hit($dmg);

				$e=new Event();
				$e->_source = 'player';
				$e->_target = get_class($z);
				$e->_type = 'touche';
				$e->_value = -$dmg;
				$wRec->addEvent($e);

				damagePerso($perso, $z, $wRec);

			}
		}else{
			$shotmiss++;
			$e = new Event();
			$e->_source = 'player';
			$e->_target = get_class($z);
			$e->_type = 'rate';
			$wRec->addEvent($e);
			damagePerso($perso, $z, $wRec);
		}
	}else{
		$dmg = $armes[$rand_arme]->getDamage();
		$rand_hit = mt_rand(1,100);
		$saveNbCibles=$nbCibles;
		while($rand_hit > (($armes[$rand_arme]->getHitChance())+($perso->getPrecision()))/2){
			$nbCibles*=0.9;
			$rand_hit = mt_rand(1,100);
		}
		$nbCibles=floor($nbCibles);

		if($nbCibles<0) $nbCibles=0;

		if($nbCibles>count($wave)) $nbCibles=count($wave);

		for($i=0;$i<$nbCibles;$i++){
			$pv=$wave[$i]->getLife();
			$wave[$i]->hit($dmg);
			if($wave[$i]->getLife()<=0){
				$perso->addXP($wave[$i]->getExp());
				$e=new Event();
				$e->_source = 'player';
				$e->_target = get_class($wave[$i]);
				$e->_type = 'tue';
				$e->_value = -$pv;
				$wRec->addEvent($e);
			}else{
				$e=new Event();
				$e->_source = 'player';
				$e->_target = get_class($wave[$i]);
				$e->_type = 'touche';
				$e->_value = -$dmg;
				$wRec->addEvent($e);

			}
			$shothit++;
		}

		if($saveNbCibles>$nbCibles && $i<count($wave)){
			$diff=$saveNbCibles-$nbCibles;
			$count=count($wave);
			for($y=$i;$y<($i+$diff) && $y<$count;$y++){
				damagePerso($perso, $wave[$y], $wRec);
				$shotmiss++;
			}
		}

		$j=0;
		$count=count($wave);
		do{
			if($wave[$j]->getLife()<=0){
				unset($wave[$j]);
				$count--;
				$wave = array_values($wave);
				$j--;
				if($j<0)$j=0;
			}else $j++;
		}while($j<$count);

	}
	if($armes[$rand_arme]->getId()!=1){
		$armes[$rand_arme]->addMunitions(-1);
		if($nbCibles>1) $perso->addEnergie(-$z->getEnergyCost()*1.5);
		else $perso->addEnergie(-$z->getEnergyCost());
	}else{
		$perso->addEnergie(-$z->getEnergyCost()*3);
	}

	$wRec->endRound();
}

$wRec->endWave();

if($perso->getEnergie()<0) $perso->setEnergie(0);

$perso->setInvArme($armes);
$perso->addJaugePoison();
$preci = number_format($shothit/($shothit+$shotmiss)*100,2);
$c=$z=$f=$p=$fail=0;
foreach ($wave as $mon){
	if($mon instanceof Crab){
		$c++;
	}elseif($mon instanceof Zombie){
		$z++;
	}elseif($mon instanceof FastZombie){
		$f++;
	}else{
		$p++;
	}
}
$crabkill = $wGen->getNbCrab()-$c;
$zombiekill = $wGen->getNbZomb()-$z;
$fastkill = $wGen->getNbFast()-$f;
$poisonkill = $wGen->getNbPois()-$p;

$perso->addVague();
$perso->addNb_crabe_kill($crabkill)->addNb_zomb_kill($zombiekill)->addNb_zfast_kill($fastkill)->addNb_zpois_kill($poisonkill);

###ARGENT GAGNE####
$gagne=ceil((($zombiekill)*Zombie::MONEY)+(($fastkill)*FastZombie::MONEY)+(($crabkill)*Crab::MONEY))+$poisonkill*PoisonZombie::MONEY;
$perso->addArgent($gagne);
$membre->addArgent(ceil($gagne*0.015));
###################

####CALCUL DES EXP#######
$xpGagne = $perso->getXp()-$saveexp;

$coef=Member::LOW_LVL_CHAR_XP_COEF;
if($perso->isAtMaxLevel()){
	$coef=Member::MAX_LVL_CHAR_XP_COEF;
}
$membre->addXp(ceil($xpGagne*$coef));

$bonusXP = $perso->retribXp();
################################

$persoController->savePerso($perso);
$memCont->saveMember($membre);

$log->insertLog("Vague",$_SESSION['member_id'],$perso->getId(),"BILAN VAGUE : <br>
                Vie avant : ".$savevie."<br>
                Vie apres : ".$perso->getVie()."<br>
                Nrg avant : ".$savenrg."<br>
                Nrg apres : ".$perso->getEnergie()."<br>
				Argent gagné : ".$gagne."<br>
				XP gagné : ".$xpGagne."<br>"
                );
?>
	<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo date("dmYH");?>">
	<table class='small' width='100%'>
		<tr>
			<td colspan=5 align=center>
				<font size=5>BILAN DE LA VAGUE </font>
				<font size=5 color='CC6600'><?php echo $perso->getNb_vague();?></font>
			</td>
		</tr>
		<tr>
			<td class='title' align=center width="80"><b>&nbsp;</b></td>
			<td class='title2' align=center>
				<img src='<?php echo convertToCDNUrl('pic/crab-wave.png');?>' width='35'>
			</td>
			<td class='title2' align=center>
				<img src='<?php echo convertToCDNUrl('pic/zombie-wave.png');?>' width='35'>
			</td>
			<td class='title2' align=center>
				<img src='<?php echo convertToCDNUrl('pic/fastzombie-wave.png');?>' width='35'>
			</td>
			<td class='title2' align=center>
				<img src='<?php echo convertToCDNUrl('pic/poisonzombie-wave.png');?>' width='35'>
			</td>
		</tr>
		<tr>
			<td align=right class='title2'><b>INCOMING</b></td>
			<td align=center class='color2'><font size=3><?php  echo $wGen->getNbCrab();?> </font>
			</td>
			<td align=center class='color2'><font size=3><?php  echo $wGen->getNbZomb();?> </font>
			</td>
			<td align=center class='color2'><font size=3><?php  echo $wGen->getNbFast();?>
			</font></td>
			<td align=center class='color2'><font size=3><?php  echo $wGen->getNbPois();?>
			</font></td>
		</tr>
		<tr>
			<td align=right class='title2'><b>SURVIVOR</b></td>
			<td align=center class='color2'><font size=3><?php  echo $c;?>
			</font></td>
			<td align=center class='color2'><font size=3><?php  echo $z;?>
			</font></td>
			<td align=center class='color2'><font size=3><?php  echo $f;?>
			</font></td>
			<td align=center class='color2'><font size=3><?php  echo $p;?>
			</font></td>
		</tr>
		<tr>
			<td align=right class='title2'><b>PRECISION</b></td>
			<td align=center class='color2' colspan=4>
				<font size=3><?php echo $preci;?> %</font>
			</td>
		</tr>
		<tr>
			<td align="center" colspan=5>
				<table width='100%' class='armes-wave'>
					<tr>
					<?php $i=0;
					 for(;$i<Perso::MAX_WEAP;$i++):?>
						<td align=center>
							<p class='small' width='100%' align=center>
								<font color='FF0000'><?php if(isset($armes[$i]))echo ($armes[$i]->getMunitions()-$savemun[$i]);else echo '-0';?></font>
							</p>
							<p class='hev' align=center>
								<?php if (isset($armes[$i])):?>
								<img src='<?php echo convertToCDNUrl('image.php?img='.$armes[$i]->getImage().'.png&h=105');?>/'>
								<?php endif;?>
							</p>
							<p class='small' width='100%' align=center>
								<?php if(isset($armes[$i]))
									echo $armes[$i]->getMunitions().' | '.$armes[$i]->getCapacity();
								else
									echo '0 | 0';?>
							</p>
						</td>
					<?php endfor;?>
					</tr>
					<tr>
						<td align=center class='title2'>
							<table class='small' width='100%'>
								<tr>
									<td align=center><?php  echo $perso->getArgent();?> $</td>
								</tr>
							</table>
							<table class='hev'>
								<tr>
									<td align=center><font color='00FF00' size=5>+ <?php  echo $gagne;?></font></td>
								</tr>
							</table>
						</td>
						<td class='title2' align=center>
							<table class='small' width='100%'>
								<tr>
									<td align=center><font color=FFFF00><?php echo floor($perso->getXp());?> EXP</font></td>
								</tr>
							</table>
							<table class='hev'>
								<tr>
									<td align=center><font color='00FF00' size=5>+ <?php  echo floor($xpGagne);?></font></td>
								</tr>
							</table>
						</td>
						<td align=center class='title2'>
							<table class='small' width='100%'>
								<tr>
									<td align=center>
										<font color='FF0000'><?php echo floor($perso->getVie()-$savevie);?></font>
									</td>
								</tr>
							</table>
							<table class='hev'>
								<tr>
									<td align=center><font color=FFFF00 size=5><?php echo (($perso->getVie()==0)?'X':floor($perso->getVie()));?></font></td>
								</tr>
							</table>
						</td>
						<td class='title2' align=center>
							<table class='small' width='100%'>
								<tr>
									<td align=center>
										<font color='FF0000'><?php echo floor($perso->getEnergie()-$savenrg)?></font>
									</td>
								</tr>
							</table>
							<table class='hev'>
								<tr>
									<td align=center><font size=6><b>NRG</b> </font>
									</td>
								</tr>
								<tr>
									<td align=left>
										<table width=100%>
											<tr height='20' valign=bottom>
												<td class='small' width='100'>
													<img src='<?php echo convertToCDNUrl('pic/jbleu.png');?>' width='<?php echo $perso->getEnergyPercent();?>%' height='20'>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<?php if($bonusXP>0):?>
		<tr><td class='gp-wave' colspan=5 align=center>La bataille fait remonter en vous les souvenirs des gloires passées : <br><font color='00FF00'>+ <?php echo $bonusXP;?> EXP</font></td></tr>
		<?php endif;?>
		<tr>
			<td colspan='5' align=center>
				<table class='wave'>
				<?php do{?>
					<tr class='round'>
					<?php if($first=$wRec->firstEvent()):?>
						<?php if($first->_source=='psn'):?>
						<td class='zomb'>
							<img src='<?php echo convertToCDNUrl('pic/psn-wave.png');?>' width='32'><br><span>Poison</span><br><span><?php echo number_format($first->_value,2)?></span>
						</td>
						<?php $second=$wRec->nextEvent()?>
						<td class='arme'><img src='<?php echo convertToCDNUrl('pic/'.$second->_target.'.png');?>' width='60'></td>
						<?php else: ?>
						<td style="width:43px;"></td><td class='arme'><img src='<?php echo convertToCDNUrl('pic/'.$first->_target.'.png');?>' width='60'></td>
						<?php endif;?>
						<td class='content'>
						<?php do{ ?>
							<?php if($event=$wRec->nextEvent()):?>
								<?php if($event->_source=='player'):?>
								<div class='player'>
									<img src='<?php echo convertToCDNUrl('pic/'.strtolower($event->_target).'-wave.png');?>' width='35'><br><span><?php echo ucfirst($event->_type)?></span><br><span><?php if($event->_value!=null)echo number_format($event->_value,2);else echo '&nbsp;';?></span>
								</div>
								<?php else:?>
								<div class='zomb'>
									<img src='<?php echo convertToCDNUrl('pic/'.strtolower($event->_source).'-wave.png');?>' width='35'><br><span><?php if($event->_source=='psn')echo 'Poison';else echo ucfirst($event->_type);?></span><br><span><?php if($event->_value!=null)echo number_format($event->_value,2);else echo '&nbsp;';?></span>
								</div>
								<?php endif;?>
							<?php endif;?>
						<?php }while($wRec->hasNextEvent());?>
						</td>
					<?php endif;?>
					</tr>
				<?php }while($wRec->nextRound());?>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan='5' align=center><img src='<?php echo convertToCDNUrl('pic/finvague.JPG');?>' width='100%'></td>
		</tr>
	</table>