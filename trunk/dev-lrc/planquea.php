<?php 
session_start();//on commence la session

    // on vérifie toujours qu'il s'agit d'un membre qui est connecté  
   if (!isset($_SESSION['login'])) { 
      // sinon on le redirige vers l'accueil 
      echo '<script language="javascript" type="text/javascript">
window.location.replace("index.htm");
</script>';
      exit();  
   } 
$nom = $_SESSION['nom'] ;  
   ?>
<?php include('page/menu.php');?>
<?php include('page/page1.php');?>
<table bgcolor='<?php  echo $_SESSION['couleur2']; ?>' width='100%'>
	<tr>
		<td align=center><b>Besoin de plus de d&eacute;fences ? C'est ici !</b></td>
	</tr>
</table>
<br>
<table bgcolor=000000><tr><td bgcolor=<?php  echo $_SESSION['couleur4']; ?>>
<a href="planque.php" onMouseOver="hiLite('e','e2','citoyent')" onMouseOut="hiLite('e','e1','')"><img name="e" src="retour1.gif" border=0 width="130" height="20"></a>	<br>   
</td></tr></table>
<?php echo $erreur1,$erreur2,$erreur3;?><br>
<?php 
     		     	include('pass.php'); 
                      
                        $login=$_SESSION['login'];
  // on prépare une requete SQL cherchant tous les dates, message ainsi que l'auteur des messages  par ordre décroissant en se limitant à 10 message
                        $sql = 'SELECT id,ptdef,planche,id_perso2,id_perso FROM planque WHERE  "'.$nom.'" = id_perso OR  "'.$nom.'" = id_perso2'; 
 // lancement de la requete SQL  
                        $res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
						$req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error()); 
                        $nb = mysql_num_rows($req);
						$t=mysql_fetch_array($res);
						
						$sql2 = 'SELECT argent FROM perso WHERE id_membre = "'.$_SESSION['login'].'" and nom = "'.$nom.'"';
						$res2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error());
						$t2=mysql_fetch_array($res2);
						
					
if ($nb == 0 ) {echo"
				Argent actuel : ".$t2[0]." $
				<table align=center>
						<tr>
						  <td>Maison abandonn&eacute;e dans Ravenholm</td>
						  </tr>
						  <tr>
						  <td><img src='pl1.jpg' width=300></td>
						  </tr>
						  <tr>
						  <td><form action='planqueachatok.php' method='POST' name='achat'></td>
						  </tr>
						  <tr>
						  <td><input type= 'submit' name = 'acheter' value = 'Acheter !'></td>
						  </tr>
						  <tr>
						  <td>Prix : 10000$ Comp&eacute;tence : 10000</td>			
						</tr>
¨                    </form>
					</table>
";}else
			{echo"
				Argent actuel : ".$t2[0]." $
			<form action='plancheachatok.php' method='POST' name='achat'>
				<table align=center>
						  <tr>
						  <td><b>Entre le nombre de planches que tu souhaites : </b></td>
						  <td><input type= 'text' name = 'planche' size='10'></td>
						  <td><input type= 'submit' name = 'acheter' value = 'Acheter !'></td>
						  </tr>
						  <tr>
						  <td>Prix : 10$ par planches</td>			
						</tr>
						<tr>
						<td>
							Nombre de planches dans la planque : ".$t[2]."
						</td>
						</tr>
¨                    </form>
					</table>
			";}

					?>
<?php include('page/page3.php');?>