$(document).ready(function(){
	$("div.conso").click(function(){
		if($(this).is(":parent")){
			$(this).empty();
			$.ajax({
				url: 'useconso.php?perso='+$(this).attr("perso")+'&i='+$(this).attr("conso"),
				success: function(data){
					var result = JSON.parse(data);
					if(result.type == "success"){
						if(result.content.type=="vie"){
							$("span#vie").text(result.content.amount);
							$("#jaugevie").animate({width: result.content.jauge},600);
						}else{
							$("span#eng").text(result.content.amount);
							$("#jaugeeng").animate({width: result.content.jauge},600);
						}
					}
				},
				error: function(data){
					alert("Error");
				}
			});
		}
		return false;
	});
	setTimeout(function(){update();},20000);
});

function update(){
	var idperso = $("div.arme").first().attr("perso");
	$.ajax({
		url: "updatejauge.php?perso="+idperso,
		success: function(data){
			var result = JSON.parse(data);
			$("span#vie").text(result.vie);
			$("span#eng").text(result.eng);
			$("#jaugevie").animate({width: result.jaugevie},500);
			$("#jaugeeng").animate({width: result.jaugeeng},500);
		}
	});
	setTimeout(function(){update();},20000);
}