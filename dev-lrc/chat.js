$(document).ready(function(){
	$("#chatform input").watermark("Entrez votre message...");
	$("#pseudobox").mCustomScrollbar({
		set_height: 300
	});
	loadChat();
	loadOnline();
	setTimeout(function(){$("#pseudobox").mCustomScrollbar("scrollTo","bottom");},555);
	$("#chatform").submit(function(){
		$(this).ajaxSubmit({
			url: 'envoischat.php',
			type:'get',
			success: function(data){
				setTimeout(function(){
					//$("#pseudobox").mCustomScrollbar("update");
					$("#pseudobox").mCustomScrollbar("scrollTo","bottom");
				},1111);
			},
			clearForm: true,
			error: function(){
				alert("Error");
			}
		});
		return false;
	});
});

function loadChat(){
	$.ajax({
		url: 'selectchat.php',
		success: function(data){
			$(".mCSB_container").empty();
			$(".mCSB_container").append(data);
			$("#pseudobox").mCustomScrollbar("update");
		}
	});
	setTimeout(function(){loadChat();},1000);
}

function loadOnline(){
	$.ajax({
		url: 'online.php',
		success: function(data){
			$("#online").empty().append(data);
		}
	});
	setTimeout(function(){loadOnline();},5000);
}