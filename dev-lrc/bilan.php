<table class='button' width='100%'>
	<tr>
		<td id='button' align=center <?php  if (($_GET['onglet'] == '') OR ($_GET['onglet'] == 'infop')) echo "class='current_page_item'";?>>
			<a href='index.php?page=perso&perso=<?php  echo $nom;?>'>CONTINUER</a>
		</td>
	</tr>
</table>
<table class='small ' width='550'>
	<tr>
		<td colspan=5 align=center><font size=5> VAGUE : </font> <font size=5 color='CC6600'><?php  echo $jourvague;?></font></td>
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
		<td align=center class='color2'><font size=4><?php  if ($jourvague >= 5) echo $zombiefast; else echo "0";?></font></td>
		<td align=center class='color2'><font size=4><?php  if ($randzp == 7) echo 1; else echo "0";?></font></td>	
	</tr>
	<tr>
		<td align=right class='title2'><b>KILL</b></td>
		<td align=center class='color2'><font size=4><?php  echo $crabekill;?></font></td>	
		<td align=center class='color2'><font size=4><?php  echo $zombiekill;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiefastkill;?></font></td>
		<td align=center class='color2'><font size=4><?php  if ($randzp == 7)echo $zombiekillpois;else echo 0;?></font></td>
	</tr>
	<tr>
		<td align=right class='title2'><b>SURVIVOR</b></td>
		<td align=center class='color2'><font size=4><?php  echo $crabenb;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombienb;?></font></td>
		<td align=center class='color2'><font size=4><?php  echo $zombiefastnb;?></font></td>
		<td align=center class='color2'><font size=4><?php  if (($zombiekillpois == 0)&&($randzp == 7))echo 1;else echo 0;?></font></td>
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
						echo "<img src='".$inv['arm'.$i].".png' width='90'>";
					echo"</td>
				</tr>
			</table>
			<table class='small' width='105'>
				<tr>
					<td align=center>
						".$mun[$i]." | ".$arme[$i]['munmax']."
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
			for ($i=1;$i<=4;$i++)
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
						echo "<img src='".$inv['pie'.$i].".png' width='90'>";
					echo"</td>
				</tr>
			</table>
			<table class='small' width='105'>
				<tr>
					<td align=center>
						".$munp[$i]." | ".$piege[$i]['munmax']."
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
									<font size=5><?php  echo $argent;?>$</font>
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
									<font size=5><b>EXP</b></font><br><font color=FFFF00 size=3><?php  echo $t['competance']+$comp;?></font>
								</td>
							</tr>
								<tr>
									<td align=left>
										<table class='button'>
											<tr height='10' valign=bottom>
												<td class='small' width='100'>
														<?php
																include_once("level.php");
																$comp+=$t['competance'];
																$levelPerso=getLevel($comp);
																$sql=mysql_query("SELECT * FROM level ORDER BY id ASC");
																$i=1;
																while ($exp = mysql_fetch_array($sql))
																{
																	$level[$i]=$exp['exp'];
																	$i++;
																}
																$pourc=ceil((($comp-$level[$levelPerso]) / ($level[$levelPerso+1]-$level[$levelPerso]))*100);
																if ($pourc < 0)
																	$pourc=0;
														?>	
													<img src='viergej.png' width='<?php echo $pourc;?>%' height='10'>
												</td>
											</tr>
										</table>
									</td>
								</tr>
						</table>
				
					</td>
					<td align=center class='title2'>
						<?php 
							if ($vie <> 0) 
							{
								$C=floor($vie/100);
								$D=floor(($vie%100)/10);
								$I=($vie%10);
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
								<td><img src='".$C.".png' width='33' ></td><td><img src='".$D.".png' width='33'></td><td><img src='".$I.".png' width='33'></td>
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
									<font color='FF0000'><?php echo "- ".($t['energie']-$energie)?></font>
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
												
													<img src='viergeb.png' width='<?php echo $energie;?>%' height='10'>
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
		<td colspan='5' align=center><img src='finvague.JPG' width='540'></td>
	</tr>
</table>
</center>           