<?php

abstract class Monster{
	protected $_baselife;
	protected $_maxLife;
	protected $_life;
	protected $_level;
	protected $_baseexp;
	protected $_exp;
	protected $_damage;
	protected $_energycost;
	protected $_hit;

	public function getLife(){
		return $this->_life;
	}
	public function getMaxLife(){
		return $this->_maxLife;
	}
	public function getLifePercentage(){
		return  $this->_life/$this->_maxLife*100;
	}
	private function computeLife($level){
		return $this->_baselife*pow(1.003, $this->_level);
	}
	public function getExp(){
		return $this->_exp;
	}
	private function computeExp($level){
		return $this->_baseexp*pow(1.015, $this->_level);
	}
	protected function setDamage($damage){
		$this->_damage = $damage;
		return $this;
	}
	protected function setBaseLife($baselife){
		$this->_baselife = $baselife;
		$this->_life = $this->computeLife($this->_level);
		return $this;
	}
	protected function setBaseExp($baseexp){
		$this->_baseexp = $baseexp;
		$this->_exp = $this->computeExp($this->_level);
		return $this;
	}
	protected function setLevel($level){
		$this->_level = $level;
		return $this;
	}
	protected function setEnergyCost($energycost){
		$this->_energycost = $energycost;
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
	public function hit($dmg){
		$this->_hit+=$dmg;
		$this->_life-=$dmg;
	}
}