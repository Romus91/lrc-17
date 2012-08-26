<?php

abstract class Monster{
	protected $_baselife;
	protected $_level;
	protected $_baseexp;
	protected $_damage;
	protected $_energycost;

	public function getLife(){
		return $this->computeLife($this->_level);
	}
	private function computeLife($level){
		if($level==1) return $this->_baselife;
		else return round(1.03*$this->computeLife($level-1),3);
	}
	public function getExp(){
		return $this->computeExp($this->_level);
	}
	private function computeExp($level){
		if($level==1) return $this->_baseexp;
		else return round(1.015*$this->computeExp($level-1),3);
	}
	protected function setDamage(float $damage){
		$this->_damage = (float) $damage;
		return $this;
	}
	protected function setBaseLife(int $baselife){
		$this->_baselife = (int) $baselife;
		return $this;
	}
	protected function setBaseExp(int $baseexp){
		$this->_baseexp = (int) $baseexp;
		return $this;
	}
	protected function setLevel(int $level){
		$this->_level = (int) $level;
		return $this;
	}
	protected function setEnergyCost(float $enregycost){
		$this->_energycost = (float) $energycost;
		return $this;
	}
	public function getLevel(){
		return $this->_level;
	}
	public function getDamage(){
		return $this->_damage;
	}
	public function getEnergyCost(){
		return $this->_energycost;
	}
}