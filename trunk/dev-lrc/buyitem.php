<?php
require_once 'autoload.php';
require_once 'verif.php';
require_once 'cdnHelper.php';

$cat = (int) htmlentities($_GET['cat']);
$id = (int) htmlentities($_GET['id']);

$response = array();

if($cat==-1 && ($id==AmelioCompte::AM_FRAG || $id==AmelioCompte::AM_PIERCE || $id==AmelioCompte::AM_INV)){
	$amCont = new AmelioCompteController();
	$memCont = new MemberController();
	$mem = $memCont->fetchMembre($_SESSION['member_id']);

	if($id==AmelioCompte::AM_PIERCE) $level = $mem->getPierceLevel();
	else if($id==AmelioCompte::AM_FRAG) $level = $mem->getFragLevel();
	else $level = $mem->getInventoryLevel();

	$am = $amCont->fetchAmelio($level,$id);
	if($am->getNiveau()!=0){
		if($mem->getLevel()>=$am->getLevelRequis()){
			if($mem->getArgent()>=$am->getPrix()){
				$mem->addArgent(-$am->getPrix());

				if($id==AmelioCompte::AM_PIERCE){
					$mem->setPierceLevel($mem->getPierceLevel()+1);
				}else if($id==AmelioCompte::AM_FRAG){
					$mem->setFragLevel($mem->getFragLevel()+1);
				}else{
					$mem->setInventoryLevel($mem->getInventoryLevel()+1);
				}

				$memCont->saveMember($mem);

				$response['type']='success';
				$response['content']=array('message'=>'Achat effectu&eacute; !');
			}else{
				$response['type']='error';
				$response['content']=array('message'=>"Pas assez d'argent pour effectuer l'achat !");
			}
		}else{
			$response['type']='error';
			$response['content']=array('message'=>'Niveau insuffisant !');
		}
	}else{
		$response['type']='error';
		$response['content']=array('message'=>'Vous avez atteind le niveau maximum !');
	}
}else if($cat>0 && $id>0){
	$shopItemCont=new ShopItemController();
	$memCont = new MemberController();
	$mem = $memCont->fetchMembre($_SESSION['member_id']);

	if($item=$shopItemCont->fetchItem($id)){

		if($mem->getLevel()>=$item->getLevelRequis()){
			if($mem->getArgent()>=$item->getPrix()){
				$memInvCont=new MemberInventoryController();
				$slot=$memInvCont->getSlot($mem, $item);
				if($slot!=null){
					$slot->incrementQuantity();
				}else{
					$slot=new MemberInventorySlot();
					$slot->setItem($item)->setMember($mem)->setQuantity(1);
				}
				$mem->addArgent(-$item->getPrix());
				$memCont->saveMember($mem);
				$memInvCont->saveSlot($slot);

				$response['type']='success';
				$response['content']=array('message'=>'Achat effectu&eacute; !');
			}else{
				$response['type']='error';
				$response['content']=array('message'=>"Pas assez d'argent pour effectuer l'achat !");
			}
		}else{
			$response['type']='error';
			$response['content']=array('message'=>"Niveau insuffisant !");
		}
	}else{
		$response['type']='error';
		$response['content']=array('message'=>'Objet inconnu !');
	}
}else{
	$response['type']='error';
	$response['content']=array('message'=>'Cat&eacute;gorie inconnue !');
}
echo json_encode($response);