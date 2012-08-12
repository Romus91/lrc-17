<?php

class MemberController{
	public function fetchAll(){
		$query = 'select id from membre;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tabMember = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$mem = $this->fetchMembre($data->id);
			$tabMember[]=$mem;
		}
		return $tabMember;
	}
}