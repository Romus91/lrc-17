<?php

class ShopItemController{

	public function fetchAll(){
		$query='select id from shop order by categ_id';
		$req= ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tabItem = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$item= $this->fetchItem($data->id);
			$tabItem[]=$item;
		}
		return $tabItem;
	}

	public function fetchItem($id){
		$shopCatCont = new ShopCategController();
		$query='select * from shop where id = :id';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':id', $id,PDO::PARAM_INT);
		$req->execute();
		$data=$req->fetch(PDO::FETCH_OBJ);
		$item = new ShopItem();
		$item	->setId($data->id)
				->setName($data->name)
				->setLevelRequis($data->level_requis)
				->setPrix($data->prix)
				->setImage($data->image)
				->setCateg($shopCatCont->fetchCateg($data->categ_id));
		return $item;
	}

	public function fetchByCateg(ShopCateg $cat) {
		$query='select * from shop where categ_id = :cat order by id';
		$req=ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':cat', $cat->getId());
		$req->execute();
		$tab = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$item = new ShopItem();
			$item	->setId($data->id)
					->setName($data->name)
					->setLevelRequis($data->level_requis)
					->setPrix($data->prix)
					->setImage($data->image)
					->setCateg($cat);
			$tab[]=$item;
		}
		return $tab;
	}
}