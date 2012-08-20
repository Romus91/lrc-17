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
	/*
	$nom=$_GET['perso'];
    $login=$_SESSION['login'];
    $sql = 'SELECT nom,photo,id_membre,argent,vie,date,jourvague,zombiekill,zombiepois,crabe,competance,zombiefast,id,level,energie FROM perso WHERE  "'.$login.'" = id_membre and "'.$nom.'" = nom';
    // lancement de la requete SQL
    $res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$t=mysql_fetch_array($res);

	$_SESSION['tune']=$t['argent'];
	$_SESSION['vie']=$t['vie'];

	$localtime=localtime($t['date'], true);
	$localtime['tm_sec']=0;
	$localtime['tm_min']=0;
	$localtime['tm_hour']=0; */

	include_once 'pass.php';

	$pourc=floor((($perso->getXp()-Perso::getXpForLevel($perso->getLevel())) / ($perso->getXpForNextLevel()-Perso::getXpForLevel($perso->getLevel())))*100);
	if ($pourc < 0) $pourc=0;

	include ("level.php");

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
							<font size=3>
								<?php echo $_SESSION['text'];?>
							</font>
						</td>
						<td class='small' align=right>
							<font size=5><div id='prix'><?php  echo $perso->getArgent();?></font>
							<font color=1EB117 size=5>$</font></div>
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
								if ($perso->getEnergie() > 0&&$pourc<100){
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
	if (isset($_GET['onglet'])&&$_GET['onglet'] =='levelup') include 'levelup.php';
		?>