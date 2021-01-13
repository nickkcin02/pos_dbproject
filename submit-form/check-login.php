<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  
if (isset($_POST["username"]) && isset($_POST["password"])) {
	require_once "../connection.php";

	$username = $_POST["username"];
	$password = md5($_POST["password"]);


	if ($username == NULL || $password == NULL) {
		echo '<script type="text/javascript">';
		echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Missing!','Please fill your username and password correctly.','warning').then((value) => {
			window.location = '../'
		})});";
		echo '</script>';
	}


	$sql = "SELECT s.staffPosition, s.staffName, t.username FROM tbl_user t, staff s WHERE s.user_id = t.user_id AND t.username = '$username' AND t.password = '$password' ";
	$result = mysqli_query($conn, $sql);


	if (mysqli_num_rows($result) > 0) {
		echo "login success";
		$row = $result -> fetch_array(MYSQLI_ASSOC);
		session_start();
		$_SESSION["username"] = $row['username'];
		$_SESSION["userRole"] = $row['staffPosition'];
		session_write_close();
		if ($row['staffPosition'] == "Storage Manager") {
			header("Location:../welcome/?test=4");
		}
		else{
			header("Location:../welcome");
		}

	} else {
		echo '<script type="text/javascript">';
		echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Invalid!','Incorrect username and password','error').then((value) => {
			window.location = '../'
		})});";
		echo '</script>';
	}

	mysqli_close($conn);
}



?>