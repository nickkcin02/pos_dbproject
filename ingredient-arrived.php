<?php
	$purchaseid = $_GET["purchaseid"];

	include'./connection.php';
    $sql = "UPDATE `buyHistory` SET isArrived = 1 WHERE purchaseID = '$purchaseid';" ;

    if(mysqli_query($conn, $sql)){
        $sql = "SELECT ingredientID, amount FROM buyIngredient WHERE purchaseID = '$purchaseid';";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $ID = $row["ingredientID"];
            $amount = $row["amount"];
            $sql = "UPDATE ingredient SET ingredientStock = ingredientStock + '$amount' WHERE ingredientID = '$ID'";
            if (!mysqli_query($conn,$sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    	echo '<script type="text/javascript">';
    	echo ' alert("Order Done"); ';
    	echo 'window.location.replace("../welcome/?test=2")';
    	echo '</script>';
    }
    else{
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


?>