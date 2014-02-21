<?php
class WaveGenerator{
	protected $_level;
	protected $_nb_crab;
	protected $_nb_zomb;
	protected $_nb_fast;
	protected $_nb_pois;
	protected $_wave;

	public function __construct($level){
		$this->_level = (int) $level;
		$this->computeCrab();
		$this->computeZombie();
		$this->computeFast();
		$this->computePoison();
		$this->_wave = $this->buildWave();
	}

	private function computeCrab(){
		$nb = floor($this->_level*1.426);
		$this->_nb_crab=$nb+mt_rand(-floor($this->_level/15),floor($this->_level/15));
	}
	private function computeZombie(){
		$nb = ceil($this->_level*0.725);
		$this->_nb_zomb=$nb+mt_rand(-floor($this->_level/15),floor($this->_level/15));
	}
	private function computeFast(){
		$nb=ceil($this->_level*0.415);
		$this->_nb_fast=$nb+mt_rand(-floor($this->_level/15),floor($this->_level/15));
	}
	private function computePoison(){
		$nb=floor($this->_level/10)-1;
		if($nb>=0){
			$this->_nb_pois= $nb;
			$reste = $this->_level % 10;
			$pct = $reste*10000;
			$rand=mt_rand(1,100000);
			if($rand<=$pct){
				$this->_nb_pois++;
			}
		}else{
			$this->_nb_pois=0;
		}
	}
	private function buildWave(){
		$z=$this->_nb_zomb;
		$p=$this->_nb_pois;
		$c=$this->_nb_crab;
		$f=$this->_nb_fast;
		$wave = array();
		$shuffle=0;
		while($z>0 || $p>0 || $c>0 || $f>0){
			$choix = mt_rand(0,3);
			$level = mt_rand((($this->_level-1>1)?$this->_level-1:1),(($this->_level+1>1)?$this->_level+1:1));
			switch($choix){
				case 0 : //zombie
					if($z>0){
						$wave[] = new Zombie($level);
						$z--;
					}
					break;
				case 1 : //fast
					if($f>0){
						$wave[] = new FastZombie($level);
						$f--;
					}
					break;
				case 2 : //poison
					if($p>0){
						$wave[] = new PoisonZombie($level);
						$p--;
					}
					break;
				case 3 : //crab
					if($c>0){
						$wave[] = new Crab($level);
						$c--;
					}
					break;
			}
		}
		//shuffle($wave);
		return $wave;
	}
	public function getLevel(){return $this->_level;}
	public function getNbCrab(){return $this->_nb_crab;}
	public function getNbZomb(){return $this->_nb_zomb;}
	public function getNbFast(){return $this->_nb_fast;}
	public function getNbPois(){return $this->_nb_pois;}
	public function getWave(){return $this->_wave;}
}