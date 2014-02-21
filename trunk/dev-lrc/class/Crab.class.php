<?php
class Crab extends Monster{
	const MONEY = 3;
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(1);
		$this->setBaseLife(5);
		$this->setDamage(0.4);
		$this->setEnergyCost(0.1);
	}
}