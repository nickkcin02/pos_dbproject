<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
	include"../connection.php";
	$start = date("Y-m-d", strtotime($_POST['start']));
	$end = date("Y-m-d", strtotime($_POST['end']));
	$sql = "INSERT INTO `discount`(`discountName`, `totalPrice`, `method`, `amount`, `startTime`, `endTime`) VALUES ('$_POST[name]','$_POST[total]','$_POST[type]','$_POST[amountInput]','$start','$end')";
	if (!mysqli_query($conn, $sql)) {
	     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	} 
	else{

		echo '<script type="text/javascript">';
       echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Discount add successfully.','','success').then((value) => {
               window.location = '../welcome/?test=8'
             })});";
       echo '</script>';
	}
	
?>