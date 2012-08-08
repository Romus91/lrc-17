<?php

require_once 'ConnectionSingleton.php';
require_once 'ConsoClass.php';

class ConsoController{
	public function fetchAll(){
		$query = 'select id from conso;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tabConso = array();
		while ($data=$req->fetch(PDO::FETCH_OBJ)){
			$conso = $this->fetch($data->id);
			$tabConso[] = $conso;
		}
		return $tabConso;
	}
	public function fetch($id){
		$query = 'select * from conso where id = :id';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id' => $id));
		$data = $req->fetch(PDO::FETCH_OBJ);
		$conso = new Conso();
		$conso	->setId($data->id)
				->setImage($data->image)
				->setLevelRequis($data->levelRequis)
				->setPrixBase($data->prixBase)
				->setType($data->type)
				->setValeurBase($data->valeurBase);
		return $conso;
	}
}