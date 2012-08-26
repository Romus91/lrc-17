$(document).ready(function(){
	$("td.achatmunarme").click(function(){
		$.ajax({
			url: $(this).children("a").attr("href"),
			success: function(data){
				var result = JSON.parse(data);
				if(result.type == "reloadsuccess"){
					var cont = result.content;
					$("div.arme").each(function(index){
						if($(this).attr("arme")==cont.arme){
							$(this).next("div.munarme")
							.empty()
							.append(cont.mun+" | "+cont.capa);
							$("td#armedetail").hide();
							$("span#prix").empty().append(cont.money);
							return false;
						}
					});
				}
			},
			error: function(){
				alert("Error");
			}
		});
		return false;
	});
});



