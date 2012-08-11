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
}