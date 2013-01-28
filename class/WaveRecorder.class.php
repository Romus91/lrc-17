<?php
class WaveRecorder{
	protected $_wave;
	protected $_round;
	protected $_ptr_round;
	protected $_ptr_event;

	public function __construct(){
		$this->_wave = array();
		$this->_round = array();
	}
	public function addEvent(Event $e){
		$this->_round[] = $e;
	}
	public function endRound(){
		$this->_wave[] = $this->_round;
		$this->_round = array();
	}
	public function endWave(){
		$this->_ptr_round=0;
		$this->_ptr_event=0;
	}
	public function nextEvent(){
		if(isset($this->_wave[$this->_ptr_round][$this->_ptr_event]))
			return $this->_wave[$this->_ptr_round][$this->_ptr_event++];
		else return null;
	}
	public function hasNextEvent(){
		if(isset($this->_wave[$this->_ptr_round][$this->_ptr_event]))
			return true;
		else return false;
	}
	public function nextRound(){
		if(isset($this->_wave[$this->_ptr_round+1])){
			$this->_ptr_event=0;
			$this->_ptr_round++;
			return true;
		}else return null;
	}
	public function firstEvent(){
		if(isset($this->_wave[$this->_ptr_round][0])){
			$this->_ptr_event=1;
			return $this->_wave[$this->_ptr_round][0];
		}else return null;
	}
}