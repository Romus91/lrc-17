$(document).ready(function(){
	setInterval(function(){update();}, 10000);
});
function update(){
	$("table.perso").each(function(index,domEle){
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
			}
		});
	});
}
