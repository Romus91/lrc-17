<?php
require_once 'autoload.php';
$persoCont = new PersoController();
$req = ConnectionSingleton::connect()->prepare("select id from perso;");
$req->execute();
$data = $req->fetchAll(PDO::FETCH_OBJ);

$query = "insert into inv_conso (perso) value (:p);";
foreach ($data as $value) {
	$req = ConnectionSingleton::connect()->prepare($query);
	$req->execute(array('p'=>$value->id));
}