<?php
$amPierce = $amCont->fetchAmelio($mem->getPierceLevel(),AmelioCompte::AM_PIERCE);
$amFrag = $amCont->fetchAmelio($mem->getFragLevel(),AmelioCompte::AM_FRAG);?>
<div class="shopitem">
	<div class="logo">
		<a href="amcompte.php?type=<?php echo AmelioCompte::AM_PIERCE?>">
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
			<span>Amélioration de compte</span>
		</p>
		<p>
			<span class="tag">Niveau requis :</span>
			<span><?php if($amPierce->getNiveau()!=0) echo $amPierce->getLevelRequis();?></span>
		</p>
		<p>
			<span class="tag">Prix :</span>
			<span><?php if($amPierce->getNiveau()!=0):?><font color="00ff00"><?php echo $amPierce->getPrix();?></font> <font color="f7a300"><strike>Cr</strike></font><?php else :?>Niveau MAX atteind<?php endif;?></span>
		</p>
	</div>
</div>
<div class="shopitem">
	<div class="logo">
		<a href="amcompte.php?type=<?php echo AmelioCompte::AM_FRAG?>">
			<img src="<?php echo convertToCDNUrl('pic/'.$amFrag->getImage());?>">
		</a>
	</div>
	<div class="desc">
		<p>
			<span class="tag">Objet :</span>
			<span>Mun. à fragmentation<?php if($amFrag->getNiveau()!=0) echo " - Niv ".$amFrag->getNiveau();?></span>
		</p>
		<p>
			<span class="tag">Type :</span>
			<span>Amélioration de compte</span>
		</p>
		<p>
			<span class="tag">Niveau requis :</span>
			<span><?php if($amFrag->getNiveau()!=0) echo $amFrag->getLevelRequis();?></span>
		</p>
		<p>
			<span class="tag">Prix :</span>
			<span><?php if($amFrag->getNiveau()!=0):?><font color="00ff00"><?php echo $amFrag->getPrix();?></font> <font color="f7a300"><strike>Cr</strike></font><?php else :?>Niveau MAX atteind<?php endif;?></span>
		</p>
	</div>
</div>