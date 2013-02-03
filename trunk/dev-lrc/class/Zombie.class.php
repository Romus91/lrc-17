<?php
class Zombie extends Monster{
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(2);
		$this->setBaseLife(15);
		$this->setDamage(0.7);
		$this->setEnergyCost(0.3);
	}
}