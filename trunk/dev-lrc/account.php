<?php
$nbPersoAlive = count($persoController->fetchMembreAlive($mem->getId()));
$nbPersoDead = count($persoController->fetchMembreDead($mem->getId()));
?>
<div class="desc">
	<p class="desc-title">Informations G&eacute;n&eacute;rales</p>
	<p>
		<span class="tag">Nom :</span>
		<span><?php echo $mem->getLogin();?></span>
	</p>
	<p>
		<span class="tag">Compte cr&eacute;&eacute; le :</span>
		<span><?php echo date('d-m-Y H:i:s',strtotime($mem->getDate()))?></span>
	</p>
	<p>
		<span class="tag">eMail :</span>
		<span><?php echo $mem->getEmail()?></span>
	</p>
</div>
<div class="desc">
	<p class="desc-title">Informations de Jeu</p>
	<p>
		<span class="tag">Niveau :</span>
		<span><?php echo $mem->getLevel()?></span>
	</p>
	<p>
		<span class="tag">Argent :</span>
		<span><span class="account-money"><?php echo $mem->getArgent();?></span> <strike>Cr</strike></span>
	</p>
	<p>
		<span class="tag">Nombre de persos :</span>
		<span><?php echo $nbPersoAlive.' sur '.$mem->getNbPersoMax();?></span>
	</p>
	<p>
		<span class="tag">Nombre de morts :</span>
		<span><?php echo $nbPersoDead;?></span>
	</p>
	<p>
		<span class="tag">Mun. perforantes :</span>
		<span>Niveau <?php echo $mem->getPierceLevel();?> - <?php echo $mem->getPierceChance();?>% de chances d'empaler</span>
	</p>
	<p>
		<span class="tag">Mun. &agrave; fragmentation :</span>
		<span>Niveau <?php echo $mem->getFragLevel()?> - <?php echo $mem->getFragAmelio()?> fois plus de cibles touch&eacute;es</span>
	</p>
	<p>
		<span class="tag">Am&eacute;lio. inventaire :</span>
		<span>Niveau <?php echo $mem->getInventoryLevel()?> - <?php echo ($mem->getInventoryLevel()*Member::INVENTORY_ROW_SIZE);?> emplacements suppl&eacute;mentaire</span>
	</p>
</div>
<?php
$memInvCont=new MemberInventoryController();
$inventory = $memInvCont->getInventoryForMember($mem);
$count = count($inventory);
?>
<div class="desc">
	<p class="desc-title">Inventaire</p>
	<table id="inventory">
	<?php for ($i = 0; $i<$mem->getInventorySize();):?>
		<tr>
		<?php for($j=0;$j<4;$i++,$j++):?>
			<td class="invSlot">
				<?php if($i<$count):?>
					<div class="invItem" data-item-id="<?php echo $inventory[$i]->getItem()->getId();?>">
						<img src="<?php echo convertToCDNUrl('pic/'.$inventory[$i]->getItem()->getImage());?>">
						<div class="invCount"><?php echo $inventory[$i]->getQuantity()?></div>
					</div>
				<?php endif;?>
			</td>
		<?php endfor;?>
		</tr>
	<?php endfor;?>
	</table>
</div>
<div class="desc">
	<p class="desc-title">Tours de force</p>
</div>