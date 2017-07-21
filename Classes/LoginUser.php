<?php

	class LoginUser
	{
		protected $connect;

		public function __construct($db_location, $db_login, $db_password, $db_name)
		{			
			$this -> connect = mysqli_connect($db_location, $db_login, $db_password, $db_name);		
		}

		public function check_user($login, $unsafe_password)
		{
			$login = htmlentities($login, ENT_QUOTES,"UTF-8");						
			$unsafe_password = htmlentities($unsafe_password, ENT_QUOTES,"UTF-8");

			$password = md5($unsafe_password);
			
			$sql = $this -> connect -> query(sprintf("SELECT * FROM log WHERE login = '%s' AND pass = '%s'",
				mysqli_real_escape_string($this -> connect,$login),
				mysqli_real_escape_string($this -> connect,$password)));

			if(mysqli_num_rows($sql) > 0)
			{
				$_SESSION['is_login'] = true;			
				header('location: home.php');
			}
			else
			{
				echo "<span style='color:red'>Błąd loginu lub hasła!</span></br></br>";
			}					
		}		
	}
?>
