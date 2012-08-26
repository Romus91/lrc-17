$(document).ready(function(){
	$("td.armeaction").click(function(){
		if($(this).attr("action")=="close"){
				$("#armeinfo").hide();
		}else{
			$("#armedetail").hide();
			$("#armedetail").empty();

			$.ajax({
				url: $(this).children("a").attr("href"),
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
});