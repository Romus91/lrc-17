<?php

include_once("verif.php");
include_once("pass.php");
$loginOnline=mysql_fetch_array(mysql_query("SELECT id FROM online WHERE login =  '".$_SESSION['login']."'"));
$time=date("Y-m-j H:i:s");
if ($loginOnline['id'])
{
	mysql_query("UPDATE online SET timestamp = '".$time."' WHERE login = '".$_SESSION['login']."'");
}else
mysql_query("INSERT INTO online (login,member_id) VALUES ('".$_SESSION['login']."','".$_SESSION['member_id']."')");

$query=mysql_query("SELECT * FROM online");
$sql=mysql_query("SELECT * FROM online ORDER BY login ASC LIMIT 0,10");
while($delOnline=mysql_fetch_array($query))
{
	if (((strtotime($time))-(strtotime($delOnline['timestamp']))) > 100)
	mysql_query("DELETE FROM online WHERE id = ".$delOnline['id']."");
}

$query=mysql_fetch_array($sql);
echo getColoredUserLogin($query);

while ($query=mysql_fetch_array($sql)){
	echo ", ".getColoredUserLogin($query);
}

function getColoredUserLogin($input){
	$user=mysql_fetch_array(mysql_query("select * from membre where id = '".$input['member_id']."';"));
	return '<span class="role-'.$user['role'].'">'.$user['login'].'</span>';
}
?>