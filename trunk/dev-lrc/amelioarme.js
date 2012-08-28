$(document).ready(function(){
	$(".plusam").click(function(){
		var url=$(this).children("a").attr("href");
		$.ajax({
			url: url,
			success: function(data){
				var result = JSON.parse(data);
				$("font.error").text(" ");
				if(result.type=="success"){
					$("font.error").append(result.content.message);

					switch(result.content.type){
					case "deg":
						$("#amdeg").text(result.content.ampct);
						$("#jamdeg").animate({width: result.content.jauge},600);
						break;
					case "pre":
						$("#ampre").text(result.content.ampct);
						$("#jampre").animate({width: result.content.jauge},600);
						break;
					case "cap":
						$("#amcap").text(result.content.ampct);
						$("#jamcap").animate({width: result.content.jauge},600);
						var arme = $("#armeinfo").attr("arme");
						$("div.arme").each(function(index){
							if($(this).attr("arme")==arme){
								$(this).next("div.munarme")
								.empty()
								.append(result.content.munitions);
							}
						});
						break;
					}

					$("#ptam").text(result.content.ptam);
					setTimeout(function(){$("font.error").text("INFOS GENERALE");},3000);
				}else{
					$("font.error").append(result.content.message);
				}
			},
			error: function(){
				alert("Error");
			}
		});
		return false;
	});

	$(".moinsam").click(function(){
		var url=$(this).children("a").attr("href");
		$.ajax({
			url: url,
			success: function(data){
				var result = JSON.parse(data);
				$("font.error").text(" ");
				if(result.type=="success"){
					$("font.error").append(result.content.message);

					switch(result.content.type){
					case "deg":
						$("#amdeg").text(result.content.ampct);
						$("#jamdeg").animate({width: result.content.jauge},600);
						break;
					case "pre":
						$("#ampre").text(result.content.ampct);
						$("#jampre").animate({width: result.content.jauge},600);
						break;
					case "cap":
						$("#amcap").text(result.content.ampct);
						$("#jamcap").animate({width: result.content.jauge},600);
						$("span#prix").empty().append(result.content.argent);
						var arme = $("#armeinfo").attr("arme");
						$("div.arme").each(function(index){
							if($(this).attr("arme")==arme){
								$(this).next("div.munarme")
								.empty()
								.append(result.content.munitions);
							}
						});
						break;
					}

					$("#ptam").text(result.content.ptam);
					setTimeout(function(){$("font.error").text("INFOS GENERALE");},3000);
				}else{
					$("font.error").append(result.content.message);
				}
			},
			error: function(){
				alert("Error");
			}
		});
		return false;
	});

});