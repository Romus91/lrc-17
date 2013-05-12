<?php
$amPierce = $amCont->fetchAmelio($mem->getPierceLevel(),AmelioCompte::AM_PIERCE);
$amFrag = $amCont->fetchAmelio($mem->getFragLevel(),AmelioCompte::AM_FRAG);
$amInv = $amCont->fetchAmelio($mem->getInventoryLevel(), AmelioCompte::AM_INV);
?>
<div class="shopitem" data-categ="-1" data-id="<?php echo AmelioCompte::AM_PIERCE?>">
	<div class="logo">
		<a href="#">
			<img src="<?php echo convertToCDNUrl('pic/'.$amPierce->getImage());?>">
		</a>
	</div>
	<div class="desc">
		<p>
			<span class="tag">Objet :</span>
			<span>Mun. perforantes<?php if($amPierce->getNiveau()!=0) echo " - Niv ".$amPierce->getNiveau();?></span>
		</p>
		<p>
			<span class="tag">Type :</span>
			<span>Am&eacute;lioration de compte</span>
		</p>
		<p>
			<span class="tag">Niveau requis :</span>
			<span><?php if($amPierce->getNiveau()!=0) echo $amPierce->getLevelRequis();?></span>
		</p>
		<p>
			<span class="tag">Prix :</span>
			<span><?php if($amPierce->getNiveau()!=0):?><font color="00ff00"><?php echo $amPierce->getPrix();?></font> <font color="f7a300"><strike>Cr</strike></font><?php else :?>Niveau MAX atteind<?php endif;?></span>
		</p>
		<p>
			<span class="tag">Description :</span>
			<span class="text">Augmente les chances de transpercer la cible lors d'un coup fatal avec une arme mono-cible.</span>
		</p>
	</div>
</div>
<div class="shopitem" data-categ="-1" data-id="<?php echo AmelioCompte::AM_FRAG?>">
	<div class="logo">
		<a href="#">
			<img src="<?php echo convertToCDNUrl('pic/'.$amFrag->getImage());?>">
		</a>
	</div>
	<div class="desc">
		<p>
			<span class="tag">Objet :</span>
			<span>Mun. &agrave; fragmentation<?php if($amFrag->getNiveau()!=0) echo " - Niv ".$amFrag->getNiveau();?></span>
		</p>
		<p>
			<span class="tag">Type :</span>
			<span>Am&eacute;lioration de compte</span>
		</p>
		<p>
			<span class="tag">Niveau requis :</span>
			<span><?php if($amFrag->getNiveau()!=0) echo $amFrag->getLevelRequis();?></span>
		</p>
		<p>
			<span class="tag">Prix :</span>
			<span><?php if($amFrag->getNiveau()!=0):?><font color="00ff00"><?php echo $amFrag->getPrix();?></font> <font color="f7a300"><strike>Cr</strike></font><?php else :?>Niveau MAX atteind<?php endif;?></span>
		</p>
		<p>
			<span class="tag">Description :</span>
			<span class="text">Augmente le nombre de cibles touch&eacute;es par les armes multi-cibles.</span>
		</p>
	</div>
</div>
<div class="shopitem" data-categ="-1" data-id="<?php echo AmelioCompte::AM_INV?>">
	<div class="logo">
		<a href="#">
			<img src="<?php echo convertToCDNUrl('pic/'.$amInv->getImage());?>">
		</a>
	</div>
	<div class="desc">
		<p>
			<span class="tag">Objet :</span>
			<span>Am&eacute;lio. inventaire<?php if($amInv->getNiveau()!=0) echo " - Niv ".$amInv->getNiveau();?></span>
		</p>
		<p>
			<span class="tag">Type :</span>
			<span>Am&eacute;lioration de compte</span>
		</p>
		<p>
			<span class="tag">Niveau requis :</span>
			<span><?php if($amInv->getNiveau()!=0) echo $amInv->getLevelRequis();?></span>
		</p>
		<p>
			<span class="tag">Prix :</span>
			<span><?php if($amInv->getNiveau()!=0):?><font color="00ff00"><?php echo $amInv->getPrix();?></font> <font color="f7a300"><strike>Cr</strike></font><?php else :?>Niveau MAX atteind<?php endif;?></span>
		</p>
		<p>
			<span class="tag">Description :</span>
			<span class="text">Augmente la taille de l'inventaire de <?php echo Member::INVENTORY_ROW_SIZE?> emplacements.</span>
		</p>
	</div>
</div>
<?php
$shopCatCont = new ShopCategController();
$shopItemCont = new ShopItemController();

$categArray = $shopCatCont->fetchAll();

foreach ($categArray as $categ) :
	$items = $shopItemCont->fetchByCateg($categ);
	foreach ($items as $item) :?>
		<div class="shopitem" data-categ="<?php echo $item->getCateg()->getId()?>" data-id="<?php echo $item->getId()?>">
			<div class="logo">
				<a href="#">
					<img src="<?php echo convertToCDNUrl('pic/'.$item->getImage());?>">
				</a>
			</div>
			<div class="desc">
				<p>
					<span class="tag">Objet :</span>
					<span class="text"><?php echo $item->getName()?></span>
				</p>
				<p>
					<span class="tag">Type :</span>
					<span class="text"><?php echo $categ->getName()?></span>
				</p>
				<p>
					<span class="tag">Niveau requis :</span>
					<span class="text"><?php echo $item->getLevelRequis()?></span>
				</p>
				<p>
					<span class="tag">Prix :</span>
					<span class="text"><font color="00ff00"><?php echo $item->getPrix();?></font> <font color="f7a300"><strike>Cr</strike></font></span>
				</p>
				<p>
					<span class="tag">Description :</span>
					<span class="text"><?php echo $item->getDescrip()?></span>
				</p>
			</div>
		</div>
	<?php endforeach;
endforeach;
?>