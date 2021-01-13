<?php
	include '../connection.php';
	$menu = explode(",", $_POST["menu"]);
	
	// echo "asd";
	$sql  = "SELECT startTime, endTime FROM promotionHistory WHERE menuID = '$menu[0]' AND size = '$menu[1]' ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
         }
         echo json_encode($rows);
    }
    else{
    	echo "";
    }
	
?>