<?php

	class Export_To_Excel
	{
		protected $connect;

		public function __construct($db_location, $db_login, $db_password, $db_name)
		{
			
			$this -> connect = mysqli_connect($db_location, $db_login, $db_password, $db_name);
			if (mysqli_connect_errno())
			  {
			 	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
			 	 exit();
			  }

		}

		public function Export($id)
		{
				
				$sql = $this -> connect -> query("SELECT * FROM device WHERE id = '$id'");
				if(mysqli_num_rows($sql) > 0)
					{
						while ($row = $sql -> fetch_assoc()) 
						{
									 $row['id'] .
									 $row['producent'].
									 $row['model'] .
									 $row['sn'] .
									 $row['sid'].
									 $row['st'] .
									 $row['cpu'].
									 $row['ram'].
									 $row['hdd'].
									 $row['nazwisko'].
									 $row['imie'].
									 $row['data'].
									 $row['uwagi'];
							
									include 'Classes/PHPExcel.php';

									$objPHPExcel = new PHPExcel();

									$objPHPExcel -> getActiveSheet() -> getColumnDimension('C')->setWidth(20);
									$objPHPExcel -> getActiveSheet() -> getColumnDimension('D')->setWidth(20);
									$objPHPExcel -> getActiveSheet() -> getColumnDimension('E')->setWidth(15);
									$objPHPExcel -> getActiveSheet() -> getColumnDimension('F')->setWidth(22);
									$objPHPExcel -> getActiveSheet() -> getColumnDimension('G')->setWidth(15);
									$objPHPExcel -> getActiveSheet() -> getColumnDimension('H')->setWidth(20);
									$objPHPExcel -> setActiveSheetIndex(0) -> mergeCells('E1:H3');
									$objPHPExcel -> getActiveSheet() -> mergeCells('A1:B1');
									$objPHPExcel -> getActiveSheet() -> mergeCells('A4:B4');
									$objPHPExcel -> getActiveSheet() -> mergeCells('A5:B5');
									$objPHPExcel -> getActiveSheet() -> mergeCells('C2:D2');
									$objPHPExcel -> getActiveSheet() -> setCellValue('A1', 'Nazwisko i imie');
									$objPHPExcel -> getActiveSheet() -> setCellValue('C1', $row['nazwisko']);
									$objPHPExcel -> getActiveSheet() -> setCellValue('D1', $row['imie']);
									$objPHPExcel -> getActiveSheet() -> setCellValue('A2', 'Pion');
									$objPHPExcel -> getActiveSheet() -> setCellValue('C2', 'Empik');
									$objPHPExcel -> getActiveSheet() -> setCellValue('A4', 'Nazwa sprzętu');
									$objPHPExcel -> getActiveSheet() -> setCellValue('C4', 'Numer Seryjny');
									$objPHPExcel -> getActiveSheet() -> setCellValue('D4', 'Numer ŚT');
									$objPHPExcel -> getActiveSheet() -> setCellValue('E4', 'Data wydania');
									$objPHPExcel -> getActiveSheet() -> setCellValue('F4', 'Podpis wypożyczającego');
									$objPHPExcel -> getActiveSheet() -> setCellValue('G4', 'Data Zwrotu');
									$objPHPExcel -> getActiveSheet() -> setCellValue('H4', 'Podpis przyjmującego');
									$objPHPExcel -> getActiveSheet() -> setCellValue('A5', $row['producent'] . $row['model']);
									$objPHPExcel -> getActiveSheet() -> setCellValue('C5', $row['sn']);
									$objPHPExcel -> getActiveSheet() -> setCellValue('D5', $row['st']);
									$objPHPExcel -> getActiveSheet() -> setCellValue('E1', 'PION INFORMATYKI Karta wypożyczeń');
										

									$objPHPExcel->getActiveSheet()->setTitle('Chesse1');

									header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
									header('Content-Disposition: attachment;filename="helloworld.xlsx"');
									header('Cache-Control: max-age=0');

									$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
									$objWriter->save('php://output');
									//exit();	
						}
						
					}
					else
					{
						echo "<span style='color:red'>Brak podanego parametru w bazie!</span>";
					}			
		}	

		public function __destruct()
		{
			mysqli_close($this -> connect);
		}		
	}
?>