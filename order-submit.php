<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  
	require_once "connection.php";
	if(isset($_GET['addorderid'])){
        $id = $_GET["addorderid"] ;
        echo "add <br>";
        $sql = "SELECT MAX(menuOrderID) AS menuOrder FROM menuOrder WHERE orderID = '$id';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $menuOrderID = $row["menuOrder"] + 1;
    }
    else {
            session_start();
            $menuOrderID = 1;
            $username = $_SESSION["username"];
            $reservationID = $_GET["reservationID"];
            if ($_GET["isWalkin"] == 1) {
                $sql = "SELECT reservationSeats FROM reservation WHERE reservationID = '$reservationID';";
                //echo $sql."<br>";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $people = $row["reservationSeats"];
            }
            else{
                $people = $_POST["people"];
            }
            //echo $people;   

            $sql = "SELECT t.user_id, s.staffID FROM tbl_user t, staff s WHERE t.username = '$_SESSION[username]' AND t.user_id = s.user_id;";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row["staffID"];


            $sql = "INSERT INTO foodOrder(orderSeats, staffID) VALUES ('$people', '$id');";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            $sql = "SELECT MAX(orderID) AS id FROM foodOrder;";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row["id"];

            //echo $id."   ".$reservationID;   
            $sql = "UPDATE reservation SET orderID = '$id' WHERE reservationID = '$reservationID';";
            if (!mysqli_query($conn, $sql)) {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }


	$sql = "SELECT m.menuID as menuID, m.menuName AS menuName, p.price AS price, p.size AS size FROM menu m, price p WHERE m.menuID = p.menuID";
	$result = mysqli_query($conn, $sql);
	// $data = $_POST['Hot Americano'];



	if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        	$ID = $row["size"].$row["menuID"];
        	$data = $_POST["$ID"];
        	if ($data != 0) {
        		$menuID = $row["menuID"];
        		$size = $row["size"];
        		$sql2 = "INSERT INTO `menuOrder`(`menuOrderID`, `orderID`, `menuID`, `size`, `amount`) VALUES ('$menuOrderID','$id','$menuID','$size','$data') ";

        		if (!mysqli_query($conn, $sql2)) {
        		    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        		}
        		$sql2 = "SELECT ingredientID, amount FROM menuStock WHERE menuID = '$menuID';";
        		$result2 = mysqli_query($conn, $sql2);
        		while ($row2 = mysqli_fetch_assoc($result2)) {
        			if ($size == 'L') 		$ingUsed = $row2["amount"]*$data*3;
        			elseif ($size == 'M') 	$ingUsed = $row2["amount"]*$data*2;
        			else 					$ingUsed = $row2["amount"]*$data;
        			
        			$ingID =  $row2["ingredientID"];
        			$sql3 = "UPDATE ingredient SET ingredientStock = ingredientStock - '$ingUsed' WHERE ingredientID = '$ingID'";
        			if (!mysqli_query($conn, $sql3)) {
        			    echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
        			}
        		}
        		// $sql2 = $sql2 = "UPDATE ingredient SET ingredientStock = ingredientStock - '$data' WHERE ingredientID = '$ID'";

        	}
            
        }
        echo '<script type="text/javascript">';
        echo "document.addEventListener('DOMContentLoaded', function(event) {swal('Order ID ".$id." recieved.','','success').then((value) => {
            window.location = '../welcome/?test=5'
        })});";
        echo '</script>';
    } 



	// if (mysqli_num_rows($result) > 0) {
 //        while($row = mysqli_fetch_assoc($result)) {
 //        	$ID = $row["size"].$row["menuID"];
 //        	$data = $_POST["$ID"];
 //        	echo 'Name   ' .$row["menuName"].'  '.$row["size"].' '.$data.'<br>';
        	
            
 //        }
 //    } 




?>
