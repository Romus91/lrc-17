<?php
class Zombie extends Monster{
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(2);
		$this->setBaseLife(7);
		$this->setDamage(0.5);
		$this->setEnergyCost(0.3);
	}
}