<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  
	require_once "connection.php";
	session_start();
	$username = $_SESSION["username"];


	$sql = "SELECT t.user_id, s.staffID FROM tbl_user t, staff s WHERE t.username = '$_SESSION[username]' AND t.user_id = s.user_id;";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$id = $row["staffID"];
	$supplierID = $_GET["sub"];

	$sql = "INSERT INTO buyHistory(staffID, supplierID) VALUES ('$id', '$supplierID');";

		if (mysqli_query($conn, $sql)) {
		    // echo 'Success';

		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

	$sql = "SELECT MAX(purchaseID) AS id FROM buyHistory;";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$purchaseid = $row["id"];

	$sql = "SELECT ingredientID FROM ingredient WHERE supplierID = '$supplierID';";
	$result = mysqli_query($conn, $sql);
	// $data = $_POST['Hot Americano'];



	if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        	$ID = $row["ingredientID"];
        	$data = $_POST["$ID"];
        	if ($data != 0) {
        		// echo "('".$purchaseid."','".$ID."', '".$data."')";
        		$sql2 = "INSERT INTO `buyIngredient`(`purchaseID`, `ingredientID`, `amount`) VALUES ('$purchaseid','$ID', '$data') ";
        		if (!mysqli_query($conn, $sql2)) {
        		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        		}
        	}
            
        }
        echo '<script type="text/javascript">';
        echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Purchase ID #".$purchaseid." Send','','success').then((value) => {
                window.location = '../welcome/?test=2'
              })});";
        echo '</script>';
        // echo '<script type="text/javascript">';
        // echo ' alert("Purchase ID #'.$purchaseid.' Send "); ';
        // echo 'window.location.replace("../welcome/?test=2")';
        // echo '</script>';
    } 


?>
