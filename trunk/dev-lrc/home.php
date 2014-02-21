<?php
include_once 'cdnHelper.php';
$wallCont = new WallController();
$nbWallUnread = $wallCont->getNbUnreadMessages($mem);

$messages = $wallCont->fetchRange(0, 5);

$persoCont = new PersoController();
$ladder = $persoCont->fetchRange(0, 5);
?>

<div id="tiles">
<div class="tile">
	<div class="tile-header">
		<p class="tile-header-lib">Derniers messages</p>
		<div class="tile-header-count"><p class="tile-header-count-lib"><?php echo $nbWallUnread;?></p></div>
	</div>
	<a class="tile-wrapper" href="#">
		<?php foreach ($messages as $mess):?>
			<div style='clear:both'>
				<div style='float:left;'><font color='ec5210'><?php echo $mess->getMembre()->getLogin()?></font></div>
				<div style='float:right;'><?php echo date('d-m-Y',strtotime($mess->getTimestamp()))?></div>
			</div>
			<div style='clear:both;background-color:#222222'>
				<?php if(strtotime($mess->getTimestamp()) > strtotime($mem->getWallTimestamp())):?>
					<span class='unreadMsg'><?php echo substr($mess->getMessage(),0,75).'...'?></span>
				<?php else:?>
					<span><?php echo substr($mess->getMessage(),0,75).'...'?></span>
				<?php endif;?>
			</div>
		<?php endforeach;?>
	</a>
</div>
<div class="tile">
	<div class="tile-header">
		<p class="tile-header-lib">Population</p>
	</div>
	<a class="tile-wrapper" href="#"></a>
</div>
<div class="tile">
	<div class="tile-header">
		<p class="tile-header-lib">Notes de mise &agrave; jour</p>
		<div class="tile-header-count"><p class="tile-header-count-lib">0</p></div>
	</div>
	<a class="tile-wrapper" href="#"></a>
</div>
<div class="tile">
	<div class="tile-header">
		<p class="tile-header-lib">Classement</p>
	</div>
	<a class="tile-wrapper" href="#">
	<?php foreach($ladder as $key=>$perso):?>
		<div style="height:50px;border-bottom:1px solid #ec5210">
			<p style="float:left;width:30px;text-align: center;margin-right:5px;line-height:25px"><?php echo $key+1?></p>
			<img style="float:left;height:50px;" src="<?php echo 'ava/'.$perso->getId().'.png'?>">
			<p style="float:right;line-height:25px"><?php echo $perso->getNom()?></p>
		</div>
	<?php endforeach;?>
	</a>
</div>
<div class="tile">
	<div class="tile-header">
		<p class="tile-header-lib">Survivants</p>
	</div>
	<a class="tile-wrapper" href="#"></a>
</div>
<div class="tile">
	<div class="tile-header">
		<p class="tile-header-lib">Lexique</p>
	</div>
	<a class="tile-wrapper" href="#"></a>
</div>
</div>

<?php //include 'home-old.php';?>