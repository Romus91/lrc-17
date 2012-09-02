<?php
require_once 'autoload.php';
require_once 'verif.php';

if(isset($_GET['maj'])&&isset($_GET['vote'])){
	$maj = (int) htmlentities($_GET['maj']);
	$vote = htmlentities($_GET['vote']);

	$query = 'select * from votemaj where id_maj = :maj and id_membre = :mem';
	$req = ConnectionSingleton::connect()->prepare($query);
	$req->execute(array('maj'=>$maj,'mem'=>$_SESSION['member_id']));
	$count = $req->rowCount();
	if($count > 0){
		echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=maj');</script>";
		exit;
	}else{
		if($vote=='up'){
			$vote=1;
		}else if($vote=='down'){
			$vote=-1;
		}else{
			echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=maj');</script>";
			exit;
		}
		$query = 'insert into votemaj (id_maj,id_membre,vote) values (:maj,:mem,:vote);';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('maj'=>$maj,'mem'=>$_SESSION['member_id'],'vote'=>$vote));
		echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=maj');</script>";
		exit;
	}
}else{
	echo "<script language='javascript' type='text/javascript'>window.location.replace('index.php?page=maj');</script>";
	exit;
}
?>