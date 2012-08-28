$(document).ready(function(){
	$("div.arme").click(function(){
		perso = $(this).attr("perso");
		arme = $(this).attr("arme");
		if($("#armeinfo").is(":hidden") || $("#armeinfo").attr("arme")!=arme){
			$("#piegeinfo").hide();
			$("#armeinfo").attr("arme",arme);
			var url = $(this).children("a").attr("href");
			if(url!="#"){
				$.ajax({
					url: url,
					success: function(data){
						$("#armeinfo td").empty().append(data);
						$("#armeinfo").show();
					},
					error: function(){
						$("#armeinfo td").empty().append("Error");
						$("#armeinfo").show();
					}
				});
			}
		}else{
			$("#armeinfo").hide();
			$("#armeinfo td").empty();
		}
		return false;
	});
	$("td.piege").click(function(){
		perso = $(this).attr("perso");
		piege = $(this).attr("piege");
		if($("#piegeinfo").is(":hidden") || $("#piegeinfo").attr("piege")!=piege){
			$("#armeinfo").hide();
			$("#piegeinfo").attr("piege",piege);
			$.ajax({
				url: $(this).children("a").attr("href"),
				success: function(data){
					$("#piegeinfo td").empty().append(data);
					$("#piegeinfo").show();
				},
				error: function(){
					$("#piegeinfo td").empty().append("Error");
					$("#piegeinfo").show();
				}
			});
		}else{
			$("#piegeinfo").hide();
			$("#piegeinfo td").empty();
		}
		return false;
	});
	$("td.conso").click(function(){
		if($(this).is(":parent")){
			$(this).empty();
			$.ajax({
				url: 'useconso.php?perso='+$(this).attr("perso")+'&i='+$(this).attr("conso"),
				success: function(data){
					var result = JSON.parse(data);
					if(result.type == "success"){
						if(result.content.type=="vie"){
							$("span#vie").text(result.content.amount);
							$("#jaugevie").animate({width: result.content.jauge},1000);
						}else{
							$("span#eng").text(result.content.amount);
							$("#jaugeeng").animate({width: result.content.jauge},1000);
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