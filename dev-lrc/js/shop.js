$(document).ready(function(){
	$(".shopitem > .logo").click(function(){
		var shopItem = $(this).parent();

		var categ = shopItem.attr("data-categ");
		var id = shopItem.attr("data-id");

		$.ajax({
			url:"buyitem.php?cat="+categ+"&id="+id,
			success:function(data){
				console.log(data);
				var result = JSON.parse(data);
				if(result.type=="success"){
					$('#popup .content .message').html('<p>'+result.content.message+'</p><span class="popup-buttons"><button id="popup-ok">Ok</button></span>');
					$('#popup .content').append();
					$('#popup .content .image').children("img").attr("src", 'http://chaotic-realms.net/pic/popup-accepted.png');
					$("#popup").show();
					$('#popup .content').animate({height : ($('#popup .content .message').outerHeight())},100);
					$('#popup-ok').click(function(){
						location.reload();
					});
				}else{
					$('#popup .content .message').html('<p>'+result.content.message+'</p>');
					$('#popup .content .image').children("img").attr("src", 'http://chaotic-realms.net/pic/popup-wrong.png');
					$("#popup").show();
					$('#popup .content').animate({height : '50px'},100);
					setTimeout(function(){$("#popup").hide();}, 3000);
				}
			},
			error:function(){
			}
		});
		return false;
	});

});