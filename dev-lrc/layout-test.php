<html>
<head>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="jquery-ui-1.8.23.custom.min.js"></script>
<style type="text/css">
	body { margin-left: auto;margin-right:auto;width: 900px;}
	.row, .col { position: absolute; }
	.row { left: 0; right: 0; }
	.col { top: 0; bottom: 0; }
	.scroll-x { overflow-x: auto; }
	.scroll-y { overflow-y: auto; }

	.left.col { width: 100px; background:#333;}
	.backtray.col{width:500px;background:yellow}
	.right.col { left: 100px; right: 0;}
	.header.row { height: 75px; line-height: 75px; background:red}
	.body.row { top: 75px; bottom: 50px; background:green}
	.footer.row { height: 50px; bottom: 0; line-height: 50px; background:blue}
	.wrapper{position:absolute;width:100%;height:100%;left:0;right:0}
	.wrapper.moved{left:250;right:-250}

	#header{
		background: #666;
		width:100%;
		height:150px;
	}
	#content{position:relative;height: 700}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(".left.col").click(function(){
		//$(".wrapper").toggleClass("moved",500);
		if($(".backtray").hasClass("moved")){
			$(".backtray").animate({left:"+=500"},100);
			$(".backtray").removeClass("moved");
		}else{
			$(".backtray").animate({left:"-=500"},100);
			$(".backtray").addClass("moved");
		}
	});
});
</script>
</head>
<body>
	<div id="header"></div>
	<div id=content>
		<div class="backtray col"></div>
		<div class="left col">
	    </div>
	    <div class="right col">
	    	<div class="wrapper">
		        <div class="header row">
		        View or edit something
			    </div>
			    <div class="body row scroll-y">
			        Here’s some content that can scroll vertically
			    </div>
			    <div class="footer row">
			        Some status message here
			    </div>
		    </div>
	    </div>
    </div>
</body>
</html>