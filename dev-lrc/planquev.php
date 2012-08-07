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
   ?>
<?php include('page/menu.php');?>
<?php include('page/page1.php');?>
					<table >
						<tr align=center>
						  <td>Vendre votre planque ? <br>
<a href="planque.php" onMouseOver="hiLite('e','e2','retour')" onMouseOut="hiLite('e','e1','')"><img name="e" src="retour1.gif" border=0 width="130" height="20"></a>
<a href="planquevendreok.php" onMouseOver="hiLite('n','n2','vendre')" onMouseOut="hiLite('n','n1','')"><img name="n" src="vendre1.gif" border=0 width="130" height="20"></a>
</td>
					    </tr>
					</table>
<?php include('page/page3.php');?>