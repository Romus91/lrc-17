<?php session_start();  
 if (!isset($_SESSION['login'])) 
	{
		
		echo"
		   <script language='javascript' type='text/javascript'>
				window.location.replace('login.php');
			</script>
			";
	}
  
 
   ?>