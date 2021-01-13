<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10" style="margin-top: 20px; margin-bottom: 20px">
      <h2><br><i class="fa fa-shopping-cart fa-lg"></i> Bills on Hold</h2>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-1"></div>
    <div class="col-sm-8">
      <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for orders...">
    </div>
    <div class="col-sm-2" align="right">
      <div class="form-group">
        <label for="role">Search by:</label>
        <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" id="search">
          <option value="1">Name</option>
          <option value="0">Order ID</option> 
          <option value="2">Table</option> 
        </select>
      </div>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-1"></div>
    <div class="col-sm-10" style="margin-top: -10px"><hr>
      <p style="margin-top: 10px" class="text-secondary">Click on the icon to see detail.</p>
      <table id="myTable" class="table-bordered" style="margin-bottom: 50px">
        <tr class="header">
          <th style="width:15%;">Order ID</th>
          <th style="width:35%;">Name</th>
          <th style="width:15%;">Table</th>
          <th style="width:15%;">Total</th>
          <th style="width:20%;"><center>Status</center></th>
        </tr>
        <?php  
        include'../connection.php';
        $sql = "SELECT op.orderID, SUM(op.price_dis*op.amount) AS total, IF(fo.paidTime IS NULL,0,1) AS isPaid, reservationName AS name, tableID, discountName, method, fo.amount FROM order_paid op, (SELECT orderID, paidTime, discountName, method, amount FROM foodOrder f LEFT JOIN discount d ON d.discountID = f.discountID) AS fo, reservation r WHERE op.orderID = fo.orderID AND op.orderID = r.orderID GROUP BY orderID ORDER BY ispaid,op.orderid;";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if ($row["isPaid"] == 0) {
              echo "<tr>";
            }
            else{
              echo "<tr bgcolor='#EEEEEE'>";
            }
            echo "<td>" . $row["orderID"]. "</td><td> ". $row["name"]. "</td><td> ". $row["tableID"]. "</td><td> " ;
            if ($row["isPaid"] == 0) {
              echo number_format($row["total"],2). '</td><td><center>
              <a href="../welcome/?test=9&orderid='.$row["orderID"].'" class="btn btn-danger"><i class="fa fa-money fa-lg"></i> Check
              </a></center>';
            }
            else{
              if ($row["discountName"] != NULL) {
                if ($row["method"] == "%") {
                  echo '<a href="#" data-rel="popover" title="Discount" data-content="'.$row["discountName"].'" data-html="true"><b style="color: #00af00">'.number_format($row["total"]*((100-$row["amount"])/100),2).'</b></a>';
                }
                else{
                  echo '<a href="#" data-rel="popover" title="Discount" data-content="'.$row["discountName"].'" data-html="true"><b style="color: #00af00">'.number_format(($row["total"]-$row["amount"]),2).'</b></a>';
                }
              }
              else{
                echo number_format($row["total"],2);
              }
              echo '</td><td><center>
              <a href="../welcome/?test=9&paid=1&orderid='.$row["orderID"].'" class="btn btn-success"><i class="fa fa-check-circle fa-lg"></i> Paid</a></center></td></tr>';
            }
          }
        } 

    // SELECT bi.ingredientID ,MAX(bh.timeOfPurchase) FROM buyIngredient bi, buyHistory bh WHERE bi.purchaseID = bh.purchaseID GROUP BY ingredientID

//SELECT i.ingredientName, i.ingredientStock, i.ingredientCostPerUnit, tb.time FROM ingredient i LEFT JOIN (SELECT bi.ingredientID AS id ,MAX(bh.timeOfPurchase) AS time FROM buyIngredient bi, buyHistory bh WHERE bi.purchaseID = bh.purchaseID GROUP BY ingredientID) AS tb ON i.ingredientID = tb.id


        mysqli_close($conn);
        ?>
      </table>
    </div>
  </div>
</div>
</div>




<script>
  $(document).ready(function(){
    $('[data-rel=popover]').popover({
      html: true,
      trigger: "hover"
    });
  });


  function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue ,col;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  col = document.getElementById("search").value;
  console.log(col);
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[col];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>


