<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  
require_once "../connection.php";

if (!isset($_POST['fname']) || !isset($_POST['lname']) || !isset($_POST['gender']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['add1']) || !isset($_POST['add2']) || !isset($_POST['add2_5']) || !isset($_POST['add3']) || !isset($_POST['zip']) || !isset($_POST['position'])) {
	echo '<script type="text/javascript">';
    echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Not enough information submitted.','','error').then((value) => {
               window.location = './staff-add.php'
             })});";
    echo '</script>';
}
$staffname = $_POST['fname']." ".$_POST['lname'];
$address = $_POST['add1'].", ".$_POST['add2'].", ".$_POST['add3']." ".$_POST['zip'];
$sql = "SELECT staffName, staffPhone, staffPosition FROM staff WHERE staffName = '$staffname' AND staffPhone = '$_POST[phone] AND staffPosition = $_POST[position]'";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo '<script type="text/javascript">';
    	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('This staff is already registered.','','error').then((value) => {
               window.location = './staff-add.php'
             })});";
    	echo '</script>';
	} 
	else {
		// $sql = "INSERT INTO `staff`(`staffID`, `staffName`, `staffAddress`, `staffPhone`, `staffEmail`, `staffPosition`) VALUES (NULL,'$staffname','$address','$_POST[phone]','$_POST[email]','$_POST[position]')";
		if (isset($_GET["id"])) {
			$sql = "UPDATE `staff` SET `staffName`='$_POST[fname]',`lName`='$_POST[lname]',`gender`='$_POST[gender]',`staffAddress`='$_POST[add1]',`subdistrict`='$_POST[add2_5]',`district`='$_POST[add2]',`province`='$_POST[add3]',`zip`='$_POST[zip]',`staffPhone`='$_POST[phone]',`staffEmail`='$_POST[email]',`staffPosition`='$_POST[position]' WHERE staffID = $_GET[id]";
		}
		else{
			$sql = "INSERT INTO `staff`(`staffName`, `lName`, `gender`, `staffAddress`, `subdistrict`, `district`, `province`, `zip`, `staffPhone`, `staffEmail`, `staffPosition`) VALUES ('$_POST[fname]','$_POST[lname]','$_POST[gender]','$_POST[add1]','$_POST[add2_5]','$_POST[add2]','$_POST[add3]','$_POST[zip]','$_POST[phone]','$_POST[email]','$_POST[position]')";
		}
		
		// echo "stringss";
		if (mysqli_query($conn, $sql)) {
			echo '<script type="text/javascript">';
       		echo "document.addEventListener('DOMContentLoaded', function(event) {swal('This staff information is recorded successfully.','','success').then((value) => {
               window.location = '../welcome/?test=1'
             })});";
       		echo '</script>';
		} 
		else{
			echo '<script type="text/javascript">';
       		echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Error','".mysqli_error($conn)."','success').then((value) => {
               window.location = '../welcome/?test=1'
             })});";
       		echo '</script>';
			// echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
}
mysqli_close($conn);
?>