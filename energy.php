<?php
	require_once 'autoload.php';
	$persoCont = new PersoController();
	$query = 'select id from perso;';
	$req = ConnectionSingleton::connect()->prepare($query);
	$req->execute();

	$times=array();

	while($data = $req->fetch(PDO::FETCH_OBJ)){
		$start = microtime(true);
		$perso = $persoCont->fetchPerso($data->id);
		if(!$perso->isDead()){
			$perso->regenEnergie();
			$perso->regenVie();
			$persoCont->savePerso($perso);
			$times[]=microtime(true)-$start;
		}
	}

	$max = floor(max($times)*100000)/100;
	$min = floor(min($times)*100000)/100;

	$mean = floor((array_sum($times)/count($times)*100000))/100;

	echo 'Moyenne : '.$mean.' ms | max : '.$max.' | min : '.$min;

?>