<?php
class PoisonZombie extends Monster{
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(100);
		$this->setBaseLife(50);
		$this->setDamage(1.6);
		$this->setEnergyCost(0.5);
	}
}