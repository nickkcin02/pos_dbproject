<?php
	include '../connection.php';
	$id = $_POST["id"];
	
	// echo "asd";
	$sql  = "DELETE FROM menu WHERE menuID = '$id' ";
	if(!mysqli_query($conn, $sql)){
		$res[] = 0;
	}
	else{
		$res[] = 1;
	}
	$res[] = mysqli_error($conn);
	echo json_encode($res);
	
?>