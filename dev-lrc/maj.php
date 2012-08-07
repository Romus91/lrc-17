<?php include ("verif.php");
$id=mysql_fetch_array(mysql_query("SELECT id FROM membre WHERE login = '".$_SESSION['login']."'"));?>
<center>
	<table width='550' align='left'  class='small'>
	<?php 
	if ($id[0] == 4)
	{
		echo "		
		<tr>
			<td>
			   <form action = 'index.php?page=maj' method='post' name='wall'>
					<table class='small' width='100%'>
						<tr>
							<td>
								<table class='button' width='100%'>
									<tr>
										<td id='button'>
											<a href='index.php?page=maj'>ACTUALISER</a>
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
								<textarea name='message' cols='60' rows='3' ></textarea>
							</td>
						</tr>
						<tr>
							<td align=center>
								<input type='submit' name='go' value='Envoyer'>
							</td>
						</tr>
					</table>
					<script>document.wall.message.focus()</script>
					</form>					
			</td>
		</tr>";
    if (($_POST['go']=='Envoyer') AND ($_POST['message'] <> '')) 
    {   
		//si tout a été bien rempli, on insère le message dans la table SQL 
		$sql = 'INSERT INTO maj(date,id_expediteur,message) VALUES( "'.date("H:i:s").'","'.$_SESSION['login'].'", "'.mysql_escape_string($_POST['message']).'")'; 
        mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$sql = "UPDATE membre SET majtimestamp = (SELECT MAX( timestamp ) FROM maj) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
    } 
 }   
	$sql = "UPDATE membre SET majtimestamp = (SELECT MAX( timestamp ) FROM maj) WHERE login ='".$_SESSION['login']."'";
	mysql_query($sql);
	// on prépare une requete SQL cherchant tous les dates, message ainsi que l'auteur des messages  par ordre décroissant en se limitant à 10 message
    $sql = 'SELECT date,id_expediteur,message,id,timestamp FROM maj ORDER BY id DESC LIMIT 0,15 ';  
	// lancement de la requete SQL 
	$res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());  
	
	echo"
	
		<tr>
			<td align=center class='color4'>&nbsp;</td>
		</tr>
		";
	$i=1;
	While($t=mysql_fetch_array($res))
    {
        if ($i <= $cpt) 
		{
			echo"
		  
		<tr>
			<td><font size = 3>",$t[4],"</font></td>
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
			<td><font size = 3>",$t[4],"</font></td>
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
	</table>
</center>
		";
		
?>