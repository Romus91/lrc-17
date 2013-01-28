/**
 *
 */
$(document).ready(function(){
	setTimeout(function(){update();},1000);
});

function update(){
	var idperso = $("#idPerso").val();
	$.ajax({
		url: "updatejauge.php?perso="+idperso,
		success: function(data){
			var result = JSON.parse(data);
			$("span#vie").text(result.vie);
			$("span#eng").text(result.eng);
			$("span#exp").text(result.exp);
			$("span#psn").text(result.psn);
			$("#jaugevie").animate({width: result.jaugevie},2001);
			$("#jaugeeng").animate({width: result.jaugeeng},2001);
			$("#jaugeexp").animate({width: result.jaugeexp},2001);
			$("#jaugepsn").animate({width: result.jaugepsn},2001);
		}
	});
	setTimeout(function(){update();},2000);
}