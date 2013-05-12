$(document).ready(function() {
	$(".left.menu > div.mainmenu").click(function() {
		if ($("#wrapper").hasClass("moved")
				&& $(".backtray#mainmenu").is(":visible")) {
			hideBacktray();
		} else {
			changeBacktray(200,function(callback) {
				$(".backtray#mainmenu").show(1, callback);
			});
		}
		return false;
	});

	$(".left.menu > div.persos").click(function() {
		if ($("#wrapper").hasClass("moved")
				&& $(".backtray#persos").is(":visible")) {
			hideBacktray();
		} else {
			changeBacktray(195,function(callback) {
				$(".backtray#persos").show(1, callback);
			});
		}
		return false;
	});

	$(".left.menu > div.compte").click(function() {
		if ($("#wrapper").hasClass("moved")
				&& $(".backtray#compte").is(":visible")) {
			hideBacktray();
		} else {
			changeBacktray(500,function(callback) {
				$(".backtray#compte").show(1, callback);
			});
		}
		return false;
	});

	$(".left.menu > div.shop").click(function() {
		if ($("#wrapper").hasClass("moved")
				&& $(".backtray#shop").is(":visible")) {
			hideBacktray();
		} else {
			changeBacktray(650,function(callback) {
				$(".backtray#shop").show(1, callback);
			});
		}
		return false;
	});
});

function hideBacktray(callback) {
	$("#wrapper").animate({
		left : 0,
		right : 0
	}, 100, function() {
		$(".backtray").each(function() {
			$(this).hide(0);
		});
		$("#wrapper").removeClass("moved");
		if (typeof callback != 'undefined')
			callback();
	});
}

function changeBacktray(width, callback) {
	hideBacktray(function() {
		callback(function() {
			$("#wrapper").addClass("moved");
			$("#wrapper").animate({
				left : width,
				right : width
			}, 200);
		});
	});
}