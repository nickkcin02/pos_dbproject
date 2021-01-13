<?php
	$orderid = $_GET["orderid"];
	$menuid = $_GET["menuid"];
	$size = $_GET["size"];

	include'./connection.php';
    $sql = "UPDATE `menuOrder` SET isDone = 1 WHERE orderID = '$orderid' AND menuID = '$menuid' AND size = '$size';" ;
    if(mysqli_query($conn, $sql)){
    	echo '<script type="text/javascript">';
    	echo ' alert("Order Done"); ';
    	echo 'window.location.replace("../welcome/?test=5")';
    	echo '</script>';
    }
    else{
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


?>