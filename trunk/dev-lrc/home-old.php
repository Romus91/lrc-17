<?php   include_once ("verif.php");
	//Barre loading
  $a0= "<font color='000000'>||||||||||</font>";
  $a10="<font color='C90F0F'>|</font><font color='000000'>|||||||||</font>";
  $a20="<font color='C90F0F'>||</font><font color='000000'>||||||||</font>";
  $a30="<font color='B2B42D'>|||</font><font color='000000'>|||||||</font>";
  $a40="<font color='B2B42D'>||||</font><font color='000000'>||||||</font>";
  $a50="<font color='B2B42D'>|||||</font><font color='000000'>|||||</font>";
  $a60="<font color='B2B42D'>||||||</font><font color='000000'>||||</font>";
  $a70="<font color='B2B42D'>|||||||</font><font color='000000'>|||</font>";
  $a80="<font color='09B00D'>||||||||</font><font color='000000'>||</font>";
  $a90="<font color='09B00D'>|||||||||</font><font color='000000'>|</font>";
  $a100="<font color='1AF10F'>||||||||||</font>"
?>
<img src='<?php echo convertToCDNUrl('pic/home.png');?>' width="100%">
<br>
<table width="100%" height="100%" class='color1'>
	<tr>
		<td class="color4" valign="top">
			<p align=center style="background:#000000"><b>Avancement des mises &agrave; jour</b></p>
			<p><span align="left">Kernel</span><span align="right"><?php  echo $a80;?></span></p>
			<p><span align="left">Web design</span><span align="right"><?php  echo $a80;?></span></p>
			<p><span align="left">Citoyen</span><span align="right"><?php  echo $a70;?></span></p>
			<p><span align="left">Vague de zombie</span><span align="right"><?php  echo $a70;?></span></p>
			<p><span align="left">Wall</span><span align="right"><?php  echo $a100;?></span></p>
			<p><span align="left">Planque</span><span align="right"><?php  echo $a0;?></span></p>
			<p><span align="left">Scores</span><span align="right"><?php  echo $a80;?></span></p>
			<p><span align="left">Colocataire</span><span align="right"><?php  echo $a0;?></span></p>
			<p><span align="left">Qu&ecirc;tes al&eacute;atoire</span><span align="right"><?php  echo $a0;?></span></p>
			<p><span align="left">Inventaire</span><span align="right"><?php  echo $a90;?></span></p>
			<p><span align="left">Caract&eacute;ristiques armes</span><span align="right"><?php  echo $a80;?></span></p>
			<p><span align="left">Caract&eacute;ristiques pi&egrave;ges</span><span align="right"><?php  echo $a60;?></span></p>
			<p><span align="left">Nations - Equipes - Guildes</span><span align="right"><?php  echo $a0;?></span></p>
			<p><span align="left">Energies</span><span align="right"><?php  echo $a80;?></span></p>
			<p><span align="left">Chat</span><span align="right"><?php  echo $a100;?></span></p>
			<p><span align="left">Level - Exp</span><span align="right"><?php  echo $a80;?></span></p>
			<p align=center >============</p>
			<p><span align="left">Progression du site</span><span align="right"><?php  echo $a60;?></span></p>
		</td>
		<td>
			<table  class='color4' width="100%" height="100%">
				<tr>
					<td align=center colspan=2 class='title' HEIGHT="5%"><b>Infos</b></td>
				</tr>
				<tr>
					<td align=right colspan=2>
					<?php
						$sql = "SELECT login FROM membre WHERE id=(SELECT MAX(id) FROM membre)";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_fetch_array($req);
						echo "<b>Dernier membre inscrit :</b>&nbsp;".$data['login']."&nbsp;";
					?>
					</td>
				</tr>
				<tr>
					<td align=right colspan=2>
					<?php
						$sql = "SELECT nom,id_membre FROM perso WHERE id=(SELECT MAX(id) FROM perso)";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_fetch_array($req);
						$persoMembre=mysql_fetch_array(mysql_query("SELECT login FROM membre WHERE id = ".$data['id_membre'].""));
						echo "<b>Dernier citoyen :</b>&nbsp;".$data['nom']."  [".$persoMembre['login']."]&nbsp;";
					?>
					</td>
				</tr>
				<tr>
					<td align=right >
					<?php
						$sql = "SELECT login FROM membre";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_num_rows($req);
						echo "<b>Membres inscrits :</b></td><td>&nbsp;";
						$M=floor($data/1000);
						$C=floor(($data%1000)/100);
						$D=floor(($data%100)/10);
						$I=($data%10);
						echo"<img src='".convertToCDNUrl('pic/'.$M.'.gif')."'><img src='".convertToCDNUrl('pic/'.$C.'.gif')."'><img src='".convertToCDNUrl('pic/'.$D.'.gif')."'><img src='".convertToCDNUrl('pic/'.$I.'.gif')."'>";
					?>
					</td>
				</tr>
				<tr>
					<td align=right>
					<?php
						$sql = "SELECT nom FROM perso";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_num_rows($req);
						echo "<b>Nombre de citoyens :</b></td><td>&nbsp;";
						$M=floor($data/1000);
						$C=floor(($data%1000)/100);
						$D=floor(($data%100)/10);
						$I=($data%10);
						echo"<img src='".convertToCDNUrl('pic/'.$M.'.gif')."'><img src='".convertToCDNUrl('pic/'.$C.'.gif')."'><img src='".convertToCDNUrl('pic/'.$D.'.gif')."'><img src='".convertToCDNUrl('pic/'.$I.'.gif')."'>";
					?>
					</td>
				</tr>
				<tr>
					<td align=right colspan=2 >
						<?php
							$sql = 'SELECT date,id_expediteur,message,id FROM messages WHERE id=(SELECT MAX(id) FROM messages)';
							$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
							$data = mysql_fetch_array($req);
							echo"
							<table class=small width='100%'>
									<tr>
										<td class='color4'>Dernier message WALL :</td>
									</tr>
									<tr>
										<td>".$data[0]." -- ".$data[1]."<br>
											<font color=FF6600>".$data[2]."</font></td>
									</tr>
									<tr>
										<td align=center class='color4'>&nbsp;</td>
									</tr>
							</table>
								";
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<table class='color4' width="100%" height="100%">
				<tr>
					<td align=center class='title' HEIGHT="5%">
						<b>Mises &agrave; jour</b><br>
					</td>
				</tr>
				<tr>
					<td align=left valign=top>
					<?php
							$sql = 'SELECT date,id_expediteur,message,id,timestamp FROM maj ORDER BY id DESC LIMIT 0,15 ';
							$res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
							$t=mysql_fetch_array($res);
								echo"

							<tr>
								<td>",$t[4],"</td>
							</tr>
							<tr>
								<td>",$t[2],"</td>
							</tr>
							<tr>
								<td align=center class='color4'>&nbsp;</td>
							</tr>
									";
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>