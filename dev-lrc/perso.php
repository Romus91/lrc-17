<?php
	include_once ("verif.php");

	$idMembre = $_SESSION['member_id'];
	$idPerso = (int) htmlentities($_GET['perso']);
	$perso=$persoController->fetchPerso($idPerso);

	if($idMembre!=$perso->getId_membre()){
		echo '<script language="javascript" type="text/javascript">
				window.location.replace("deconnexion.php");
			</script>';
		exit;
	}

	include_once 'pass.php';

	if ($perso->getVie()==0)
	{
		echo '<script language="javascript" type="text/javascript">
				window.location.replace("index.php?page=citoyen");
			</script>';
	}

	if ($_SESSION['erreur'] == false)
	{
		if ((!isset($_GET['onglet'])) OR ($_GET['onglet'] == 'infop'))
			$_SESSION['text']="INFOS GENERALE";
		if (isset($_GET['onglet'])&&$_GET['onglet'] == 'achat')
		{
			if(isset($_GET['cat'])&&(($_GET['cat'] == 'armes') OR ($_GET['cat'] == 'pieges') OR ($_GET['cat'] == 'mun')))
				$_SESSION['text']="ARMURERIE";
			if(isset($_GET['cat'])&&$_GET['cat'] == 'vie')
				$_SESSION['text']="SOINS";
		}
		if (isset($_GET['onglet'])&&$_GET['onglet'] == 'levelup') $_SESSION['text']="LEVEL UP";
	}
?>
	<center>
	<table class='small' align=center width='550'>
		<tr>
			<td colspan=4>
				<table class='small' width='100%'>
					<tr>
						<td class='small'>
							<font class="error" size=3>
								<?php echo $_SESSION['text'];?>
							</font>
						</td>
						<td class='small' align=right>
							<font size=5>
								<span id='prix'><?php  echo $perso->getArgent();?></span>
								<font color=1EB117>$</font>
							</font>
						</td>
					</tr>
				</table>
				<table class='button' width='100%'>
					<tr>
						<td id='button' align=center>
							<a href="index.php?page=citoyen"><-</a>
						</td>
						<td id='button' align=center <?php  if (!isset($_GET['onglet']) or (($_GET['onglet'] == '') OR ($_GET['onglet'] == 'infop'))) echo "class='current_page_item'";?>>
							<a href='index.php?page=perso&perso=<?php  echo $perso->getId();?>'><?php  echo $perso->getNom();?></a>
						</td>
						<td id='button' <?php  if (isset($_GET['cat'])&&$_GET['cat'] == 'armes') echo "class='current_page_item'";?> align=center>
							<a href="index.php?page=perso&onglet=achat&cat=armes&perso=<?php echo $perso->getId();?>">ARMES</a>
						</td>
						<td id='button' <?php  if (isset($_GET['cat'])&&$_GET['cat'] == 'pieges') echo "class='current_page_item'";?> align=center>
							<a href="index.php?page=perso&onglet=achat&cat=pieges&perso=<?php echo $perso->getId();?>">PIEGES</a>
						</td>
						<td id='button' <?php  if (isset($_GET['cat'])&&$_GET['cat'] == 'vie') echo "class='current_page_item'";?> align=center>
							<a href="index.php?page=perso&onglet=achat&cat=vie&perso=<?php echo $perso->getId();?>">CONSO</a>
						</td>
						<td id='button' align=center>
						<?php
								if ($perso->getEnergie() > 0&&$perso->getLevelPercent()<100){
									echo"
											<a href='index.php?page=vague&perso=".$perso->getId()."' ><font color='FF0000'>VAGUE</font></a>
									";
								}
						?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	<?php
	if ((!isset($_GET['onglet'])) OR ($_GET['onglet'] == 'infop')) include ("infop.php");
	if (isset($_GET['onglet'])&&$_GET['onglet'] == 'achat') include ("achat.php");
		?>