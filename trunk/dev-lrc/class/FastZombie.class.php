<?php
class FastZombie extends Monster{
	const MONEY = 30;
	public function __construct($level){
		$this->setLevel((int)$level);
		$this->setBaseExp(7);
		$this->setBaseLife(10);
		$this->setDamage(1.2);
		$this->setEnergyCost(1);
	}
}