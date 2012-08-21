<?php include_once("verif.php");

$tabPerso = $persoController->fetchMembre($_SESSION['member_id']);

$nb2=0;
/*foreach($tabPerso as $perso){
	$nb2+=(($perso->isDead())?1:0);
}*/
$nb2=mysql_num_rows(mysql_query("SELECT * FROM perso WHERE id_membre = ".$_SESSION['member_id']." AND vie > 0"));
/*
$req = mysql_query('SELECT count(*) FROM perso WHERE id_membre = "'.$_SESSION['login'].'" AND enterrer = 0');
$nb = mysql_fetch_array($req);
*/
if ($nb2 >= 5){
	echo '<script language="javascript" type="text/javascript">window.location.replace("index.php?page=citoyen");</script>';
	$_SESSION['erreur']="Plus assez de place ! (5 max)";
}
?>
<center>
<table align="center" class='small' width='550'>
	<tr>
		<td colspan=5 class='title2'>
			<table class='title2' width='100%'>
				<tr>
					<td>
						<table class='button'>
							<tr>
								<td id='button'>
									<a href="index.php?page=citoyen">RETOUR</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<tD colspan=5 class='title' align=center>
		<?php
			if (isset($erreur))
				echo $erreur;
			else
				echo "UN NOUVEAU CITOYEN EST ARRIVE !";
		?>
		</td>
	</tr>
<form action = "index.php?page=citoyencreerok" method="post">
	<tr>
		<?php  for ($i=1;$i<=5;$i++)
				echo"
		<td>
			<img src='image.php?img=".$i.".JPG&w=105'>
		</td>
					";
		?>
	</tr>
	<tr>
		<?php  for ($i=1;$i<=5;$i++)
				echo"
		<td align=center bgcolor='333333'>
			<input type= 'radio' name = 'photo' value = ".$i.">
		</td>
					";
		?>
	</tr>

	<tr>
		<?php  for ($i=6;$i<=10;$i++)
				echo"
		<td>
			<img src='image.php?img=".$i.".JPG&w=105'>
		</td>
					";
		?>
	</tr>
	<tr>
		<?php  for ($i=6;$i<=10;$i++)
				echo"
		<td align=center bgcolor='333333'>
			<input type= 'radio' name = 'photo' value = ".$i.">
		</td>
					";
		?>
	</tr>

	<tr>
		<?php  for ($i=11;$i<=15;$i++)
				echo"
		<td>
			<img src='image.php?img=".$i.".JPG&w=105'>
		</td>
					";
		?>
	</tr>
	<tr>
		<?php  for ($i=11;$i<=15;$i++)
				echo"
		<td align=center bgcolor='333333'>
			<input type= 'radio' name = 'photo' value = ".$i.">
		</td>
					";
		?>
	</tr>

	<tr>
		<?php  for ($i=16;$i<=20;$i++)
				echo"
		<td>
			<img src='image.php?img=".$i.".JPG&w=105'>
		</td>
					";
		?>
	</tr>
	<tr>
		<?php  for ($i=16;$i<=20;$i++)
				echo"
		<td align=center bgcolor='333333'>
			<input type= 'radio' name = 'photo' value = ".$i.">
		</td>
					";
		?>
	</tr>
    <tr>
		<td colspan=2 align=right>Son nom :</td><td colspan=2><input type="text" name="nom" maxlength='10' value="<?php  if (isset($_POST['nom'])) echo stripslashes(htmlentities(trim($_POST['nom']))); ?>" ></td>
        <td><input type="submit" name="creer" value="Go !"></td>
    </tr>
</table>