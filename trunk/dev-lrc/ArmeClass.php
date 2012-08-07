<?php
	
class Arme{
	protected $_id;
	protected $_nom;
	protected $_image;
	protected $_munmax;
	protected $_prix;
	protected $_prixballes;
	protected $_lvlrequis;
	protected $_force;
	protected $_precision;
	protected $_munitions;
	protected $_ordre;
	protected $_amForce;
	protected $_amPrecision;
	protected $_amCapa;
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}
	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
		return $this;
	}
	/**
	 * @return the $_nom
	 */
	public function getNom() {
		return $this->_nom;
	}
	/**
	 * @param field_type $_nom
	 */
	public function setNom($_nom) {
		$this->_nom = $_nom;
		return $this;
	}
	/**
	 * @return the $_image
	 */
	public function getImage() {
		return $this->_image;
	}
	/**
	 * @param field_type $_image
	 */
	public function setImage($_image) {
		$this->_image = $_image;
		return $this;
	}
	/**
	 * @return the $_munmax
	 */
	public function getMunmax() {
		return $this->_munmax;
	}
	/**
	 * @param field_type $_munmax
	 */
	public function setMunmax($_munmax) {
		$this->_munmax = $_munmax;
		return $this;
	}
	/**
	 * @return the $_prix
	 */
	public function getPrix() {
		return $this->_prix;
	}
	/**
	 * @param field_type $_prix
	 */
	public function setPrix($_prix) {
		$this->_prix = $_prix;
		return $this;
	}
	/**
	 * @return the $_prixballes
	 */
	public function getPrixballes() {
		return $this->_prixballes;
	}
	/**
	 * @param field_type $_prixballes
	 */
	public function setPrixballes($_prixballes) {
		$this->_prixballes = $_prixballes;
		return $this;
	}
	/**
	 * @return the $_lvlrequis
	 */
	public function getLvlrequis() {
		return $this->_lvlrequis;
	}
	/**
	 * @param field_type $_lvlrequis
	 */
	public function setLvlrequis($_lvlrequis) {
		$this->_lvlrequis = $_lvlrequis;
		return $this;
	}
	/**
	 * @return the $_force
	 */
	public function getForce() {
		return $this->_force;
	}
	/**
	 * @param field_type $_force
	 */
	public function setForce($_force) {
		$this->_force = $_force;
		return $this;
	}
	/**
	 * @return the $_precision
	 */
	public function getPrecision() {
		return $this->_precision;
	}
	/**
	 * @param field_type $_precision
	 */
	public function setPrecision($_precision) {
		$this->_precision = $_precision;
		return $this;
	}
	public function getMunitions(){
		return $this->_munitions;
	}
	public function setMunitions($mun){
		$this->_munitions = (int) $mun;
		return $this;
	}
	public function addMunitions($mun){
		$this->_munitions += (int) $mun;
		if($this->_munitions > $this->getCapacity()) $this->setMunitions($this->getCapacity());
		return $this;
	}
	public function getOrdre(){
		return $this->_ordre;
	}
	public function setOrdre($o){
		$this->_ordre = (int) $o;
		return $this;
	}
	public function setAmPreci($amP){
		$this->_amPrecision = (int) $amP;
		return $this;
	}
	public function setAmCapa($amC){
		$this->_amCapa = (int) $amC;
		return $this;
	}
	public function setAmForce($amF){
		$this->_amForce = (int) $amF;
		return $this;
	}
	public function getAmPreci(){
		return $this->_amPrecision;
	}
	public function getAmCapa(){
		return $this->_amCapa;
	}
	public function getAmForce(){
		return $this->_amForce;
	}
	public function addAmPreci(){
		$this->_amPrecision++;
		return $this;
	}
	public function addAmCapa(){
		$this->_amCapa++;
		return $this;
	}
	public function addAmForce(){
		$this->_amForce++;
		return $this;
	}
	public function getHitChance(){
		return 1-(2/(3+($this->_precision*(1+($this->_amPrecision/10)))));
	}
	public function getDamage(){
		return $this->_force*(1+($this->_amForce/10));
	}
	public function getCapacity(){
		return $this->_munmax*(1+($this->_amCapa/10));
	}
}
?>