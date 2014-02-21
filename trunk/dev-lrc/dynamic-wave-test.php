<?php
// require_once 'verif.php';
require_once 'autoload.php';

session_start();

$persoCont = new PersoController();
$perso = $persoCont->fetchPerso(1);

$inv_arm=$perso->getInvArme();


if(isset($_POST['ajax'])){

	echo "{}";
	exit;
}else{
	if(!isset($_SESSION['wave'])){
		$waveGen = new WaveGenerator($perso->getLevel());
		$_SESSION['wave']=$waveGen->getWave();
		$_SESSION['waveGen']=$waveGen;
		$_SESSION['waveRec']=new WaveRecorder();



	}else{
		$wave = $_SESSION['wave'];
	}
}

?>
<link href="css/style.css?<?php echo date("dmYH");?>" rel="stylesheet" type="text/css"/>
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

<script type="text/javascript">
<!--
var tickInterval = 2000;
var decompte = 5;
var loopPtr;
var warmUpPtr;
var key = null;

var keyA={
			display:"A",
			id:"#key-a",
			weapon: <?php if(isset($inv_arm[0])) echo $inv_arm[0]->getId();else echo -1;?>
			};
var keyZ={
			display:"Z",
			id:"#key-z",
			weapon: <?php if(isset($inv_arm[1])) echo $inv_arm[1]->getId();else echo -1;?>
			};
var keyE={
			display:"E",
			id:"#key-e",
			weapon: <?php if(isset($inv_arm[2])) echo $inv_arm[2]->getId();else echo -1;?>
			};
var keyR={
			display:"R",
			id:"#key-r",
			weapon: <?php if(isset($inv_arm[3])) echo $inv_arm[3]->getId();else echo -1;?>
			};
var keyT={
			display:"T",
			id:"#key-t",
			weapon: <?php if(isset($inv_arm[4])) echo $inv_arm[4]->getId();else echo -1;?>
			};
var keyY={
			display:"Y",
			id:"#key-y",
			weapon: <?php if(isset($inv_arm[5])) echo $inv_arm[5]->getId();else echo -1;?>
			};

function warmUp(){
	warmUpPtr = setInterval(function(){

		decompte--;
		if(decompte==0){
			startLoop();
		}
		$("#timer").html(decompte);
	},1000);
}
function startLoop(){
	clearInterval(warmUpPtr);
	animateBar();
	loopPtr = setInterval(doLoop,tickInterval);
	$("#timer").hide();
}
function doLoop(){
	animateBar();

	var startTime = new Date().getTime();
	var selectedKey = key;

	$.ajax({
		url:"/dynamic-wave-test.php",
		type: "POST",
		data:{
			weapon: selectedKey,
			ajax: true
		},
		success: function(data){
			$("#latency").html(new Date().getTime()-startTime);

			console.log(data);


			$("#exec-time").html(new Date().getTime()-startTime);
		},
		error: function(data){
			console.log(data);
		}
	});

	key=null;
	keySelected(key);
	$("#selected-key").html(null);
}
function stopLoop(){
	clearInterval(loopPtr);
}
function animateBar(){
	var barre = $(".jauge > .barre");
	barre.stop();
	barre.css({width: "100%"});

	barre.animate({
		width: 0
	},tickInterval);
}
function keyPressed(evt){
	switch(evt.keyCode){
	case 97: key=keyA;break;
	case 122: key=keyZ;break;
	case 101: key=keyE;break;
	case 114: key=keyR;break;
	case 116: key=keyT;break;
	case 121: key=keyY;break;
	}
	keySelected(key);
	console.log(evt.keyCode);
}
function keySelected(selectedKey){
	$(".key").each(function(){
		$(this).removeClass("pressed");
	});

	if(selectedKey!=null){
		$(selectedKey.id).addClass("pressed");
		$("#selected-key").html(selectedKey.display);
	}
}
$(document).ready(function(){
	$("#timer").html(decompte);
	warmUp();
	document.onkeypress = keyPressed;
});
//-->
</script>
<style>
.barre, .jauge {
	width: 300px;
	height: 5px;
}
#timer,#selected-key {
	font-size: 20pt;
}
.reset-float{
	clear: both;
	float: none;
}
#keyboard>.key {
	float: left;
	background: #ec5210;
	width: 45px;
	height: 45px;
	margin-left: 2px;
	margin-right: 1px;
	border: 1px transparent solid;
	text-align: center;
}
#keyboard>.pressed {
	border: 1px white solid;
}
</style>

<div id="timer"></div>
<div class='jauge'>
	<img class='barre' id="jaugevie" src='pic/jgris.png' width='100%'>
</div>
<div id="keyboard">
	<div id="key-a" class="key">A</div>
	<div id="key-z" class="key">Z</div>
	<div id="key-e" class="key">E</div>
	<div id="key-r" class="key">R</div>
	<div id="key-t" class="key">T</div>
	<div id="key-y" class="key">Y</div>
	<div class="reset-float"/>
</div>
<div id="selected-key"></div>
<div>Latence : <span id="latency">0</span> ms</div>
<div>Temps execution : <span id="exec-time">0</span> ms</div>