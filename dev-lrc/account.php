<?php
$nbPersoAlive = count($persoController->fetchMembreAlive($mem->getId()));
$nbPersoDead = count($persoController->fetchMembreDead($mem->getId()));
?>
<div class="desc">
	<p class="desc-title">Informations Générales</p>
	<p>
		<span class="tag">Nom :</span>
		<span><?php echo $mem->getLogin();?></span>
	</p>
	<p>
		<span class="tag">Compte créé le :</span>
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
		<span><?php echo $mem->getArgent()?> <strike>Cr</strike></span>
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
		<span class="tag">Mun. à fragmentation :</span>
		<span>Niveau <?php echo $mem->getFragLevel()?> - <?php echo $mem->getFragAmelio()?> fois plus de cibles touchées</span>
	</p>
</div>
<div class="desc">
	<p class="desc-title">Inventaire</p>
	<table id="inventory">
	<?php for ($i = 0; $i<2; $i++):?>
		<tr>
		<?php for($j=0;$j<4;$j++):?>
			<td class="invSlot">

			</td>
		<?php endfor;?>
		</tr>
	<?php endfor;?>
	</table>
</div>
<div class="desc">
	<p class="desc-title">Tours de force</p>
</div>