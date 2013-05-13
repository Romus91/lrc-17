<?php
class WallEntry {
	protected $id;
	protected $membre;
	protected $message;
	protected $timestamp;

	public function getId(){
	    return $this->id;
	}

	public function getMembre(){
	    return $this->membre;
	}

	public function getMessage(){
	    return $this->message;
	}

	public function getTimestamp(){
	    return $this->timestamp;
	}

	public function setId($id){
	    $this->id = $id;
	    return $this;
	}

	public function setMembre(Member $membre){
	    $this->membre = $membre;
	    return $this;
	}

	public function setMessage($message){
	    $this->message = $message;
	    return $this;
	}

	public function setTimestamp($timestamp){
	    $this->timestamp = $timestamp;
	    return $this;
	}
}