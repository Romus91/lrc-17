$(document).ready(function(){
	$("td.vendrearme").click(function(){
		$.ajax({
			url: $(this).children("a").attr("href"),
			success: function(data){
				var result = JSON.parse(data);
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
				}
			},
			error: function(){

			}
		});
		return false;
	});
});