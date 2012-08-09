<script type="text/javascript" language="javascript" src="stats.js"></script>

<?php
include_once("verif.php");
include_once("level.php");

$data=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as nbArticle FROM perso"));

//Affiche 30 logs et calcule le nombre de log par page
$nbArticle = $data['nbArticle'];
$perPage = 10;
$nbPage = ceil($nbArticle /$perPage);

// p = numéro de la page
if(isset($_GET['nb']) && $_GET['nb']>0 && $_GET['nb']<=$nbPage){
	$cPage = $_GET['nb'];
} else {
	$cPage = $_GET['nb'] = 1;
}

	echo "<table width='550' class='small'>
		<tr height=30>
			<td colspan=7 align=center class='title2'>
				<font size=3>CLASSEMENT</font>
			</td>
		</tr>
		<tr >
			<td  colspan=4>";
				$i = $cPage; $i--;
				if ($i != 0)
				{
					echo ('<a href="index.php?page=scores&nb='.$i.'">PRECEDENT</a>');
				}else
					echo ("PRECEDENT");

		echo"</td><td colspan=3 align=right>";

				$i = $cPage; $i++;
				if ($i <= $nbPage)
				{
					echo ('<a href="index.php?page=scores&nb='.$i.'">SUIVANT</a>');
				}else
					echo ("SUIVANT");
			echo"
			</td>
		</tr>
		<tr>
			<td align=center>&nbsp;</td>
			<td align=center>&nbsp;</td>
			<td align=center>RIP</td>
			<td align=center>CITOYEN</td>
			<td align=center>MEMBRE</td>
			<td align=center>EXP</td>
			<td align=center>NIVEAU</td>
		</tr>";


	$sql=mysql_query("SELECT * FROM perso ORDER BY competance DESC LIMIT ".(($cPage-1)*$perPage).", ".$perPage."");
	$i=(($_GET['nb']*10)-10)+1;
	while($perso=mysql_fetch_array($sql)){
		$membre=mysql_fetch_array(mysql_query('select * from membre where id = '.$perso['id_membre'].';'));
		$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso['id'].""));
		if ($i == 1)
			$bgcolor='ffc600';
		else
			if ($i == 2)
				$bgcolor='aaaaaa';
			else
				if ($i == 3)
					$bgcolor='ab7604';
						else
							$bgcolor='CC6600';
	echo "

	<tr class='perso' perso='http://".$_SERVER['HTTP_HOST']."/stats.php?id=".$perso['id']."' style='cursor:hand;'>
		<td bgcolor='".$bgcolor."' align=center><font size=4>".$i."</font></td>
		";
		if ($perso['vie'] == 0)
		{
			echo"<td align=center bgcolor='AA0000'><img src='pic/".$perso['photo'].".JPG' height='50'></td>
			<td class='color3' align=center width='20'><img src='pic/mort.png' width='20'></td>";
		}
		else
		{
			echo"<td align=center bgcolor='999999' width='30'><img src='pic/".$perso['photo'].".JPG' height='50'></td>
			<td class='color3' align=center width='20'>&nbsp;</td>";
		}

		echo "
		<td class='color4' align=center width='25%'>".$perso['nom']."</td>
		<td class='color3' align=center width='25%'>".$membre['login']."</td>
		<td class='color4' align=center width='20%'><font color='FFFF00' size=3>",$perso['competance'],"</font></td>
		<td class='color3' align=center width='10%'><font color='CC6600' size=4>".$perso['level']."</font></td>
	</tr>
	<tr class='stats' style='display:none;'>
		<td colspan=3 class='color3'>&nbsp;</td>
		<td class='color4' style='padding-left:3px;'><div>Endurance : ".$perso['endurance']."</div><div>Dexterite : ".$perso['dexterite']."</div><div>Esquive : ".$perso['esquive']."</div></td>
		<td colspan=3 class='color3'>";
		for($j=1;$j<=4;$j++)if($inv['arm'.$j]!=null) echo "<img src='pic/".$inv['arm'.$j].".png' height='40'>";
		for($j=1;$j<=2;$j++)if($inv['pie'.$j]!=null) echo "<img src='pic/".$inv['pie'.$j].".png' height='40'>";
		echo "</td>
	</tr>
	";
	$i++;
	}

    echo"
			<tr>
			<td  colspan=4>";
				$i = $cPage; $i--;
				if ($i != 0)
				{
					echo ('<a href="index.php?page=scores&nb='.$i.'">PRECEDENT</a>');
				}else
					echo ("PRECEDENT");

		echo"</td><td colspan=3 align=right>";

				$i = $cPage; $i++;
				if ($i <= $nbPage)
				{
					echo ('<a href="index.php?page=scores&nb='.$i.'">SUIVANT</a>');
				}else
					echo ("SUIVANT");
			echo"
			</td>
		</tr>
</table>";

?>
