<?php
	// $db_host="localhost"; //localhost server 
	// $db_user="root"; //database username
	// $db_password=""; //database password   
	// $db_name="POSProject"; //database name

	// try
	// {
 // 		$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
 // 		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// }
	// catch(PDOEXCEPTION $e)
	// {
 // 	$e->getMessage();
	// }	




	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "POS";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
?>