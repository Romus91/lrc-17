<?php
class AmelioCompte{
	protected $_niveau;
	protected $_type;
	protected $_level_requis;
	protected $_prix;
	protected $_image;
	const AM_PIERCE = 1;
	const AM_FRAG = 2;
	const AM_INV = 3;

	public function getNiveau(){return $this->_niveau;}
	public function getType(){return $this->_type;}
	public function getPrix(){return $this->_prix;}
	public function getLevelRequis(){return $this->_level_requis;}
	public function getImage(){return $this->_image;}

	public function setNiveau($arg){$this->_niveau=$arg;return $this;}
	public function setType($arg){$this->_type=$arg;return $this;}
	public function setPrix($arg){$this->_prix=$arg;return $this;}
	public function setLevelRequis($arg){$this->_level_requis=$arg;return $this;}
	public function setImage($arg){$this->_image = $arg;return $this;}
}