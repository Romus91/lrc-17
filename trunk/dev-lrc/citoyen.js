$(document).ready(function(){
	setInterval(function(){update();}, 5000);
});
function update(){
	$("table.perso").each(function(index,domEle){
		$.ajax({
			url: "updatejauge.php?perso="+$(this).attr("id"),
			success: function(data){
				var result = JSON.parse(data);
				$(domEle).find("img.jaugevie").animate({width: result.jaugevie},100);
				$(domEle).find("img.jaugeeng").animate({width: result.jaugeeng},100);
			}
		});
	});
}
