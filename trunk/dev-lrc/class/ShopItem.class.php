<?php

class ShopItem{
	protected $id;
	protected $name;
	protected $prix;
	protected $levelRequis;
	protected $image;
	protected $descrip;
	protected $categ;

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function getPrix(){
		return $this->prix;
	}

	public function getLevelRequis(){
		return $this->levelRequis;
	}

	public function getImage(){
		return $this->image;
	}

	public function getCateg(){
		return $this->categId;
	}

	public function getDescrip(){
		return $this->descrip;
	}

	public function setId($id){
		$this->id = $id;
		return $this;
	}

	public function setName($name){
		$this->name = $name;
		return $this;
	}

	public function setPrix($prix){
		$this->prix = $prix;
		return $this;
	}

	public function setLevelRequis($levelRequis){
		$this->levelRequis = $levelRequis;
		return $this;
	}

	public function setImage($image){
		$this->image = $image;
		return $this;
	}

	public function setCateg(ShopCateg $categId){
		$this->categId = $categId;
		return $this;
	}

	public function setDescrip($descrip){
		$this->descrip = $descrip;
		return $this;
	}
}

?>