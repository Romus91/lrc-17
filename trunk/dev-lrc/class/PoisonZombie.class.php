<?php
class PoisonZombie extends Monster{
	public function __construct(int $level){
		$this->setLevel($level);
		$this->setBaseExp(100);
		$this->setBaseLife(50);
		$this->setDamage(6);
		$this->setEnergyCost(0.05);
	}
}