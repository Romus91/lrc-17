<table class='small' align=center width='100%'>
	<?php  $_SESSION['erreur']=false;
		if ($_GET['cat'] == 'armes')
			include('armes.php');
		if ($_GET['cat'] == 'vie')
			include('vie.php');

	?>
	</table>
