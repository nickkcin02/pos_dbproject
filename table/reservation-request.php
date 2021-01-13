<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  
require_once "../connection.php";
$name = $_POST['name'];
$seat = $_POST['seats'];
$custype = $_POST['cusType'];
$iswalkin = $_POST['isWalkin'];
if(isset($_POST['date']) && isset($_POST['time'])){
	$olddatetime = $_POST['date']." ".$_POST['time'];
	$datetime = date("Y-m-d H:i:s", strtotime($olddatetime));
}
$tableid = $_POST['tableid'];

session_start();
$username = $_SESSION["username"];
$querystaff = "SELECT t.user_id, s.staffID AS staffID FROM tbl_user t, staff s WHERE t.username = '$_SESSION[username]' AND t.user_id = s.user_id;";
$staffs = mysqli_query($conn, $querystaff);
$staff = mysqli_fetch_assoc($staffs);
if ($iswalkin == 0 and (!isset($_POST['date']) or !isset($_POST['date']) ) ) {
	echo '<script type="text/javascript">';
	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Please add reserve date and time.','','error').then((value) => {
		window.location = './reservation-add.php'
	})});";
	echo '</script>';
}

if ($iswalkin == 0 ) {
	$sql = "INSERT INTO reservation(`reservationName`, `reservationSeats`, `customerTypeID`, `isWalkin`, `tableID`, `time`, `staffID`) VALUES ('$name', $seat, $custype, $iswalkin, $tableid, '$datetime', $staff[staffID]);";
	if (mysqli_query($conn, $sql)) {
		echo '<script type="text/javascript">';
		echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Reservation Complete.','','success').then((value) => {
			window.location = '../welcome/'
		})});";
		echo '</script>';
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
else {
	$sql = "INSERT INTO `reservation`(`reservationName`, `reservationSeats`, `customerTypeID`, `isWalkin`, `tableID`, `staffID`) VALUES ('$name', $seat, $custype, $iswalkin, $tableid, $staff[staffID]);";
	if (mysqli_query($conn, $sql)) {
		echo '<script type="text/javascript">';
		echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Customer Information Recorded.','','success').then((value) => {
			window.location = '../welcome/'
		})});";
		echo '</script>';
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

mysqli_close($conn); 
?>


















