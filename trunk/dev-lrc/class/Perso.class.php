<?php
class Perso{
	const POISON_DAMAGE_PER_TICK = 0.15;
	const MAX_JAUGE_POISON = 30;
	const MAX_WEAP = 6;
	const AVATAR_HEIGHT = 135;
	const REGEN_TICK_INTERVAL = 60;
	const LEVEL_UP_RES_BONUS_PERCENTAGE = 0.1;
	const MAX_VIE = 100;
	const MAX_LEVEL = 60;
	const BASE_ENERGY = 100;
	const ENERGY_MAX_BONUS_PER_LEVEL = 10;
	const ENERGY_MAX_BONUS_PER_STAMINA = 5;
	const NB_PT_AM_PER_LEVEL = 2;
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
	protected $_last_regen_vie;
	protected $_last_regen_nrg;
	//xp&leveling
	protected $_xp;
	protected $_level;
	protected $_dead;
	protected $_xpafk;
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
	//ameliorations
	protected $_nbPtsAmMax;
	protected $_nbPtsAmDispo;
	//inventaire
	protected $_invArme;
	protected $_invPiege;
	protected $_invConso;
	//combat
	protected $_poison;
	protected $_jauge_poison;

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
	 * @return the $_xp
	 */
	public function getXpWhenAfk() {
		return $this->_xpafk;
	}
	/**
	 * @param field_type $_xp
	 */
	public function setXpWhenAfk($_xp) {
		$this->_xpafk = $_xp;
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
	public function addNb_crabe_kill($_nb_crabe_kill) {
		$this->_nb_crabe_kill +=(int) $_nb_crabe_kill;
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
	public function addNb_zomb_kill($_nb_zomb_kill) {
		$this->_nb_zomb_kill +=(int) $_nb_zomb_kill;
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
	public function addNb_zfast_kill($_nb_zfast_kill) {
		$this->_nb_zfast_kill +=(int) $_nb_zfast_kill;
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
	public function addNb_zpois_kill($_nb_zpois_kill) {
		$this->_nb_zpois_kill +=(int) $_nb_zpois_kill;
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
		return self::BASE_ENERGY+(self::ENERGY_MAX_BONUS_PER_LEVEL*($this->getLevel()-1))+(self::ENERGY_MAX_BONUS_PER_STAMINA*$this->getEndurance());
	}
	public function getComfort(){
		return $this->getEndurance();
	}

	public function regenEnergie(){
		if(!$this->isDead()){
			//on recupere le timestamp actuel en microseconde
			$now = microtime(true);
			//on calcul l'interval de temps entre les deux
			$timeSinceLastRegen = $now - $this->_last_regen_nrg;

			//si le temps depuis la dernière update est plus grand que le temps entre deux ticks
			if($timeSinceLastRegen>$this->getTimeBetweenEnergyTick()){
				//le nombre de tick pendant l'interval
				$nbTick = $timeSinceLastRegen / $this->getTimeBetweenEnergyTick();
				//on tronque en un entier
				$nbRealTick = floor($nbTick);
				//on recupere le temps entre le dernier tick et maintenant
				$diff = $nbTick-$nbRealTick;
				if($nbRealTick>5000)$nbRealTick=5000;
				//on regen
				$this->_energie+=$nbRealTick;

				//on met à jour le timestamp de la dernière regen
				$this->_last_regen_nrg = $now-($diff*$this->getTimeBetweenEnergyTick());
				//on cap au max d'energie
				$this->_energie = min(
						array(
								$this->_energie,
								$this->getMaxEnergie()
						)
				);
			}
		}
		return $this;
	}

	public function getAbsoluteRegen(){
		return self::REGEN_TICK_INTERVAL/$this->getTimeBetweenEnergyTick();
	}
	public function getTimeBetweenEnergyTick(){
		return self::REGEN_TICK_INTERVAL - $this->getRegenDelayReduction();
	}
	private function getRegenDelayReduction(){
		return self::REGEN_TICK_INTERVAL*(1-(1/(1+$this->getComfort()/20)));
	}
	public function regenVie(){
		if(!$this->isDead()){
			$now = microtime(true);
			$timeSinceLastRegen = $now - $this->_last_regen_vie;
			if($timeSinceLastRegen>self::REGEN_TICK_INTERVAL){
				$nbTick = $timeSinceLastRegen / self::REGEN_TICK_INTERVAL;
				$nbRealTick = floor($nbTick);
				$diff = $nbTick-$nbRealTick;

				if($nbRealTick>5000) $nbRealTick=5000;

				for ($i = 0; $i < $nbRealTick; $i++) {
					if($this->_jauge_poison>0){
						$this->_jauge_poison--;
					}else if ($this->_vie<self::MAX_VIE){
						$this->_vie++;
					}
				}
				$this->_last_regen_vie = $now-($diff*self::REGEN_TICK_INTERVAL);
			}
		}
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
		$this->_nbPtsAmMax+=self::NB_PT_AM_PER_LEVEL;
		$this->_nbPtsAmDispo+=self::NB_PT_AM_PER_LEVEL;
		$this->_level++;

		$this->addVie(self::MAX_VIE*self::LEVEL_UP_RES_BONUS_PERCENTAGE);
		$this->addEnergie($this->getMaxEnergie()*self::LEVEL_UP_RES_BONUS_PERCENTAGE);
		$this->_jauge_poison-=self::MAX_JAUGE_POISON*self::LEVEL_UP_RES_BONUS_PERCENTAGE;

		if($this->_jauge_poison<0){
			$this->_jauge_poison=0;
		}
	}
	public function addXP($xp){
		if($this->_level<self::MAX_LEVEL){
			$this->_xp+=$xp;
		}
		return $this;
	}
	public function addXpAfk(){
		$amount= floor($this->_xp*0.01);
		$this->_xp-=$amount;
		$this->_xpafk+=$amount;
	}
	public function retribXp(){
		$coef = 0.25-(0.20*($this->_level/self::MAX_LEVEL));
		$amount= ceil($this->_xpafk*$coef);
		$this->_xp+=$amount;
		$this->_xpafk-=$amount;
		return $amount;
	}
	public function addVie($vie){
		$this->_vie+=$vie;
		if($this->getVie() > self::MAX_VIE) $this->setVie(self::MAX_VIE);
		return $this;
	}
	public function addEnergie($energie){
		$this->_energie+=$energie;
		if($this->getEnergie() > $this->getMaxEnergie()) $this->setEnergie($this->getMaxEnergie());
		return $this;
	}
	public function addArgent($argent){
		$this->_argent+=$argent;
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
	public function setInvArme(array $tab){
		$this->_invArme = $tab;
		return $this;
	}
	public function getInvArme(){
		return $this->_invArme;
	}
	public function setInvConso(array $tab){
		$this->_invConso = $tab;
		return $this;
	}
	public function getInvConso(){
		return $this->_invConso;
	}
	public function getTauxEsquive(){
		$esq = floor((1-(1/(1.25+($this->_esquive/5))))*10000)/100;
		$esq*=0.75;
		if($this->getEnergyPercent()<5) return floor($esq/3*100)/100;
		else return $esq;
	}
	public function damage($amount){
		$rating = $this->getTauxEsquive()*100;
		for($i=0;$i<25;$i++) $rand = mt_rand(1,10000);
		if($rand<=$rating) return 0;
		else return $amount*$this->getDamageCoeffFromPoison();
	}
	public function getDamageCoeffFromPoison(){
		if($this->_jauge_poison<(self::MAX_JAUGE_POISON*0.25)) return 1;
		else if($this->_jauge_poison<(self::MAX_JAUGE_POISON*0.50)) return 1.25;
		else if($this->_jauge_poison<(self::MAX_JAUGE_POISON*0.75)) return 1.5;
		else return 2;
	}
	public function getPrecision(){
		if($this->getEnergyPercent()<5) return 0;
		else return floor((1-(1/(3+($this->_dexterite/3))))*10000)/100;
	}
	public function getJaugePoison(){
		return $this->_jauge_poison;
	}
	public function setJaugePoison($j){
		$this->_jauge_poison=(int)$j;
		if($this->_jauge_poison>self::MAX_JAUGE_POISON) $this->_jauge_poison=self::MAX_JAUGE_POISON;
		return $this;
	}
	public function addJaugePoison(){
		$this->_jauge_poison+=floor($this->_poison);
		if($this->_jauge_poison > self::MAX_JAUGE_POISON) $this->_jauge_poison=self::MAX_JAUGE_POISON;
		if($this->_jauge_poison<0) $this->_jauge_poison=0;
		return $this;
	}
	public function getPoisonPercent(){
		return $this->_jauge_poison/self::MAX_JAUGE_POISON*100;
	}
	public function addVague(){
		$this->_nb_vague++;
	}
	public function getLastRegenEnergie(){
		return $this->_last_regen_nrg;
	}
	public function setLastRegenEnergie($last_regen){
		$this->_last_regen_nrg = $last_regen;
		return $this;
	}
	public function getLastRegenVie(){
		return $this->_last_regen_vie;
	}
	public function setLastRegenVie($last_regen){
		$this->_last_regen_vie = $last_regen;
		return $this;
	}
	public function poison($pois = 0){
		$this->_poison+= $pois;
		if($this->_poison>0){
			$this->_poison-=self::POISON_DAMAGE_PER_TICK;
			$this->_vie-=self::POISON_DAMAGE_PER_TICK;
			return true;
		}else{
			return false;
		}
	}
	public function getLevelPercent(){
		$pourc = ($this->_xp-self::getXpForLevel($this->_level)) / ($this->getXpForNextLevel()-self::getXpForLevel($this->_level))*100;
		if($pourc < 0) return 0;
		else if($pourc > 100) return 100;
		else return $pourc;
	}
	public function getEnergyPercent(){
		$pourc = ($this->_energie/$this->getMaxEnergie())*100;
		if($pourc < 0) return 0;
		else if($pourc > 100) return 100;
		else return $pourc;
	}
	public function isAtMaxLevel(){
		return $this->_level>=self::MAX_LEVEL;
	}
}