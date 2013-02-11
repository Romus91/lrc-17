<script type="text/javascript" language="javascript" src="stats.js?<?php echo date("dmYH");?>"></script>

<table width='100%' class='small'>
	<tr height=30>
		<td colspan=7 align=center class='title2'><font size=3>CLASSEMENT</font></td>
	</tr>
	<tr>
		<td colspan=7>
			<table class='button' width='100%'>
				<tr>
					<td id='button' width="50%"><a href="index.php?page=ladder">PERSONNAGES</a>
					</td>
					<td id='button' width="50%"><a href="index.php?page=ladder&tab=members">MEMBRES</a>
					</td>
				</tr>
			</table></td>
	</tr>
	<?php
	if(isset($_GET['tab'])&&$_GET['tab']=='members'){
		include_once 'memberLadder.php';
	}else{
		include_once('scores.php');
	}
	?>
</table>
