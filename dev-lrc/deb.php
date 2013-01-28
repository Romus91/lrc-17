<?php if(file_exists('lrc.lock')) {exit("Le site est actuellement en maintenance, allez vous faire un café et revenez dans quelques minutes !");} ?>
<html>
<head>
	<title>LES RESCAPES DE CITE 17</title>
	<link rel="icon" type="image/jpg" href="hl2logo.gif" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link href="jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
	<link href="vader/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="jquery-ui-1.8.23.custom.min.js"></script>
	<script src="http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js"></script>
	<script src="jquery.mousewheel.min.js"></script>
	<script src="jquery.mCustomScrollbar.js"></script>
	<script src="jquery.form.js"></script>
	<script src="jquery.watermark.js"></script>
	<script src="chat.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#shop').accordion({
				autoHeight: false
			});
			$('#wheel').click(function(){
				$('#meminfo').toggle();
				$('#shop').accordion("resize");
			});
		});
	</script>
	<meta http-equiv="content-language" content="fr">
<!-- <meta http-equiv="content-type" content="text/html; charset=utf-8" />-->
<?php
	if (isset($_GET['reloadcit'])&&$_GET['reloadcit'])
		echo'<meta http-equiv="refresh" content="0; url=index.php?page=citoyen" />';

	$memCont = new MemberController();
	$mem = $memCont->fetchMembre($_SESSION['member_id']);
	if($mem->getLevelPercent()>=100){
		$mem->levelUp();
		$memCont->saveMember($mem);
	}
	$amCont = new AmelioCompteController();
  ?>

</head>
<body>
	<center>
	<audio id="chat-sound-player" preload>
		<source src="snd/chat.mp3" type="audio/mpeg">
		<source src="snd/chat.ogg" type="audio/ogg">
		<source src="snd/chat.wav" type="audio/wav">
		<div style="
			position: fixed;
			text-align: center;
			left:30;
			right:30;
			top:100;
			padding: 30px;
			color: #f00;
			font-family: verdana;
			font-size: 20px;
			background: #666;
			z-index: 30;
		">
			<p>Votre navigateur est obsol&egrave;te et ne supporte pas l'HTML5 !</p>
			<p>Merci de le mettre &agrave; jour pour profiter pleinement de l'exp&eacute;rience de jeu ;-)</p>
		</div>
	</audio>
		<table align=center class='main'>
			<tr>
				<td>
					<table border="0" width=100%>
						<tr>
							<td width="100%" class="header" colspan="3" align=center>
								<a href="index.php">
									<img border="0" src="<?php echo convertToCDNUrl('pic/banner.png');?>" width="700">
								</a>
							</td>
						</tr>
						<tr>
							<td width="100%" class="bannerinfo" colspan="3" align=center>
								<table width='100%'>
									<tr>
										<td class='info' align=center width="30%"><?php echo $mem->getLogin();?><br>
											<span id='info'>-</span></td>
										<td id="wheel" class='info' align=center width="40%"><span id='info'><img
												src="<?php echo convertToCDNUrl('pic/wheel.png');?>" height="40px"> </span></td>
										<td class='info' align=center width="15%">NIV<br> <span
											id='info'><?php echo $mem->getLevel();?> </span></td>
										<td class='info' align=center width="15%">ARG<br> <span
											id='info'><?php echo $mem->getArgent();?> $</span></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan=3>
								<?php if(isset($_SESSION['shop_error'])):?>
									<p id="shop-error" style="color:#f00;text-align: center;font-size:18;"><?php echo $_SESSION['shop_error'];unset($_SESSION['shop_error']);?></p>
									<script>setTimeout(function(){$("#shop-error").remove();},5000);</script>
								<?php endif;?>
								<div id='membre' class='jauge'>
									<img class='grid' src="<?php echo convertToCDNUrl('pic/fond-jauge.png');?>"> <img
										class='barre' src='<?php echo convertToCDNUrl('pic/jblanc.png');?>'
										width='<?php echo $mem->getLevelPercent();?>%'>
									<div class='lib'>EXP</div>
									<div class="texte">
										<?php echo $mem->getXp();?>
										|
										<?php echo floor($mem->getXpForNextLevel());?>
									</div>
								</div>
							</td>
						</tr>
						<tr id="meminfo">
							<td colspan=3>
								<div id="shop">
									<h3>
										<a href="#">Shop</a>
									</h3>
									<div>
									<table id="shopList">
										<tr>
											<?php
											$amPierce = $amCont->fetchAmelio($mem->getPierceLevel(),AmelioCompte::AM_PIERCE);
											$amFrag = $amCont->fetchAmelio($mem->getFragLevel(),AmelioCompte::AM_FRAG);?>
											<td class="shopitem">
											<?php if($amPierce!=null):?>
												<?php if($mem->getLevel()>=$amPierce->getLevelRequis()):?>
												<a class="hev" href="amcompte.php?type=<?php echo AmelioCompte::AM_PIERCE?>">
													<img src="<?php echo convertToCDNUrl('pic/'.$amPierce->getImage());?>" height="40px">
													<p><font size=3><?php echo $amPierce->getPrix()?> $</font></p>
												</a>
												<?php else:?>
												<div class="hev">
													<p><font size=2 color=999999>NIVEAU</font></p>
													<p><font size=5 color="F7A300"><?php echo $amPierce->getLevelRequis()?></font></p>
													<p><font size=2 color=999999>REQUIS</font></p>
												</div>
												<?php endif;?>
											<?php else:?>
											<font size=6 color=999999>MAX</font>
											<?php endif;?>
											</td>
											<td class="shopitem">
												<?php if($amFrag!=null):?>
													<?php if($mem->getLevel()>=$amFrag->getLevelRequis()):?>
													<a class="hev" href="amcompte.php?type=<?php echo AmelioCompte::AM_FRAG?>">
														<img src="<?php echo convertToCDNUrl('pic/'.$amFrag->getImage());?>" height="40px">
														<p><font size=3><?php echo $amFrag->getPrix()?> $</font></p>
													</a>
													<?php else:?>
													<div class="hev">
														<font size=2 color=999999>NIVEAU</font>
														<br>
														<font size=5 color="F7A300"><?php echo $amFrag->getLevelRequis()?></font>
														<br>
														<font size=2 color=999999>REQUIS</font>
													</div>
													<?php endif;?>
												<?php else:?>
												<font size=6 color=999999>MAX</font>
												<?php endif;?>
											</td>
											<td class="shopitem">
												<div class="hev">
													<img src="<?php echo convertToCDNUrl('pic/antidote.png');?>" height="40px">
													<p><font size=3>5000 $</font></p>
												</div>
											</td>
										</tr>
										<tr>
											<td class="shopitemdesc">Munitions Perforantes</td><td class="shopitemdesc">Munitions Frag</td><td class="shopitemdesc">Antidote</td>
										</tr>
									</table>
									</div>
									<h3>
										<a href="#">Inventaire</a>
									</h3>
									<div>
									<table id="inventory">
									<?php for ($i = 0; $i<1; $i++):?>
										<tr>
										<?php for($j=0;$j<8;$j++):?>
										<td class="invSlot">

										</td>
										<?php endfor;?>
										</tr>
									<?php endfor;?>
									</table>
									</div>
									<h3>
										<a href="#">Tours de force</a>
									</h3>
									<div>Comming soon ;-)</div>
								</div>
							</td>
						</tr>
						<tr class='maincenter'>
							<td id="left-column" valign='top'>
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
									<tr>
										<td style="border: 1px solid black;" class='color1'>
											<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
												<tr>
													<td valign=top align=center width="100%" height="100%">
															<table align=center>
																<tr>
																	<td colspan='3' align=center>
																		<!--menu-->
																		<table id='menu'>
																			<tr>
																				<td><a href="index.php?page=home">HOME</a></td>
																			</tr>

																			<tr>
																				<td><a href="index.php?page=citoyen"> SURVIVANTS </a>
																				</td>
																			</tr>
																			<tr>
																				<td><a href='index.php?page=scores'> CLASSEMENT </a>
																				</td>
																			</tr>
																			<tr>
																				<td><a href="index.php?page=wall"> WALL <?php
																			$cptwall=0;
																			$sql="SELECT messages.timestamp, membre.walltimestamp FROM messages, membre WHERE membre.login =  '".$_SESSION['login']."' AND messages.timestamp > membre.walltimestamp";
																			$res=mysql_query($sql);
																			While($t=mysql_fetch_array($res))
																				$cptwall++;
																			if ($cptwall > 0)
																					echo "<font color='FF0000'>(".$cptwall.")</font>";
																		?> </a>
																				</td>
																			</tr>
																			<tr>
																				<td><a href="index.php?page=maj"> MISE A JOURS <?php
																			$cpt=0;
																			$sql="SELECT maj.timestamp, membre.majtimestamp FROM maj, membre WHERE membre.login =  '".$_SESSION['login']."' AND maj.timestamp > membre.majtimestamp";
																			$res=mysql_query($sql);
																			While($t=mysql_fetch_array($res))
																				$cpt++;
																			if ($cpt > 0)
																					echo "<font color='FF0000'>(".$cpt.")</font>";
																		?> </a>
																				</td>
																			</tr>
																			<tr>
																				<td><a href="index.php?page=lexique">LEXIQUE</a></td>
																			</tr>
																			<tr>
																				<td><a href="deconnexion.php">DECONNEXION</a></td>
																			</tr>
																		</table>
																	</td>
																</tr>
																</table>
																<table class='small' width='100%'>
																	<tr>
																		<td class='main' align=center><img
																			src='<?php echo convertToCDNUrl('pic/enligne.png');?>'>
																		</td>
																	</tr>

																	<tr class='title2'>
																		<td>
																			<div id="online">
																				<img src='<?php echo convertToCDNUrl('pic/charg.gif');?>' width='100%'>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<br><p class="color1">L&eacute;gende : <span class="role-admin">Admin</span>, <span class="role-dev">DevTeam</span>, <span class="role-member">Joueur</span>
																		</td>
																	</tr>
																</table>
																<table>
																	<tr>
																		<td><img src='<?php echo convertToCDNUrl('pic/zombiePorte.png');?>' width='280'></td>
																	</tr>
																</table>
																<table class='barremenu' width="100%">
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																</td>
																</tr>
															</table>

													</td>
												</tr>
											</table>
										</td>
										<td id="right-column" width="560" valign='top'>
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td style="border: 1px solid black;" bgcolor="333333" align=center>
														<table border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td valign="top" align=center>
																	<div style='position: relative'>
																		<div id="popup">
																			<div class='content'>
																				<div class='message'></div>
																				<div class="image">
																					<img src="http://placehold.it/50x50">
																				</div>
																			</div>
																		</div>
																		<table valign=top align=center width="100%">
																			<tr>
																				<td>