<?php
class MemberInventoryController {
	public function getInventoryForMember(Member $member) {
		$shopItemCont=new ShopItemController();
		$query = 'SELECT * FROM inventaire_membre WHERE membre_id = :mem';
		$req=ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':mem', $member->getId(),PDO::PARAM_INT);
		$req->execute();
		$tab=array();
		while($data=$req->fetch(PDO::FETCH_OBJ)){
			$slot = new MemberInventorySlot();
			$slot	->setItem($shopItemCont->fetchItem($data->shop_id))
					->setQuantity($data->quantity)
					->setMember($member);
			$tab[]=$slot;
		}
		return $tab;
	}
	public function getSlot(Member $member, ShopItem $item) {
		$query='SELECT * FROM inventaire_membre WHERE membre_id = :mem AND shop_id = :item';
		$req=ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':mem', $member->getId(),PDO::PARAM_INT);
		$req->bindParam(':item', $item->getId(),PDO::PARAM_INT);
		$req->execute();

		if($req->rowCount()!=0){
			$data=$req->fetch(PDO::FETCH_OBJ);

			$slot = new MemberInventorySlot();
			$slot	->setItem($item)
					->setMember($member)
					->setQuantity($data->quantity);
			return $slot;
		}else{
			return null;
		}
	}

	public function saveSlot(MemberInventorySlot $slot) {
		if($slot->getQuantity()<=0){
			$this->deleteSlot($slot);
		}else{
			if($this->getSlot($slot->getMember(), $slot->getItem())!==null){
				$this->updateSlot($slot);
			}else{
				$member = $slot->getMember();
				if(count($this->getInventoryForMember($member))<$member->getInventorySize()){
					$this->addSlot($slot);
				}else{
					throw new Exception("Inventaire plein !");
				}
			}
		}
	}

	private function deleteSlot(MemberInventorySlot $slot) {
		$query='DELETE FROM inventaire_membre WHERE membre_id = :mem AND shop_id = :item';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':mem', $slot->getMember()->getId(),PDO::PARAM_INT);
		$req->bindParam(':item', $slot->getItem()->getId(),PDO::PARAM_INT);

		$req->execute();
	}

	private function updateSlot(MemberInventorySlot $slot) {
		$query='UPDATE inventaire_membre SET quantity = :qty WHERE membre_id = :mem AND shop_id = :item';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':qty', $slot->getQuantity(),PDO::PARAM_INT);
		$req->bindParam(':mem', $slot->getMember()->getId(),PDO::PARAM_INT);
		$req->bindParam(':item', $slot->getItem()->getId(),PDO::PARAM_INT);

		$req->execute();
	}

	private function addSlot(MemberInventorySlot $slot){
		$query='INSERT INTO inventaire_membre(quantity, membre_id,shop_id) VALUES (:qty,:mem,:item)';
		$req = ConnectionSingleton::connect()->prepare($query);
		$req->bindParam(':qty', $slot->getQuantity(),PDO::PARAM_INT);
		$req->bindParam(':mem', $slot->getMember()->getId(),PDO::PARAM_INT);
		$req->bindParam(':item', $slot->getItem()->getId(),PDO::PARAM_INT);

		$req->execute();
	}
}