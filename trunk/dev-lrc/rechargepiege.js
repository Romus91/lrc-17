$(document).ready(function(){
	$("td.achatmunpiege").click(function(){
		$.ajax({
			url: $(this).children("a").attr("href"),
			success: function(data){
				var result = JSON.parse(data);
				if(result.type == "reloadsuccess"){
					var cont = result.content;
					$("div.piege").each(function(index){
						if($(this).attr("piege")==cont.piege){
							$(this).next("div.munpiege")
							.empty()
							.append(cont.munp+" | "+cont.capa);
							$("td#piegedetail").hide();
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



