<?php require_once 'cdnHelper.php';?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Accueil</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
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
<table align=center class='main'>
	<tr >
		<td>
			<table border="0" width="100%" >
				<tr >
					<td width="100%" class="header"  colspan="3" align=center>
					   <a href="index.php"><img border="0" src="<?php echo convertToCDNUrl('pic/banner.png');?>" width="700" ></a>
					</td>
				</tr>

				<tr class='maincenter' >
					<td width="270" height="100%" valign='top'>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
							<tr height="100%">
								<td height="100%" style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);"  class='color1' >
									<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" >
										<tr  height="100%">
											<td valign=top align=center width="100%" height="100%">
												<table class='barremenu' width="100%" height="100%">
													<tr>
														<td align=center>&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr height="100%">
											<td align=center >
												<table height="100%">
													<tr >
														<td>
															<table align=center style="margin: 79 0;">
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
																					<td id='button' width='100%' align="center">
																						<input type="image" src='<?php echo convertToCDNUrl('image.php?img=img02go.png&w=110&h=30');?>' value='connexion' onmouseover="src='<?php echo convertToCDNUrl('image.php?img=img03go.png&w=110&h=30');?>'" onmouseout="src='<?php echo convertToCDNUrl('image.php?img=img02go.png&w=110&h=30');?>'">
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
																		<font size=3 color='555555'>LES RESCAPES DE CITE 17</font><br>
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
																	<? if(isset($_SESSION['erreur2']))echo $_SESSION['erreur2']; ?>
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
																	<? if(isset($_SESSION['erreur1'])) echo $_SESSION['erreur1']; ?>
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
																			<td id='button' align="center">
																				<input type="image" src='<?php echo convertToCDNUrl('image.php?img=img02ins.png&w=110&h=30');?>' value='connexion' onmouseover="src='<?php echo convertToCDNUrl('image.php?img=img03ins.png&w=110&h=30');?>'" onmouseout="src='<?php echo convertToCDNUrl('image.php?img=img02ins.png&w=110&h=30');?>'">
																			</td>
																		</tr>
																	</table>
																</td>
															 </tr>
															 <tr>
																<td colspan=2>
																	<? if(isset($_SESSION['erreur3'])) echo $_SESSION['erreur3']; ?>
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
												<table class='barremenu' width="100%">
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
					</center>
					</td>
					<td width="100%" valign='top'>
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);" class='color3' >
									<center><!-- 52636B -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td valign="top" align=center width="100%">
												<table class='barremenu' width="100%">
													<tr>
														<td align=center>&nbsp;</td>
													</tr>
												</table>
												<table width="100%" valign=top align=center>
													<tr>
														<td><img src='<?php echo convertToCDNUrl('pic/homelogin.png');?>' width='100%'></td>
													</tr>
												</table>
												<table class='barremenu' width="100%">
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
