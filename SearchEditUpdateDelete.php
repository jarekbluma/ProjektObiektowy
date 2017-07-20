<?php

class Search_Edit_Update_Delete
{
	protected $connect;

	public function __construct($db_location, $db_login, $db_password, $db_name)
	{		
		$this -> connect = mysqli_connect($db_location, $db_login, $db_password, $db_name);	
	}
	
	public function Search($search, $option)
	{	
		if     ($option == 1)  $sql = $this -> connect -> query("SELECT * FROM device WHERE producent  = '$search' ");
		elseif ($option == 2)  $sql = $this -> connect -> query("SELECT * FROM device WHERE model      = '$search' "); 
		elseif ($option == 3)  $sql = $this -> connect -> query("SELECT * FROM device WHERE sn         = '$search' ");	
		elseif ($option == 4)  $sql = $this -> connect -> query("SELECT * FROM device WHERE sid        = '$search' ");
		elseif ($option == 5)  $sql = $this -> connect -> query("SELECT * FROM device WHERE st         = '$search' ");
		elseif ($option == 6)  $sql = $this -> connect -> query("SELECT * FROM device WHERE cpu        = '$search' ");
		elseif ($option == 7)  $sql = $this -> connect -> query("SELECT * FROM device WHERE ram        = '$search' ");
		elseif ($option == 8)  $sql = $this -> connect -> query("SELECT * FROM device WHERE hdd        = '$search' ");
		elseif ($option == 9)  $sql = $this -> connect -> query("SELECT * FROM device WHERE uwagi      = '$search' ");
		elseif ($option == 10) $sql = $this -> connect -> query("SELECT * FROM device WHERE nazwisko   = '$search' ");
		elseif ($option == 11) $sql = $this -> connect -> query("SELECT * FROM device WHERE imie       = '$search' ");
		elseif ($option == 12) $sql = $this -> connect -> query("SELECT * FROM device WHERE data       = '$search' ");	
		else echo "<span style='color:red'><h3>Brak podanego parametru w bazie!</h3></span>";	

			if(mysqli_num_rows($sql) > 0)
			{
				while ($row = $sql -> fetch_assoc()) 
				{
					echo "<div id='search'>"         .
					     "<div id='id'>"             .   $row['id']        . "</div>" .
					     "<div id='producent'>"      .   $row['producent'] . "</div>" .
					     "<div id='model'>"          .   $row['model']     . "</div>" .
					     "<div id='sn'>"             .   $row['sn']        . "</div>" .
					     "<div id='sid'>"            .   $row['sid']       . "</div>" .
					     "<div id='st'>"             .   $row['st']        . "</div>" .
					     "<div id='cpu'>"            .   $row['cpu']       . "</div>" .
					     "<div id='ram'>"            .   $row['ram']       . "</div>" .
					     "<div id='hdd'>"            .   $row['hdd']       . "</div>" .
					     "<div id='nazwisko'>"       .   $row['nazwisko']  . "</div>" .
					     "<div id='imie'>"           .   $row['imie']      . "</div>" .
					     "<div id='data'>"           .   $row['data']      . "</div>" .
					     "<div id='uwagi'> Uwagi: "  .   $row['uwagi']     . "</div>" .
					     "</div>";

					echo '<div id = "edit_delete"><a href="edit.php?id='         . $row['id'] . '"> Edytuj/Usuń</a><br></div>';
					echo '<div id = "edit_delete"><a href="create_excel.php?id=' . $row['id'] . '"> Export to Excel</a><br></div><br><br>';	
				}				
			}
			else
			{
				echo "<span style='color:red'><h3>Brak podanego parametru w bazie!</h3></span>";
			}	
	}

	public function Add($producent, $model, $sn, $sid, $st, $cpu, $ram, $hdd, $surname, $name, $data, $notice)
	{		
		$sql = $this -> connect ->query(" 
			INSERT INTO device (producent, model, sn, sid, st, cpu, ram, hdd, nazwisko, imie, data, uwagi) 
			VALUES ('$producent', '$model', '$sn', '$sid', '$st', '$cpu', '$ram', '$hdd', '$surname', '$name', '$data', '$notice') ");
		
		unset($producent, $model, $sn, $sid, $st, $cpu, $ram, $hdd, $surname, $name, $data, $notice);		
	}

	public function Edit($id)
	{

		$sql = $this -> connect -> query("SELECT * FROM device WHERE id = '$id'");
		if(mysqli_num_rows($sql) > 0)
			{
				while ($row = $sql -> fetch_assoc()) 
				{
					echo "<form action='' method='post'> 
							  <br>   <div id = 'add'>ID:        </div>	   <input type = 'text'  name = 'id' 		   value =" . $row['id']        . " readonly>
							  <br>   <div id = 'add'>Producent: </div>     <input type = 'text'  name = 'producent'    value =" . $row['producent'] . ">
							  <br>   <div id = 'add'>Model:     </div>     <input type = 'text'  name = 'model'        value =" . $row['model']     . ">
							  <br>   <div id = 'add'>SN:        </div>     <input type = 'text'  name = 'sn'           value =" . $row['sn']        . ">
							  <br>   <div id = 'add'>SID:       </div>     <input type = 'text'  name = 'sid'          value =" . $row['sid']       . ">
							  <br>   <div id = 'add'>ST:        </div>     <input type = 'text'  name = 'st'           value =" . $row['st']        . ">
							  <br>   <div id = 'add'>CPU:       </div>     <input type = 'text'  name = 'cpu'          value =" . $row['cpu']       . ">
							  <br>   <div id = 'add'>RAM:       </div>     <input type = 'text'  name = 'ram'          value =" . $row['ram']       . ">
							  <br>   <div id = 'add'>HDD:       </div>     <input type = 'text'  name = 'hdd'          value =" . $row['hdd']       . ">
							  <br>   <div id = 'add'>Nazwisko:  </div>     <input type = 'text'  name = 'nazwisko'     value =" . $row['nazwisko']  . ">
							  <br>   <div id = 'add'>Imie:      </div>     <input type = 'text'  name = 'imie'         value =" . $row['imie']      . ">
							  <br>   <div id = 'add'>Data:      </div>     <input type = 'date'  name = 'data'         value =" . $row['data']      . ">
							  <br>   <div id = 'add'>Uwagi:     </div>     <input type = 'text'  name = 'uwagi'        value =" . $row['uwagi']     . ">

							  <br><br>  <input type = 'submit' value = 'Zapisz'> 	
					      </form>";
				}	
			}
			
			else
			{
				echo "<span style='color:red'><h3>Brak podanego parametru w bazie! </h3></span>";
			}	
	}

	public function Delete($id)
	{
		  
		$sql = $this -> connect -> query("DELETE FROM device WHERE id = '$id'");
		echo "<span style='color:red'><h3> Usunięto ten rekord!</h3></span>";
	}

	public function Update($id, $producent, $model, $sn, $sid, $st, $cpu, $ram, $hdd, $nazwisko, $imie, $data, $uwagi)	
	{
		$sql = $this -> connect -> query("
			UPDATE device SET
		    producent = '$producent',
			 model = '$model',
			  sn = '$sn',
			   sid = '$sid',
			    st = '$st',
			     cpu = '$cpu',
			      ram = '$ram',
			       hdd = '$hdd',
			        nazwisko = '$nazwisko',
			         imie = '$imie',
			          data = '$data',
			           uwagi = '$uwagi'
			            WHERE id = '$id' ");

		header("Refresh:0");
	}
}
?>
