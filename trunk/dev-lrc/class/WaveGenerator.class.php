<?php
class WaveGenerator{
	protected $_level;
	protected $_nb_crab;
	protected $_nb_zomb;
	protected $_nb_fast;
	protected $_nb_pois;

	public function __construct(int $level){
		$this->_level = (int) $level;
		$this->computeCrab();
		$this->computeZombie();
		$this->computeFast();
		$this->computePoison();
	}

	private function computeCrab(){
		$this->_nb_crab=($this->_level*5)+mt_rand(-(floor($this->_level/8)),(floor($this->_level/8)));
	}
	private function computeZombie(){
		$this->_nb_zomb=($this->_level*3)+mt_rand(-(floor($this->_level/6)),(floor($this->_level/6)));
	}
	private function computeFast(){
		if($this->_level>1) $this->_nb_fast=($this->_level*2)+mt_rand(-(floor($this->_level/4)),(floor($this->_level/4)));
		else $this->_nb_fast=0;
	}
	private function computePoison(){
		$nb=floor($this->_level/10);
		$this->_nb_pois= mt_rand(0,$nb);

		/*$rand=mt_rand(10,99);
		if($this->_level >= $rand) $this->_nb_pois = floor($this->_level/10)+mt_rand(-1,1);
		else $this->_nb_pois=0;*/
	}
}