<?php include ("verif.php");
	include ("pass.php");
	$nom=$_GET['perso'];
	$sql = 'SELECT argent,vie,energie FROM perso WHERE perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$nom.'"'; //on sélèctionne l'argent, arme, pige, vie du perso du membre connecté
	$res = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());//On vérifie si il n'y a pas d'erreurs
	$t = mysql_fetch_array($res);//On stocke les resultats dans une variable t
	//Chaque if correspond à chaque objets
	//On vérifie si le POST de la page précédente correspond a l'objet, si l'argent est suffisant, et si il ne le possède pas déjà.
	//Dans ce cas, on modifie dans la base de donnée (table perso) l'arme, ou le piege, ou la vie du perso du membre connecté
	//Ensuite, son argent
	//On vérifie toujours si il n'y a pas d'erreurs		
						$argent=mysql_fetch_array(mysql_query("SELECT argent,vie,level,energie,endurance,id FROM perso WHERE nom ='".$nom."' AND id_membre = '".$_SESSION['login']."'"));
						$max_Energy = 100+(10*($argent['level']-1))+($argent['endurance']*10);
						
						$inventaire=mysql_fetch_array(mysql_query("SELECT * FROM inventaire WHERE id_perso = ".$argent['id'].""));
						
						if (($_GET['type'] == 'JKREJI8HYJ444YT'))
						{ 						      
							for ($i=1;$i<=2;$i++)
							{
								if (($inventaire['conso'.$i] == NULL) OR ($inventaire['conso'.$i] == ''))
								{
									break;
								}
							}
							
							if ($i <= 2)
							{
							
								if ($_GET['medipack'] == 10)
								{
									if ($argent['argent'] >=  (ceil($argent['level']/4)*150))
									{
										$sql = 'UPDATE inventaire SET conso'.$i.'= "v10" WHERE id_perso = "'.$argent['id'].'"'; 
										mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
										mysql_query('UPDATE perso SET argent = "'.($argent['argent']-(ceil($argent['level']/4)*150)).'" WHERE nom ="'.$nom.'" AND id_membre = "'.$_SESSION['login'].'"');
									}else
									{
										$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
										$_SESSION['erreur']=true;
									}
								}else
								if ($_GET['medipack'] == 50)
								{
									if ($argent['argent'] >=  (ceil($argent['level']/4)*450))
									{
										$sql = 'UPDATE inventaire SET conso'.$i.' = "v50" WHERE id_perso = "'.$argent['id'].'"'; 
										mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
										mysql_query('UPDATE perso SET argent = "'.($argent['argent']-(ceil($argent['level']/4)*450)).'" WHERE nom ="'.$nom.'" AND id_membre = "'.$_SESSION['login'].'"');
									}else
									{
										$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
										$_SESSION['erreur']=true;
									}
								}else
								if ($_GET['medipack'] == 'full')
								{
									if ($argent['argent'] >=(ceil($argent['level']/4)*750))
									{
										$sql = 'UPDATE inventaire SET conso'.$i.' = "vf" WHERE id_perso = "'.$argent['id'].'"'; 									
										mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
										mysql_query('UPDATE perso SET argent = "'.($argent['argent']-(ceil($argent['level']/4)*750)).'" WHERE nom ="'.$nom.'" AND id_membre = "'.$_SESSION['login'].'"');
									}else
									{
										$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
										$_SESSION['erreur']=true;
									}
								}else
								if ($_GET['nrgpack'] == '20')
								{

									if ($argent['argent'] >=(ceil($argent['level']/4)*100))
									{
										$sql = 'UPDATE inventaire SET conso'.$i.' = "n20" WHERE id_perso = "'.$argent['id'].'"'; 		
										mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
										mysql_query('UPDATE perso SET argent = "'.($argent['argent']-(ceil($argent['level']/4)*100)).'" WHERE nom ="'.$nom.'" AND id_membre = "'.$_SESSION['login'].'"');
									}else
									{
										$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
										$_SESSION['erreur']=true;
									}
								}else
								if ($_GET['nrgpack'] == '70')
								{
									
									if ($argent['argent'] >=(ceil($argent['level']/4)*600))
									{
										$sql = 'UPDATE inventaire SET conso'.$i.' = "n70" WHERE id_perso = "'.$argent['id'].'"';  
										mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
										mysql_query('UPDATE perso SET argent = "'.($argent['argent']-(ceil($argent['level']/4)*600)).'" WHERE nom ="'.$nom.'" AND id_membre = "'.$_SESSION['login'].'"');
									}else
									{
										$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
										$_SESSION['erreur']=true;
									}
								}else
								if ($_GET['nrgpack'] == '100')
								{
									
									if ($argent['argent'] >=(ceil($argent['level']/4)*800))
									{
										$sql = 'UPDATE inventaire SET conso'.$i.' = "n100" WHERE id_perso = "'.$argent['id'].'"';  
										mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
										mysql_query('UPDATE perso SET argent = "'.($argent['argent']-(ceil($argent['level']/4)*800)).'" WHERE nom ="'.$nom.'" AND id_membre = "'.$_SESSION['login'].'"')or die(mysql_error());
									}else
									{
										$_SESSION['text']= "<font color='FF0000'><b>Pas assez de fric !</b></font>";
										$_SESSION['erreur']=true;
									}
								}else
								{
									$_SESSION['text']= "<font color='FF0000'><b>ERREUR PACK</b></font>";
									$_SESSION['erreur']=true;
								}
							
							}else
							{
								$_SESSION['text']= "<font color='FF0000'><b>INVENTAIRE PLEIN</b></font>";
								$_SESSION['erreur']=true;
							}
							
                        
						}
						else
					    {
						//Sinon, on affiche un message
					    $_SESSION['text']= "<font color='FF0000'><b>ERREUR CODE</b></font>";
						$_SESSION['erreur']=true;
						//On inclu la page 'achat'
						//On quitte la page courante
					    }
?>	
<html>
<head>
  <title>LES RESCAPES DE CITE 17 - Vendre</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="refresh" content="0; url=index.php?page=perso&onglet=infop&perso=<?php  echo $nom;?>" />
</head>
</html>