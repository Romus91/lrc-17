<?php
class Event{
	public $_type;
	public $_value;
	public $_source;
	public $_target;

	public function equals(Event $e){
		return 	$this->_type==$e->_type &&
				$this->_source==$e->_source &&
				$this->_target==$e->_target;
	}
}