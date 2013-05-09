<?php
require_once 'autoload.php';
include_once("verif.php");
include_once("pass.php");
$length=100;
if(!isset($_GET['time'])){
	$nb=mysql_fetch_array(mysql_query("SELECT count(id) FROM chat"));
	$query=mysql_query("SELECT * FROM chat ORDER BY timestamp ASC LIMIT ".(($nb[0]<$length)?0:$nb[0]-$length).",".$nb[0]."");
	$response = array('type'=>'initial','timestamp'=>microtime(true),'content'=>array());
	while ($mess=mysql_fetch_array($query))
	{
		$post = array('user'=>$mess['login'],'date'=>date("d/m H:i:s",$mess['timestamp']));
		if($mess['message'])
			$post['message']=$mess['message'];
		$response['content'][]=$post;
	}
	echo json_encode($response);
}else{
	$time= htmlspecialchars($_GET['time'], ENT_QUOTES, 'UTF-8');
	$req = ConnectionSingleton::connect()->prepare("select * from chat where timestamp >= :time and id_membre <> :id order by timestamp asc");
	$req->execute(array('time'=>$time,'id'=>$_SESSION['member_id']));
	$data = $req->fetchAll(PDO::FETCH_ASSOC);
	$response = array('type'=>'update','timestamp'=>microtime(true),'content'=>array());
	foreach ($data as $mess) {
		$post = array('user'=>$mess['login'],'date'=>date("H:i:s",$mess['timestamp']));
		if($mess['message'])
			$post['message']=$mess['message'];
		$response['content'][]=$post;
	}
	echo json_encode($response);
}
?>