<?php
class Map{
	const DEFAULT_MAP_SIZE = 13;

	protected $map;
	protected $poi;
	protected $size;


	public function getMap(){
	    return $this->map;
	}

	public function getSize(){
	    return $this->size;
	}

	public function setMap($map){
	    $this->map = $map;
	    return $this;
	}

	public function setSize($size){
	    $this->size = $size;
	    return $this;
	}

	public function generate(){
		if($this->map==null){
			$this->map=array();
			$this->poi = array(false,false,false,false);
			$this->size = self::DEFAULT_MAP_SIZE;

			$xmax = $ymax = $this->size;

			//génération du tableau et de la map de base
			for($x=0;$x<$xmax;$x++){
				$this->map[$x]=array();
				for($y=0;$y<$ymax;$y++){
					if($y==0 || $y==$ymax-1 || $x==0 ||$x==$xmax-1){
						$this->setCell($x, $y, MapCell::TILE_WALL);
					}else{
						$this->setCell($x, $y, MapCell::TILE_GRASS);
					}
				}
			}

			//placement de la planque
			$x=floor($xmax/2);
			$y=floor($ymax/2);
			$this->setCell($x, $y, MapCell::TILE_PLANQUE);


			//randomisation de l'emplacement des resources
			$middlex = floor($xmax/2);
			$middley = floor($ymax/2);

			$nbresources=0;
			$q1=$q2=$q3=$q4=false;
			while(!$q1 || !$q2 || !$q3 || !$q4){
				$x = mt_rand(2,$xmax-3);
				$y = mt_rand(2,$ymax-3);

				$rand = mt_rand(1,10000);
				if($x<$middlex-2 && $y<$middley-2 && !$q1){
					//quadrant1
					if($rand<7500){
						//1seul chemin
						$rand = mt_rand(1, 10000);
						if($rand<5000) for($p=$x+1;$p<$middlex+2;$p++) $this->setCell($p, $y, MapCell::TILE_ROAD);
						else for($p=$y+1;$p<$middley+2;$p++) $this->setCell($x, $p, MapCell::TILE_ROAD);
					}else{
						//2chemins
						for($p=$x+1;$p<$middlex+2;$p++) $this->setCell($p, $y, MapCell::TILE_ROAD);
						for($p=$y+1;$p<$middley+2;$p++) $this->setCell($x, $p, MapCell::TILE_ROAD);
					}
					$this->setPOI($x, $y);
					$this->circleCell($x, $y, MapCell::TILE_ROAD);
					$q1=true;
				}else if($x>$middlex+2 && $y<$middley-2 && !$q2){
					//quadrant2
					if($rand<7500){
						//1seul chemin
						$rand = mt_rand(1, 10000);
						if($rand<5000) for($p=$x-1;$p>$middlex-2;$p--) $this->setCell($p, $y, MapCell::TILE_ROAD);
						else for($p=$y+1;$p<$middley+2;$p++) $this->setCell($x, $p, MapCell::TILE_ROAD);
					}else{
						//2chemins
						for($p=$x-1;$p>$middlex-2;$p--)	$this->setCell($p, $y, MapCell::TILE_ROAD);
						for($p=$y+1;$p<$middley+2;$p++)	$this->setCell($x, $p, MapCell::TILE_ROAD);
					}
					$this->setPOI($x, $y);
					$this->circleCell($x, $y, MapCell::TILE_ROAD);
					$q2=true;
				}else if($x>$middlex+2 && $y>$middley+2 && !$q3){
					//quadrant3
					if($rand<7500){
						//1seul chemin
						$rand = mt_rand(1, 10000);
						if($rand<5000) for($p=$x-1;$p>$middlex-2;$p--) $this->setCell($p, $y, MapCell::TILE_ROAD);
						else for($p=$y-1;$p>$middley-2;$p--) $this->setCell($x, $p, MapCell::TILE_ROAD);
					}else{
						//2chemins
						for($p=$x-1;$p>$middlex-2;$p--) $this->setCell($p, $y, MapCell::TILE_ROAD);
						for($p=$y-1;$p>$middley-2;$p--) $this->setCell($x, $p, MapCell::TILE_ROAD);
					}
					$this->setPOI($x, $y);
					$this->circleCell($x, $y, MapCell::TILE_ROAD);
					$q3=true;
				}else if($x<$middlex-2 && $y>$middley+2 && !$q4){
					//quadrant4
					if($rand<7500){
						//1seul chemin
						$rand = mt_rand(1, 10000);
						if($rand<5000) for($p=$x+1;$p<$middlex+2;$p++) $this->setCell($p, $y, MapCell::TILE_ROAD);
						else for($p=$y-1;$p>$middley-2;$p--) $this->setCell($x, $p, MapCell::TILE_ROAD);
					}else{
						//2chemins
						for($p=$x+1;$p<$middlex+2;$p++) $this->setCell($p, $y, MapCell::TILE_ROAD);
						for($p=$y-1;$p>$middley-2;$p--) $this->setCell($x, $p, MapCell::TILE_ROAD);
					}
					$this->setPOI($x, $y);
					$this->circleCell($x, $y, MapCell::TILE_ROAD);
					$q4=true;
				}

			}

			//génération des routes principales
			//nord
			$d=-1;
			for($p=$middley-1;$this->map[$middlex][$p]->getTileType()!=MapCell::TILE_WALL;$p--){
				if($this->map[$middlex][$p]->getTileType()==MapCell::TILE_ROAD){
					$d=$p;
				}
			}
			if($d!=-1) {
				for($j=$middley-1;$j>$d-2;$j--) {
					$this->setCell($middlex, $j, MapCell::TILE_ROAD);
				}
			}
			//est
			$d=-1;
			for($p=$middlex-1;$this->map[$p][$middley]->getTileType()!=MapCell::TILE_WALL;$p--){
				if($this->map[$p][$middley]->getTileType()==MapCell::TILE_ROAD){
					$d=$p;
				}
			}
			if($d!=-1) {
				for($j=$middlex-1;$j>$d-2;$j--) {
					$this->setCell($j, $middley, MapCell::TILE_ROAD);
				}
			}
			//sud
			$d=-1;
			for($p=$middley+1;$this->map[$middlex][$p]->getTileType()!=MapCell::TILE_WALL;$p++){
				if($this->map[$middlex][$p]->getTileType()==MapCell::TILE_ROAD){
					$d=$p;
				}
			}
			if($d!=-1) {
				for($j=$middley+1;$j<$d+2;$j++) {
					$this->setCell($middlex, $j, MapCell::TILE_ROAD);
				}
			}
			//ouest
			$d=-1;
			for($p=$middlex+1;$this->map[$p][$middley]->getTileType()!=MapCell::TILE_WALL;$p++){
				if($this->map[$p][$middley]->getTileType()==MapCell::TILE_ROAD){
					$d=$p;
				}
			}
			if($d!=-1) {
				for($j=$middlex+1;$j<$d+2;$j++) {
					$this->setCell($j, $middley, MapCell::TILE_ROAD);
				}
			}

			$this->circleCell($middlex, $middley, MapCell::TILE_ROAD);
		}else{
			throw new Exception("Map already generated");
		}

	}

	public function setCell($x,$y,$tile){
		if(!isset($this->map[$x][$y]) || $this->map[$x][$y]==null){
			$this->map[$x][$y] = new MapCell($x,$y,$tile);
		}else{
			$this->map[$x][$y]->setTileType($tile);
		}
	}

	public function circleCell($x,$y,$tile){
		$this->setCell($x-1, $y-1, $tile);
		$this->setCell($x-1, $y, $tile);
		$this->setCell($x-1, $y+1, $tile);
		$this->setCell($x, $y-1, $tile);
		$this->setCell($x, $y+1, $tile);
		$this->setCell($x+1, $y-1, $tile);
		$this->setCell($x+1, $y, $tile);
		$this->setCell($x+1, $y+1, $tile);
	}

	public function setPOI($x,$y){
		$rand;
		for($rand=mt_rand(0, 3);$this->poi[$rand];$rand=mt_rand(0, 3));
		switch($rand){
			case 0 :
				$this->poi[$rand]=true;
				$this->setCell($x, $y, MapCell::TILE_SCIERIE);
				break;
			case 1 :
				$this->poi[$rand]=true;
				$this->setCell($x, $y, MapCell::TILE_USINE);
				break;
			case 2 :
				$this->poi[$rand]=true;
				$this->setCell($x, $y, MapCell::TILE_HOSTO);
				break;
			case 3 :
				$this->poi[$rand]=true;
				$this->setCell($x, $y, MapCell::TILE_ENTREPOT);
				break;
		}
	}

}