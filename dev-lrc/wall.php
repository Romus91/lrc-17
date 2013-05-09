<?php include_once ("verif.php");?>
<center>
	<table width='100%' align='left'  class='small'>
		<tr>
			<td>
			   <form action = "index.php?page=wall" method="post" name="wall">
					<table class='small' width='100%'>
						<tr>
							<td>
								<table class='small' width='100%'>
									<tr>
										<td class='button'>
											<a href="index.php?page=wall">ACTUALISER</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class='title2'>
								<b>Message : </b>
							</td>
						</tr>
						<tr>
							<td align=center>
								<textarea name="message" cols="60" rows="3" ></textarea>
							</td>
						</tr>
						<tr>
							<td align=center>
								<input type="submit" name="go" value="Envoyer">
							</td>
						</tr>
					</table>
				</form>
				<script>document.wall.message.focus()</script>
			</td>
		</tr>
<?php

	$cptwall=0;
   	$sql="SELECT messages.timestamp, membre.walltimestamp FROM messages, membre WHERE membre.id =  '".$_SESSION['member_id']."' AND messages.timestamp > membre.walltimestamp";
   	$res=mysql_query($sql);
    while($t=mysql_fetch_array($res)){
    	$cptwall++;
    }

    $sql = "UPDATE  membre SET walltimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
    mysql_query($sql);

    if (isset($_POST['go']) AND($_POST['go']=='Envoyer') AND ($_POST['message'] <> ''))
    {
		$count = mysql_fetch_array(mysql_query("SELECT login FROM membre WHERE login =  '".mysql_real_escape_string($_SESSION['login'])."'"));
		if ($count[0])
		{

			//si tout a été bien rempli, on insère le message dans la table SQL
			$sql = 'INSERT INTO messages(date,id_expediteur,id_membre,message) VALUES( "'.date("H:i:s").'","'.mysql_real_escape_string($_SESSION['login']).'",'.$_SESSION['member_id'].', "'.mysql_real_escape_string($_POST['message']).'")';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
			$sql = "UPDATE  membre SET walltimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
			mysql_query($sql);
		}
    }





	$data=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as nbArticle FROM messages"));

	//Affiche 30 logs et calcule le nombre de log par page
	$nbArticle = $data['nbArticle'];
	$perPage = 15;
	$nbPage = ceil($nbArticle /$perPage);

	// p = numéro de la page
	if(isset($_GET['nb']) && $_GET['nb']>0 && $_GET['nb']<=$nbPage)
	{
		$cPage = $_GET['nb'];
	} else
	{
		$cPage = $_GET['nb'] = 1;
	}


	// on prépare une requete SQL cherchant tous les dates, message ainsi que l'auteur des messages  par ordre décroissant en se limitant à 10 message
    $sql = 'SELECT date,id_expediteur,message,id,timestamp FROM messages ORDER BY id DESC LIMIT '.(($cPage-1)*$perPage).', '.$perPage.' ';
	// lancement de la requete SQL
	$res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	echo"
	<tr>
		<td class='color4'>
			<table class='title2' width='100%'>
				<tr>
					<td >";
						$i = $cPage; $i--;
						if ($i != 0)
						{
							echo ('<a href="index.php?page=wall&nb='.$i.'">PRECEDENT</a>');
						}else
							echo ("PRECEDENT");

				echo"</td><td align=center> | ";
				for ($i=1; $i <= $nbPage ;$i++)
				{
					if ($_GET['nb'] == $i)
						echo $i." | ";
					else
						echo  "<a href='index.php?page=wall&nb=".$i."'>".$i."</a> | ";

				}
				echo"</td><td align='right'>";

						$i = $cPage; $i++;
						if ($i <= $nbPage)
						{
							echo ('<a href="index.php?page=wall&nb='.$i.'">SUIVANT</a>');
						}else
							echo ("SUIVANT");
					echo"
					</td>
				</tr>
			</table>
		</td>
	</tr>
		";
	$i=1;
	While($t=mysql_fetch_array($res))
    {
        if ($i <= $cptwall)
		{
			echo"

		<tr>
			<td>",$t[4]," -- <b>",$t[1],"</b></td>
		</tr>
		<tr>
			<td><font color=FF6600>",$t[2],"</font></td>
		</tr>
		<tr>
			<td align=center class='color4'>&nbsp;</td>
		</tr>
				";
		}
        else
		{
			echo"
		<tr>
			<td>",$t[4]," -- <b>",$t[1],"</b></td>
		</tr>
		<tr>
			<td>",$t[2],"</td>
		</tr>
		<tr>
			<td align=center class='color4'>&nbsp;</td>
		</tr>
				";
		}
            $i++;
    }
    echo"
	<tr>
		<td class='color4'>
			<table class='title2' width='100%'>
				<tr>
					<td >";
						$i = $cPage; $i--;
						if ($i != 0)
						{
							echo ('<a href="index.php?page=wall&nb='.$i.'">PRECEDENT</a>');
						}else
							echo ("PRECEDENT");

			echo"</td><td align=center>| ";

				for ($i=1; $i <= $nbPage ;$i++)
				{
					if ($_GET['nb'] == $i)
						echo $i." | ";
					else
						echo  "<a href='index.php?page=wall&nb=".$i."'>".$i."</a> | ";

				}
				echo"</td><td align='right'>";

						$i = $cPage; $i++;
						if ($i <= $nbPage)
						{
							echo ('<a href="index.php?page=wall&nb='.$i.'">SUIVANT</a>');
						}else
							echo ("SUIVANT");
					echo"
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class='color4'>
			&nbsp;
		</td>
	</tr>
	</table>
</center>
		";

?>