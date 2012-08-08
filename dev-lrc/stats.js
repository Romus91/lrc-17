$(document).ready(function(){
	$("tr.perso").click(function(){
		var url = $(this).attr("perso");
		$(this).next("tr.stats").toggle();
	});
});