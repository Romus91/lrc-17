<?php   
session_start();
$nom = $_SESSION['nom'] ;
                        include('pass.php'); 
                        
						$sql = 'SELECT argent,arme,piege,vie FROM perso WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$nom.'"'; 
                        $res = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
						$t = mysql_fetch_array($res);
												
                         if (($_POST['acheter'] == 'Acheter !') && ($t[0] >= 10000))
						 { 
                              $sql = 'INSERT INTO planque (id_perso) VALUES("'.$nom.'")'; 
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
						      
                              $argent = $t[0];
							  $argent = $argent - 10000;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$nom.'" '; 
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
						{
						$erreur3= "<font color='FF0000'><b>Heu... Tu n'as pas assez de flouz vieux !</b></font>";
						include ('planquea.php');
						exit();
						}

?>	
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Achat</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <meta http-equiv="refresh" content="0; url=perso.php" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
</html>