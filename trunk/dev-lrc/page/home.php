<img src='ravenholm.JPG' width="550">
<br>
<table width="100%" height="100%">
	<tr>
		<td>
			<table bgcolor=<? echo $_SESSION['couleur4']; ?> width="100%" height="100%">
				<tr>
					<td align=center colspan=2 bgcolor=000000><b>Avancement des mise &agrave; jour</b></td>	
				</tr>
				<tr>
					<td align=left>Web disign</td><td align=right>[80]  <? echo $a80;?></td>
				</tr>	
				<tr>
					<td align=left>Citoyen</td><td align=right>[100]  <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Vague de zombie</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Achat</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Vendre</td><td align=right>[100] <? echo $a100;?></td>
				</tr>	
					<tr>
					<td align=left>Wall</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Planque</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Scores</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Colocataire</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Compteurs</td><td align=right>[70] <? echo $a70;?></td>
				</tr>
				<tr>
					<td align=left>Images Al&eacute;atoires</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Th&egrave;me s&eacute;lectionnable</td><td align=right>[100] <? echo $a100;?></td>
				</tr>
				<tr>
					<td align=left>Bouton 'OPTIONS'</td><td  align=right>[100] <? echo $a100; ?></td>
				</tr>
				<tr>
					<td align=left>Mega-bug IE</td><td align=right>[100] <? echo $a100; ?></td>
				</tr>
				<tr>
					<td align=center colspan=2>============</td>
				</tr>
				<tr>
					<td align=left>Progression du site</td><td align=right><? echo $a60;?></td>
				</tr>
			</table>
		</td>
		<td>
			<table  bgcolor=<? echo $_SESSION['couleur4']; ?> width="100%" height="100%">
				<tr>
					<td align=center colspan=2 bgcolor=000000 HEIGHT="5%"><b>Infos</b></td>
				</tr>
				<tr>
					<td align=right colspan=2>
					<?
						$sql = "SELECT login FROM membre WHERE id=(SELECT MAX(id) FROM membre)";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_fetch_array($req);
						echo "<b>Dernier membre inscrit :</b>&nbsp;".$data['login']."&nbsp;";
					?>
					</td>
				</tr>
				<tr>
					<td align=right colspan=2>
					<?
						$sql = "SELECT nom,id_membre FROM perso WHERE id=(SELECT MAX(id) FROM perso)";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_fetch_array($req);
						echo "<b>Dernier citoyen :</b>&nbsp;",$data['nom'],"  [",$data[1],"]&nbsp;";
					?>
					</td>
				</tr>
				<tr>
					<td align=right colspan=2>
					<?
						$sql = "SELECT planque.id,perso.nom,planque.id_perso,perso.id_membre FROM perso,planque WHERE (planque.id=(SELECT MAX(planque.id) FROM planque))AND(perso.nom = planque.id_perso)";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_fetch_array($req);
						echo "<b>Derni&egrave;re planque :</b>&nbsp;",$data[2],"  [",$data[3],"]&nbsp;";
					?>
					</td>
				</tr>
				<tr>
					<td align=right >
					<? 
						$sql = "SELECT login FROM membre";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_num_rows($req);
						echo "<b>Membres inscrits :</b></td><td>&nbsp;"; 
						$M=floor($data/1000);
						$C=floor(($data%1000)/100);
						$D=floor(($data%100)/10);
						$I=($data%10);
						echo"<img src='page/".$M.".gif'><img src='page/".$C.".gif'><img src='page/".$D.".gif'><img src='page/".$I.".gif'>";
					?>
					</td>
				</tr>
				<tr>
					<td align=right>
					<? 
						$sql = "SELECT nom FROM perso";
						$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
						$data = mysql_num_rows($req);
						echo "<b>Nombre de citoyens :</b></td><td>&nbsp;"; 
						$M=floor($data/1000);
						$C=floor(($data%1000)/100);
						$D=floor(($data%100)/10);
						$I=($data%10);
						echo"<img src='page/".$M.".gif'><img src='page/".$C.".gif'><img src='page/".$D.".gif'><img src='page/".$I.".gif'>";
					?>
					</td>
				</tr>
				<tr>
					<td align=right>
						<?
							$sql = "SELECT id FROM planque";
							$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
							$data = mysql_num_rows($req);
							echo "<b>Nombre de planques :</b></td><td>&nbsp;"; 
							$M=floor($data/1000);
							$C=floor(($data%1000)/100);
							$D=floor(($data%100)/10);
							$I=($data%10);
							echo"<img src='page/".$M.".gif'><img src='page/".$C.".gif'><img src='page/".$D.".gif'><img src='page/".$I.".gif'>";		
						?>
					</td>
				</tr>
				<tr>
					<td align=right colspan=2><b>Dernier message WALL : <b></td>
				</tr>
				<tr>
					<td align=right colspan=2 > 
						<?
							$sql = 'SELECT date,id_expediteur,message,id FROM messages WHERE id=(SELECT MAX(id) FROM messages)';  
							$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
							$data = mysql_fetch_array($req);
							echo $data[0]," -- <b>",$data[1],"</b><br>
							<font color=FF6600>",$data[2],"</font>";
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<table bgcolor=<? echo $_SESSION['couleur4']; ?> width="100%" height="100%">
				<tr>
					<td align=center bgcolor="000000" HEIGHT="5%">
						<b>Mise &agrave; jour</b><br>
					</td>
				</tr>
				<tr>
					<td align=left valign=top>
						<b>|| 10/09/10 -- 16h34 || <br>R&eacute;am&eacute;nagement</b><br><br>
					</td>
				</tr> 
				<tr>
					<td align=left valign=top>
						<b>|| 09/09/10 -- 15h49 || <br>Grand travaux de r&eacute;am&eacute;nagement</b><br><br>
					</td>
				</tr> 
				<tr>
					<td align=left valign=top>
						<b>|| 08/09/10 -- 21h31 || <br>Webdisign</b><br><br>
					</td>
				</tr>
				<tr>
					<td align=left valign=top>
						<b>|| 07/09/10 -- 20h37 || <br>Rec&eacute;ation du site</b><br><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>