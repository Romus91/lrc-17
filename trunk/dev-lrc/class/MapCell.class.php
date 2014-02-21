<?php
class MapCell{
	const TILE_WALL = 0;
	const TILE_PLANQUE = 1;
	const TILE_ROAD = 2;

	const TILE_SCIERIE = 3;
	const TILE_USINE = 4;
	const TILE_HOSTO = 5;
	const TILE_ENTREPOT = 6;

	const TILE_GRASS = 9;

	protected $planqueId;

	protected $x;
	protected $y;
	protected $tileType;

	protected $nbWaveRemaining;
	protected $quantityRessource;

	public function __construct($x,$y,$type){
		$this->x=$x;
		$this->y=$y;
		$this->tileType=$type;
	}

	public function getX(){
	    return $this->x;
	}

	public function getY(){
	    return $this->y;
	}

	public function getTileType(){
	    return $this->tileType;
	}

	public function getPlanqueId(){
	    return $this->planqueId;
	}

	public function getNbWaveRemaining(){
	    return $this->nbWaveRemaining;
	}

	public function getQuantityRessource(){
	    return $this->quantityRessource;
	}

	public function setPlanqueId($planqueId){
	    $this->planqueId = $planqueId;
	    return $this;
	}

	public function setNbWaveRemaining($nbWaveRemaining){
	    $this->nbWaveRemaining = $nbWaveRemaining;
	    return $this;
	}

	public function setQuantityRessource($quantityRessource){
	    $this->quantityRessource = $quantityRessource;
	    return $this;
	}

	public function setX($x){
	    $this->x = $x;
	    return $this;
	}

	public function setY($y){
	    $this->y = $y;
	    return $this;
	}

	public function setTileType($tileType){
	    $this->tileType = $tileType;
	    return $this;
	}
}