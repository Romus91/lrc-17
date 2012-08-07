
	<?php  $_SESSION['erreur']=false;
		if ($_GET['cat'] == 'armes')
			include('armes.php');
		if ($_GET['cat'] == 'pieges')
			include('pieges.php');
		if ($_GET['cat'] == 'vie')
			include('vie.php');
			
	?>
	</table>
</center>		   