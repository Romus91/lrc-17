<? session_start();//on commence la session
// on vérifie toujours qu'il s'agit d'un membre qui est connecté  
if (!isset($_SESSION['login'])) 
{ 
	// sinon on le redirige vers l'accueil 
	echo '<script language="javascript" type="text/javascript">
	window.location.replace("index.htm");
	</script>';
     exit();  
}  
		                        
include('pass.php');
$sql = "SELECT theme FROM membre WHERE login='".$_SESSION['login']."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_array($req); 
if ($data[0] == 0){$_SESSION['couleur1']='333333'; $_SESSION['couleur2']='CC6600'; $_SESSION['couleur3']='333333'; $_SESSION['couleur4']='555555'; $_SESSION['couleur5']='484848';}else
if ($data[0] == 1){$_SESSION['couleur1']='2F240D'; $_SESSION['couleur2']='7C5300'; $_SESSION['couleur3']='5A4F3A'; $_SESSION['couleur4']='7C6E53'; $_SESSION['couleur5']='382D16';}else
if ($data[0] == 2){$_SESSION['couleur1']='2B1010';   $_SESSION['couleur2']='A60000'; $_SESSION['couleur3']='2B1010'; $_SESSION['couleur4']='3C1010'; $_SESSION['couleur5']='400D0D';} 	else
if ($data[0] == 3){$_SESSION['couleur1']='514F04';   $_SESSION['couleur2']='8D8A3F'; $_SESSION['couleur3']='514F04'; $_SESSION['couleur4']='5E5D31'; $_SESSION['couleur5']='51501E';} 	else    
if ($data[0] == 4){$_SESSION['couleur1']='333399';   $_SESSION['couleur2']='8D8A3F'; $_SESSION['couleur3']='514F04'; $_SESSION['couleur4']='5E5D31'; $_SESSION['couleur5']='51501E';} 	    ?>
<?				
	//Barre loading
  $a0= "<font color='000000'>----------</font>";
  $a10="<font color='C90F0F'>-</font><font color='000000'>---------</font>";
  $a20="<font color='C90F0F'>--</font><font color='000000'>--------</font>";
  $a30="<font color='B2B42D'>---</font><font color='000000'>-------</font>";
  $a40="<font color='B2B42D'>----</font><font color='000000'>------</font>";
  $a50="<font color='B2B42D'>-----</font><font color='000000'>-----</font>";
  $a60="<font color='B2B42D'>------</font><font color='000000'>----</font>";
  $a70="<font color='B2B42D'>-------</font><font color='000000'>---</font>";
  $a80="<font color='09B00D'>--------</font><font color='000000'>--</font>";
  $a90="<font color='09B00D'>---------</font><font color='000000'>-</font>";
  $a100="<font color='1AF10F'>----------</font>";

include('deb.php');
include('home.php');


include('fin.php');
?>
