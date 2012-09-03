<?php
require_once 'autoload.php';
require_once 'image.php';

$query = 'select * from perso;';
$req = ConnectionSingleton::connect()->prepare($query);
$req->execute();
$data = $req->fetchAll(PDO::FETCH_OBJ);

foreach($data as $p){
	if(imagepng(genImg($p->photo.'.JPG',207,0,$p->level),'ava/'.$p->id.'.png')){
		echo $p->id.' done !<br>';
	}else
		echo $p->id.' failed !<br>';
}