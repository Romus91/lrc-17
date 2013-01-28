<?php include_once("verif.php");

$memCont = new MemberController();
$membre = $memCont->fetchMembre($_SESSION['member_id']);

$tabPerso = $persoController->fetchMembre($membre->getId());

$nb2=0;
/*foreach($tabPerso as $perso){
	$nb2+=(($perso->isDead())?1:0);
}*/
$nb2=mysql_num_rows(mysql_query("SELECT * FROM perso WHERE id_membre = ".$membre->getId()." AND vie > 0"));
/*
$req = mysql_query('SELECT count(*) FROM perso WHERE id_membre = "'.$_SESSION['login'].'" AND enterrer = 0');
$nb = mysql_fetch_array($req);
*/
if ($nb2 >= $membre->getNbPersoMax()){
	echo '<script language="javascript" type="text/javascript">window.location.replace("index.php?page=citoyen");</script>';
	$_SESSION['erreur']="Plus assez de place ! (".$membre->getNbPersoMax()." max)";
}
?>
<table align="center" class='small' width='100%'>
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
		<?php for($j=0;$j<4;$j++):?>
		<tr>
			<?php for($i=1;$i<=5;$i++):?>
			<td>
				<p><img src='<?php echo convertToCDNUrl('image.php?img='.(($j*5)+$i).'.JPG&w=133');?>' width="100%"></p>
				<p width="100%" align=center><input type= 'radio' name = 'photo' value = "<?php echo (($j*5)+$i);?>"></p>
			</td>
			<?php endfor;?>
		</tr>
		<?php endfor;?>
	    <tr>
			<td colspan=2 align=right>Son nom :</td><td colspan=2><input type="text" name="nom" maxlength='10' value="<?php  if (isset($_POST['nom'])) echo stripslashes(htmlentities(trim($_POST['nom']))); ?>" ></td>
	        <td><input type="submit" name="creer" value="Go !"></td>
	    </tr>
    </form>
</table>