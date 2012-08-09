<?php

class Perso{
	//id
	protected $_id;
	protected $_id_planque;
	protected $_id_membre;
	//Stats invariables
	protected $_nom;
	protected $_avatar;
	protected $_date_created;
	//jauges
	protected $_vie;
	protected $_energie;
	protected $_argent;
	//xp&leveling
	protected $_xp;
	protected $_level;
	protected $_dead;
	//caracteristiques
	protected $_endurance;
	protected $_dexterite;
	protected $_esquive;
	//statistiques de jeu
	protected $_nb_vague;
	protected $_nb_crabe_kill;
	protected $_nb_zomb_kill;
	protected $_nb_zfast_kill;
	protected $_nb_zpois_kill;
	//améliorations
	protected $_nbPtsAmMax;
	protected $_nbPtsAmDispo;
	//inventaire
	protected $_invArme;
	protected $_invPiege;
	protected $_invConso;

	public function __set($name, $value){
		$method = 'set'.$name;
		if(($name == 'mapper') || !method_exists($this, $method)){
			throw new Exception('Invalid perso property');
		}
		$this->$method($value);
	}
	public function __get($name){
		$method = 'get'.$name;
		if(($name=='mapper')||!method_exists($this, $method)){
			throw new Exception('Invalid perso property');
		}
		return $this->$method();
	}
	public function getId(){
		return $this->_id;
	}
	public function setId($id){
		$this->_id=(int) $id;
		return $this;
	}
	public function getId_planque(){
		return $this->_id_planque;
	}
	public function setId_planque($id_planque){
		$this->_id_planque = (int) $id_planque;
		return $this;
	}
	public function getId_membre(){
		return $this->_id_membre;
	}
	public function setId_membre($id_membre){
		$this->_id_membre = (int)$id_membre;
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
	 * @return the $_avatar
	 */
	public function getAvatar() {
		return $this->_avatar;
	}
	/**
	 * @param field_type $_avatar
	 */
	public function setAvatar($_avatar) {
		$this->_avatar = $_avatar;
		return $this;
	}
	/**
	 * @return the $_date_created
	 */
	public function getDate_created() {
		return $this->_date_created;
	}
	/**
	 * @param field_type $_date_created
	 */
	public function setDate_created($_date_created) {
		$this->_date_created = $_date_created;
		return $this;
	}
	/**
	 * @return the $_vie
	 */
	public function getVie() {
		return $this->_vie;
	}
	/**
	 * @param field_type $_vie
	 */
	public function setVie($_vie) {
		$this->_vie = $_vie;
		return $this;
	}
	/**
	 * @return the $_energie
	 */
	public function getEnergie() {
		return $this->_energie;
	}
	/**
	 * @param field_type $_energie
	 */
	public function setEnergie($_energie) {
		$this->_energie = $_energie;
		return $this;
	}
	/**
	 * @return the $_argent
	 */
	public function getArgent() {
		return $this->_argent;
	}
	/**
	 * @param field_type $_argent
	 */
	public function setArgent($_argent) {
		$this->_argent = $_argent;
		return $this;
	}
	/**
	 * @return the $_xp
	 */
	public function getXp() {
		return $this->_xp;
	}
	/**
	 * @param field_type $_xp
	 */
	public function setXp($_xp) {
		$this->_xp = $_xp;
		return $this;
	}
	/**
	 * @return the $_level
	 */
	public function getLevel() {
		return $this->_level;
	}
	/**
	 * @param field_type $_level
	 */
	public function setLevel($_level) {
		$this->_level = $_level;
		return $this;
	}
	/**
	 * @return the $_endurance
	 */
	public function getEndurance() {
		return $this->_endurance;
	}
	/**
	 * @param field_type $_endurance
	 */
	public function setEndurance($_endurance) {
		$this->_endurance = $_endurance;
		return $this;
	}
	/**
	 * @return the $_dexterite
	 */
	public function getDexterite() {
		return $this->_dexterite;
	}
	/**
	 * @param field_type $_dexterite
	 */
	public function setDexterite($_dexterite) {
		$this->_dexterite = $_dexterite;
		return $this;
	}
	/**
	 * @return the $_esquive
	 */
	public function getEsquive() {
		return $this->_esquive;
	}
	/**
	 * @param field_type $_esquive
	 */
	public function setEsquive($_esquive) {
		$this->_esquive = $_esquive;
		return $this;
	}
	/**
	 * @return the $_nb_vague
	 */
	public function getNb_vague() {
		return $this->_nb_vague;
	}
	/**
	 * @param field_type $_nb_vague
	 */
	public function setNb_vague($_nb_vague) {
		$this->_nb_vague = $_nb_vague;
		return $this;
	}
	/**
	 * @return the $_nb_crabe_kill
	 */
	public function getNb_crabe_kill() {
		return $this->_nb_crabe_kill;
	}
	/**
	 * @param field_type $_nb_crabe_kill
	 */
	public function setNb_crabe_kill($_nb_crabe_kill) {
		$this->_nb_crabe_kill = $_nb_crabe_kill;
		return $this;
	}
	/**
	 * @return the $_nb_zomb_kill
	 */
	public function getNb_zomb_kill() {
		return $this->_nb_zomb_kill;
	}
	/**
	 * @param field_type $_nb_zomb_kill
	 */
	public function setNb_zomb_kill($_nb_zomb_kill) {
		$this->_nb_zomb_kill = $_nb_zomb_kill;
		return $this;
	}
	/**
	 * @return the $_nb_zfast_kill
	 */
	public function getNb_zfast_kill() {
		return $this->_nb_zfast_kill;
	}
	/**
	 * @param field_type $_nb_zfast_kill
	 */
	public function setNb_zfast_kill($_nb_zfast_kill) {
		$this->_nb_zfast_kill = $_nb_zfast_kill;
		return $this;
	}
	/**
	 * @return the $_nb_zpois_kill
	 */
	public function getNb_zpois_kill() {
		return $this->_nb_zpois_kill;
	}
	/**
	 * @param field_type $_nb_zpois_kill
	 */
	public function setNb_zpois_kill($_nb_zpois_kill) {
		$this->_nb_zpois_kill = $_nb_zpois_kill;
		return $this;
	}
	public function isDead(){
		return $this->_dead;
	}
	public function setDead(){
		$this->_dead=(($this->vie==0)?true:false);
		return $this;
	}
	public function getMaxEnergie(){
		return 100+(10*($this->getLevel()-1))+(10*$this->getEndurance());
	}
	public function getComfort(){
		return 1+($this->getEndurance());
	}
	public function regenEnergie(){
		if($this->_energie<$this->getMaxEnergie() && !$this->isDead()) $this->_energie++;
		if($this->_energie<$this->getMaxEnergie() && !$this->isDead()){
			for($i=0;$i<25;$i++) $rand = rand(1,50);
			if($rand<=$this->getComfort()) $this->_energie++;
		}
		return $this;
	}
	public function regenVie(){
		if ($this->_vie<100 && !$this->isDead()) $this->_vie++;
		return $this;
	}
	public function levelUp($stat){
		$choix =  (int)$stat;
		switch ($choix) {
			case 0:
				//endurance
				$this->_endurance++;
			break;
			case 1:
				//dexterite
				$this->_dexterite++;
			break;
			case 2:
				//esquive
				$this->_esquive++;
			break;
		}
		$this->_nbPtsAmMax+=1;
		$this->_nbPtsAmDispo+=1;
		$this->_level++;
	}
	public function addXP($xp){
		$this->_xp+=(int)$xp;
		return $this;
	}
	public function addVie($vie){
		$this->_vie+=(int)$vie;
		if($this->getVie() > 100) $this->setVie(100);
		return $this;
	}
	public function addEnergie($energie){
		$this->_energie+=(int)$energie;
		if($this->getEnergie() > $this->getMaxEnergie()) $this->setEnergie($this->getMaxEnergie());
		return $this;
	}
	public function addArgent($argent){
		$this->_argent+=(int)$argent;
		if($this->getArgent() < 0) $this->setArgent(0);
		return $this;
	}
	public static function getXpForLevel($i){
		if($i==1) return 1;
		else return 2*pow($i,3)+3*pow($i,2)+(self::getXpForLevel($i-1)/1.75)+15;
	}
	public function getXpForNextLevel(){
		return self::getXpForLevel($this->getLevel()+1);
	}
	public function getNbPtsAmMax(){
		return $this->_nbPtsAmMax;
	}
	public function getNbPtsAmDispo(){
		return $this->_nbPtsAmDispo;
	}
	public function setNbPtsAmMax($am){
		$this->_nbPtsAmMax = (int) $am;
		return $this;
	}
	public function setNbPtsAmDispo($am){
		$this->_nbPtsAmDispo = (int) $am;
		return $this;
	}
	public function addPtsAmDispo($am){
		$this->_nbPtsAmDispo+=(int) $am;
		if($this->_nbPtsAmDispo > $this->_nbPtsAmMax) $this->_nbPtsAmDispo=$this->_nbPtsAmMax;
		return $this;
	}
	public function setInvArme($tab){
		$this->_invArme = $tab;
		return $this;
	}
	public function getInvArme(){
		return $this->_invArme;
	}
	public function setInvPiege($tab){
		$this->_invPiege = $tab;
		return $this;
	}
	public function getInvPiege(){
		return $this->_invPiege;
	}
	public function setInvConso($tab){
		$this->_invConso = $tab;
		return $this;
	}
	public function getInvConso(){
		return $this->_invConso;
	}
	public function getTauxEsquive(){
		return floor((1-(1/(4+($this->_esquive/1.5))))*10000)/100;
	}
	public function damage($amount){
		$rating = $this->getTauxEsquive()*100;
		for($i=0;$i<25;$i++) $rand = rand(1,10000);
		if($rand<=$rating) return 0;
		else return $amount;
	}
	public function getPrecision(){
		return floor((1-(1/(4+($this->_dexterite/1.5))))*10000)/100;
	}
}