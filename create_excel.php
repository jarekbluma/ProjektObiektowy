<?php
	require_once 'connect.php';
	require_once 'export.php';

	$id = $_GET['id'];
	$export = new Export_To_Excel($db_location, $db_login, $db_password, $db_name);
	$export -> Export($id);
?>