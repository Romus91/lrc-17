$(document).ready(function(){
	$("div.arme").click(function(){
		perso = $(this).attr("perso");
		arme = $(this).attr("arme");
		$("#piedbiche").hide();
		if($("#armeinfo").is(":hidden") || $("#armeinfo").attr("arme")!=arme){
			hidePiegeinfo(false);
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
							$.ajax({
								url: "armeinforecharg.php?perso="+perso+"&i="+arme,
								success: function(data){
									$("#armedetail").html(data);
									$("#armedetail").show();
								},
								error: function(){
									$("#armedetail").html("Error");
									$("#armedetail").show();
								}
							});
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
	$("div.piege").click(function(){
		perso = $(this).attr("perso");
		piege = $(this).attr("piege");
		if($("#piegeinfo").is(":hidden") || $("#piegeinfo").attr("piege")!=piege){
			hideArmeinfo(false);
			$("#piegeinfo").attr("piege",piege);
			var url = $(this).children("a").attr("href");
			if(url){
				$.ajax({
					url: url,
					success: function(data){
						var result = JSON.parse(data);
						if(result.type == "success"){
							$("#piegeinfo").stop(true);
							$("#piegeinfo").show();
							$("#pjdeg").animate({width: result.content.pjdeg},600);
							$("#pjpre").animate({width: result.content.pjpre},600);
							$("#pjcap").animate({width: result.content.pjcap},600);
							$("#nompiege").text(result.content.nomarme);
							$.ajax({
								url: "piegeinforecharg.php?perso="+perso+"&i="+piege,
								success: function(data){
									$("#piegedetail").html(data);
									$("#piegedetail").show();
								},
								error: function(){
									$("#piegedetail").html("Error");
									$("#piegedetail").show();
								}
							});
						}
					},
					error: function(){
						alert("Error");
					}
				});
			}
		}else{
			hidePiegeinfo(true);
		}
		return false;
	});
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
	$("td.armeaction").click(function(){
		if($(this).attr("action")=="close"){
			hideArmeinfo(true);
		}else{
			$("#armedetail").hide();
			$("#armedetail").empty();

			$.ajax({
				url: $(this).children("a").attr("href")+$("#armeinfo").attr("arme"),
				success: function(data){
					$("#armedetail").append(data);
					$("#armedetail").show();
				},
				error: function(){
					$("#armedetail").append("Error");
					$("#armedetail").show();
				}
			});
		}
		return false;
	});
	$("td.piegeaction").click(function(){
		if($(this).attr("action")=="close"){
			hidePiegeinfo(true);
		}else{
			$("#piegedetail").hide();
			$("#piegedetail").empty();

			$.ajax({
				url: $(this).children("a").attr("href")+$("#piegeinfo").attr("piege"),
				success: function(data){
					$("#piegedetail").append(data);
					$("#piegedetail").show();
				},
				error: function(){
					$("#piegedetail").append("Error");
					$("#piegedetail").show();
				}
			});
		}
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
function hidePiegeinfo(sync){
	$("#pjdeg").animate({width: '0%'},600);
	$("#pjpre").animate({width: '0%'},600);
	if(sync){
		$("#pjcap").animate({width: '0%'},600,function(){$("#piegeinfo").hide();});
	}else{
		$("#pjcap").animate({width: '0%'},600);
		$("#piegeinfo").hide();
	}
}