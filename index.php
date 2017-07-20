<?php
	session_start();

	require_once 'connect.php';
	require_once 'LoginUser.php';

	$log = new LoginUser($db_location, $db_login, $db_password, $db_name);	                									 
?>	

<!DOCTYPE HTML>
<html lang = "pl">
<head>
<meta charset = "UTF-8"/>
<meta http-equiv = "X-UA-compatible" content = "IE = edge, chrome=1"/>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
	<body>
	<div id = "container">
	<h1>Logowanie</h1>
		<form action="" method="post">
			Login: <input type="text" name="login" placeholder="Login"/><br>
<?php
							if(isset($_POST['login']) && isset($_POST['password']))
							{
								$login = $_POST['login'];
								$password = $_POST['password'];
								$log -> check_user($login, $password);
										
						    	unset ($_POST['login']);
						    	unset ($_POST['password']);
						    }	
?>			
				   <input type="submit" value="Log in"><br><br>	
		</form>	
	</div>	

	</body>
</html>