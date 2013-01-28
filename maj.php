<?php include_once("verif.php");?>
<table width='100%' align='left' class='small'>
	<tr class="button">
		<td id='button' colspan="2"><a href='index.php?page=maj'>ACTUALISER</a></td>
	</tr>
<?php if ($mem->getRole()=='admin'||$mem->getRole()=='dev'):?>
	<tr>
		<td width="100%" colspan="2">
			<form action='index.php?page=maj' method='post' name='wall'>
				<table class='small' width='100%'>

					<tr>
						<td class='title2'><b>Message : </b>
						</td>
					</tr>
					<tr>
						<td align=center><textarea name='message' cols='70' rows='5'></textarea>
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
	<?php if (isset($_POST['go']) && $_POST['go']=='Envoyer' && !empty($_POST['message'])){
		//si tout a été bien rempli, on insère le message dans la table SQL
		$sql = 'INSERT INTO maj(date,id_expediteur,message) VALUES( "'.date("H:i:s").'","'.$mem->getLogin().'", "'.mysql_escape_string($_POST['message']).'")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$sql = "UPDATE membre SET majtimestamp = (SELECT MAX( timestamp ) FROM maj) WHERE login ='".$mem->getLogin()."'";
		mysql_query($sql);
	}
	endif;

	$sql = "UPDATE membre SET majtimestamp = (SELECT MAX( timestamp ) FROM maj) WHERE login ='".$mem->getLogin()."'";
	mysql_query($sql);
	// on prépare une requete SQL cherchant tous les dates, message ainsi que l'auteur des messages  par ordre décroissant en se limitant à 10 message
	$sql = 'SELECT date,id_expediteur,message,id,timestamp FROM maj ORDER BY id DESC LIMIT 0,30 ';
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
			<p><font size=3><?php echo date("d/m/Y H:i:s",strtotime($item->timestamp));?></font></p>
			<p><font color=FF6600><?php echo $item->message?></font></p>
		</td>
	<?php else: ?>
		<td>
			<p><font size=3><?php echo date("d/m/Y H:i:s",strtotime($item->timestamp));?></font></p>
			<p><?php echo $item->message?></p>
		</td>
	<?php endif;?>
		<td align=right width="75px" style="padding:5px;" valign="bottom">
			<div class="vote">
				<div><a href="votemaj.php?maj=<?php echo $item->id;?>&vote=up"><img src="<?php echo convertToCDNUrl('pic/thumb_up.png');?>"></a></div>
				<div class="votecount" style="background-color: #00cc00;" align=center><font color="white"><?php echo $voteup;?></font></div>
			</div>
			<div class="vote">
				<div><a href="votemaj.php?maj=<?php echo $item->id;?>&vote=down"><img src="<?php echo convertToCDNUrl('pic/thumb_down.png');?>"></a></div>
				<div class="votecount" style="background-color: #ff0000;" align=center><font color="white"><?php echo $votedown;?></font></div>
			</div>
		</td>
	</tr>
	<tr>
		<td align=center class='color4' colspan=2>&nbsp;</td>
	</tr>
	<?php $i++;
	endforeach;?>
</table>
