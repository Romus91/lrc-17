<?php
require_once 'autoload.php';

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

include_once("pass.php");
$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
$arm=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inv['arm'.$i]."'"));

$max = $arm['munmax']+($arm['munmax']*($inv['capa'.$i]/10));
$nbmun = $max - $inv['mun'.$i];
?>
<table class='small' width='100%' height='30'>
	<tr>
		<td align=center><font size=3>RECHARGER</font></td>
	</tr>
</table>
<table>
	<tr>
	<?php 	if($nbmun>0) echo "<td>Acheter ".$nbmun." balles pour ".($nbmun*$arm['prixballes'])." $ ? (".$arm['prixballes']."$ / balle)</td>";
			else echo "<td><p>Arme d&eacute;j&#224; recharg&eacute;e !</p></td>"?>
	</tr>
</table>
<table width=100%>
	<tr>
		<td><?php
			if($nbmun>0)
			echo"<table class='button'  >
				<tr>
					<td align=center id='button' class='achatmunarme'>
						<a href='achatmunarme.php?perso=".$p."&arme=".$i."'>OK</a>
					</td>
				</tr>
			</table>";
			?>
		</td>
	</tr>
</table>
<script type="text/javascript" language="javascript" src="rechargearme.js"></script>