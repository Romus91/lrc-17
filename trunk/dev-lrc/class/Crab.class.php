<?php
class Crab extends Monster{
	public function __construct(int $level){
		$this->setLevel($level);
		$this->setBaseExp(1);
		$this->setBaseLife(1);
		$this->setDamage(0.25);
		$this->setEnergyCost(0.2);
	}
}