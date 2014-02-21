<?php
require_once 'autoload.php';

require_once 'lock.php';

$persoCont = new PersoController();
$query = 'select id from perso;';
$req = ConnectionSingleton::connect()->prepare($query);
$req->execute();

while($data = $req->fetch(PDO::FETCH_OBJ)){
	$perso = $persoCont->fetchPerso($data->id);
	if(!$perso->isDead()){
		$perso->addXpAfk();
		$persoCont->savePerso($perso);
	}
}



require_once 'unlock.php';