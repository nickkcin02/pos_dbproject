<?php
	$orderid = $_GET["orderID"];
	$menuID = $_GET["menuID"];

	include'./connection.php';
    $sql = "UPDATE `menuorder` SET Ischeckout = 1 WHERE orderID = '$orderID' AND menuID = '$menuID' " ;
    if(mysqli_query($conn, $sql)){
    	echo '<script type="text/javascript">';
    	echo ' alert("Checkout Done"); ';
    	echo 'window.location.replace("../welcome/?test=9")';
    	echo '</script>';
    }
    else{
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


?>