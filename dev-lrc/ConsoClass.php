<?php

class Conso{
	protected $_id;
	protected $_valeurBase;
	protected $_prixBase;
	protected $_levelRequis;
	protected $_image;
	protected $_type;
	
	public function getId(){
		return $this->_id;
	}
	public function setId($id){
		$this->_id = (int) $id;
		return $this;
	}
	public function getValeurBase(){
		return $this->_valeurBase;
	}
	public function setValeurBase($val){
		$this->_valeurBase = (int) $val;
		return $this;
	}
	public function getPrixBase(){
		return $this->_prixBase;
	}
	public function setPrixBase($pb){
		$this->_prixBase = (int) $pb;
		return $this;
	}
	public function getLevelRequis(){
		return $this->_levelRequis;
	}
	public function setLevelRequis($lr){
		$this->_levelRequis = (int) $lr;
		return $this;
	}
	public function getImage(){
		return $this->_image;
	}
	public function setImage($img){
		$this->_image = $img;
		return $this;
	}
	public function getType(){
		return $this->_type;
	}
	public function setType($type){
		$this->_type = (int) $type;
		return $this;
	}
	public function getValeur($maxEnergie){
		return (($maxEnergie*$this->_valeur)/100);
	}
	public function getPrix($level){
		return (ceil($level/4)*$this->_prixBase);
	}
}