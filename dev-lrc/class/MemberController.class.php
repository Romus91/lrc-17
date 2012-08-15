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
	public function fetchMembre($id){
		$query = 'select * from membre where id = :id;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id'=>$id));
		$data = $req->fetch(PDO::FETCH_OBJ);
		$membre = new Member();
		$membre	->setId($data->id)
				->setLogin($data->login)
				->setPass($data->pass)
				->setDate($data->date)
				->setArgent($data->argent)
				->setEmail($data->email)
				->setMajTimestamp($data->majtimestamp)
				->setWallTimestamp($data->walltimestamp)
				->setTheme($data->theme)
				->setXp($data->xp);
		return $membre;
	}
}
