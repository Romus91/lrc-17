<?php

class ArmeController{
	public function fetchAll(){
		$query = 'select id from armes order by lvlrequis;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tabArme = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$arme = $this->fetchArme($data->id);
			$tabArme[] = $arme;
		}
		return $tabArme;
	}
	public function fetchArme($id){
		$query = 'select * from armes where id = :id';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id' => $id));
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$arme = new Arme();
			$arme	-> setId($data->id)
					-> setNom($data->nom)
					-> setImage($data->image)
					-> setMunmax($data->munmax)
					-> setPrix($data->prix)
					-> setPrixballes($data->prixballes)
					-> setForce($data->force)
					-> setPrecision($data->preci_base)
					-> setAmCapMax($data->cap_max)
					-> setAmDegMax($data->deg_max)
					-> setAmPreMax($data->pre_max)
					-> setNbCible($data->nb_cible);
		}
		return $arme;
	}
	public function fetchPerso($id){
		$query = 'select * from inv_arme where inv_arme.perso = :id order by ordre;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('id' => $id));
		$tabArme = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$arme = $this->fetchArme($data->arme);
			$arme	-> setMunitions($data->mun)
					-> setAmPreci($data->preci)
					-> setAmForce($data->degat)
					-> setAmCapa($data->capa)
					-> setOrdre($data->ordre);
			$tabArme[] = $arme;
		}
		return $tabArme;
	}
	public function addArme($id_perso, Arme $arm){
		$nb = count($this->fetchPerso($id_perso));
		$query = 'select max(ordre) as max from inv_arme where perso = :p and arme <> 1;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('p'=>$id_perso));
		$data = $req->fetch(PDO::FETCH_OBJ)->max;
		if($arm->getId()==1){
			$ordre=6;
		}else{
			$ordre=$data+1;
		}
		if($nb<6){
			$query = "insert into inv_arme (perso,arme,mun,ordre) values (:p,:a,:m,:o);";
			$req = ConnectionSingleton::connect()->prepare($query);
			return $req->execute(array('p'=>$id_perso,'a'=>$arm->getId(),'m'=>$arm->getMunitions(),'o'=>$ordre));
		}else{
			return false;
		}
	}
	public function savePerso(Perso $p){
		$tabArme = $p->getInvArme();
		foreach($tabArme as $arm){
			$this->saveArme($p, $arm);
		}
	}
	public function saveArme(Perso $p, Arme $arm){
		$query = 'update inv_arme set
			mun = :mun,
			degat = :for,
			preci = :pre,
			capa = :cap,
			ordre = :o
			where arme = :arm and perso = :perso;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array(
					'mun'	=>$arm->getMunitions(),
					'for'	=>$arm->getAmForce(),
					'pre'	=>$arm->getAmPreci(),
					'cap'	=>$arm->getAmCapa(),
					'o'		=>$arm->getOrdre(),
					'arm'	=>$arm->getId(),
					'perso'	=>$p->getId()
		));
	}
	public function moveArmeLeft(Perso $p, Arme $a){
		if($a->getId()!=1 && $a->getOrdre()>1){
			$armes = $p->getInvArme();
			$o = $a->getOrdre();


			$j=0;
			for(;$j<count($armes) && $armes[$j]->getOrdre()!=($o-1);$j++);

			$aBis = $armes[$j];

			$a->setOrdre($o-1);

			$aBis->setOrdre(0);
			$this->saveArme($p, $aBis);

			$this->saveArme($p, $a);

			$aBis->setOrdre($o);
			$this->saveArme($p, $aBis);

			return true;
		}else return false;
	}
	public function moveArmeRight(Perso $p, Arme $a){
		if($a->getId()!=1 && $a->getOrdre()<5){
			$armes = $p->getInvArme();
			$o = $a->getOrdre();

			$j=0;
			for(;$j<count($armes) && $armes[$j]->getOrdre()!=($o+1);$j++);

			$aBis = $armes[$j];

			$a->setOrdre($o+1);

			$aBis->setOrdre(0);
			$this->saveArme($p, $aBis);

			$this->saveArme($p, $a);

			$aBis->setOrdre($o);
			$this->saveArme($p, $aBis);
			return true;
		}else return false;
	}
	public function deleteArme(Perso $perso,Arme $arme){
		$query = 'delete from inv_arme where perso = :p and arme = :a;';
		$req = ConnectionSingleton::connect()->prepare($query);
		return $req->execute(array('p'=>$perso->getId(),'a'=>$arme->getId()));
	}
}
?>