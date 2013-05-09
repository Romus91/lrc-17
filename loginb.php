<?php require_once 'cdnHelper.php';?>
<html>
<head>
<title>Chaotic Realms - Accueil</title>
<link rel="icon" type="image/jpg" href="hl2logo.gif" />
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo date("dmYH");?>" />
<meta http-equiv="content-language" content="fr">
<style>
body{
	background: none;
	border: none;
}
#content.row{
	top: 70px;
	background-color: #333333;
	position: relative;
	min-height: 559px;
}
p.title{
	height: 40px;
	line-height: 40px;
	text-align: center;
	margin:0;
}
input{
	width:100%;
}
input[type="submit"]{
	display: block;
	height:40px;
	line-height: 40px;
	background: #242424;
	text-decoration: none;
	text-align: center;
	font-size: 13px;
	font-weight: bold;
	border:none;
	color: #FFFFFF;
}
input[type="submit"]:hover{
	background: #7f7f7f;
}
.col{
	box-sizing: border-box;
	border: 1px solid black;
}
.form{
	left:0;
	width:301px;
	padding:0;
}
.form > div{
	padding-bottom: 15px;
}
.img{
	right:0;
	left:300px;
}
.img img{
	margin: 1px 0px;
}
p.barremenu{
	padding: 0;
	margin: 0;
	height: 20px;
}
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18021612-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="body-wrapper">
	<div id="header" class="row">
		<a href="index.php"><img border="0" src="<?php echo convertToCDNUrl('pic/banner2.png');?>"></a>
	</div>
	<div id="content" class="row">
		<div class="form col">
			<div>
				<p class="title"><font size=3 color='555555'>CHAOTIC REALMS</font></p>
				<p class="desc">est un jeu de survie, le but étant de contrer des vagues de zombies chaque jour.<br>
				Avec pour seul amis, vos armes, vos pièges et vos précieuses munitions... <br><br>
				</p>
			</div>
			<div>
				<p class="title"><font size=3 color='555555'>CONNEXION</font></p>
				<form action="login.php" method='post'>
					<input type="text" name="login" maxlength="20" placeholder="LOGIN">
					<input type="password" name="pass" maxlength="20" placeholder="MOT DE PASSE">
					<input type="submit" value='>'>
					<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur'])) echo '<p>'.$_SESSION['erreur'].'</p>';?>
				</form>
			</div>
			<div>
				<p class="title"><font size=3 color='555555'>INSCRIPTION</font></p>
				<form action="inscriptionok.php" method="post">
					<input type="text" name="login" maxlength='20' placeholder="LOGIN">
					<?php if(isset($_SESSION['erreur2'])) echo '<p>'.$_SESSION['erreur2'].'</p>'; ?>
					<input type="password" name="pass" maxlength="30" placeholder="MOT DE PASSE">
					<input type="password" name="pass_confirm" maxlength="30" placeholder="CONFIRMATION">
					<?php if(isset($_SESSION['erreur1'])) echo '<p>'.$_SESSION['erreur1'].'</p>'; ?>
					<input type="text" name="email" placeholder="E-MAIL">
					<input type="submit" value='>'>
					<?php if(isset($_SESSION['erreur3'])) echo '<p>'.$_SESSION['erreur3'].'</p>'; ?>
				</form>
			</div>
		</div>
		<div class="img col"><img src='<?php echo convertToCDNUrl('pic/homelogin.png');?>' width='100%'></div>
	</div>
	<div id="footer">
			<p>
				<a href='http://romustech.dyndns.org'>Created by Romus</a><font color="FAC21D"> -- Copyright © Chaotic-Realms -- Co-developper : Anthares
					<!-- Mets l'adresse de ta plateforme personnelle ici ;) -->
				</font>
			</p>
		</div>
</div>
</body>
</html>
