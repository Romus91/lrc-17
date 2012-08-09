<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Accueil</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="content-language" content="fr">
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
<center>
<table align=center>
	<tr>
		<td>
			<table border="0" class='color5' width="800">
			<tr>
				<td width="200%" background="blanc.png" bgcolor="000000" colspan="3" align=center>
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
													<td align=center>&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align=center>
												<table>
													<tr>
														<td colspan='3'>
															<table align=center>
																<form action="login.php" method='post'>
																	<tr>
																		<td align=right><font color='FFFFFF'><b>LOGIN </b></font><input type="text" name="login" maxlength="20"></td>
																	</tr>
																	<tr>
																		<td align=right><font color='FFFFFF'><b>MOT DE PASSE </b></font><input type="password" name="pass" maxlength="20"></td>
																	</tr>
																	<tr>
																		<td align=center>
																			<table class='button'>
																				<tr>
																					<td id='button'>
																						<input type="image" src='images/img02go.png' value='connexion' width='110' height='30' onmouseover="src='images/img03go.png'" onmouseout="src='images/img02go.png'">
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td align=center>
																			<? echo $_SESSION['erreur']; ?>
																		</td>
																	</tr>
																</form>
															</table>
															<center>
															<table width='100%'>
																<tr>
																	<td align=center class='title'>
																		<font size=3 color='FF9900'>LES RESCAPES DE CITE 17</font><br>
																	</td>
																</tr>
																<tr>
																	<td>
																		est un jeu de survie, le but étant de contrer des vagues de zombies chaque jour.<br>
																		Avec pour seul amis, vos armes, vos pièges et vos précieuses munitions...
																		<br><br>

																	</td>
																</tr>
															</table>
															<table align="center" border="0">
										<!--on commence le formulaire pour l'inscription-->
															 <form action = "inscriptionok.php" method="post">
															 <tr>
															   <td align=right>LOGIN </td>
											<!--on insère un champ texte pour le login qui ne depasse pas 20 caractère sous le nom de 'login'-->
															   <td><input type="text" name="login" maxlength='20'></td>
															 </tr>
															 <tr>
																<td colspan=2>
																	<? echo $_SESSION['erreur2']; ?>
																</td>
															</tr>
															 <tr>
															   <td align=right>MOT DE PASSE </td>
											<!--on insère un champ texte pour le mot de passe sous le nom de 'pass' de max 30 caractères-->
															   <td><input type="password" name="pass" maxlength="30" ></td>
															 </tr>
															 <tr>
																<td>
																</td>
															</tr>
															 <tr>
																<td align=right>CONFIRMATION </td>
											<!--on insère un champ texte pour le mot de passe à confirmer sous le nom de 'pass_confirm' de max 30 caractères-->
																<td><input type="password" name="pass_confirm" maxlength="30" ></td>
															 </tr>
															 <tr>
																<td colspan=2>
																	<? echo $_SESSION['erreur1']; ?>
																</td>
															</tr>
															  <tr>
																<td align=right>E-MAIL </td>
											<!--on insère un champ texte pour l'e-mail-->
																<td><input type="text" name="email"></td>
															 </tr>
															 <tr>
																<td colspan="2" align="center">
																	<table class='button'>
																		<tr>
																			<td id='button'>
																				<input type="image" src='images/img02ins.png' width='110' height='30' value='connexion' onmouseover="src='images/img03ins.png'" onmouseout="src='images/img02ins.png'">
																			</td>
																		</tr>
																	</table>
																</td>
															 </tr>
															 <tr>
																<td colspan=2>
																	<? echo $_SESSION['erreur3']; ?>
																</td>
															</tr>
														  </table>
															</center>
															<br>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>
												<table class='color2' width="100%">
													<tr>
														<td align=center>&nbsp;</td>
													</tr>
												</table>
												</font>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</center>
					</td>
					<td width="560" valign='top'>
						<table border="0" cellpadding="0" cellspacing="0" width="560">
							<tr>
								<td style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);" class='color3' >
									<center><!-- 52636B -->
									<table border="0" cellpadding="0" cellspacing="0" width="557">
										<tr>
											<td valign="top" align=center>
											<font color=FFFFFF>
												<table class='color2' width="100%">
													<tr>
														<td align=center>&nbsp;</td>
													</tr>
												</table>
												<table  valign=top align=center>
													<tr>
														<td><img src='pic/ravenholm.JPG' width="550"></td>
													</tr>
												</table>
											</font>
												<table class='color2' width="100%">
													<tr>
														<td align=center>&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									</center>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr align="left">
					<td colspan="2"><a href='http://romustech.dyndns.org'>Created by Romus</a><font color="FAC21D"> -- Copyright © LES RESCAPES DE CITE 17 -- </font></td>
				</tr>
				</center>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
