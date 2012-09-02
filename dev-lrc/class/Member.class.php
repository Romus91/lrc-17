<?php

class Member{
	protected $_id;
	protected $_login;
	protected $_pass;
	protected $_date;
	protected $_email;
	protected $_theme;
	protected $_walltimestamp;
	protected $_majtimestamp;
	protected $_argent;
	protected $_xp;
	protected $_level;

	public function __set($name, $value){
		$method = 'set'.$name;
		if(($name == 'mapper') || !method_exists($this, $method)){
			throw new Exception('Invalid member property');
		}
		$this->$method($value);
	}
	public function __get($name){
		$method = 'get'.$name;
		if(($name=='mapper')||!method_exists($this, $method)){
			throw new Exception('Invalid member property');
		}
		return $this->$method();
	}
	public function getId(){
		return $this->_id;
	}
	public function setId($id){
		$this->_id = (int) $id;
		return $this;
	}
	public function getLogin(){
		return $this->_login;
	}
	public function setLogin($login){
		$this->_login = $login;
		return $this;
	}
	public function getPass(){
		return $this->_pass;
	}
	public function setPass($pass){
		$this->_pass = $pass;
		return $this;
	}
	public function getDate(){
		return $this->_date;
	}
	public function setDate($date){
		$this->_date = $date;
		return $this;
	}
	public function getEmail(){
		return $this->_email;
	}
	public function setEmail($email){
		$this->_email = $email;
		return $this;
	}
	public function getTheme(){
		return $this->_theme;
	}
	public function setTheme($theme){
		$this->_theme = $theme;
		return $this;
	}
	public function getWallTimestamp(){
		return $this->_walltimestamp;
	}
	public function setWallTimestamp($wt){
		$this->_walltimestamp = $wt;
		return $this;
	}
	public function getMajTimestamp(){
		return $this->_majtimestamp;
	}
	public function setMajTimestamp($mt){
		$this->_majtimestamp = $mt;
		return $this;
	}
	public function getArgent(){
		return $this->_argent;
	}
	public function setArgent($a){
		$this->_argent =(int) $a;
		return $this;
	}
	public function addArgent($a){
		$this->_argent+=(int)$a;
		return $this;
	}
	public function getXp(){
		return $this->_xp;
	}
	public function setXp($xp){
		$this->_xp = (int) $xp;
		return $this;
	}
	public function addXp($xp){
		$this->_xp+=(int)$xp;
		return $this;
	}
	public function getLevel() {
		return $this->_level;
	}
	public function setLevel($level) {
		$this->_level = $level;
		return $this;
	}
	public function levelUp(){
		$this->_level++;
		return $this;
	}
	public static function getXpForLevel($i){
		if($i==1) return 1;
		else return 2*pow($i,3)+3*pow($i,2)+(self::getXpForLevel($i-1)/1.75)+15;
	}
	public function getXpForNextLevel(){
		return self::getXpForLevel($this->getLevel()+1);
	}
	public function getLevelPercent(){
		$pourc = floor(($this->_xp-self::getXpForLevel($this->_level)) / ($this->getXpForNextLevel()-self::getXpForLevel($this->_level))*100);
		if($pourc < 0) return 0;
		else if($pourc > 100) return 100;
		else return $pourc;
	}
	public static function purifyLogin($log){
		$log=ucfirst($log);
		$log=stripslashes(str_replace("'","_",$log));
		$log=stripslashes(str_replace(" ","_",$log));
		$log=stripslashes(str_replace("*","_",$log));
		$log=stripslashes(str_replace("/","_",$log));
		$log=stripslashes(str_replace("-","_",$log));
		$log=stripslashes(str_replace("+","_",$log));
		$log=stripslashes(str_replace("$","_",$log));
		$log=stripslashes(str_replace("^","_",$log));
		$log=stripslashes(str_replace("µ","_",$log));
		$log=stripslashes(str_replace(":","_",$log));
		$log=stripslashes(str_replace(",","_",$log));
		$log=stripslashes(str_replace("&","_",$log));
		$log=stripslashes(str_replace("?","_",$log));
		$log=stripslashes(str_replace("(","_",$log));
		$log=stripslashes(str_replace(")","_",$log));
		$log=stripslashes(str_replace("!","_",$log));
		$log=stripslashes(str_replace("§","_",$log));
		$log=stripslashes(str_replace("|","_",$log));
		$log=stripslashes(str_replace("ç","_",$log));
		$log=stripslashes(str_replace(";","_",$log));
		$log=stripslashes(str_replace("#","_",$log));
		return mysql_real_escape_string($log);
	}
}