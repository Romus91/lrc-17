<?php  include ("verif.php");?>
<center>
<?php 				 
	//Affichage des perso du membre connecté                     
	$login=$_SESSION['login'];
	if ($_GET['status'] == 1)
		$ent=1;
	else
		$ent=0;
	// on prépare une requete SQL cherchant le nom,sexe,photo,id_membre,argent,vie,date,jourvague,arme,piege du perso du memebre connecté par ordre croissant de l'id des perso
	$sql = 'SELECT nom,photo,id_membre,argent,vie,date,jourvague,arme,piege,competance FROM perso WHERE enterrer = '.$ent.' ORDER BY id DESC'; 
	// lancement de la requete SQL  
	$res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error()); 
	$nb = mysql_num_rows($req);	//Nombre de resultat trouvé
	
	$sql2='SELECT count(*) FROM perso WHERE "'.$login.'" = id_membre AND enterrer = 1';
	$req2 = mysql_query($sql2) or die('Erreur SQL !'.$sql2.''.mysql_error()); 
	$nb2 = mysql_fetch_array($req2);

	//On affiche le tout
?>
<table align='center' class='small' width='550'>
	<tr>
		<td colspan=4 class='title2'>
			<table class='title2' width='100%'>
				<tr>
					<td>
						<table class='button'>
							<tr>
								<td id='button'>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<font color='FF0000'><?php  echo $_SESSION['erreur'];?></font>
					</td>
					<td align=right>
						<table class='button'>
							<tr>
								<td id='button'>

								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php 
	//Si il n'y a aucun resultat, on affiche qu'il n'y en a pas
	if ($nb == 0)
	{
		echo"
	<tr>
		<td colspan='6' align=center>Tu n'as aucun citoyen (clique sur NOUVEAU)</td>
	</tr>
		";
	}else//Sinon, on affiche les resultat
	{
        $a=1;
        While($t=mysql_fetch_array($res))	 
        {
		$date= (ceil((time()-$t[5])/86400));//On calcule le nombre de jour du perso passé dans le jeu					  
		$heure=date('H:i:s',$t[5]);//On calcule l'heure de l'insciption du perso
		if (date('H:i:s') < $heure){$date = $date + 1;}//Si l'heure actuelle est plus petite que l'heure d'inscription, on ajoute 1 au jour du perso
        $date2=$date-$t[6];  
		
		echo "
	<tr>
		<td width='110' align=center>
			"; 
		if($t[4] <> 0 ) 
		{
		echo"
			<table class='button'>
				<tr>
					<td id='button'>
						<a href=''>";
						if ($date2 > 0)
							echo "<font color='FF0000'>".$t[0]."</font>";
						else
							echo $t[0];
						echo"</a>
					</td>
				</tr>
			</table>
		</td>
			";
		}else
		{ 
			if ($_GET['status'] <> 1) 
				echo"
			<table class='button'>
				<tr>
					<td id='button'>
						<a href=''>".$t[0]."</a>
					</td>
				</tr>
			</table>
		</td>    
				";
			else
				echo"
						<font size=4>".$t[0]."</font>
		</td>    
				";
		}
		//On affiche les jours de vagues, l'argent, la vie, la photo, la date et l'heure de l'insciption, la photo de l'arme et du piege.
		  
		if($t[4] <> 0 ) 
		{
			echo"
				<td align='center'>
					<table class='hev'>
						<tr>
							<td align=center>";
				if ($date2 > 0)
				{
						echo"RETARD : ".$date2."<br>JOURS : ".$t[6]."<br>".$t['id_membre']."";
				}else
					echo"JOUR<br><font color='CC6600' size=6>".$t[6]."</font><br>".$t['id_membre']."";
						echo"</td>
						</tr>
					</table>
				</td>
				";
		}else
		{
			echo"
				<td align='center'>
					<table class='hev'>
						<tr>
							<td align=center>
								<b>A SURVECUS<br><font color='CC6600' size=3>".$t[6]."</font><br>JOURS</b>
							</td>
						</tr>
					</table>
				</td>
			";
		}
		
			echo"
		<td align=left>
			<table class='hev' >
				<tr>
					<td align=center>
						<font size=5><b>EXP</b></font><br><font color=FFFF00 size=3><b>",$t['competance'],"</b></font>
					</td>
				</tr>
			</table>
		</td>
		<td rowspan='2' align=center background='".$t[1].".JPG' width='130' hight='70'>
			";
			if ($t[4] == 0)
				echo"<img src='rouge.png' width='185' height='170'></td>";
			else
				echo"<img src='blanc.png' width='185' height='170'></td>";
		echo"
	</tr>
	<tr>
		<td align=center>
			<table class='hev'>
				<tr>
					<td align=center><img src='".$t[7].".png' width='90'></td>
				</tr>
			</table>
		</td>
		<td width='200' align=center>
			";
			//Si le piege du perso et différent de rien, on affiche la photo, sinon on affiche qu'il n'en a pas
		if ($t[8] <> '')
		{
			echo"
			<table class='hev'>
				<tr>
					<td align=center>
						<img src='".$t[8].".png' width='70'>  
					</td>
				</tr>
			</table>
				";
		}else
		{
			echo"
			<table class='hev'>
				<tr>
					<td align=center><b>Aucun piège</b></td>
				</tr>
			</table>
				";
		}
		echo"
		</td>
		<td>";

		
		//$vieb=$t[4];
	    $C=floor($t[4]/100);
	    $D=floor(($t[4]%100)/10);
	    $I=($t[4]%10);
		if ($t[4] <> 0)
			echo"
				<table class='hev'>
					<tr>
						<td><img src='".$C.".png' width='33' ></td><td><img src='".$D.".png' width='33'></td><td><img src='".$I.".png' width='33'></td>
					</tr>
				</table>
				";
		else
			echo"
			<table class='hev'>
				<tr>
					<td align=center><font color=FFFF00 size=7>X</font></td>
				</tr>
			</table>
			";
		
		
		
		echo"
		</td>
	</tr>
	<tr>
		<td colspan=6 align=center bgcolor=111111>&nbsp;</td>
	</tr>";					 
		}
	}
    echo"
</table>";
$_SESSION['erreur']='';
?>
			    