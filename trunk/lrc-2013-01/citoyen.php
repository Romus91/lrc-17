<?php
	include_once ("verif.php");
?>
<?php
	//Affichage des perso du membre connecté
	$ent=0;
	if (isset($_GET['status'])) $ent = (int) htmlentities($_GET['status']);

	$tabPersos = $persoController->fetchMembreAlive($_SESSION['member_id']);
	$tabDead = $persoController->fetchMembreDead($_SESSION['member_id']);
	$nb=count($tabPersos);
	$nb2=count($tabDead);

?>
<table align='center' class='small' width='100%'>
	<tr>
		<td colspan=4 class='title2'>
			<table class='title2' width='100%'>
				<tr>
					<td width='70%'><font color='FF0000'><?php  if(isset($_SESSION['erreur'])) echo $_SESSION['erreur'];else echo '&nbsp;';?> </font></td>
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
	<?php if($nb2 == 0 && $ent==1):?>
	<tr height='175'>
		<td colspan='6' align=center>Le cimetière est vide</td>
	</tr>
	<?php endif;
	if($ent==0) include_once 'citoyen_vivant.php';
	if($nb2>0 && $ent==1) include_once 'citoyen_mort.php';?>
</table>
<?php $_SESSION['erreur']='';?>
