<?php
require_once 'ArmeClass.php';
require_once 'ConnectionSingleton.php';


class ArmeController{
	public function fetchAll(){
		$query = 'select id from armes;';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute();
		$tabArme = array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$arme = $this->fetchArme($data->id);
			$tabArme[] = $arme;
		}
		return tabArme;
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
					-> setPrecision($data->precision);
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
					-> setOrdre($data->ordre)
					-> setAmPreci($data->precision)
					-> setAmForce($data->force)
					-> setAmCapa($data->capa);
			$tabArme[] = $arme;
		}
		return $tabArme;
	}
}
?>