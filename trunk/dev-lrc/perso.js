/**
 *
 */
$(document).ready(function(){
	setTimeout(function(){updatePerso();},2500);
});

function updatePerso(){
	var idperso = $("#idPerso").val();
	$.ajax({
		url: "updatejauge.php?perso="+idperso,
		success: function(data){
			var result = JSON.parse(data);
			$("#jaugeperso span#vie").text(result.vie);
			$("#jaugeperso span#eng").text(result.eng);
			$("#jaugeperso span#exp").text(result.exp);
			$("#jaugeperso span#psn").text(result.psn);
			$("#jaugeperso #jaugevie").animate({width: result.jaugevie},2001);
			$("#jaugeperso #jaugeeng").animate({width: result.jaugeeng},2001);
			$("#jaugeperso #jaugeexp").animate({width: result.jaugeexp},2001);
			$("#jaugeperso #jaugepsn").animate({width: result.jaugepsn},2001);

			setTimeout(function(){updatePerso();},10000);
		},
		error: function(){
			setTimeout(function(){updatePerso();},3000);
		}
	});
}