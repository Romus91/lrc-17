<?php include_once ("verif.php");
   $id = (int) htmlentities($_GET['perso']);

   $sql = "UPDATE perso SET enterrer = 1 WHERE perso.id_membre = '".$_SESSION['member_id']."' and perso.id = '".$id."' ";
   $req = mysql_query($sql) or die('Erreur SQL !'.$sql.''.mysql_error());
?>
<script>window.location.replace('index.php?page=citoyen');</script>
