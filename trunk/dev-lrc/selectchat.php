<?php
include_once("verif.php");
include_once("pass.php");
$nb=mysql_fetch_array(mysql_query("SELECT count(message) FROM chat"));
$query=mysql_query("SELECT * FROM chat ORDER BY timestamp ASC LIMIT ".(($nb[0]<15)?0:$nb[0]-15).",".$nb[0]."");
while ($mess=mysql_fetch_array($query))
{
	echo "<div class='small'>
			<div style='float:left;'><font color='CC6600'>".$mess['login']."</font> </div>
			<div style='float:right;' > ".$mess['timestamp']."</div>
		</div>
		<div class='color1' style='clear:both;'> ".$mess['message']."</div>";
}
?>