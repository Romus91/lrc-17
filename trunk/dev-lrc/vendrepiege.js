$(document).ready(function(){
	$("td.vendrepiege").click(function(){
		$.ajax({
			url: $(this).children("a").attr("href"),
			success: function(data){
				var result = JSON.parse(data);
				if(result.type == "success"){
					var cont = result.content;
					var elem;
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
				}
			},
			error: function(){

			}
		});
		return false;
	});
});