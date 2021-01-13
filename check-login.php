
<?php  
	if (isset($_POST["username"]) && isset($_POST["password"])) {
		require_once "connection.php";

		$username = $_POST["username"];
		$password = md5($_POST["password"]);


		if ($username == NULL || $password == NULL) {
			echo '<script type="text/javascript">';
			echo ' alert("please fill your username or password "); ';
			echo 'window.location.replace("./")';
			echo '</script>';
		}


		$sql = "SELECT userRole, user_id FROM tbl_user WHERE username = '$username' AND password = '$password' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		    echo "login success";
		    session_start();
		    $_SESSION["username"] = $username;
		    $row = mysqli_fetch_assoc($result);
		    $_SESSION["userRole"] = $row["userRole"];
		    session_write_close();
		    header("Location:./welcome");

		} else {
		    echo "0 results";
		}

		mysqli_close($conn);
	}
	


?>