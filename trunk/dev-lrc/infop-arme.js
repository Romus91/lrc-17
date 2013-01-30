$(document).ready(function(){
	$("div.arme").click(function(){
		perso = $(this).attr("perso");
		arme = $(this).attr("arme");
		$("#piedbiche").hide();
		if($("#armeinfo").is(":hidden") || $("#armeinfo").attr("arme")!=arme){
			$('#armeinfo').attr("perso",perso);
			$("#armeinfo").attr("arme",arme);
			var url = $(this).children("a").attr("href");
			if(url){
				$.ajax({
					url: url,
					success: function(data){
						var result = JSON.parse(data);
						if(result.type=="success"){
							$("#armeinfo").stop(true);
							$("#armeinfo").show();

							$("#jdeg").animate({width: result.content.jdeg},600);
							$("#jamdeg").animate({width: result.content.jamdeg},600);
							$("#libdeg").text(result.content.libdeg);
							$("#tdeg").text(result.content.tdeg);

							$("#jpre").animate({width: result.content.jpre},600);
							$("#jampre").animate({width: result.content.jampre},600);
							$("#libpre").text(result.content.libpre);
							$("#tpre").text(result.content.tpre);

							$("#jcap").animate({width: result.content.jcap},600);
							$("#jamcap").animate({width: result.content.jamcap},600);
							$("#libcap").text(result.content.libcap);
							$("#tcap").text(result.content.tcap);

							$("#nomarme").text(result.content.nomarme);
							loadRefillCost(perso,arme);
						}else{
							hideArmeinfo(false);
							$("#piedbiche").show();
						}
					},
					error: function(){
						alert("Error");
					}
				});
			}
		}else{
			hideArmeinfo(true);
		}
		return false;
	});
	$("td.armeaction.reload").click(function(){
		if(!$(this).children("a").hasClass("disabled")){
			var url = $(this).children("a").attr("href")+$("#armeinfo").attr('arme');
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(data){
					var result = data;
					if(result.type == "reloadsuccess"){
						var cont = result.content;
						$("div.arme").each(function(index){
							if($(this).attr("arme")==cont.arme){
								$(this).next("div.munarme")
								.empty()
								.append(cont.mun+" | "+cont.capa);
								$("span#prix").empty().append(cont.money);
								$("td.armeaction.reload").children("a").text("RECHARGER");
								$("td.armeaction.reload").children("a").addClass("disabled");
								$("td.armeaction.reload").children("a").css("color","#333333");
								return false;
							}
						});
					}
				},
				error: function(){
					alert("Error");
				}
			});
		}
		return false;
	});
	$("td.armeaction.sell").click(function(){
		$.ajax({
			url: $(this).children("a").attr("href")+$("#armeinfo").attr("arme"),
			dataType: 'json',
			success: function(data){
				$('#popup .content .message').html('<p>Voulez vous vendre '+data.arme+' pour <font color="#00ff00">'+data.prix+' $</font></p>'+'<span class="popup-buttons"><button id="popup-vente-yes">Oui</button><button id="popup-no">Non</button></span>');
				$('#popup .content').append();
				$('#popup .content .image').children("img").attr("src", 'http://anthares.be/lrc/pic/popup-question.png');
				$("#popup").show();
				$('#popup .content').animate({height : ($('#popup .content .message').outerHeight())},100);
				$('#popup-vente-yes').click(function(e){
					var url= 'armevendreok.php?perso='+$('#armeinfo').attr("perso")+'&id='+$('#armeinfo').attr('arme');
					$.ajax({
						url: url,
						dataType: 'json',
						success: function(data){
							var result = data;
							if(result.type == "success"){
								var cont = result.content;
								var elem;
								var parent;
								$("div.arme").each(function(index){
									if($(this).attr("arme")==cont.arme){
										$(this).empty().append("<a href='#'></a>");
										$(this).next("div.munarme")
										.empty()
										.append("0 | 0");
										elem = $(this).parent("td");
										parent = elem.parent("tr");
										elem.remove();
										parent.append(elem);
										$("span#prix").empty().append(cont.money);
										$("#armeinfo").hide();
										return false;
									}
								});
								$('#popup').hide();
							}
						},
						error: function(){
							alert('Error !');
						}
					});
				});
				$('#popup-no').click(function(e){
					$("#popup").hide();
				});
			},
			error: function(){
				alert('Error !');
			}
		});
		return false;
	});
	$("td.armeaction.move-left, td.armeaction.move-right").click(function(){
		var url=$(this).children("a").attr("href")+"&id="+$('#armeinfo').attr("arme");
		$.ajax({
			url: url,
			success: function(data){
				window.location.reload();
			},
			error: function(){
				alert("Error");
			}
		});
		return false;
	});
	$(".plusam").click(function(){
		var url=$(this).children("a").attr("href")+$('#armeinfo').attr("arme");
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
						$("#jamdeg").animate({width: result.content.jauge},100);
						$("#libdeg").text(result.content.lib);
						$("#tdeg").text(result.content.texte);
						break;
					case "pre":
						$("#ampre").text(result.content.ampct);
						$("#jampre").animate({width: result.content.jauge},100);
						$("#libpre").text(result.content.jauge);
						$("#tpre").text(result.content.texte);
						break;
					case "cap":
						$("#amcap").text(result.content.ampct);
						$("#jamcap").animate({width: result.content.jauge},100);
						$("#libcap").text(result.content.lib);
						$("#tcap").text(result.content.texte);
						var arme = $("#armeinfo").attr("arme");
						$("div.arme").each(function(index){
							if($(this).attr("arme")==arme){
								$(this).next("div.munarme")
								.empty()
								.append(result.content.munitions);
							}
						});
						loadRefillCost($("#armeinfo").attr("perso"),$("#armeinfo").attr("arme"));
						break;
					}

					$("#ptam").text(result.content.ptam);
					setTimeout(function(){$("font.error").text("INFOS GENERALE");}, 5000);
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
		var url=$(this).children("a").attr("href")+$('#armeinfo').attr("arme");
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
						$("#jamdeg").animate({width: result.content.jauge},100);
						$("#libdeg").text(result.content.lib);
						$("#tdeg").text(result.content.texte);
						break;
					case "pre":
						$("#ampre").text(result.content.ampct);
						$("#jampre").animate({width: result.content.jauge},100);
						$("#libpre").text(result.content.jauge);
						$("#tpre").text(result.content.texte);
						break;
					case "cap":
						$("#amcap").text(result.content.ampct);
						$("#jamcap").animate({width: result.content.jauge},100);
						$("#libcap").text(result.content.lib);
						$("#tcap").text(result.content.texte);
						$("span#prix").empty().append(result.content.argent);
						var arme = $("#armeinfo").attr("arme");
						$("div.arme").each(function(index){
							if($(this).attr("arme")==arme){
								$(this).next("div.munarme")
								.empty()
								.append(result.content.munitions);
							}
						});
						loadRefillCost($("#armeinfo").attr("perso"),$("#armeinfo").attr("arme"));
						break;
					}

					$("#ptam").text(result.content.ptam);
					setTimeout(function(){$("font.error").text("INFOS GENERALE");},5000);
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

function loadRefillCost(perso,arme){
	$.ajax({
		url: "armeinforecharg.php?perso="+perso+"&id="+arme,
		dataType: 'json',
		success: function(data){
			if(data.type=='success'){
				if(data.content!=0){
					$("td.armeaction.reload").children("a").text("RECHARGER ? ("+data.content+" $)");
					$("td.armeaction.reload").children("a").removeClass("disabled");
					$("td.armeaction.reload").children("a").css("color","#ffffff");
				}else{
					$("td.armeaction.reload").children("a").text("RECHARGER");
					$("td.armeaction.reload").children("a").addClass("disabled");
					$("td.armeaction.reload").children("a").css("color","#333333");
				}
			}
		},
		error: function(){
			alert("Error");
		}
	});
}
function hideArmeinfo(sync){
	$("#jdeg").animate({width: '0%'},600);
	$("#jamdeg").animate({width: '0%'},600);
	$("#jpre").animate({width: '0%'},600);
	$("#jampre").animate({width: '0%'},600);
	$("#jcap").animate({width: '0%'},600);
	if(sync){
		$("#jamcap").animate({width: '0%'},600,function(){$("#armeinfo").hide();});
	}else{
		$("#jamcap").animate({width: '0%'},600);
		$("#armeinfo").hide();
	}
	$("#piedbiche").hide();
}