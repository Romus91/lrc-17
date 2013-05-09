<?php
class AmelioCompteController{
	public function fetchAmelio($level, $type){
		$query = "select * from amelio_compte where type = :t and niveau = :n order by type,niveau;";
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array('n'=>$level+1,'t'=>$type));
		if($type==AmelioCompte::AM_PIERCE) $image = 'piercingammo.png';
		if($type==AmelioCompte::AM_FRAG) $image = 'fragammo.png';
		if($data = $req->fetch(PDO::FETCH_OBJ)){
			$am = new AmelioCompte();
			$am -> setImage($image)
				-> setLevelRequis($data->level_requis)
				-> setNiveau($data->niveau)
				-> setType(AmelioCompte::AM_PIERCE)
				-> setPrix($data->prix);
			return $am;
		}else{
			$am = new AmelioCompte();
			$am	-> setImage($image)
				-> setLevelRequis(0)
				-> setNiveau(0)
				-> setType(AmelioCompte::AM_PIERCE)
				-> setPrix(0);
			return $am;
		}
	}
}