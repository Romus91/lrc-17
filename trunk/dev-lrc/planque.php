<?php include_once ("verif.php");
   if ($_POST['demande'])
   {
		if ($_POST['demande'] == 'Accepter')
		{
			$sql3 = 'UPDATE planque SET id_perso2 = "'.$nom.'" WHERE id_perso = "'.$_SESSION['coloc'].'"';
            mysql_query($sql3) or die('Erreur SQL !'.$sql3.''.mysql_error());
		}else
		{
			$sql3 = 'UPDATE planque SET id_perso2 = "" WHERE id_perso = "'.$_SESSION['coloc'].'"';
            mysql_query($sql3) or die('Erreur SQL !'.$sql3.''.mysql_error());
		}
			$sql4 = 'DELETE FROM coloc WHERE id_perso = "'.$nom.'"';
            mysql_query($sql4) or die('Erreur SQL !'.$sql4.''.mysql_error());
   }

	$login=$_SESSION['login'];
	// on prépare une requete SQL cherchant tous les dates, message ainsi que l'auteur des messages  par ordre décroissant en se limitant à 10 message
	$sql = 'SELECT planque.id,planque.ptdef,planque.planche,planque.id_perso2,planque.id_perso,perso.photo,perso.nom,planque.caisse FROM planque,perso WHERE planque.id_membre = "'.$login.'"';
	// lancement de la requete SQL
	$res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
	$nb = mysql_num_rows(mysql_query("SELECT count(*) FROM planque"));
	$t=mysql_fetch_array($res);


   ?>
   	<center>
	<table class='small' align=center width='550'>
		<tr>
			<tD colspan=4 class='title2'>
				<table class='title2' width='100%'>
					<tr>
						<td>
							<table class='button'>
								<tr>
									<td id='button' width='140'>
										<a href="index.php" >UN LIEN</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=4>
				<table class='small' width='100%'>
					<tr>
						<td class='small'>
							<font size=3>
								PLANQUE - <?php  echo $nb;?> HABITANT<?php  if ($nb > 1) echo "S";?>
							</font>
						</td>
						<td class='small' align=right>
							<font size=5><id id='prix'><?php  echo $t['caisse'];?></div></font>
							<font color=1EB117 size=5>$</font>
						</td>
					</tr>
				</table>
				<table class='button' width='100%'>
					<tr>
						<td id='button' align=center>
							<a href="index.php">ENCORE UN LIEN</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<?php  echo $nom;
				if ($t[0])
				{
				echo "
				<table width='100%'>
					<tr>
						<td colspan=2><img src='pic/pl1.jpg' width='100%'></td>
					</tr>
					<tr class='color2'>
						<td align=center width='50%'>POINTS DE DEFENSE</td>
						<td align=center >HABITANTS</td>
					</tr>
					<tr class='color4'>
						<td align=center width='50%'><font size=5>".$t[1]."</font></td>
						<td align=center >";
						$res=mysql_query("SELECT nom,photo FROM perso WHERE id_planque = ".$t[0]."");
						while ($citoyen=mysql_fetch_array($res))
								echo $citoyen['nom'];
						echo "</td>
					</tr>
				</table>";
				/*echo"<table>
					<tr>
						<td bgcolor=222222>Colocataire</td>
						<td>";
					if ($t[3] <> '')
					{
						echo $t[3];
					}else
					{
						// on prépare une requete SQL selectionnant tous les login des membres du site en prenant soin de ne pas selectionner notre propre login, le tout, servant à alimenter le menu déroulant spécifiant le destinataire du message
						$sql = 'SELECT membre.login as nom_destinataire, membre.id as id_destinataire, perso.nom as id_perso,perso.id_membre as id_membre FROM membre,perso WHERE perso.id_membre=membre.login AND perso.nom <> "'.$nom.'" ORDER BY membre.id ASC';
						// on lance notre requete SQL
						$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$nb = mysql_num_rows ($req);
						// si au moins un membre qui n'est pas nous même a été trouvé, on affiche le formulaire d'envoie de message
						echo"  <form action='coloc.php' method='post'>
								<select name='colocdes'>";
							// on alimente le menu déroulant avec les login des différents membres du site
							while ($data = mysql_fetch_array($req))
							{
								echo '<option value="' , $data['id_perso'] ,'">' , stripslashes(htmlentities(trim($data['nom_destinataire']))) , ' -- ',$data['id_perso'],'</option>';
							}

							echo "
								</select>
								<input type='submit' name='go' value='Demander !'>
							</form>";

				 mysql_free_result($req);
				 mysql_close();
					}
				echo "
							</td>
						</tr>
					</table>*/
				}
				else
					echo "Vous n'avez pas de planque";
			?>
	</table>
