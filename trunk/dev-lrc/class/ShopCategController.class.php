<?php
class ShopCategController{
	public function fetchCateg($id){
		$query='select * from categ_shop where id = :id';
		$req =  ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$data=$req->fetch(PDO::FETCH_OBJ);
		$categ = new ShopCateg();
		$categ	->setId($data->id)
				->setName($data->name);
		return $categ;
	}
	public function fetchAll() {
		$query='select * from categ_shop order by name';
		$req =  ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tab=array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$categ = new ShopCateg();
			$categ	->setId($data->id)
					->setName($data->name);
			$tab[]=$categ;
		}
		return $tab;
	}
}