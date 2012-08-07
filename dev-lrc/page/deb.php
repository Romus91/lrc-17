<html>
<head>
  <title>LES RESCAPES DE CITE 17</title>
  <link rel="icon" type="image/jpg" href="hl2logo.jpg" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <meta http-equiv="content-language" content="fr">
</head>
<script language="javascript">
<!-- 
a1 = new Image(107,36);
a1.src = "page/accueil1.gif";
a2 = new Image(107,36);
a2.src = "page/accueil2.gif";
c1 = new Image(107,36);
c1.src = "page/wall1.gif";
c2 = new Image(107,36);
c2.src = "page/wall2.gif";
d1 = new Image(107,36);
d1.src = "page/citoy1.gif";
d2 = new Image(107,36);
d2.src = "page/citoy2.gif";
e1 = new Image(107,36);
e1.src = "page/retour1.gif";
e2 = new Image(107,36);
e2.src = "page/retour2.gif";
f1 = new Image(107,36);
f1.src = "page/actu1.gif";
f2 = new Image(107,36);
f2.src = "page/actu2.gif";
j1 = new Image(107,36);
j1.src = "page/quit1.gif";
j2 = new Image(107,36);
j2.src = "page/quit2.gif";
k1 = new Image(107,36);
k1.src = "page/ins1.gif";
k2 = new Image(107,36);
k2.src = "page/ins2.gif";
h1 = new Image(107,36);
h1.src = "page/supp1.gif";
h2 = new Image(107,36);
h2.src = "page/supp2.gif";
g1 = new Image(107,36);
g1.src = "page/nouv1.gif";
g2 = new Image(107,36);
g2.src = "page/nouv2.gif";
l1 = new Image(107,36);
l1.src = "page/acha1.gif";
l2 = new Image(107,36);
l2.src = "page/acha2.gif";
m1 = new Image(107,36);
m1.src = "page/hist1.gif";
m2 = new Image(107,36);
m2.src = "page/hist2.gif";
n1 = new Image(107,36);
n1.src = "page/vendre1.gif";
n2 = new Image(107,36);
n2.src = "page/vendre2.gif";
o1 = new Image(107,36);
o1.src = "page/planque1.gif";
o2 = new Image(107,36);
o2.src = "page/planque2.gif";
p1 = new Image(107,36);
p1.src = "page/scores1.gif";
p2 = new Image(107,36);
p2.src = "page/scores2.gif";
q1 = new Image(107,36);
q1.src = "page/forum1.gif";
q2 = new Image(107,36);
q2.src = "page/forum2.gif";
r1 = new Image(107,36);
r1.src = "page/opt1.gif";
r2 = new Image(107,36);
r2.src = "page/opt2.gif";

function hiLite(imgDocID, imgObjName, comment) {

document.images[imgDocID].src = eval(imgObjName + ".src");
window.status = comment; return true;
}
//end hiding -->
</script>
<body bgcolor="#000000">
<center>
<table align=center>
	<tr>
		<td>
			<table border="0" bgcolor="<? echo $_SESSION['couleur5']; ?>" width="800">
			<tr>
				<td width="200%" bgcolor="#000000" colspan="3" align=center>
				   <a href="index.php"><img border="0" src="page/banner.gif" width="500" height="70"></a>
				</td>
			</tr>
			<tr>
				<td width="100%" height="100%" valign='top'>
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
						<tr>
							<td  style="border-left: 1px solid rgb(0,0,0); border-right: 1px solid rgb(0,0,0); border-top: 1px solid rgb(0,0,0); border-bottom: 1px solid rgb(0,0,0);" bgcolor="<? echo $_SESSION['couleur1']; ?>" >
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
									<tr>
										<td valign=top align=center width="100%" height="100%"> <font color=FFFFFF>
											<table bgcolor="<? echo $_SESSION['couleur2']; ?>" width="100%" >
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
														<table bgcolor=000000>
															<tr>
																<td bgcolor=<? echo $_SESSION['couleur4']; ?>><a href="index.php" onMouseOver="hiLite('a','a2','accueil')" onMouseOut="hiLite('a','a<? if ($lien == '/index.php'){echo "2";}else{echo "1";}?>','')"><img name="a" src="page/accueil<? if ($lien == '/index.php'){echo "2";}else{echo "1";}?>.gif" border=0 width="130" height="20"></a></td>
															</tr>        
															<tr>
																<td bgcolor=<? echo $_SESSION['couleur4']; ?>><a href="citoyen.php" onMouseOver="hiLite('d','d2','citoyent')" onMouseOut="hiLite('d','d<? if (($lien == '/citoyen.php')OR($lien == '/perso.php')OR($lien == '/planque.php')OR($lien == '/planquea.php')OR($lien == '/planqueachatok.php')OR($lien == '/vendre.php')OR($lien == '/achat.php')OR($lien == '/achatok.php')){echo "2";}else{echo "1";}?>','')"><img name="d" src="page/citoy<? if (($lien == '/citoyen.php')OR($lien == '/perso.php')OR($lien == '/planque.php')OR($lien == '/planquea.php')OR($lien == '/planqueachatok.php')OR($lien == '/vendre.php')OR($lien == '/achat.php')OR($lien == '/achatok.php')){echo "2";}else{echo "1";}?>.gif" border=0 width="130" height="20"></a></td>
															</tr> 
															<tr>
																<td bgcolor=<? echo $_SESSION['couleur4']; ?>><a href="scores.php" onMouseOver="hiLite('p','p2','scores')" onMouseOut="hiLite('p','p<? if ($lien == '/scores.php'){echo "2";}else{echo "1";}?>','')"><img name="p" src="page/scores<? if ($lien == '/scores.php'){echo "2";}else{echo "1";}?>.gif" border=0 width="130" height="20"></a></td>
															</tr> 
															<tr>
																<td bgcolor=<? echo $_SESSION['couleur4']; ?>><a href="wall.php" onMouseOver="hiLite('c','c2','wall')" onMouseOut="hiLite('c','c<? if ($lien == '/wall.php'){echo "2";}else{echo "1";}?>','')"><img name="c" src="page/wall<? if ($lien == '/wall.php'){echo "2";}else{echo "1";}?>.gif" border=0 width="130" height="20"></a></td>
															</tr> 
															<tr>
																<td bgcolor=<? echo $_SESSION['couleur4']; ?>><a href="histoire.php" onMouseOver="hiLite('m','m2','hist')" onMouseOut="hiLite('m','m<? if ($lien == '/histoire.php'){echo "2";}else{echo "1";}?>','')"><img name="m" src="page/hist<? if ($lien == '/histoire.php'){echo "2";}else{echo "1";}?>.gif" border=0 width="130" height="20"></a></td>
															</tr> 
															<tr>
																<td bgcolor=<? echo $_SESSION['couleur4']; ?>><a href="options.php" onMouseOver="hiLite('r','r2','opt')" onMouseOut="hiLite('r','r<? if ($lien == '/options.php'){echo "2";}else{echo "1";}?>','')"><img name="r" src="page/opt<? if ($lien == '/options.php'){echo "2";}else{echo "1";}?>.gif" border=0 width="130" height="20"></a></td>
															</tr> 
															<tr>
																<td bgcolor=<? echo $_SESSION['couleur4']; ?>><a href="deconnexion.php" onMouseOver="hiLite('j','j2','quit')" onMouseOut="hiLite('j','j1','')"><img name="j" src="page/quit1.gif" border=0 width="130" height="20"></a></td>
															</tr>
														</table>	
														<br>	   
														<table>   
															<tr>
																<td align='center' bgcolor="000000">
																	<font color='990606'><b>Date/Heure</b></font>
																</td>
															</tr>
															<tr>
																<td align=center>
																<? 
																	$datea=date('d/m/Y');
																	$heurea=date('H:i');
																	echo "<font color='FFFFFF'><b>Jour actuel : </b></font></td></tr><tr><td align=center><font color='FFFFFF'>",$datea,"</td></tr><tr><td align=center><font color='FFFFFF'><b>Heure actuelle : </b></font></td></tr><tr><td align=center><font color='FFFFFF'>",$heurea,"</font>";
																?>
																</td>
															</tr>
															<tr>
																<td bgcolor=000000 align=center><font color='990606'>---</font></td>
															</tr>
															<tr>
																<td><img src='r<? echo $_SESSION['nb'];?>.bmp' width='250'></td>
															</tr>
															<tr>
																<td><img src='tourcite17.bmp' width='250'></td>
															</tr>		
														</table>					
													<!--/menu-->	
													</td>
												</tr>					
											</table>
											<table bgcolor="<? echo $_SESSION['couleur2']; ?>" width="100%">
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
											<table bgcolor="<? echo $_SESSION['couleur2']; ?>" width="100%">
												<tr>
													<td align=center>&nbsp;</td>
												</tr>
											</table>
											<table  valign=top align=center>
												<tr>
													<td>