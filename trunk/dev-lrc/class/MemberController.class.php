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
	public function saveMember(Member $member){
		$query =
		'update membre set
				theme = :theme,
				walltimestamp = :wt,
				majtimestamp = :mt,
				argent = :argent,
				xp = :xp,
				level = :level
			where id = :id;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array(
				'theme'		=> $member->getTheme(),
				'wt'		=> $member->getWallTimestamp(),
				'mt'		=> $member->getMajTimestamp(),
				'argent'	=> $member->getArgent(),
				'xp'		=> $member->getXp(),
				'level'		=> $member->getLevel(),
				'id'		=> $member->getId()
		));
	}
	public function findByLogin($login){
		$query = 'select id from membre where login = :l;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('l'=>$login));
		if($req->rowCount()==0) throw new Exception('Login incorrect');
		else return $this->fetchMembre($req->fetch(PDO::FETCH_OBJ)->id);
	}
	public function createMember($login,$pass,$email){
		$query = 'insert into membre (login, pass, email) values (:log, :pass, :email);';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('log'=>$login,'pass'=>$pass,'email'=>$email));
	}
	public function checkLoginAndMail($login,$email){
		$query = 'select id from membre where login = :l or email = :e;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('l'=>$login,'e'=>$email));
		if($req->rowCount()!=0) throw new Exception();
	}
}
