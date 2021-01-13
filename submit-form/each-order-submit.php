<?php
	$orderID = $_GET["order"];
	$discount = $_POST["discount"];
	// echo $orderID." ".$discount;
	// echo "Today is " . date("Y/m/d h:i:sa") . "<br>";
	if ($discount  == 0) {
		$sql = "UPDATE foodOrder SET paidTime = NOW() WHERE orderID = '$orderID';";
	}
	else{
		$sql = "UPDATE foodOrder SET paidTime = NOW(), discountID = '$discount' WHERE orderID = '$orderID';";
	}
	include '../connection.php';
	if(mysqli_query($conn, $sql)){
    	echo '<script type="text/javascript">';
    	echo ' alert("Bill Success. Thank you"); ';
    	echo 'window.location.replace("../welcome")';
    	echo '</script>';
    }
    else{
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

?>