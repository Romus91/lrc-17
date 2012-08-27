<?php
include_once("ConnectionSingleton.class.php");
class Log
{
	private $_id;
	private $_id_membre;
	private $_type;
	private $_commentaire;

	public function getId()
	{
		return $this->_id;
	}

	public function getId_membre()
	{
		return $this->_id_membre;
	}
	public function setId_membre()
	{
		$this->_id_membre=$_id_membre;
	}

	public function getType()
	{
		return $this->_type;
	}
	public function setType()
	{
		$this->_type=$_type;
	}

	public function getCommentaire()
	{
		return $this->_commentaire;
	}
	public function setCommentaire()
	{
		$this->_commentaire=$_commentaire;
	}


	public function insertLog($typeLog,$id_membre,$id_perso,$commentaire)
	{
		$query="INSERT INTO log (type,id_membre,id_perso,commentaire) VALUES (:typ,:id_mem,:id_pers,:com);";
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->execute(array(
			'typ' => $typeLog,
			'id_mem' => $id_membre,
			'id_pers' => $id_perso,
			'com' => $commentaire
			));
	}
}
?>