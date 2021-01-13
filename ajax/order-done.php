<?php
	$orderid = $_POST["orderid"];
	$menuid = $_POST["menuid"];
	$size = $_POST["size"];
    // echo json_encode($menuid);
	include'../connection.php';
    $sql = "UPDATE `menuOrder` SET isDone = 1 WHERE orderID = '$orderid' AND menuID = '$menuid' AND size = '$size';" ;
    if(mysqli_query($conn, $sql)){
        $res[] = 1;
    	// echo '<script type="text/javascript">';
    	// echo ' alert("Order Done"); ';
    	// echo 'window.location.replace("../welcome/?test=5")';
    	// echo '</script>';
    }
    else{
        $res[] = 0;
    }

    $res[] = mysqli_error($conn);
    echo json_encode($res);

?>