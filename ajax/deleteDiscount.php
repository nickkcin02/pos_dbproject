<?php
$discountID = $_POST["ID"];


include '../connection.php';
$sql = "DELETE FROM discount WHERE discountID = '$discountID' ";
if(mysqli_query($conn, $sql)){
	$res[] = 1;
}
else{
	$res[] = 0;
}
$res[] = mysqli_error($conn);
echo json_encode($res);

?>