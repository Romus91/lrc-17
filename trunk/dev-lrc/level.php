<?php
	function getLevel ($exp)
	{
		$sql=mysql_query("SELECT * FROM level");
		while ($levelid=mysql_fetch_array($sql))
		{
			if ($exp < $levelid['exp']){
				$level = $levelid['id'];
				break;
			}
		}
		mysql_free_result($sql);
		return $level-1;
	}
	
	/*mysql_query("UPDATE perso SET level = ".$level." WHERE nom = '".$nom."'");
	$level=mysql_fetch_array(mysql_query("SELECT level FROM perso WHERE  '".$login."' = id_membre and '".$nom."' = nom"));
	$t['level']=$level['level'];
	*/
	?>