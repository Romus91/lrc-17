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
   	if ($_POST['coul'] <> ''){
	$sql2= "UPDATE membre SET theme = '".$_POST['coul']."' WHERE login='".$_SESSION['login']."'";
	$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
     $data2 = mysql_fetch_array($req2); 
	 }		

		                        include('pass.php');
     $sql = "SELECT theme FROM membre WHERE login='".$_SESSION['login']."'";
     $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
     $data = mysql_fetch_array($req); 
		if ($data[0] == 0){$_SESSION['couleur1']='333333'; $_SESSION['couleur2']='CC6600'; $_SESSION['couleur3']='333333'; $_SESSION['couleur4']='555555'; $_SESSION['couleur5']='484848';}else
		if ($data[0] == 1){$_SESSION['couleur1']='2F240D';   $_SESSION['couleur2']='7C5300'; $_SESSION['couleur3']='5A4F3A'; $_SESSION['couleur4']='7C6E53'; $_SESSION['couleur5']='382D16';}  else
        if ($data[0] == 2){$_SESSION['couleur1']='2B1010';   $_SESSION['couleur2']='A60000'; $_SESSION['couleur3']='2B1010'; $_SESSION['couleur4']='3C1010'; $_SESSION['couleur5']='400D0D';}else
        if ($data[0] == 3){$_SESSION['couleur1']='514F04';   $_SESSION['couleur2']='8D8A3F'; $_SESSION['couleur3']='514F04'; $_SESSION['couleur4']='5E5D31'; $_SESSION['couleur5']='51501E';}else
		if ($data[0] == 4){$_SESSION['couleur1']='3333FF';   $_SESSION['couleur2']='8D8A3F'; $_SESSION['couleur3']='514F04'; $_SESSION['couleur4']='5E5D31'; $_SESSION['couleur5']='51501E';} 		
 		
   ?>
<?php include('page/menu.php');?>
<?php include('page/page1.php');?>
<table bgcolor="<?php  echo $_SESSION['couleur2']; ?>" width="100%">
	<tr>
		<td align=center><b>Couleurs th&egrave;me</b></td>
	</tr>
</table>
<br>
<table>
<form action='options.php' method='POST' name='couleur'>
	<tr>
		<td> Th&egrave;me:</td><td>
<select name="coul" multiple>
  <option value='0'>Th&egrave;me Gris/Orange</option>
  <option value='1'>Th&egrave;me Brun</option>
  <option value='2'>Th&egrave;me Rouge</option>
  <option value='3'>Th&egrave;me Kaki</option>
</select> 
		</td>
		<td><input type= 'submit' name = 'coulok' value='OK'></td>
	</tr>
</form>
</table>

<?php include('page/page3.php');?>