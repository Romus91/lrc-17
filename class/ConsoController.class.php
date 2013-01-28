<?php

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
	public function fetchPerso($id_perso){
		$query = 'select * from inv_conso where perso = :p;';
		$req = ConnectionSingleton::connect()->prepare($query);
		if($req->execute(array('p' => $id_perso))){
			$data = $req->fetchAll(PDO::FETCH_OBJ);
			$arr = array();
			for($i=0;$i<2;$i++){
				if(isset($data[$i]))
					$arr[] = $data[$i]->conso;
				else $arr[] = null;
			}
			return $arr;
		}
		return null;
	}
	public function addConso(Perso $p, Conso $c){
		$query = 'select count(*) as count from inv_conso where perso = :p;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('p'=>$p->getId()));
		$count = $req->fetch(PDO::FETCH_OBJ)->count;
		if($count<2){
			$query = 'insert into inv_conso (conso,perso) value (:cons,:p);';
			$req = ConnectionSingleton::connect()->prepare($query);
			return $req->execute(array('cons'=>$c->getId(),'p'=>$p->getId()));
		}else return false;
	}
	public function useConso(Perso $p, Conso $c){
		$query = 'delete from inv_conso where perso = :p and conso = :cons;';
		$req = ConnectionSingleton::connect()->prepare($query);
		return $req->execute(array('p'=>$p->getId(),'cons'=>$c->getId()));
	}
}