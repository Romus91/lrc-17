<?php
require_once 'autoload.php';

$i=(int)htmlentities($_GET['i']);
$p=(int)htmlentities($_GET['perso']);

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso($p);

require_once 'pass.php';

$inv=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$perso->getId().""));
$arm=mysql_fetch_array(mysql_query("SELECT * FROM armes WHERE image = '".$inv['arm'.$i]."'"));
$value=(($arm['prix']/2));
?>

<table class='small' width='100%' height='30'>
	<tr>
		<td align=center><font size=3>VENDRE <?php echo $arm['nom'];?> ? </font>
		</td>
	</tr>
</table>
<table class='button' width='100%' height='35'>
	<tr valign=top>
		<td align=center>
			<font size=4 color="00FF00"> + <?php echo $value; ?>$</font>
		</td>
	</tr>
</table>
<table width=100%>
	<tr>
		<td>
			<table class='button'>
				<tr>
					<td align=center id='button' class='vendrearme'>
						<a href='armevendreok.php?perso=<?php echo $perso->getId();?>&i=<?php echo $i;?>'>OK</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript" language="javascript" src="vendrearme.js"></script>
