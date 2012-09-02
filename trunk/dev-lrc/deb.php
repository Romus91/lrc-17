<?php if(file_exists('lrc.lock')) {exit("Le site est actuellement en maintenance, allez vous faire un café et revenez dans quelques minutes !");} ?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link href="jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script src="http://cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js"></script>
	<script src="jquery.mousewheel.min.js"></script>
	<script src="jquery.mCustomScrollbar.js"></script>
	<script src="jquery.form.js"></script>
	<script src="jquery.watermark.js"></script>
	<script src="chat.js"></script>
  <meta http-equiv="content-language" content="fr">
 <!-- <meta http-equiv="content-type" content="text/html; charset=utf-8" />-->
  <?php
	if (isset($_GET['reloadcit'])&&$_GET['reloadcit'])
		echo'<meta http-equiv="refresh" content="0; url=index.php?page=citoyen" />';

	$memCont = new MemberController();
	$mem = $memCont->fetchMembre($_SESSION['member_id']);
  ?>

</head>
<body>
<center>
<table align=center class='main' width='800'>
	<tr>
		<td>
			<table border="0" class='main' width="100%" >
			<tr >
				<td width="100%" class="header"  colspan="3" align=center>
				   <a href="index.php"><img border="0" src="pic/banner.png" width="700" ></a>
				</td>
			</tr>
			<tr >
				<td width="100%" class="bannerinfo" colspan="3" align=center>
					<table width='100%'>
						<tr>
							<td class='info' align=center width="30%"><?php echo $mem->getLogin();?><br><span id='info'>-</span></td>
							<td class='info' align=center width="40%"><span id='info'><img src="pic/wheel.png" height="40px"></span></td>
							<td class='info' align=center width="15%">NIV<br><span id='info'><?php echo $mem->getLevel();?></span></td>
							<td class='info' align=center width="15%">ARG<br><span id='info'><?php echo $mem->getArgent();?> $</span></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan=3>
					<div id='membre' class='jauge' width="856px">
						<img class='grid' src="pic/fond-jauge.png" width="856px">
						<img class='barre' src='pic/jblanc.png' width='<?php echo $mem->getLevelPercent();?>%'>
						<div class='lib'>EXP</div>
						<div class="texte">
							<?php echo $mem->getXp();?> | <?php echo floor($mem->getXpForNextLevel());?>
						</div>
					</div>
				</td>
			</tr>
			<tr class='maincenter'>
				<td width="100%" height="100%" valign='top'>
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
						<tr>
							<td  style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);"  class='color1' >
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
									<tr>
										<td valign=top align=center width="100%" height="100%"> <font color=FFFFFF>
											<table  valign=top align=center>
												<tr>
													<td colspan='3' align=center>
													<!--menu-->
														<table id='menu'>
															<tr>
																<td><a href="index.php?page=home">HOME</a></td>
															</tr>
															<!--<tr>
																<td><a href="index.php">PLANQUE</a></td>
															</tr> 		-->
															<tr>
																<td>
																	<a href="index.php?page=citoyen">
																		SURVIVANTS
																	</a>
																</td>
															</tr>
															<tr>
																<td>
																	<a href='index.php?page=scores'>
																		CLASSEMENT
																	</a>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="index.php?page=wall">
																		WALL
																		<?php
																			$cptwall=0;
																			$sql="SELECT messages.timestamp, membre.walltimestamp FROM messages, membre WHERE membre.login =  '".$_SESSION['login']."' AND messages.timestamp > membre.walltimestamp";
																			$res=mysql_query($sql);
																			While($t=mysql_fetch_array($res))
																				$cptwall++;
																			if ($cptwall > 0)
																					echo "<font color='FF0000'>(".$cptwall.")</font>";
																		?>
																	</a>
																</td>
															</tr>
															<tr>
																<td>
																	<a href="index.php?page=maj">
																		MISE A JOURS
																		<?php
																			$cpt=0;
																			$sql="SELECT maj.timestamp, membre.majtimestamp FROM maj, membre WHERE membre.login =  '".$_SESSION['login']."' AND maj.timestamp > membre.majtimestamp";
																			$res=mysql_query($sql);
																			While($t=mysql_fetch_array($res))
																				$cpt++;
																			if ($cpt > 0)
																					echo "<font color='FF0000'>(".$cpt.")</font>";
																		?>
																	</a>
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
											<table class='small' width='100%' >
												<tr>
													<td class='main' align=center>
														<img src='pic/chat.png'>
													</td>
												</tr>

												<tr valign=top>
													<td class='title2' >
														<div id="pseudobox"><img src='pic/charg.gif' width='100%'></div>
													</td>
												</tr>
												<tr>
													<td class='color1' align=center style="padding: 0;">
														<form id="chatform"><input type="text" name="mess"/><input name="pseudo" type="hidden" value="<?php $log=mysql_fetch_array(mysql_query("select login from membre where id = ".$_SESSION['member_id'].";")); echo $log[0];?>"/></form>
													</td>
												</tr>
											</table>
											<div id="chattimestamp" style="display: none;"></div>
											<table class='small' width='100%'>
												<tr>
													<td class='main' align=center>
														<img src='pic/enligne.png'>
													</td>
												</tr>

												<tr class='title2'>
													<td >
														<div id="online" ><img src='pic/charg.gif' width='100%'></div>
													</td>
												</tr>

											</table>

											<table>
												<tr>
													<td><img src='pic/zombiePorte.png' width='280'></td>
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
				<td width="560" valign='top'>
	    			<table border="0" cellpadding="0" cellspacing="0" width="560">
						<tr>
							<td style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);" bgcolor="333333" align=center>
								<table border="0" cellpadding="0" cellspacing="0" width="557">
									<tr>
										<td valign="top" align=center>
											<table class='barremenu' width="100%">
												<tr>
													<td align=center>&nbsp;</td>
												</tr>
											</table>
											<table  valign=top align=center>
												<tr>
													<td>