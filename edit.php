<?php
	session_start();
	if($_SESSION['is_login'] == false)
		{
			
			header('Location: index.php');
			exit;
		}

		require_once (__DIR__ . '\connect.php');
		require_once (__DIR__ . '\Classes\SearchEditUpdateDelete.php');
		require_once (__DIR__ . '\Classes\export.php');
		
		$id = $_GET['id'];

		$edit = new Search_Edit_Update_Delete($db_location, $db_login, $db_password, $db_name);
        $edit -> Edit($id);


		if(!empty($_POST['producent']))
		{
			$producent = $_POST['producent'];
			$model     = $_POST['model'];
			$sn        = $_POST['sn'];
			$sid       = $_POST['sid'];
			$st        = $_POST['st'];
			$cpu       = $_POST['cpu'];
			$ram       = $_POST['ram'];
			$hdd       = $_POST['hdd'];
			$nazwisko  = $_POST['nazwisko'];
			$imie      = $_POST['imie'];
			$data      = $_POST['data'];
			$uwagi     = $_POST['uwagi'];

			$edit -> Update($id, $producent, $model, $sn, $sid, $st, $cpu, $ram, $hdd, $nazwisko, $imie, $data, $uwagi);
			
			unset($_POST['producent'], 
				  $_POST['model'], 
				  $_POST['sn'], 
				  $_POST['sid'], 
				  $_POST['st'], 
				  $_POST['cpu'], 
				  $_POST['ram'], 
				  $_POST['hdd'], 
				  $_POST['nazwisko'], 
				  $_POST['imie'], 
				  $_POST['data'], 
				  $_POST['uwagi']);					
		}


?>	

<!DOCTYPE HTML>
<html lang = "pl">
<head>
<meta charset = "UTF-8"/>
<meta http-equiv = "X-UA-compatible" content = "IE = edge, chrome=1"/>
<link rel="stylesheet" href="css/style.css" type="text/css"/>

<script type="text/javascript">
			function logout()
			{
				if(confirm("Czy checesz się wylogować?"))
				{
					window.location.href='logout.php';
					return true;
				}
			}
</script>
<script type="text/javascript">
			function del(event)
			{
				if(!confirm("Czy usunąć rekord?"))
				{
					event.preventDefault(); 
				}
				else
				{
					alert("Usunieto!");
				}
			}
</script>		
</head>
	<body>
		<form action="" method="POST">
			<input type="submit" onclick="del(event)" name="delete" value="Usuń"/>
		</form>
<?php
		if(isset($_POST['delete']))
		{
			$edit -> Delete($id);
		}
?>		
		<div id= "downmenu2">
			<a href="home.php">Powrót</a>
		</div><br>
		
		<div id= "downmenu2">	
			<input type="submit" onclick="logout()" id="Wyloguj się" value = "Wyloguj się"/>
		</div>			
	</body>
</html>