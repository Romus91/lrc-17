<?php if(file_exists('lrc.lock')) {echo "Le site est actuellement en maintenance, allez vous faire un café et revenez dans quelques minutes !";exit();} ?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link href="jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
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
  ?>

</head>
<body>
<center>
<table align=center>
	<tr>
		<td>
			<table border="0" class='color5' width="800">
			<tr>
				<td width="200%" background="pic/blanc.png" bgcolor="000000" colspan="3" align=center>
				   <a href="index.php"><img border="0" src="pic/banneralpha.png" width="500" height="70" ></a>
				</td>
			</tr>
			<tr>
				<td width="100%" height="100%" valign='top'>
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
						<tr>
							<td  style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);"  class='color1' >
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
									<tr>
										<td valign=top align=center width="100%" height="100%"> <font color=FFFFFF>
											<table class='color2' width="100%" >
												<tr>
													<td align=center>
														<!--Bonjour intel-->
														<?php
															echo"<font color=FFFFFF><b>Bonjour ",$_SESSION['login']," !</b></font>";
															$lien=$_SERVER["PHP_SELF"];
														?>
														<!--/bonjour intel-->
													</td>
												</tr>
											</table>
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
																		CITOYEN
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
																<td><a href="deconnexion.php">DECONNEXION</a></td>
															</tr>
														</table>
													</td>
												</tr>
											<table class='small' width='100%' >
												<tr>
													<td class='color2'align=center>
														<font size=3>CHAT</font>
													</td>
												</tr>
												<tr valign=top>
													<td class='title2' >
														<div id="pseudobox"><img src='pic/charg.gif' width='100%'></div>
													</td>
												</tr>
												<tr>
													<td class='color1' align=center style="padding: 0;">
														<form id="chatform"><input type="text" name="mess"/></form>
													</td>
												</tr>
											</table>

											<table class='small' width='100%'>
												<tr>
													<td class='color2' align=center>
														<font size=3>EN LIGNE</font>
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
													<td><img src='pic/r<?php  echo $_SESSION['nb'];?>.bmp' width='260'></td>
												</tr>
											</table>
											<table class='color2' width="100%">
												<tr>
													<td align=center>&nbsp;</td>
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
											<table class='color2' width="100%">
												<tr>
													<td align=center>&nbsp;</td>
												</tr>
											</table>
											<table  valign=top align=center>
												<tr>
													<td>