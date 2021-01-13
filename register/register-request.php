<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  
require_once "../connection.php";
$username = $_POST["username"];
$password = md5($_POST["password"]);
$con_password = md5($_POST["con-password"]);
$count = 0;

if (!isset($_POST['staff'])) {
	echo '<script type="text/javascript">';
	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Registration Failed','All the staff are registered!','warning').then((value) => {
		window.location = '../register'
	})});";
	echo '</script>';
	$count = 1;
}
if ($con_password != $password) {
	echo '<script type="text/javascript">';
	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Registration Failed','Please confirm you password again.','warning').then((value) => {
		window.location = '../register'
	})});";
	echo '</script>';
	$count = 1;
}
$sql = "SELECT username FROM tbl_user";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		if ($row["username"] == $username) {
			$count = 2;
		}
	}
}

if ($count == 0) {
	$sql = "INSERT INTO `tbl_user`(`user_id`, `username`, `password`) VALUES (NULL,'$username','$password') ";
	if (mysqli_query($conn, $sql)) {
		$sql = "SELECT user_id FROM tbl_user WHERE username = '$username'";
		$query = mysqli_query($conn, $sql);
		$userid = mysqli_fetch_assoc($query);
		$sql = "UPDATE `staff` SET `user_id` = '$userid[user_id]' WHERE staffID = '$_POST[staff]'";
		if (mysqli_query($conn, $sql)) {
			echo '<script type="text/javascript">';
			echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Registration Succeeded','Your account is ready to use.','success').then((value) => {
				window.location = '../'
			})});";
			echo '</script>';
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
	}
	else
	{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
else if ($count == 2)
{
	echo '<script type="text/javascript">';
	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('We are sorry!','This username already exists.','info').then((value) => {
		window.location = '../register'
	})});";
	echo '</script>';
}



mysqli_close($conn);

?>