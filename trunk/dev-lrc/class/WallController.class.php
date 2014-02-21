<?php
class WallController{
	public function getNbUnreadMessages(Member $membre){
		$query = "SELECT count(*) as count FROM messages as mes, membre as mem WHERE mem.id = :id AND mes.timestamp > mem.walltimestamp;";
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id'=>$membre->getId()));
		if($req->rowCount()!=0){
			return $req->fetch(PDO::FETCH_OBJ)->count;
		}else{
			return 0;
		}
	}

	public function fetchAllMessages() {
		$memCont = new MemberController();
		$query = "SELECT * FROM messages";
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tab=array();
		while($data = $req->fetch(PDO::FETCH_OBJ)){
			$entry = new WallEntry();
			$entry	->setId($data->id)
					->setMembre($memCont->fetchMembre($data->id_membre))
					->setMessage($data->message)
					->setTimestamp($data->timestamp);
			$tab[]=$entry;
		}
		return $tab;
	}

	public function fetchRange($start, $length){
		$memCont = new MemberController();
		$query='SELECT * FROM messages ORDER BY id DESC LIMIT :s , :l';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':s', $start, PDO::PARAM_INT);
		$req->bindParam(':l', $length, PDO::PARAM_INT);
		$req->execute();
		$tab=array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$entry = new WallEntry();
			$entry	->setId($data->id)
					->setMembre($memCont->fetchMembre((int)$data->id_membre))
					->setMessage($data->message)
					->setTimestamp($data->timestamp);
			$tab[]=$entry;
		}
		return $tab;
	}
}