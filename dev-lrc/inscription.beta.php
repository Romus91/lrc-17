 <table  valign=top align=center background="hl2.jpg" width="100%" height="100%">

					 <tr>
						<td align=center colspan=2><?php echo $erreur1,$erreur2,$erreur3;?><br></td>
				    </tr>
<!--on commence le formulaire pour l'inscription-->
                     <form action = "inscriptionok.php" method="post">
                     <tr>
                       <td align=right><font color='FFFFFF'><b>LOGIN (20 caract&egrave;re max) :</b></font></td>
	<!--on insère un champ texte pour le login qui ne depasse pas 20 caractère sous le nom de 'login'-->
                       <td><input type="text" name="login" maxlength='20' value="<?php  if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>"></td>
                     </tr>
                     <tr>
                       <td align=right><font color='FFFFFF'><b>MOT DE PASSE : </b></font></td>
	<!--on insère un champ texte pour le mot de passe sous le nom de 'pass' de max 30 caractères-->
                       <td><input type="password" name="pass" maxlength="30" value="<?php  if (isset($_POST['pass'])) echo stripslashes(htmlentities(trim($_POST['pass']))); ?>"></td>
                     </tr>
                     <tr>
                        <td align=right><font color='FFFFFF'><b>CONFIRMATION DU MOT DE PASSE : </b></font></td>
	<!--on insère un champ texte pour le mot de passe à confirmer sous le nom de 'pass_confirm' de max 30 caractères-->
                        <td><input type="password" name="pass_confirm" maxlength="30" value="<?php  if (isset($_POST['pass_confirm'])) echo stripslashes(htmlentities(trim($_POST['pass_confirm']))); ?>"></td>
                     </tr>
					  <tr>
                        <td align=right><font color='FFFFFF'><b>ADRESSE E-MAIL *: </b></font></td>
	<!--on insère un champ texte pour l'e-mail-->
                        <td><input type="text" name="email" value="<?php  if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>"></td>
                     </tr>
                     <tr>
                        <td colspan="2" align="center"><!--on insère un bouton input--><input type="submit" name="inscription" value="Inscription">
					
					<br><br><br><br><br><br>
					</td>
					</tr>					
					
			    </table>-->