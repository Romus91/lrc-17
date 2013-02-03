<?php
class Crab extends Monster{
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(1);
		$this->setBaseLife(5);
		$this->setDamage(0.2);
		$this->setEnergyCost(0.2);
	}
}