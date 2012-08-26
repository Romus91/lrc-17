<?php
class FastZombie extends Monster{
	public function __construct(int $level){
		$this->setLevel($level);
		$this->setBaseExp(7);
		$this->setBaseLife(4);
		$this->setDamage(1);
		$this->setEnergyCost(0.6);
	}
}