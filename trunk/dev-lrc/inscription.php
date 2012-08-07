<?php  session_start();?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Inscription</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="content-language" content="fr">
</head>
<body>
<center><table align=center>
	<tr>
		<td>
			<table border="0" class='color5' width="800">
			<tr>
				<td width="200%" background="blanc.png" bgcolor="000000" colspan="3" align=center>
				   <a href="index.php"><img border="0" src="banneralpha.png" width="500" height="70" ></a>
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
&nbsp;</td>
	</tr>
</table>
			   <table  valign=top align=center>

					<tr>
					<td colspan='3' >
<center>
					<table id='menu'>
						<tr>
							<td >
								<a href="index.htm">RETOUR</a>
							</td>
						</tr>
					</table>
					<br>
					<table>
	<tr>
		<td align=center>
Pour vous incrire il vous suffit simplement d'entrer un login et un mot de passe, l'addresse e-mail est facultative.*<br><br>
</td>
</tr>
</table>
					</center>
					</td>
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
</td>
    <td width="560" valign='top'>
	    <table border="0" cellpadding="0" cellspacing="0" width="560">
          <tr>
            <td style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);" class='color3' >
			<center><!-- 52636B -->
			<table border="0" cellpadding="0" cellspacing="0" width="557">
              <tr>
        		       <td valign="top" align=center> <font color=FFFFFF>
<table class='color2' width="100%">
	<tr>
		<td align=center>&nbsp;</td>
	</tr>
</table>
<br>


                  <table align="center" border="0">
<!--on commence le formulaire pour l'inscription-->
                     <form action = "inscriptionok.php" method="post">
                     <tr>
                       <td align=right>LOGIN :</td>
	<!--on insère un champ texte pour le login qui ne depasse pas 20 caractère sous le nom de 'login'-->
                       <td><input type="text" name="login" maxlength='20' value="<?php  if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>"></td>
                     </tr>
					 <tr>
						<td colspan=2>
							<?php  echo $_SESSION['erreur2']; ?>
						</td>
					</tr>
                     <tr>
                       <td align=right>MOT DE PASSE : </td>
	<!--on insère un champ texte pour le mot de passe sous le nom de 'pass' de max 30 caractères-->
                       <td><input type="password" name="pass" maxlength="30" value="<?php  if (isset($_POST['pass'])) echo stripslashes(htmlentities(trim($_POST['pass']))); ?>"></td>
                     </tr>
                     <tr>
                        <td align=right>CONFIRMATION MOT DE PASSE : </td>
	<!--on insère un champ texte pour le mot de passe à confirmer sous le nom de 'pass_confirm' de max 30 caractères-->
                        <td><input type="password" name="pass_confirm" maxlength="30" value="<?php  if (isset($_POST['pass_confirm'])) echo stripslashes(htmlentities(trim($_POST['pass_confirm']))); ?>"></td>
                     </tr>
					 <tr>
						<td colspan=2>
							<?php  echo $_SESSION['erreur1']; ?>
						</td>
					</tr>
					  <tr>
                        <td align=right>E-MAIL : </td>
	<!--on insère un champ texte pour l'e-mail-->
                        <td><input type="text" name="email" value="<?php  if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>"></td>
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
							<?php  echo $_SESSION['erreur3']; ?>
						</td>
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
            </center>
			</td>
          </tr>
        </table>
	</td>
	  <tr align="left">
	    <td colspan="2"><a href='http://romustech.dyndns.org'>Created by Romus</a><font color="FAC21D"> -- Copyright © LES RESCAPES DE CITE 17 -- </font></td>
      </tr> 
  </tr>
    </center>   
</table>
</td>
</tr>
</table>
</body>
</html>
