<?php
class MemberInventorySlot {
	protected $item;
	protected $quantity;
	protected $member;

	public function getItem(){
	    return $this->item;
	}
	public function getQuantity(){
	    return $this->quantity;
	}
	public function getMember(){
	    return $this->member;
	}

	public function setItem(ShopItem $item){
	    $this->item = $item;
	    return $this;
	}
	public function setQuantity($quantity){
	    $this->quantity = (int) $quantity;
	    return $this;
	}
	public function setMember(Member $member){
	    $this->member = $member;
	    return $this;
	}
	public function incrementQuantity($qty=1) {
		$this->quantity+=$qty;
	}
	public function decrementQuantity($qty=1) {
		$this->quantity-=$qty;
	}
}