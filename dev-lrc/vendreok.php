<?php
session_start();
                        include('pass.php');

						$sql = 'SELECT argent,arme,piege FROM perso WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'"';
                        $res = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
						$t = mysql_fetch_array($res);


                         if (($_POST['vendre'] == 'pistol'))
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 25;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
					 	if ($_POST['vendre'] == 'alixgun')
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 40;
							  echo"'".$t[0]."'";
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
					 	if ($_POST['vendre'] == 'mitrail')
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 60;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }	else
					 	if ($_POST['vendre'] == 'shotgun')
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 75;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
					 	if ($_POST['vendre'] == 'magnum')
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 300;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
					 	if ($_POST['vendre'] == 'annabelle')
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 350;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
					 	if ($_POST['vendre'] == 'combine')
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 750;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
					 	if ($_POST['vendre'] == 'bazooka')
						 {
                              $sql = 'UPDATE perso SET arme = "piedbiche" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 2500;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
						if ($_POST['vendre'] == 'piege1')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 150;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
						if ($_POST['vendre'] == 'piege2')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 250;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
						if ($_POST['vendre'] == 'piege3')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 500;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
						if ($_POST['vendre'] == 'piege4')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 2500;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
												if ($_POST['vendre'] == 'piege5')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 450;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
												if ($_POST['vendre'] == 'piege6')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 300;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
												if ($_POST['vendre'] == 'piege7')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 350;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
												if ($_POST['vendre'] == 'piege8')
						 {
                              $sql = 'UPDATE perso SET piege = "" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());

                              $argent = $t[0];
							  $argent = $argent + 1000;
						      $sql = 'UPDATE perso SET argent = "'.$argent.'" WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'" ';
                              mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
                        }else
					    {
						if (($_POST['acheter'] == 'piedbiche')){echo"<font color='FFFFFF'>Vous ne pouvez pas vendre cette arme ! Et avec koi tu vas atak&eacute; apr&egrave;s ?</font>";}
                        include('achat.php');
                        exit();
					    }

?>
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.gif" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <meta http-equiv="refresh" content="0; url=achat.php" />
</head>
</html>