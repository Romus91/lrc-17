<?php   
session_start();
$nom = $_SESSION['nom'] ;
                        include('pass.php'); 
                        
						$sql = 'SELECT argent FROM perso WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$nom.'"';						
                        $res = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
						$t = mysql_fetch_array($res);
						
						$sql2 = 'SELECT ptdef,planche,id_perso2,id_perso FROM planque WHERE  "'.$nom.'" = id_perso OR  "'.$nom.'" = id_perso2';
						$res2 = mysql_query($sql2) or die('Erreur SQL !'.$sql2.''.mysql_error());
						$t2 = mysql_fetch_array($res2);						
$pla=(round($_POST['planche']));
if ($pla>0){
$plan=($pla*10);
$pla=$pla+($t2[1]);
                         if (($_POST['acheter'] == 'Acheter !') && ($t[0] >= $plan))
						 { 
							$ptdef=((ceil($pla/2)));					  
                              $argent = $t[0];
							  $argent = $argent - $plan;							  
                              $sql = 'UPDATE planque SET planche = "'.($pla).'",ptdef= "'.$ptdef.'" WHERE "'.$nom.'" = id_perso OR  "'.$nom.'" = id_perso2'; 
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());							  
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$nom.'" '; 
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
						{
						$erreur1= "<font color='FF0000'><b>T'as pas assez de flouz !</b></font>";
						include ('planquea.php');
						exit();
						}
			      }else
				  {
					$erreur2= "<font color='FF0000'><b>Tu te fou de moi ou quoi ? <br>
					Entre un nombre positif plus grand que 0</b></font>";
						include ('planquea.php');
						exit();
						}
?>	
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Achat</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <meta http-equiv="refresh" content="0; url=planque.php" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
</html>