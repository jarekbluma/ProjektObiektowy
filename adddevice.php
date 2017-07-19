<?php
	session_start();
	if($_SESSION['is_login'] == false)
		{			
			header('Location: index.php');
			exit;
		}

		require_once 'connect.php';
		require_once 'SearchEditUpdateDelete.php';

		
		if(!empty($_POST['producent']))
		{
			$producent = $_POST['producent'];
			if(!empty($_POST['model'])) $model = $_POST['model'];
			  else $model = "brak danych";

			if(!empty($_POST['sn'])) $sn = $_POST['sn'];
			  else $sn = "brak danych";

			if(!empty($_POST['sid'])) $sid = $_POST['sid'];
			  else $sid = "brak danych";

			if(!empty($_POST['st'])) $st = $_POST['st'];
			  else $st = "brak danych";

			if(!empty($_POST['cpu'])) $cpu = $_POST['cpu'];
			  else $cpu = "brak danych";

			if(!empty($_POST['ram'])) $ram = $_POST['ram'];
			  else $ram = "brak danych";

			if(!empty($_POST['hdd'])) $hdd = $_POST['hdd'];
			  else $hdd = "brak danych";

			if(!empty($_POST['surname'])) $surname = $_POST['surname'];
			  else $surname = "brak danych";

			if(!empty($_POST['name'])) $name = $_POST['name'];
			  else $name = "brak danych";

			$date = $_POST['date'];			  

			if(!empty($_POST['notice'])) $notice = $_POST['notice'];
			  else $notice = "brak danych";

			unset($_POST['producent'], $_POST['model'], $_POST['sn'], $_POST['sid'], $_POST['st'], $_POST['cpu'], $_POST['ram'], $_POST['hdd'], $_POST['surname'], $_POST['name'], $_POST['date'], $_POST['notice']);
			
			$add_device = new Search_Edit_Update_Delete($db_location, $db_login, $db_password, $db_name);
			
			$add_device -> Add($producent, $model, $sn, $sid, $st, $cpu, $ram, $hdd, $surname, $name, $date, $notice);
			
			unset($producent, $model, $sn, $sid, $st, $cpu, $ram, $hdd, $surname, $name, $date, $notice);
						
		};	
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
		<form action="" method="post">
			<div id = 'add'>*Producent:</div><input type="text" name="producent" placeholder="producent" /><br/>
			<div id = 'add'>Model:	   </div><input type="text" name="model"	 placeholder="model" />    <br/>
			<div id = 'add'>S/N:	   </div><input type="text" name="sn"        placeholder="S/N" />      <br/>
			<div id = 'add'>SID:       </div><input type="text" name="sid"       placeholder="SID" />      <br/>
			<div id = 'add'>ST:        </div><input type="text" name="st"        placeholder="ST" />       <br/>
			<div id = 'add'>CPU:       </div><input type="text" name="cpu"       placeholder="CPU" />      <br/>
			<div id = 'add'>RAM:       </div><input type="text" name="ram"       placeholder="RAM" />      <br/>
			<div id = 'add'>HDD:       </div><input type="text" name="hdd"       placeholder="HDD" />      <br/>
			<div id = 'add'>Nazwisko:  </div><input type="text" name="surname"   placeholder="Nazwisko" /> <br/>
			<div id = 'add'>Imię:      </div><input type="text" name="name"      placeholder="Imie" />     <br/>
			<div id = 'add'>Data:      </div><input type="date" name="date"      placeholder="data"  value="2000-01-01" />     <br/>
			<div id = 'add'>Uwagi:     </div><input type="text" name="notice"    placeholder="uwagi" />    <br/></br>
			
            <input type="submit" value="Zapisz">	
		</form></br>
			
		<div id= "downmenu2">
			<a href="home.php">Powrót</a></br>
		</div></br>
			
		<div id= "downmenu2">	
			<input type="submit" onclick="logout()" id="Wyloguj się" value = "Wyloguj się"/>
		</div>	
		
	</body>
</html>