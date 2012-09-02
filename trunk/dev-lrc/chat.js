$(document).ready(function(){
	$("#chatform input[name=mess]").watermark("Entrez votre message...");
	$("#pseudobox").mCustomScrollbar({
		set_height: 300
	});
	loadChat();
	loadOnline();
	setTimeout(function(){$("#pseudobox").mCustomScrollbar("scrollTo","bottom");},555);
	$("#chatform").submit(function(){
		$(this).ajaxSubmit({
			url: 'envoischat.php',
			type:'post',
			clearForm: true,
			beforeSubmit: addMessage,
			error: function(){
				alert("Error");
			}
		});
		return false;
	});
});

function addMessage(arr, form, options){
	if(form[0].mess.value.length==0){
		return false;
	}else{
		var d = new Date();
		var date =  d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
		addContent($(".mCSB_container"),form[0].pseudo.value,date,form[0].mess.value);
	}
}
function loadChat(){
	var url = 'selectchat.php';
	if($("#chattimestamp").text()){
		url=url+'?time='+$("#chattimestamp").text();
	}
	$.ajax({
		url: url,
		dataType: 'json',
		success: function(data){
			var result = data;
			if(result.type=='initial'){
				var cont = result.content;
				$("#chattimestamp").text(result.timestamp);
				$(".mCSB_container").empty();
				for(var i in cont){
					addContent($(".mCSB_container"),cont[i].user,cont[i].date,cont[i].message);
				}
				$('body').append('<span id="playSound"></span>');
			}else{
				var cont = result.content;
				$("#chattimestamp").text(result.timestamp);
				if(cont.length>0){
					for(var i in cont){
						addContent($(".mCSB_container"),cont[i].user,cont[i].date,cont[i].message);
					}
					$('#playSound').html("<embed src='snd/chat.mp3' hidden='true' autostart='true' loop='false'>");
				}
			}
		}
	});
	setTimeout(function(){loadChat();},1000);
}
function addContent(container, user, date, message){
	container.append(
			"<div class='small' style='clear:both;'>" +
				"<div style='float:left;'>" +
					"<font color='CC6600'>"+
						user+
					"</font>" +
				"</div>" +
				"<div style='float:right;'>"+
					date+
				"</div>" +
			"</div>");
	if(message){
		container.append("<div class='color1' style='clear:both;'>"+message+"</div>");
	}
	$("#pseudobox").mCustomScrollbar("update");
	$("#pseudobox").mCustomScrollbar("scrollTo","bottom");
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