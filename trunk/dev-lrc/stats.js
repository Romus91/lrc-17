$(document).ready(function(){
	$("tr.perso").click(function(){
		var url = $(this).attr("perso");
		$(this).next("tr.stats").toggle();
	});
	$("tr.perso").hover(
		function(){
			$(this).children("td").addClass("hover");
		},
		function(){
			$(this).children("td").removeClass("hover");
		}
	);
});