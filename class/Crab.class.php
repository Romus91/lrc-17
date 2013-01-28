<?php
class Crab extends Monster{
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(1);
		$this->setBaseLife(1);
		$this->setDamage(0.25);
		$this->setEnergyCost(0.2);
	}
}