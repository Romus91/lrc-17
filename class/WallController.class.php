<?php
class WallController{
	protected $_membre;
	public function __construct(Member $membre){
		$this->_membre=$membre;
	}
	public function getNbUnreadMessages(){
		$query = "SELECT mes.timestamp, mem.walltimestamp FROM messages as mes, membre as mem WHERE mem.id = :id AND mes.timestamp > mem.walltimestamp;";
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id'=>$this->_membre->getId()));
		$data = $req->fetch(PDO::FETCH_OBJ);
		return count($data);
	}

}