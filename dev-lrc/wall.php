<?php
include_once ("verif.php");
include_once 'pagination.php';
?>
<center>
	<table width='100%' align='left' class='small'>
		<tr>
			<td>
			   <form action = "index.php?page=wall" method="post" name="wall">
					<table class='small' width='100%'>
						<tr>
							<td class='button'>
								<a href="javascript:location.reload();">ACTUALISER</a>
							</td>
						</tr>
						<tr>
							<td class='title2'>
								<b>Message : </b>
							</td>
						</tr>
						<tr>
							<td align=center>
								<textarea name="message" cols="100" rows="5" placeholder="Entrez votre message ici..."></textarea>
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
    $sql = "UPDATE  membre SET walltimestamp = (SELECT MAX( TIMESTAMP ) FROM messages) WHERE login ='".$_SESSION['login']."'";
    mysql_query($sql);

    if (isset($_POST['go']) AND($_POST['go']=='Envoyer') AND ($_POST['message'] <> '')){
		$count = mysql_fetch_array(mysql_query("SELECT login FROM membre WHERE login =  '".mysql_real_escape_string($_SESSION['login'])."'"));
		if ($count[0])
		{
			//si tout a été bien rempli, on insère le message dans la table SQL
			$sql = 'INSERT INTO messages(date,id_expediteur,id_membre,message) VALUES( "'.date("H:i:s").'","'.mysql_real_escape_string($_SESSION['login']).'",'.$_SESSION['member_id'].', "'.mysql_real_escape_string(str_replace("\r\n", "<br>", htmlentities($_POST['message']))).'")';
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

	$cPage=1;
	if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbPage)	{
		$cPage = $_GET['p'];
	}

	$wallCont = new WallController();
	$messages = $wallCont->fetchRange((($cPage-1)*$perPage), $perPage);
?>
	<tr>
		<td>
			<?php echo pagination($perPage,$cPage,'index.php?page=wall&p=',$nbArticle);?>
		</td>
	</tr>
<?php
foreach ($messages as $key => $mess):
	if($key!=0):?>
	<tr><td align=center class='color6'>&nbsp;</td></tr>
	<?php endif;?>
	<tr><td><?php echo $mess->getTimestamp()?> -- <b><?php echo $mess->getMembre()->getLogin()?></b></td></tr>
	<tr>
		<?php if(strtotime($mess->getTimestamp())>strtotime($mem->getWallTimestamp())):?>
			<td class='unreadMsg'><?php echo $mess->getMessage()?></td>
		<?php else:?>
			<td><?php echo $mess->getMessage()?></td>
		<?php endif;?>
	</tr>
<?php endforeach;?>
	<tr>
		<td class='color6'>
			<div class='pagination-wrapper'><ul class='pagination pages'><li><a href="#top">Haut de la page</a></li></ul></div>
		</td>
	</tr>
	</table>
</center>
