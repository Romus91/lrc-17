<?php
class AmelioCompteController{
	public function fetchAmelio($level, $type){
		$query = "select * from amelio_compte where type = :t and niveau = :n order by type, niveau;";
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('n'=>$level+1,'t'=>$type));
		switch ($type){
			case AmelioCompte::AM_PIERCE: break;
			case AmelioCompte::AM_FRAG: break;
			case AmelioCompte::AM_INV: break;
		}

		$image=$this->getImage($type);

		$am = new AmelioCompte();
		if($data = $req->fetch(PDO::FETCH_OBJ)){
			$am -> setImage($image)
				-> setLevelRequis($data->level_requis)
				-> setNiveau($data->niveau)
				-> setType($data->type)
				-> setPrix($data->prix);
		}else{
			$am	-> setImage($image)
				-> setLevelRequis(0)
				-> setNiveau(0)
				-> setType($type)
				-> setPrix(0);
		}
		return $am;
	}
	private function getImage($type) {
		switch ($type){
			case AmelioCompte::AM_PIERCE: 	return 'piercingammo.png';
			case AmelioCompte::AM_FRAG: 	return 'fragammo.png';
			case AmelioCompte::AM_INV:		return 'inventory-upgrade.png';
		}
	}
}