<?php
$tabPersos = $persoController->fetchMembreAlive($_SESSION['member_id']);
foreach ($tabPersos as $perso):
$perso->regenEnergie()->regenVie();
?>
<div class="smallperso" id="<?php echo $perso->getId(); ?>">
	<a href="index.php?page=perso&perso=<?php echo $perso->getId();?>"> <img src="ava/<?php echo $perso->getId();?>.png?<?php echo $perso->getLevel();?>">
	</a>
	<div class='jauge'>
		<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>">
		<img class='barre' id="jaugevie" src='<?php echo convertToCDNUrl('pic/jvert.png');?>' width='<?php echo $perso->getVie();?>%'>
		<div class="texte">
			<span id="vie"><?php echo $perso->getVie();?> </span> | 100
		</div>
	</div>
	<div class='jauge'>
		<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>">
		<img class='barre' id="jaugeeng" src='<?php echo convertToCDNUrl('pic/jbleu.png');?>' width='<?php echo $perso->getEnergyPercent();?>%'>
		<div class="texte">
			<span id="eng"><?php echo floor($perso->getEnergie());?> </span> | <span id="maxeng"><?php echo $perso->getMaxEnergie();?> </span>
		</div>
	</div>
</div>

<?php endforeach;?>

<script type="text/javascript">
<!--
$(document).ready(function(){
	setTimeout(function(){updateCitoyens();}, 10000);
});
function updateCitoyens(){
	$(".smallperso").each(function(index,domEle){
		$.ajax({
			url: "updatejauge.php?perso="+$(this).attr("id"),
			success: function(data){
				var result = JSON.parse(data);
				$(domEle).find("span#vie").text(result.vie);
				$(domEle).find("span#eng").text(result.eng);
				$(domEle).find("span#exp").text(result.exp);
				$(domEle).find("span#psn").text(result.psn);
				$(domEle).find("#jaugevie").animate({width: result.jaugevie},2001);
				$(domEle).find("#jaugeeng").animate({width: result.jaugeeng},2001);
				$(domEle).find("#jaugeexp").animate({width: result.jaugeexp},2001);
				$(domEle).find("#jaugepsn").animate({width: result.jaugepsn},2001);

			},
			error: function(){
			}
		});
	});
	setTimeout(function(){updateCitoyens();}, 10000);
}
//-->
</script>
