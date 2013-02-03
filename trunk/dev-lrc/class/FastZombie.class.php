<?php
class FastZombie extends Monster{
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(7);
		$this->setBaseLife(10);
		$this->setDamage(1.2);
		$this->setEnergyCost(1);
	}
}