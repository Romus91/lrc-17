<?php
	include_once ("verif.php");
	require_once 'PersoController.php';
	require_once 'LogClass.php';

	$persoController = new PersoController();
	$log = new Log();

	$perso=$persoController->fetchPerso($_GET['perso']);

	include_once 'pass.php';
	$sql=mysql_query("SELECT * FROM level ORDER BY id ASC");
	$i=1;
	while ($exp = mysql_fetch_array($sql)){
		$level[$i]=$exp['exp'];
		$i++;
	}
	$pourc=floor((($perso->getXp()-Perso::getXpForLevel($perso->getLevel())) / ($perso->getXpForNextLevel()-Perso::getXpForLevel($perso->getLevel())))*100);

?>
<center>
<?php
		if($pourc>=100){
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=perso&perso=".$perso->getId()."');</script>";
		}
		if ($perso->getEnergie() > 0)
		{
			$saveEnergie = $energie = $perso->getEnergie();

			$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId()."")); //Va chercher tout l'inventaire
			for ($cpt=1;$cpt<=4;$cpt++) //Compte le nombre d'armes dans l'inventaire
			{
				if ($inv['arm'.$cpt] == NULL)
					break;
			}
			$cpt--;


			for ($cptp=1;$cptp<=2;$cptp++) //Compte le nombre de piege dans l'inventaire
			{
				if ($inv['pie'.$cptp] == NULL)
					break;
			}
			$cptp--;

			for ($i=1;$i<=$cpt;$i++)//Selection de chaque arme (caract)
				$arme[$i]=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image='".$inv['arm'.$i]."'"));

			for ($i=1;$i<=$cptp;$i++)//idem piege
				$piege[$i]=mysql_fetch_array(mysql_query("SELECT * FROM pieges WHERE image='".$inv['pie'.$i]."'"));

			###Recalcul du nombre de jours (vague)###
			$jourvague= $perso->getNb_vague() + 1;
			$perso->setNb_vague($jourvague);

			###Attribution des points pour les armes###
			for ($i=1;$i<=4;$mun[$i++]=0);
			for ($i=1;$i<=$cpt;$i++)
			{
				$mun[$i]=ceil(($inv['mun'.$i])*($arme[$i]['force']+($arme[$i]['force']*($inv['degat'.$i]/10))));
			}

			###Attribution des points pour les pièges###
			for ($i=1;$i<=2;$munp[$i++]=0);
			for ($i=1;$i<=$cptp;$i++)
			{
				$munp[$i]=ceil(($inv['munp'.$i])*$piege[$i]['force']);
			}

			###Calcul du nombre de zombie ce jour####
			$zombie=$zombienb=($perso->getLevel()*3)+rand(-(floor($perso->getLevel()/6)),(floor($perso->getLevel()/6))); //compt nb zombie
			$crabe=$crabenb=($perso->getLevel()*5)+rand(-(floor($perso->getLevel()/8)),(floor($perso->getLevel()/8))); // Compte le nombre de head-crabs
			$zombiefast=$zombiefastnb=($perso->getLevel()*2)+rand(-(floor($perso->getLevel()/4)),(floor($perso->getLevel()/4)));

			$zombiefastkill=0;

			$shootGoal=0;
			$shootMissed=0;
			####Grande boucle de random pour les kill#####
			while ((($zombienb > 0) OR ($crabenb > 0) OR ($zombiefastnb > 0)) AND (($munp[1] > 0) OR ($mun[1] > 0) OR ($munp[2] > 0) OR ($mun[2] > 0) OR ($mun[3] > 0) OR ($mun[4] > 0)) AND ($energie > 0))
			{
				$randKill=rand(1,3);
				$usePiege=true;
				for ($i=1;$i<=4;$munEncore[$i++]=false);
				for ($i=1;$i<=$cpt;$i++)//Il reste des munitions dans celle la ?
				{
					if ($mun[$i] > 0)
						{
							$munEncore[$i]=true;
							$usePiege=false;
						}

				}
				for ($i=1;$i<=2;$munpEncore[$i++]=false);
				for ($i=1;$i<=$cptp;$i++)
				{
					if ($munp[$i] > 0)
						$munpEncore[$i]=true;
				}

				###FAST-ZOMBIES### --> 1
				if ($perso->getLevel() > 1) //Si le nombre de vague est sup à 5 --> Attaque de fast-zombies
				{
					if (($randKill == 1) AND ($zombiefastnb > 0))
					{
						while (1)
						{
							$randArme=rand(1,$cpt);
							$randPiege=rand(1,$cptp);
							if ($munEncore[$randArme] == true)
								break;
							if (($munpEncore[$randPiege] == true) AND ($usePiege == true))
								break;
						}


						if ($munEncore[$randArme] == true)
						{

								$random=rand(1,100);
								if ($random <= ($arme[$randArme]['precision']*(1+($inv['prec'.$randArme]/10))))
								{
										$mun[$randArme]--;
										$zombiefastnb--;
										$shootGoal++;
										$energie-=1;
								}else
								{
									$mun[$randArme]--;
									$shootMissed++;
								}
						}else
						{

								$random=rand(1,100);
								if ($random <= $arme[$randPiege]['precision'])
								{
									$munp[$randPiege]--;
									$zombiefastnb--;
									$shootGoal++;
									$energie-=1;

								}else
								{
									$munp[$randPiege]--;
									$shootMissed++;
								}
						}
					}
				}else
					$zombiefast=$zombiefastnb=0;
				##################


				###ZOMBIES## --> 2
				if (($randKill == 2)AND ($zombienb > 0))
				{
					while (1)
					{
						$randArme=rand(1,$cpt);
						$randPiege=rand(1,$cptp);
						if ($munEncore[$randArme] == true)
							break;
						if (($munpEncore[$randPiege] == true) AND ($usePiege == true))
							break;
					}


					if ($munEncore[$randArme] == true)
					{
							$random=rand(1,100);
							if ($random <= $arme[$randArme]['precision']*(1+($inv['prec'.$randArme]/10)))
								{
									$mun[$randArme]--;
									$zombienb--;
									$shootGoal++;
									$energie-=0.5;
								}else
								{
									$mun[$randArme]--;
									$shootMissed++;
								}
					}else
					{
							$random=rand(1,100);
								if ($random <= $arme[$randPiege]['precision'])
								{
									$munp[$randPiege]--;
									$zombienb--;
									$shootGoal++;
									$energie-=0.5;

								}else
								{
									$munp[$randPiege]--;
									$shootMissed++;
								}
					}
				}
				#################

				###HEAD-CRABS###
				if (($randKill == 3)AND ($crabenb > 0))
				{
					while (1)
					{
						$randArme=rand(1,$cpt);
						$randPiege=rand(1,$cptp);
						if ($munEncore[$randArme] == true)
							break;
						if (($munpEncore[$randPiege] == true) AND ($usePiege == true))
							break;
					}


					if ($munEncore[$randArme] == true)
					{
							$random=rand(1,100);
							if ($random <= $arme[$randArme]['precision']*(1+($inv['prec'.$randArme]/10)))
								{
									$mun[$randArme]--;
									$crabenb--;
									$shootGoal++;
									$energie-=0.3;
								}else
								{
									$mun[$randArme]--;
									$shootMissed++;
								}
					}else
					{
							$random=rand(1,100);
								if ($random <= $arme[$randPiege]['precision'])
								{
									$munp[$randPiege]--;
									$crabenb--;
									$shootGoal++;
									$energie-=0.3;
								}else
								{
									$munp[$randPiege]--;
									$shootMissed++;
								}
					}

				}
				################
			}

			###############################

			####VIES####
			$vieperdue=((floor($crabenb/4))+(ceil($zombienb/3))+(ceil($zombiefastnb)));
			$vie=$perso->getVie()-$vieperdue;
			if ($vie < 0)//Si la vie descend en dessous de 0, on la planche à 0
				$vie = 0;
			############

			####ZOMBIE-POISON####### (cas spécial)
			$zombiepoison=0;
			$rand=rand(1,50);
			$totmunForZP=0;

			if (($perso->getLevel()-3) >= $rand)
			{

					$zombiepoison=$zombiepoisonnb=1 ;
					/*$totMun=0;
					for ($i=1;$i<=$cpt;$i++)
					{
						$totMun+=$mun[$i];
					}
					$totMunp=0;
					for ($i=1;$i<=$cptp;$i++)
					{
						$totMunp+=$munp[$i];
					}
					$totmunForZP=($totMun + $totMunp);*/
					//if (($totmunForZP > 150) && ($energie > 0) && $vie > 0)
					//{
						for ($vieZP=150;($vieZP>0) && ($mun[1] > 0 OR $mun[2] > 0 OR $mun[3] > 0 OR $mun[4] > 0 OR $munp[1] > 0 OR $munp[2] > 0) && ($energie > 0) && ($vie > 0);$vieZP--)
						{

							while (1)
							{
								$randArme=rand(1,$cpt);
								$randPiege=rand(1,$cptp);
								if ($munEncore[$randArme] == true)
									break;
								if ($munpEncore[$randPiege] == true)
									break;
							}


							if ($munEncore[$randArme] == true)
							{
									$mun[$randArme]--;
									$energie-=0.1;
							}else
							{
									$munp[$randPiege]--;
									$energie-=0.1;
							}
						}

						if ($vieZP > 0)
							$vie=1;
						else
							$zombiepoisonnb--;
					//}else
					//{
					//	$vie=1;
					//}

			}else
				$zombiepoison=$zombiepoisonnb=0;
			################################


			####RATRIBUTION DES MUN#####

			for ($i=1;$i<=$cpt;$i++)
			{
				$mun[$i]=ceil($mun[$i]/($arme[$i]['force']+($arme[$i]['force']*($inv['degat'.$i]/10))));
				if ($mun[$i] <= 0) $mun[$i]=0;
			}

			for ($i=1;$i<=$cptp;$i++)
			{
				$munp[$i]=ceil($munp[$i]/$piege[$i]['force']);
				if ($munp[$i] <= 0) $munp[$i]=0;
			}

			############################

			###BILAN DU NOMBRE DE TUES#######
			$zombiefastkill=$zombiefast-$zombiefastnb;
			$zombiekill=$zombie-$zombienb;
			$crabekill=$crabe-$crabenb;
			$zombiekillpois=$zombiepoison-$zombiepoisonnb;
			#################################

			###ARGENT GAGNE####
			$gagne=ceil((($zombiekill)*8)+(($zombiefastkill)*16)+(($crabekill)*3));
			$perso->addArgent($gagne);
			###################

			####CALCUL DES EXP#######
			$comp=ceil(($zombiefastkill*10)+($zombiekillpois*1000)+($zombiekill*2)+$crabekill);
			$perso->addXp($comp);
			################################

			#####GO BDD !!##########
			if ($energie < 0) $energie=0;

			$perso	-> setNb_vague($jourvague)
					-> setVie($vie)
					-> setNb_zomb_kill($perso->getNb_zomb_kill()+$zombiekill)
					-> setNb_zfast_kill($perso->getNb_zfast_kill()+$zombiefastkill)
					-> setNb_zpois_kill($perso->getNb_zpois_kill()+$zombiekillpois)
					-> setNb_crabe_kill($perso->getNb_crabe_kill()+$crabekill)
					-> setEnergie(ceil($energie));

			$persoController->savePerso($perso);

			for ($i=1;$i<=$cpt;$i++){
				if (!$mun[$i]) $mun[$i] = 0;
			}

			$sql = 'UPDATE inventaire SET
				mun1="1",
				mun2="'.$mun[2].'",
				mun3="'.$mun[3].'",
				mun4="'.$mun[4].'",
				munp1="'.$munp[1].'",
				munp2="'.$munp[2].'"
				WHERE id_perso = '.$perso->getId().'';
			mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
			#######################

		}else
		{
			if ($perso->getVie() == 0)
			{
				echo '<script language="javascript" type="text/javascript">
						window.location.replace("index.php?page=citoyen");
					</script>';
			}
			else
			{
				echo '<script language="javascript" type="text/javascript">
						window.location.replace("index.php?page=perso&perso='.$perso->getId().'");
					</script>';
			}
		}
?>
<table class='button' width='100%'>
	<tr>
		<td id='button' align=center <?php  if ((!isset($_GET['onglet'])) OR ($_GET['onglet'] == 'infop')) echo "class='current_page_item'";?>>
			<a href='index.php?page=perso&perso=<?php  echo $perso->getId();?>'>CONTINUER</a>
		</td>
	</tr>
</table>
<table class='small ' width='550'>
	<tr>
		<td colspan=5 align=center><font size=5> VAGUE : </font> <font size=5 color='CC6600'><?php  echo $perso->getNb_vague();?></font></td>
	</tr>
	<tr>
		<td colspan='5' align=center><font size=4>BILAN DE LA DERNIERE VAGUE</font></td>
	</tr>
	<tr>
		<td class='title' align=center><b>&nbsp;</b></td>
		<td class='title2' align=center><b>HEAD-CRABS</b></td>
		<td class='title2' align=center><b>ZOMBIE</td>
		<td class='title2' align=center><b>FAST-ZOMBIE</td>
		<td class='title2' align=center><b>POISON-ZOMBIE</td>
	</tr>
	<tr>
		<td align=right class='title2'><b>INCOMING</b></td>
		<td align=center class='color2'><font size=4><?php  echo $crabe;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombie;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiefast;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiepoison;?></font></td>
	</tr>
	<tr>
		<td align=right class='title2'><b>KILL</b></td>
		<td align=center class='color2'><font size=4><?php  echo $crabekill;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiekill;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiefastkill;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiekillpois;?></font></td>
	</tr>
	<tr>
		<td align=right class='title2'><b>SURVIVOR</b></td>
		<td align=center class='color2'><font size=4><?php  echo $crabenb;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombienb;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiefastnb;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiepoisonnb;?></font></td>
	</tr>
	<tr>
		<td align=center class='title' colspan=5>&nbsp;</td>
	</tr>
	<tr>
		<td align=right class='title2'><b>PRECISION</b></td>
		<td align=center class='color2' colspan=4><font size=4><?php
			$num=($shootGoal/($shootGoal+$shootMissed))*100;


		echo (number_format($num,2));?> %</font></td>
	</tr>
	<tr >
		<td align="center" colspan=5 >
			<table width='100%' class='title2'>
				<tr>
		<?php
			for ($i=1;$i<=4;$i++)
			{
				echo "
		<td align=center  class='title2'>
			<table class='small' width='105'>
				<tr>
					<td align=center>
						<font color='FF0000'>- ".($inv['mun'.$i]-$mun[$i])."</font>
					</td>
				</tr>
			</table>
			<table class='hev'>
				<tr>
					<td align=center>";
					if ($inv['arm'.$i])
						echo "<img src='pic/".$inv['arm'.$i].".png' width='90'>";
					echo"</td>
				</tr>
			</table>
			<table class='small' width='105'>
				<tr>
					<td align=center>
						".$mun[$i]." | ".($arme[$i]['munmax']+($arme[$i]['munmax']*($inv['capa'.$i]/10)))."
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
		<td align="center" colspan=5 >
			<table  width='100%' class='title2'>
				<tr>
		<?php
			for ($i=1;$i<=2;$i++)
			{
				echo "

		<td align=center  class='title2'>
			<table class='small' width='105'>
				<tr>
					<td align=center>
						<font color='FF0000'>- ".($inv['munp'.$i]-$munp[$i])."</font>
					</td>
				</tr>
			</table>
			<table class='hev'>
				<tr>
					<td align=center>";
					if ($inv['pie'.$i])
						echo "<img src='pic/".$inv['pie'.$i].".png' width='90'>";
					echo"</td>
				</tr>
			</table>
			<table class='small' width='105'>
				<tr>
					<td align=center>
						".$munp[$i]." | ".((isset($piege[$i]['munmax']))?$piege[$i]['munmax']:0)."
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
		<td align="center" colspan=5>
			<table  width='100%' class='title2'>
				<tr>
					<td align=center class='title2' valign=top>
						<table class='small' width='105'>
							<tr>
								<td align=center>
									<font color='00FF00'>+ <?php  echo $gagne;?></font>
								</td>
							</tr>
						</table>
						<table class='hev' >
							<tr>
								<td align=center>
									<font size=5><?php  echo $perso->getArgent();?>$</font>
								</td>
							</tr>
						</table>
					</td>
					<td class='title2' align=center>
						<table class='small' width='105'>
							<tr>
								<td align=center>
									<font color='00FF00'>+ <?php  echo $comp;?></font>
								</td>
							</tr>
						</table>
						<table class='hev' >
							<tr>
								<td align=center>
									<font size=5><b>EXP</b></font><br><font color=FFFF00 size=3><?php  echo $perso->getXp();?></font>
								</td>
							</tr>
								<tr>
									<td align=left>
										<table class='button'>
											<tr height='10' valign=bottom>
												<td class='small' width='100'>
														<?php
																$pourc=floor((($perso->getXp()-Perso::getXpForLevel($perso->getLevel())) / ($perso->getXpForNextLevel()-Perso::getXpForLevel($perso->getLevel())))*100);
																if ($pourc < 0)
																	$pourc=0;
																if($pourc>100)$pourc=100;
														?>
													<img src='pic/viergej.png' width='<?php echo $pourc;?>%' height='10'>
												</td>
											</tr>
										</table>
									</td>
								</tr>
						</table>

					</td>
					<td align=center class='title2'>
						<?php
							if ($perso->getVie() <> 0)
							{
								$C=floor($perso->getVie()/100);
								$D=floor(($perso->getVie()%100)/10);
								$I=($perso->getVie()%10);
								echo"
						<table class='small' width='105'>
							<tr>
								<td align=center>
									<font color='FF0000'>- ".$vieperdue."</font>
								</td>
							</tr>
						</table>
						<table class='hev'>
							<tr>
								<td><img src='pic/".$C.".png' width='33' ></td><td><img src='pic/".$D.".png' width='33'></td><td><img src='pic/".$I.".png' width='33'></td>
							</tr>
						</table>
									";
							}else
								echo "
						<table class='small' width='105'>
							<tr>
								<td align=center>
									<font color='FF0000'>- ".$vieperdue."</font>
								</td>
							</tr>
						</table>
						<table class='hev'>
							<tr>
								<td align=center><font color=FFFF00 size=7>X</font></td>
							</tr>
						</table>
									";
						?>
					</td>
					<td class='title2' valign=bottom align=center>
						<table class='small' width='105'>
							<tr>
								<td align=center>
									<font color='FF0000'><?php

									echo "- ".($saveEnergie-$perso->getEnergie())?></font>
								</td>
							</tr>
						</table>
							<table class='hev'>
								<tr>
									<td align=center>
										<font size=5><b>NRG</b></font>
									</td>
								</tr>
								<tr>
									<td align=left>
										<table class='button'>
											<tr height='10' valign=bottom>
												<td class='small' width='100'>

													<img src='pic/viergeb.png' width='<?php
													echo ($perso->getEnergie()/$perso->getMaxEnergie())*100;?>?>%' height='10'>
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
	<tr>
		<td colspan='5' align=center><img src='pic/finvague.JPG' width='540'></td>
	</tr>
</table>
</center>
<?php $log->insertLog("Vague",$_SESSION['member_id'],$perso->getId(),"BILAN VAGUE : <br>
		Nb Vague : ".$perso->getNb_vague()."<br>
		Crabes IN : ".$crabe."<br>
		Zombie IN : ".$zombie."<br>
		ZombieF IN : ".$zombiefast."<br>
		ZombieP IN : ".$zombiepoison."<br>
		Crabes OUT : ".$crabenb."<br>
		Zombie OUT : ".$zombienb."<br>
		ZombieF OUT : ".$zombiefastnb."<br>
		ZombieP OUT : ".$zombiepoisonnb."<br>
		Arme1 mun pert : ".($inv['mun1']-$mun[1])."<br>
		Arme1 mun : ".$mun[1]."<br>
		Arme2 mun pert : ".($inv['mun2']-$mun[2])."<br>
		Arme2 mun : ".$mun[2]."<br>
		Arme3 mun pert : ".($inv['mun3']-$mun[3])."<br>
		Arme3 mun : ".$mun[3]."<br>
		Arme4 mun pert : ".($inv['mun4']-$mun[4])."<br>
		Arme4 mun : ".$mun[4]."<br>
		Piege1 mun pert : ".($inv['munp1']-$munp[1])."<br>
		Piege1 mun : ".$munp[1]."<br>
		Piege2 mun pert : ".($inv['munp2']-$munp[2])."<br>
		Piege2 mun : ".$munp[2]."<br>
		Mun req ZP : ".$totmunForZP."<br>
		Prec : ".(number_format($num,2))."<br>
		Gagne $ : ".$gagne."<br>
		Tune : ".$perso->getArgent()."<br>
		Gagne exp : ".$comp."<br>
		exp : ".$perso->getXp()."<br>
		Vie perdue : ".$vieperdue."<br>
		Vie : ".$perso->getVie()."<br>
		Nrg perdue : ".($saveEnergie-$perso->getEnergie())."<br>
		Nrg : ".$perso->getEnergie()."<br>"
		); ?>
