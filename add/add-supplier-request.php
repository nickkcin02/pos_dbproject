<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
	include"../connection.php";
	// $address = $_POST["inputAddress"].', '.$_POST["inputDistrict"].', '.$_POST["inputProvince"].', '.$_POST["inputZip"];
	if (isset($_GET["id"])) { //edit
		$sql = "UPDATE `supplier` SET `supplierName` = '$_POST[inputName]', `supplierAddress` = '$_POST[inputAddress]' ,`subdistrict` = '$_POST[inputSubdistrict]', `district` = '$_POST[inputDistrict]', `province` = '$_POST[inputProvince]', `zip` = '$_POST[inputZip]',`phoneNumber` = '$_POST[inputPhone]', `supplierEmail` ='$_POST[inputEmail]', `contactSale` = '$_POST[inputSale]' WHERE supplierID = $_GET[id];";
	}
	else{
		$sql = "INSERT INTO `supplier`(`supplierName`, `supplierAddress`,`subdistrict`, `district`, `province`, `zip`,`phoneNumber`, `supplierEmail`, `contactSale`) VALUES ('$_POST[inputName]','$_POST[inputAddress]','$_POST[inputSubdistrict]','$_POST[inputDistrict]','$_POST[inputProvince]','$_POST[inputZip]','$_POST[inputPhone]','$_POST[inputEmail]','$_POST[inputSale]');" ;
	}
	
	if (!mysqli_query($conn, $sql)) {
	     // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    echo '<script type="text/javascript">';
       	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Error','".mysqli_error($conn)."','error').then((value) => {
               window.location = '../welcome/?test=11'
             })});";
       	echo '</script>';
	} 
	if (!isset($_GET["id"])) { //not edit
		$sql = "SELECT MAX(supplierID) AS id FROM supplier";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		
	}
	else{
		$id = $_GET['id'];
	}
	$name = $_POST["name"];
	$cost = $_POST["cost"];
	
	if (!isset($_POST["addIngredients"])) {
		echo '<script type="text/javascript">';
       	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Supplier add successfully.','','success').then((value) => {
               window.location = '../welcome/?test=10'
             })});";
       	echo '</script>';
	}
	else {
		for ($i=0; $i < count($name); $i++) { 
			$sql = "INSERT INTO `ingredient`(`ingredientName`, `ingredientStock`, `ingredientCostPerUnit`, `supplierID`) VALUES ('$name[$i]',0,'$cost[$i]','$id');";
			echo $i." ".$name[$i]." ".$cost[$i]." ".$id;
			if (!mysqli_query($conn, $sql)) {
		 		echo '<script type="text/javascript">';
				echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Error','".mysqli_error($conn)."','error').then((value) => {
		               window.location = '../welcome/?test=11'
	             })});";
	       		echo '</script>';
			}
			echo mysqli_error($conn); 
		}
		echo '<script type="text/javascript">';
		       	echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Supplier and Ingredient add successfully.','','success').then((value) => {
		               window.location = '../welcome/?test=10'
		         })});";
	    		echo '</script>';
	}
	
?>