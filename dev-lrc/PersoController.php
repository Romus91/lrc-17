<?php
require_once 'PersoClass.php';
require_once 'LogClass.php';
require_once 'ConnectionSingleton.php';

class PersoController{
	public function fetchAll(){
		$query = 'select id from perso;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tabPerso = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$perso = $this->fetchPerso($data->id);
			$tabPerso[] = $perso;
		}
		return $tabPerso;
	}
	public function fetchMembre($id){
		$query = 'select id from perso where id_membre = :id;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req->execute();
		$tabPerso = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$perso = $this->fetchPerso($data->id);
			$tabPerso[] = $perso;
		}
		return $tabPerso;
	}
	public function fetchPlanque($id){
		$query = 'select id from perso where id_planque = :id;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id' => $id));
		$tabPerso = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$perso = $this->fetchPerso($data->id);
			$tabPerso[] = $perso;
		}
		return $tabPerso;
	}
	public function fetchPerso($id){
		$query = 'select * from perso where id = :id;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id' => $id));
		$data = $req->fetch(PDO::FETCH_OBJ);
		$perso = new Perso();
		$perso	->setId($data->id)
				->setId_planque($data->id_planque)
				->setId_membre($data->id_membre)
				->setNom($data->nom)
				->setAvatar($data->photo)
				->setDate_created($data->date)
				->setVie($data->vie)
				->setEnergie($data->energie)
				->setArgent($data->argent)
				->setXp($data->competance)
				->setLevel($data->level)
				->setEndurance($data->endurance)
				->setDexterite($data->dexterite)
				->setEsquive($data->esquive)
				->setNb_vague($data->jourvague)
				->setNb_crabe_kill($data->crabe)
				->setNb_zomb_kill($data->zombiekill)
				->setNb_zfast_kill($data->zombiefast)
				->setNb_zpois_kill($data->zombiepois)
				->setDead($data->enterrer);
		return $perso;
	}
	public function savePerso($perso){
		$query = 
			'update perso set 
				vie = :vie, 
				energie = :ener, 
				argent = :agt, 
				competance = :xp, 
				level = :lvl, 
				endurance = :endu,
				dexterite = :dext,
				esquive = :esq,
				jourvague = :vague, 
				crabe = :crab, 
				zombiekill = :zomb,
				zombiefast = :zf,
				zombiepois = :zp,
				enterrer = :dead 
			where id = :id;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array(
			'vie' 	=> $perso->getVie(),
			'ener' 	=> $perso->getEnergie(),
			'agt'	=> $perso->getArgent(),
			'xp'	=> $perso->getXp(),		
			'lvl'	=> $perso->getLevel(),
			'endu'	=> $perso->getEndurance(),
			'vague'	=> $perso->getNb_vague(),
			'crab'	=> $perso->getNb_crabe_kill(),
			'zomb'	=> $perso->getNb_zomb_kill(),
			'zf'	=> $perso->getNb_zfast_kill(),
			'zp'	=> $perso->getNb_zpois_kill(),
			'id'	=> $perso->getId(),
			'dead'	=> $perso->isDead(),
			'dext'	=> $perso->getDexterite(),
			'esq'	=> $perso->getEsquive()
		));
		return true;
	}
	public function createPerso($nom,$avatar,$id_membre){
		$query = 'insert into perso (nom,photo,id_membre) 
							values (:nom,:ava,:memb);';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array(
			'nom'	=> $nom,
			'ava'	=> $avatar,
			'memb'	=> $id_membre
		));
		$id_perso= ConnectionSingleton::connect()->lastInsertId();
		//$id_perso=mysql_fetch_array(mysql_query("SELECT id FROM perso WHERE id_membre = ".$id_membre.""));
		mysql_query("INSERT INTO inventaire (id_perso) VALUE (".$id_perso.")");
		return $this;
	}
}
