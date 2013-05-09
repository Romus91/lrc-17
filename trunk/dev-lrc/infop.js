$(document).ready(function(){
	$("div.conso").click(function(){
		if($(this).is(":parent")){
			var url = $(this).children("a").attr('href');
			console.log(url);
			var target = $(this);
			$.ajax({
				url: url,
				success: function(data){
					var result = JSON.parse(data);
					if(result.type == "success"){
						if(result.content.type=="vie"){
							$("span#vie").text(result.content.amount);
							$("#jaugevie").stop(true,true).animate({width: result.content.jauge},2001);
						}else{
							$("span#eng").text(result.content.amount);
							$("#jaugeeng").stop(true,true).animate({width: result.content.jauge},2001);
						}
						target.empty();
					}else{
						$('#popup .content .message').html('<p>Consommable inexistant, r&eacute;essayez !</p>');
						$('#popup .content .image').children("img").attr("src", 'http://anthares.be/lrc/pic/popup-wrong.png');
						$("#popup").show();
						$('#popup .content').animate({height : ($('#popup .content .message').outerHeight())},100);
						setTimeout(function(){$("#popup").hide();}, 5000);
					}
				},
				error: function(data){
					$("div#error").html(data);
					alert("Error");
				}
			});
		}
		return false;
	});
});

