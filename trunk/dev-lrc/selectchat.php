<?php
include_once("verif.php");
include_once("pass.php");
$length=15;
$nb=mysql_fetch_array(mysql_query("SELECT count(id) FROM chat"));
$query=mysql_query("SELECT * FROM chat ORDER BY timestamp ASC LIMIT ".(($nb[0]<$length)?0:$nb[0]-$length).",".$nb[0]."");
while ($mess=mysql_fetch_array($query))
{
	echo "<div class='small' style='clear:both;'>
			<div style='float:left;'><font color='CC6600'>".$mess['login']."</font> </div>
			<div style='float:right;' > ".date("d/m H:i:s",strtotime($mess['timestamp']))."</div>
		</div>";
	if($mess['message'])
		echo "<div class='color1' style='clear:both;'> ".$mess['message']."</div>";
}
?>