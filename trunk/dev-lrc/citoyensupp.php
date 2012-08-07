<?php include ("verif.php");?>
<table bgcolor=000000>
	<tr align=center >
		<td colspan=2 bgcolor=<?php  echo $_SESSION['couleur4']; ?>>Supprimer ton perso ? </td>
	</tr>
	<tr>
		<td bgcolor=<?php  echo $_SESSION['couleur4']; ?>>
			<a href="perso.php" onMouseOver="hiLite('e','e2','retour')" onMouseOut="hiLite('e','e1','')"><img name="e" src="page/retour1.gif" border=0 width="130" height="20"></a>
		</td>
		<td bgcolor=<?php  echo $_SESSION['couleur4']; ?>>
			<a href='citoyensuppok.php' onMouseOver="hiLite('h','h2','wall')" onMouseOut="hiLite('h','h1','')"><img name="h" src="page/supp1.gif" border=0 width='130' height='20'></a>
		</td>
    </tr>
</table>