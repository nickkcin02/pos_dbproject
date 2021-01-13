<?php
$menuID = $_POST["menuID"];
$size = $_POST["size"];
$promotionID = $_POST["promotionID"];
$startTime = $_POST["startTime"];

include '../connection.php';
$sql = "DELETE FROM promotionHistory WHERE menuID = '$menuID' AND size = '$size' AND promotionID = '$promotionID' AND startTime = '$startTime' ";
if(mysqli_query($conn, $sql)){
	$res[] = 1;
}
else{
	$res[] = 0;
}
$res[] = mysqli_error($conn);
echo json_encode($res);

?>