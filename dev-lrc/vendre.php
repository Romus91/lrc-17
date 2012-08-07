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
include('pass.php'); 
                         
                        $login=$_SESSION['login'];
  // on prépare une requete SQL cherchant tous les dates, message ainsi que l'auteur des messages  par ordre décroissant en se limitant à 10 message
                        $sql = 'SELECT nom,sexe,photo,id_membre,argent,vie,arme,piege,date,jourvague FROM perso WHERE  perso.id_membre = "'.$_SESSION['login'].'" and perso.nom = "'.$_SESSION['nom'].'"';
 // lancement de la requete SQL  
                        $res = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$t=mysql_fetch_array($res);
   ?>
<?php include('page/menu.php');?>
<?php include('page/page1.php');?>
<table bgcolor='<?php  echo $_SESSION['couleur2']; ?>' width='100%'>
	<tr>
		<td align=center><b>Ras-le-bol de ton arme ? Vends-la !</b></td>
	</tr>
</table>
<br>
   <br>              
<table bgcolor=000000><tr><td bgcolor=<?php  echo $_SESSION['couleur4']; ?>>
					      <a href="perso.php" onMouseOver="hiLite('e','e2','retour')" onMouseOut="hiLite('e','e1','')"><img name="e" src="retour1.gif" border=0 width="130" height="20"></a>	    
</td></tr></table>
				<taBLE>
				<tr><td colspan=3><b>Vendre quel objet ?</b></td></tr>
				  <tr>
				    <td colspan=3><b> <br> (Une fois l'arme vendue, le Pied-de-biche sera &agrave; ta disposition.)<br><font color=FF0000>(Ton arme te rapporte la moiti&eacute; de son prix initial.)</font></b></td>
				  </tr>
				   <tr>
					<td>Arme poss&eacute;d&eacute;e : </td><?php  echo"<td><img src='".$t[6].".JPG' width='100' hight='80'></td>  ";  ?><td><form action='vendreok.php' method='POST' name='vendr'><?php  echo"<input type= 'radio' name = 'vendre' value = '".$t[6]."'>";?></td>
				  </tr>
				  <tr>
                    <td>Pi&egrave;ge poss&eacute;d&eacute  : </td><td> <?php if ($t[7] <> ''){echo"<img src='".$t[7].".JPG' width='100' hight='80'>  ";}else{echo"Aucun pi&egrave;ge";}echo"</td>";  ?><td><?php  if ($t[7] <> ''){echo"<input type= 'radio' name = 'vendre' value = '".$t[7]."'>";}else{echo"";}?></td>		   
				   </tr>
				   <tr>
					<td><input type= 'submit' value = 'Vendre !'></td><td colspan=2></form></td>
				   </tr>
				 </table>
<?php include('page/page3.php');?>