<?php if(file_exists('lrc.lock')) {
	include_once 'maintenance.php';
}

include_once("verif.php");
include_once('pass.php');
require_once("cdnHelper.php");

$memCont = new MemberController();
$mem = $memCont->fetchMembre($_SESSION['member_id']);

if($mem->getLevelPercent()>=100){
	$mem->levelUp();
	$memCont->saveMember($mem);
}

$amCont = new AmelioCompteController();

$persoController = new PersoController();
$log = new Log();
?>
<html>
<head>
<title>LES RESCAPES DE CITE 17</title>
<meta charset="UTF-8">
<link rel="icon" type="image/jpg" href="hl2logo.gif" />
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo date("dmYH");?>" />
<link href="jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script src="http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js"></script>
<script src="jquery.mousewheel.min.js"></script>
<script src="jquery.mCustomScrollbar.js"></script>
<script src="jquery.form.js"></script>
<script src="jquery.watermark.js"></script>
<script src="js/mousetrap.js"></script>
<script src="js/mousetrap-global.js"></script>
<script src="js/chat.js?<?php echo date("dmYH");?>"></script>
<script src="js/menu.js?<?php echo date("dmYH");?>"></script>
<script type="text/javascript">
		var wheelUrl = '<?php echo convertToCDNUrl('pic/wheel.png');?>';
		var arrowDownUrl = '<?php echo convertToCDNUrl('pic/meminfoArrowDown.png')?>';
		var arrowUpUrl = '<?php echo convertToCDNUrl('pic/meminfoArrowUp.png')?>';
		$(document).ready(function(){
			$.fn.preload = function() {
			    this.each(function(){
			        $('<img/>')[0].src = this;
			    });
			};
			$('#wheel').click(function(){
				$('#meminfo').toggle();
			});
			$([arrowDownUrl,arrowUpUrl]).preload();
			$('#wheel').hover(
				function(){
					var img = $(this).children("span#info").children('img');
					if($('#meminfo').is(':visible')){
						img.attr('src',arrowUpUrl);
					}else{
						img.attr('src',arrowDownUrl);
					}
					img.animate({
						height: '+=10',
						width: '+=10',
						top: '-=5',
						left: '-=5'
					},200);
				},
				function(){
					var img = $(this).children("span#info").children('img');
					img.animate({
						height: '-=10',
						width: '-=10',
						top: '+=5',
						left: '+=5'
					},200,function(){
						img.attr('src',wheelUrl);
					});
				}
			);
			//$("body").height($(document).height()-2);
		});
	</script>
<meta http-equiv="content-language" content="fr">
</head>
<body>
	<audio id="chat-sound-player" preload>
		<source src="snd/chat.mp3" type="audio/mpeg">
		<source src="snd/chat.ogg" type="audio/ogg">
		<source src="snd/chat.wav" type="audio/wav">
		<div style="position: fixed; text-align: center; left: 30; right: 30; top: 100; padding: 30px; color: #f00; font-family: verdana; font-size: 20px; background: #666; z-index: 30;">
			<p>Votre navigateur est obsol&egrave;te et ne supporte pas l'HTML5 !</p>
			<p>Merci de le mettre &agrave; jour pour profiter pleinement de l'exp&eacute;rience de jeu ;-)</p>
			<p>
				<a href="www.google.com/chrome">
					<img src="http://upload.wikimedia.org/wikipedia/fr/9/9e/Google_Chrome_logo.png" height="50px">
				</a>
				<a href="http://windows.microsoft.com/fr-FR/internet-explorer/downloads/ie-10/worldwide-languages">
					<img src="http://upload.wikimedia.org/wikipedia/fr/a/a0/Internet_Explorer_9_logo.png" height="50px">
				</a>
				<a href="www.mozilla.org/fr/firefox/">
					<img src="http://upload.wikimedia.org/wikipedia/fr/8/84/Firefox_New_Logo.png" height="50px">
				</a>
			</p>
		</div>
	</audio>
	<div id="body-wrapper">
		<div id="header" class="row">
			<a href="index.php"><img border="0" src="<?php echo convertToCDNUrl('pic/banner2.png');?>"> </a>
		</div>
		<div class="bannerinfo row">
			<div class="info">
				<p>
					<?php echo $mem->getLogin();?>
				</p>
				<span>-</span>
			</div>
			<div class="info">
				<p>NIV</p>
				<span><?php echo $mem->getLevel();?> </span>
			</div>
			<div class="info">
				<p>ARG</p>
				<span><?php echo $mem->getArgent();?> <strike>Cr</strike> </span>
			</div>
			<div class="info"></div>
		</div>
		<div id='membre' class='jauge row'>
			<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>"> <img class='barre'
				src='<?php echo convertToCDNUrl('pic/jblanc.png');?>' width='<?php echo $mem->getLevelPercent();?>%'
			>
			<div class='lib'>EXP</div>
			<div class="texte">
				<?php echo $mem->getXp();?>
				|
				<?php echo floor($mem->getXpForNextLevel());?>
			</div>
		</div>
		<div id="content" class="row">
			<div class="left col menu">
				<div class="mainmenu">
					<a href=#>MENU</a>
				</div>
				<div class="persos">
					<a href=#>PERSOS</a>
				</div>
				<div class="compte">
					<a href=#>COMPTE</a>
				</div>
				<div class="shop">
					<a href=#>SHOP</a>
				</div>
				<p>&nbsp;</p>
			</div>
			<div class="right col">
				<div id="mainmenu" class="backtray col scroll-y">
					<?php include_once 'static/main-menu.html';?>
				</div>
				<div id="persos" class="backtray col scroll-y">
					<?php require_once 'survivants-fast.php';?>
				</div>
				<div id="compte" class="backtray col scroll-y">
					<?php require_once 'account.php';?>
				</div>
				<div id="shop" class="backtray col scroll-y">
					<?php require_once 'shop-content.php';?>
				</div>
				<div id="wrapper">
					<div id="popup">
						<div class='content'>
							<div class='message'></div>
							<div class="image">
								<img src="http://placehold.it/50x50">
							</div>
						</div>
					</div>
					<div class="body row scroll-y">
						<?php
						if ((!isset($_GET['page'])) or (isset($_GET['page']) && $_GET['page'] == 'home')){
							include('home.php');
						}else if(isset($_GET['page'])){
							switch ($_GET['page']){
								case 'planque': 		include 'planque.php'; 			break;
								case 'citoyen': 		include 'citoyen.php'; 			break;
								case 'ladder': 			include 'ladder.php'; 			break;
								case 'perso': 			include 'perso.php'; 			break;
								case 'vague': 			include 'wave.php'; 			break;
								case 'achat': 			include 'achat.php'; 			break;
								case 'achatok': 		include 'achatok.php'; 			break;
								case 'citoyencreer': 	include 'citoyencreer.php';		break;
								case 'citoyencreerok':	include 'citoyencreerok.php'; 	break;
								case 'citoyensuppok': 	include 'citoyensuppok.php';	break;
								case 'wall': 			include 'wall.php'; 			break;
								case 'maj': 			include 'maj.php'; 				break;
								case 'lexique': 		include 'lexique.php'; 			break;
								default:				include 'deconnexion.php';
							}
						}?>
					</div>
				</div>
			</div>
		</div>
		<?php require_once 'chat.php';?>
		<div id="footer">
			<p>
				<a href='http://romustech.dyndns.org'>Created by Romus</a><font color="FAC21D"> -- Copyright &copy; Chaotic-Realms -- Co-developper : Anthares
					<!-- Mets l'adresse de ta plateforme personnelle ici ;) -->
				</font>
			</p>
		</div>
	</div>
</body>
</html>
