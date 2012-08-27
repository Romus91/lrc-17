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
<img src='pic/home.png' width="550">
<br>
<table width="100%" height="100%" class='color1'>
	<tr>
		<td>
			<table class='color4' width="250" height="100%">
				<tr>
					<td align=center colspan=2 bgcolor=000000><b>Avancement des mises &agrave; jour</b></td>
				</tr>
				<tr>
					<td align=left>Kernel</td><td align=right><?php  echo $a80;?></td>
				</tr>
				<tr>
					<td align=left>Web disign</td><td align=right><?php  echo $a80;?></td>
				</tr>
				<tr>
					<td align=left>Citoyen</td><td align=right><?php  echo $a70;?></td>
				</tr>
				<tr>
					<td align=left>Vague de zombie</td><td align=right><?php  echo $a70;?></td>
				</tr>
				<tr>
					<td align=left>Wall</td><td align=right><?php  echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Planque</td><td align=right><?php  echo $a0;?></td>
				</tr>
				<tr>
					<td align=left>Scores</td><td align=right><?php  echo $a80;?></td>
				</tr>
				<tr>
					<td align=left>Colocataire</td><td align=right><?php  echo $a0;?></td>
				</tr>
				<tr>
					<td align=left>Quêtes aléatoire</td><td align=right><?php  echo $a0;?></td>
				</tr>
				<tr>
					<td align=left>Inventaire</td><td align=right><?php  echo $a90;?></td>
				</tr>
				<tr>
					<td align=left>Caractéristiques armes</td><td align=right><?php  echo $a80;?></td>
				</tr>
				<tr>
					<td align=left>Caractéristiques pièges</td><td align=right><?php  echo $a60;?></td>
				</tr>
				<tr>
					<td align=left>Nations - Equipes - Guildes</td><td align=right><?php  echo $a0;?></td>
				</tr>
				<tr>
					<td align=left>Energies</td><td align=right><?php  echo $a80;?></td>
				</tr>
				<tr>
					<td align=left>Chat</td><td align=right><?php  echo $a30;?></td>
				</tr>
				<tr>
					<td align=left>Level - Exp</td><td align=right><?php  echo $a80;?></td>
				</tr>
				<tr>
					<td align=center colspan=2>============</td>
				</tr>
				<tr>
					<td align=left>Progression du site</td><td align=right><?php  echo $a60;?></td>
				</tr>
			</table>
		</td>
		<td>
			<table  class='color4' width="290" height="100%">
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
						echo"<img src='pic/".$M.".gif'><img src='pic/".$C.".gif'><img src='pic/".$D.".gif'><img src='pic/".$I.".gif'>";
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
						echo"<img src='pic/".$M.".gif'><img src='pic/".$C.".gif'><img src='pic/".$D.".gif'><img src='pic/".$I.".gif'>";
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
	<!--
	<tr>
		<td colspan=2>
			<table class='color4' width="100%" height="100%">
				<tr>
					<td align=center class='title' HEIGHT="5%">
						<b>A faire</b><br>
					</td>
				</tr>
				<tr>
					<td align=left valign=top>
						- Bug pour la sélection de munitions (Ca foire quand on clique sur 'maximiser')
					</td>
				</tr>
			</table>
		</td>
	</tr>-->
</table>