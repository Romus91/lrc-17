<?php include_once("verif.php");
$id=mysql_fetch_array(mysql_query("SELECT id FROM membre WHERE login = '".$_SESSION['login']."'"));?>
<table width='100%' align='left' class='small'>
<?php if ($id[0] == 4):?>
	<tr>
		<td>
			<form action='index.php?page=maj' method='post' name='wall'>
				<table class='small' width='100%'>
					<tr class="button">
						<td id='button'><a href='index.php?page=maj'>ACTUALISER</a></td>
					</tr>
					<tr>
						<td class='title2'><b>Message : </b>
						</td>
					</tr>
					<tr>
						<td align=center><textarea name='message' cols='60' rows='3'></textarea>
						</td>
					</tr>
					<tr>
						<td align=center><input type='submit' name='go' value='Envoyer'>
						</td>
					</tr>
				</table>
				<script>document.wall.message.focus();</script>
			</form>
		</td>
	</tr>
	<?php if (($_POST['go']=='Envoyer') AND ($_POST['message'] <> ''))
	{
		//si tout a �t� bien rempli, on ins�re le message dans la table SQL
		$sql = 'INSERT INTO maj(date,id_expediteur,message) VALUES( "'.date("H:i:s").'","'.$_SESSION['login'].'", "'.mysql_escape_string($_POST['message']).'")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$sql = "UPDATE membre SET majtimestamp = (SELECT MAX( timestamp ) FROM maj) WHERE login ='".$_SESSION['login']."'";
		mysql_query($sql);
	}
	endif;

	$sql = "UPDATE membre SET majtimestamp = (SELECT MAX( timestamp ) FROM maj) WHERE login ='".$_SESSION['login']."'";
	mysql_query($sql);
	// on pr�pare une requete SQL cherchant tous les dates, message ainsi que l'auteur des messages  par ordre d�croissant en se limitant � 10 message
	$sql = 'SELECT date,id_expediteur,message,id,timestamp FROM maj ORDER BY id DESC LIMIT 0,15 ';
	// lancement de la requete SQL
	$res = ConnectionSingleton::connect()->prepare($sql);
	$res->execute();
	$data = $res->fetchAll(PDO::FETCH_OBJ);
	$i=0;
	?>

	<tr>
		<td align=center class='color4' colspan=2>&nbsp;</td>
	</tr>
	<?php
	foreach ($data as $item):
		$statement = 'select * from votemaj where id_maj = :maj and vote = :vote;';

		$req = ConnectionSingleton::connect()->prepare($statement);
		$req->execute(array('maj'=>$item->id,'vote'=>1));
		$voteup = $req->rowCount();

		$req = ConnectionSingleton::connect()->prepare($statement);
		$req->execute(array('maj'=>$item->id,'vote'=>-1));
		$votedown = $req->rowCount();
		?>
	<tr>
	<?php if ($i < $cpt):?>
		<td>
			<p><font size=3><?php echo $item->date;?></font></p>
			<p><font color=FF6600><?php echo $item->message?></font></p>
		</td>
	<?php else: ?>
		<td>
			<p><font size=3><?php echo $item->date;?></font></p>
			<p><?php echo $item->message?></font></p>
		</td>
	<?php endif;?>
		<td align=right width="100px" style="padding:5px;">
			<div class="vote">
				<div><a href="votemaj.php?maj=<?php echo $item->id;?>&vote=up"><img src="pic/thumb_up.png"></a></div>
				<div align=center><font color="00cc00"><?php echo $voteup;?></font></div>
			</div>
			<div class="vote">
				<div><a href="votemaj.php?maj=<?php echo $item->id;?>&vote=down"><img src="pic/thumb_down.png"></a></div>
				<div align=center><font color="cc0000"><?php echo $votedown;?></font></div>
			</div>
		</td>
	</tr>
	<tr>
		<td align=center class='color4' colspan=2>&nbsp;</td>
	</tr>
	<?php $i++;
	endforeach;?>
</table>
