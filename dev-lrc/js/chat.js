$(document).ready(function(){
	$("#chatform input[name=mess]").watermark("Entrez votre message...");
	$("#pseudobox").mCustomScrollbar({
		set_height: '340'
	});
	$("#online").mCustomScrollbar({
		set_height: '270'
	});
	loadChat();
	loadOnline();
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
	$("#chat-tray").click(function(){
		toggleChat();
	});
	Mousetrap.bindGlobal("ctrl+space",function(e){
		toggleChat();
		return false;
	});
	if(window.localStorage.getItem('unreadMessage') != null){
		$("#chatUnreadMessage").html(window.localStorage.getItem('unreadMessage'));
	}
	document.getElementById('chat-sound-player').addEventListener('ended',function(){
		this.currentTime=0;
	},false);
	if(window.localStorage.getItem('playChatSound')== null){
		window.localStorage.setItem('playChatSound',true);
	}else{
		if(window.localStorage.getItem('playChatSound') === 'true'){
			$('#chat-sound').removeClass("off");
		}else{
			$('#chat-sound').addClass("off");
		}
	}
	$('#chat-sound').click(function(){
		if(window.localStorage.getItem('playChatSound') === 'true'){
			window.localStorage.setItem('playChatSound',false);
			$(this).addClass("off");
		}else{
			window.localStorage.setItem('playChatSound',true);
			$(this).removeClass("off");
		}
	});
});

function toggleChat(){
	if($("#footer-block-wrapper").hasClass('shown')){
		$("#footer-block-wrapper").stop().animate({height:'31px'},600);
	}else{
		$("#footer-block-wrapper").stop().animate({height:'402px'},600,function(){
			$("#chatform input[name=mess]").focus();
		});
		window.localStorage.setItem('unreadMessage',0);
		$("#chatUnreadMessage").html(window.localStorage.getItem('unreadMessage'));
	}
	$("#footer-block-wrapper").toggleClass('shown');
	$("#chat-tray-arrow").toggleClass('down');
}

function addMessage(arr, form, options){
	if(form[0].mess.value.length==0){
		return false;
	}else{
		var d = new Date();
		var date =  d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
		addContent($("#pseudobox .mCSB_container"),form[0].pseudo.value,date,form[0].mess.value);
		updateScroll();
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
				$("#pseudobox .mCSB_container").empty();
				for(var i in cont){
					addContent($("#pseudobox .mCSB_container"),cont[i].user,cont[i].date,cont[i].message);
				}
				if(window.localStorage.getItem('unreadMessage') == null) window.localStorage.setItem('unreadMessage',0);
				updateScroll();
			}else{
				var cont = result.content;
				$("#chattimestamp").text(result.timestamp);
				if(cont.length>0){
					for(var i in cont){
						addContent($("#pseudobox .mCSB_container"),cont[i].user,cont[i].date,cont[i].message);
					}
					playSound();
					if(!$("#footer-block-wrapper").hasClass('shown')){
						var count = parseInt(window.localStorage.getItem('unreadMessage'));
						count+=cont.length;
						$("#chatUnreadMessage").html(count);
						window.localStorage.setItem('unreadMessage',count);
					}
					updateScroll();
				}
			}
			setTimeout(function(){loadChat();},1000);
		},
		error: function(){
			setTimeout(function(){loadChat();},500);
		}
	});
}
function updateScroll(){
	$("#pseudobox").mCustomScrollbar("update");
	$("#pseudobox").mCustomScrollbar("scrollTo","bottom");
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
}
function playSound(){
	if(window.localStorage.getItem('playChatSound') === 'true'){
		document.getElementById('chat-sound-player').play();
	}
}

function loadOnline(){
	$.ajax({
		url: 'online.php',
		success: function(data){
			$("#online .mCSB_container").empty().append(data);
			$("#online").mCustomScrollbar("update");
		}
	});
	setTimeout(function(){loadOnline();},5000);
}