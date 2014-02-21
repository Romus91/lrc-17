<?php

class PersoController{
	public function fetchAll(){
		$query = 'select id from perso;';
		$req = ConnectionSingleton::connect()->prepare($query);
		return $this->fetchArray($req);
	}
	public function fetchRange($start,$length){
		$query = "select id, coalesce(max_level_reached_date, date('3000-01-01')) as max_level_date  from perso order by `max_level_date` ASC, competance DESC, level ASC limit :s, :l";
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':s', $start, PDO::PARAM_INT);
		$req->bindParam(':l', $length, PDO::PARAM_INT);
		return $this->fetchArray($req);
	}
	private function fetchArray($req){
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
	public function fetchMembreAlive($id){
		$query = 'select id from perso where id_membre = :id and enterrer = 0;';
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
	public function fetchMembreDead($id){
		$query = 'select id from perso where id_membre = :id and enterrer = 1;';
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
		$armeCont = new ArmeController();
		$consoCont = new ConsoController();
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
				->setNbPtsAmDispo($data->pt_amelio_dispo)
				->setNbPtsAmMax($data->pt_amelio_max)
				->setDead($data->enterrer)
				->setXpWhenAfk($data->xpafk)
				->setInvArme($armeCont->fetchPerso($data->id))
				->setInvConso($consoCont->fetchPerso($data->id))
				->setLastRegenEnergie($data->last_regen_nrg)
				->setLastRegenVie($data->last_regen_vie)
				->setJaugePoison($data->jaugepois)
				->setMaxLevelReachedDate($data->max_level_reached_date);
		return $perso;
	}
	public function savePerso(Perso $perso){
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
				enterrer = :dead,
				pt_amelio_dispo = :pad,
				pt_amelio_max = :pam,
				xpafk = :xpafk,
				jaugepois = :jpoi,
				last_regen_nrg = :lregennrg,
				last_regen_vie = :lregenvie,
				max_level_reached_date = FROM_UNIXTIME(:mlrdate)
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
			'esq'	=> $perso->getEsquive(),
			'pad'	=> $perso->getNbPtsAmDispo(),
			'pam'	=> $perso->getNbPtsAmMax(),
			'xpafk' => $perso->getXpWhenAfk(),
			'jpoi'	=> $perso->getJaugePoison(),
			'lregennrg'=> $perso->getLastRegenEnergie(),
			'lregenvie'=> $perso->getLastRegenVie(),
			'mlrdate'=>$perso->getMaxLevelReachedDate()
		));
		$armCont = new ArmeController();
		$armCont->savePerso($perso);
		return true;
	}
	public function createPerso($nom,$avatar,$id_membre){
		$query = 'insert into perso (nom,photo,id_membre,date,last_regen_nrg,last_regen_vie)
							values (:nom,:ava,:memb,:date,:lregennrg,:lregenvie);';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array(
			'nom'	=> $nom,
			'ava'	=> $avatar,
			'memb'	=> $id_membre,
			'date'	=> time(),
			'lregenvie'=> microtime(true),
			'lregennrg'=> microtime(true)
		));
		$id_perso= ConnectionSingleton::connect()->lastInsertId();
		mysql_query("insert into inv_arme (perso,arme,ordre,mun) value (".$id_perso.",1,".Perso::MAX_WEAP.",1)");
		return $this->fetchPerso($id_perso);
	}
}
