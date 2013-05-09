<?php
class PoisonZombie extends Monster{
	const MONEY = 25;
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(100);
		$this->setBaseLife(75);
		$this->setDamage(1.6);
		$this->setEnergyCost(0.75);
	}
}