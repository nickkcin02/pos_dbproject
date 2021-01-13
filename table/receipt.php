<form method="post" action="../order-submit.php">

<div class="container" style="margin-top: 40px">
<div class="col-sm-1"></div>
<div class="col-sm-12">
<table id="myTable">
  <tr class="header">

    <th style="width:20%;">OrderID</th>
    <th style="width:40%;">Menu</th>
    <th style="width:20%;">Price</th>
    <th style="width:20%;">Total</th>
    <th style="width:20%;">Status</th>

  </tr>
  <?php  
    include'../connection.php';

    $sql = "SELECT mo.orderID AS orderID, m.menuID AS menuID, m.menuName AS menuName, mo.amount, mo.size, p.price AS price FROM menuorder mo,price p , menu m WHERE mo.menuID = m.menuID AND p.menuID = mo.menuID" ;

	$result = $conn->query($sql);




if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if ($row["isDone"] == 1) {
              echo "<tr bgcolor='#FF0042'>";
            }
            else{
              echo "<tr>";
            }
            
            echo '<td> ';
            if ($row["size"] == 'NA') {
              echo ' ' . $row["orderID"]. "</td><td> " . $row["menuName"]. "</td><td> " . $row["price"]. "</td><td> " . $row["Total"]. "</td>";
            }
            else{
              echo ' ' . $row["orderID"]. "</td><td> " . $row["menuName"]. "</td><td> " . $row["price"]. "</td><td> " . $row["Total"]. "</td>";
            }
            if ($row["isDone"] == 1) {
              echo "<td></td>";
            }
            else{
              echo '<td>  <div >
           <a href="../Checkout.php?orderid='.$row["orderID"].'&price='.$row["price"].'&menuName='.$row["menuName"].'" class="btn btn-primary">Checkout</a></div>';
            }
            
            echo "</td>";
            echo "</tr>";
        }
    } 

// if ($result->num_rows > 0) {
//     echo "<table><tr><th>OrderID</th><th>Menu</th><th>Price</th><th>Total</th></tr>";

//     while($row = $result->fetch_assoc()) {
//         echo "<tr><td>" . $row["OrderID"]. "</td><td>" . $row["Menu"]. " " . $row["Price"]. "</td></tr>";
//     }
//     echo "</table>";
// } else {
//     echo "0 results";
// }


$conn->close();
?>



  