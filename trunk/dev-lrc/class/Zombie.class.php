<?php
class Zombie extends Monster{
	public function __construct(int $level){
		$this->setLevel($level);
		$this->setBaseExp(2);
		$this->setBaseLife(7);
		$this->setDamage(0.5);
		$this->setEnergyCost(0.3);
	}
}