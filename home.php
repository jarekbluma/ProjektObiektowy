<?php
		session_start();
		if($_SESSION['is_login'] == false)
		{
			
			header('Location: index.php');
			exit;
		}
?>

<!DOCTYPE HTML>
<html lang = "pl">
<head>
<meta charset = "UTF-8"/>
<meta http-equiv = "X-UA-compatible" content = "IE = edge, chrome=1"/>
<link rel="stylesheet" href="style.css" type="text/css"/>
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
</head>
	<body>
		<div class= "select">
			<form action="" method="post">
				
					<select name="form">
						<option value="1">Producent: </option>
						<option value="2">Model: </option>
						<option value="3">SN: </option>   
						<option value="4">SID: </option>  
						<option value="5">ST:	 </option>  
						<option value="6">CPU:  </option> 
						<option value="7">RAM:  </option> 
						<option value="8">HDD: </option>  
						<option value="9">Uwagi: </option>
						<option value="10">Nazwisko: </option>	 
						<option value="11">Imię: </option>		 
						<option value="12">Data zakupu: </option>
					</select>

						<input type="text" name="text"/>
					    <input type="submit" value="Szukaj"/><br/><br/><br/>	
			</form>
		</div>
		<div id= "downmenu1">
			<a href="adddevice.php">Dodaj</a><br/>
		</div>
		

<?php									
		require_once 'connect.php';
		require_once 'SearchEditUpdateDelete.php';
		
		
		$search_device = new Search_Edit_Update_Delete($db_location, $db_login, $db_password, $db_name);

		if(!empty($_POST['text']))
		{
			$form = $_POST['form'];
			$search = $_POST['text'];
?>

		<div id = "upmenu">
						 <div id='id'>ID</div>
					     <div id='producent'>Producent</div>
					     <div id='model'>Model</div>
					     <div id='sn'>SN</div>
					     <div id='sid'>SID</div>
					     <div id='st'>ŚT</div>
					     <div id='cpu'>CPU</div>
					     <div id='ram'>RAM</div>
					     <div id='hdd'>HDD</div>
					     <div id='nazwisko'>Nazwisko</div>
					     <div id='imie'>Imię</div>
					     <div id='data'>Data</div></br></br>					    
		</div>

<?php			
			$search_device -> Search($search, $form);	
														//Search method
															
		};

?>
		<div id= "downmenu2">	
			<input type="submit" onclick="logout()" id="Wyloguj się" value = "Wyloguj się"/>
		</div>	
	</body>
</html>