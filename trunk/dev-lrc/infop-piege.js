$(document).ready(function(){
	$("div.piege").click(function(){
		perso = $(this).attr("perso");
		piege = $(this).attr("piege");
		if($("#piegeinfo").is(":hidden") || $("#piegeinfo").attr("piege")!=piege){
			hideArmeinfo(false);
			$("#piegeinfo").attr("perso",perso);
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
								dataType : 'json',
								success: function(data){
									if(data.type=='success'){
										if(data.content!=0){
											$("td.piegeaction.reload").children("a").text("RECHARGER ? ("+data.content+" $)");
											$("td.piegeaction.reload").children("a").removeClass("disabled");
											$("td.piegeaction.reload").children("a").css("color","#ffffff");
										}else{
											$("td.piegeaction.reload").children("a").text("RECHARGER");
											$("td.piegeaction.reload").children("a").addClass("disabled");
											$("td.piegeaction.reload").children("a").css("color","#333333");
										}
									}
								},
								error: function(){
									alert("Error");
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
	$("td.piegeaction.reload").click(function(){
		if(!$(this).children("a").hasClass("disabled")){
			var url = $(this).children("a").attr("href")+$("#piegeinfo").attr('piege');
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(data){
					console.log(data);
					var result = data;
					if(result.type == "reloadsuccess"){
						var cont = result.content;
						$("div.piege").each(function(index){
							if($(this).attr("piege")==cont.piege){
								$(this).next("div.munpiege")
								.empty()
								.append(cont.munp+" | "+cont.capa);
								$("span#prix").empty().append(cont.money);
								$("td.piegeaction.reload").children("a").text("RECHARGER");
								$("td.piegeaction.reload").children("a").addClass("disabled");
								$("td.piegeaction.reload").children("a").css("color","#333333");
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
	$("td.piegeaction.sell").click(function(){
		$.ajax({
			url: $(this).children("a").attr("href")+$("#piegeinfo").attr("piege"),
			dataType: 'json',
			success: function(data){
				$('#popup .content .message').html('<p>Voulez vous vendre '+data.piege+' pour <font color="#00ff00">'+data.prix+' $</font></p>'+'<span class="popup-buttons"><button id="popup-vente-yes">Oui</button><button id="popup-no">Non</button></span>');
				$('#popup .content').append();
				$('#popup .content .image').children("img").attr("src", 'pic/popup-question.png');
				$("#popup").show();
				$('#popup .content').animate({height : ($('#popup .content .message').outerHeight())},100);
				$('#popup-vente-yes').click(function(e){
					var url= 'piegevendreok.php?perso='+$('#piegeinfo').attr("perso")+'&i='+$('#piegeinfo').attr('piege');
					$.ajax({
						url: url,
						dataType: 'json',
						success: function(data){
							var result = data;
							if(result.type == "success"){
								var cont = result.content;
								var elem;
								var parent;
								$("div.piege").each(function(index){
									if($(this).attr("piege")==cont.piege){
										$(this).empty().append("<a href='#'></a>");
										$(this).next("div.munpiege")
										.empty()
										.append("0 | 0");
										elem = $(this).parent("td");
										elem.remove();
										$("td.piege").after(elem);
										$("span#prix").empty().append(cont.money);
										$("#piegeinfo").hide();
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
});
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