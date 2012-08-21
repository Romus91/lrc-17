<?php
	include_once ("verif.php");
?>
<center>
<?php
	//Affichage des perso du membre connecté
	$ent=0;
	if (isset($_GET['status'])) $ent=$_GET['status'];

	$tabPersos = $persoController->fetchMembre($_SESSION['member_id']);
	$nb=count($tabPersos);
	$nb2=0;
	foreach($tabPersos as $perso){
		$nb2+=(($perso->isDead())?1:0);
	}
	/*
	// on prépare une requete SQL cherchant le nom,sexe,photo,id_membre,argent,vie,date,jourvague,arme,piege du perso du memebre connecté par ordre croissant de l'id des perso
	$sql = 'SELECT nom,photo,id_membre,argent,vie,date,jourvague,competance,id,level,energie FROM perso WHERE  "'.$login.'" = id_membre AND enterrer = '.$ent.' ORDER BY id ASC';
	// lancement de la requete SQL
	$res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
	$nb = mysql_num_rows($req);	//Nombre de resultat trouvé

	$sql2='SELECT count(*) FROM perso WHERE "'.$login.'" = id_membre AND enterrer = 1';
	$req2 = mysql_query($sql2) or die('Erreur SQL !'.$sql2.''.mysql_error());
	$nb2 = mysql_fetch_array($req2);
	*/

	include_once("level.php");



	//On affiche le tout
?>
<table align='center' class='small' width='550'>
	<tr>
		<td colspan=4 class='title2'>
			<table class='title2' width='100%'>
				<tr>
					<td id='button' width='30%'><?php
						if ($ent==0)
						echo '<a href="index.php?page=citoyencreer">NOUVEAU</a>';
					?></td>
					<td width='40%'><font color='FF0000'><?php  if(isset($_SESSION['erreur'])) echo $_SESSION['erreur'];else echo '&nbsp;';?> </font></td>
					<td id='button' width='30%'><?php
						if ($ent == 1)
						echo "<a href='index.php?page=citoyen&status=0'><b>VIVANTS</b></a>";
						else
						echo "<a href='index.php?page=citoyen&status=1'><b>CIMETIERE : ".$nb2."</b></a>";
					?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan=6 align=center bgcolor=BC6600></td>
	</tr>
	<?php
	//Si il n'y a aucun resultat, on affiche qu'il n'y en a pas
	if ($nb == 0)
	{
		if ($ent==0)
		echo"
	<tr height='175'>
		<td colspan='6' align=center>Tu n'as aucun citoyen (clique sur NOUVEAU)</td>
	</tr>
		";
		else
		echo"
	<tr height='175'>
		<td colspan='6' align=center>Le cimetière est vide</td>
	</tr>
		";
	}else//Sinon, on affiche les resultat
	{
        foreach($tabPersos as $perso)
        {
			if($perso->isDead() && $ent==0) continue;
			if(!$perso->isDead() && $ent==1) continue;

		echo "
	<tr valign=bottom height='60'>
		<td width='100%' align=center valign=bottom colspan=3>
			<table class='color1' width='100%'>
				<tr>
					<td align=center>
						<font size =4>".$perso->getNom()."</font>
					</td>
				</tr>
			</table>
			";
		if($perso->getVie() > 0 )
		{
		echo"

			<table class='button' width='100%'>
				<tr>
					<td id='button' align=center>
						<a href='index.php?page=perso&perso=".$perso->getId()."'>";
							echo "GESTION
						</a>
					</td>
				</tr>
			</table>
		</td>
			";
		}else
		{
			if ($ent ==0)
				echo"
			<table class='button'>
				<tr>
					<td id='button'>
						<a href='index.php?page=citoyensuppok&perso=".$perso->getNom()."'>ENTERRER</a>
					</td>
				</tr>
			</table>
		</td>
				";
			else
				echo"
						<font size=4>&nbsp;</font>
		</td>
				";
		}
		//On affiche les jours de vagues, l'argent, la vie, la photo, la date et l'heure de l'insciption, la photo de l'arme et du piege.


			echo"

		<td rowspan='2' align=center background='pic/".$perso->getAvatar().".JPG' width='130' hight='70'>
			";
			if ($perso->getVie() == 0)
				echo"<img src='pic/rouge.png' width='185' height='170'></td>";
			else
				echo"<a href='index.php?page=perso&perso=".$perso->getId()."'><img src='pic/blanc.png' width='185' height='170'></a></td>";


		echo"
	</tr>
	<tr >";
		if($perso->getVie() > 0 )
		{
			echo"
				<td align='center' >
					<table class='hev'>
						<tr>
							<td align=center>";
					echo"NIVEAU<br><font color='CC6600' size=6>".$perso->getLevel()."</font>";
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
								<b>A SURVECUS<br><font color='CC6600' size=3>".$perso->getNb_vague()."</font><br>VAGUE</b>
							</td>
						</tr>
					</table>
				</td>
			";
		}
		echo"
		<td width='200' align=center>
			";
			//Si le piege du perso et différent de rien, on affiche la photo, sinon on affiche qu'il n'en a pas

			echo"
			<table class='hev'>
				<tr>
					<td align=center>
						<font size=5><b>EXP</b></font><br><font color=FFFF00 size=2><b>".$perso->getXp()."</b></font>
					</td>

				</tr>
			</table>
				";

		echo"
		</td>
		<td>";


		echo"
	<table class='hev'>

		<tr align=center>
			<td>
				<table class='button' width='100'>
					<tr>
						<td class='small' width='100%'>
							<img src='image.php?img=viergev.png&h=10&d=1' width='".$perso->getVie()."%' height='10'>
						</td>
					</tr>
				</table>
				<br>
				<table class='button' width='100'>
					<tr>
						<td class='small' width='100%'>";
						$pourcEn = (($perso->getEnergie()/$perso->getMaxEnergie())*100);
						echo"
							<img src='image.php?img=viergeb.png&h=10&d=1' width='".(($pourcEn>100)?100:$pourcEn)."%' height='10'>
						</td>
					</tr>
				</table>
				<br>
				<table class='button' width='100'>
					<tr>
						<td class='small' width='100%'>";
										$pourc=floor((($perso->getXp()-Perso::getXpForLevel($perso->getLevel())) / ($perso->getXpForNextLevel()-Perso::getXpForLevel($perso->getLevel())))*100);
										if($pourc < 0) $pourc = 0;
										if($pourc>100) $pourc = 100;
									echo"
									<img src='image.php?img=viergej.png&h=10&d=1' width='".$pourc."%' height='10'>
						</td>
					</tr>
				</table>
			</td>
		</tr>

	</table>
	";

	echo"
		</td>
	</tr>
	<tr>
		<td colspan=6 align=center bgcolor=BC6600></td>
	</tr>";
		}
	}
    echo"
</table>";
$_SESSION['erreur']='';
?>
