<div class="container">
  <div class="row">
    <div class="col-sm-8" style="margin-top: 20px"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."></div>
    <div class="col-sm-2">
      <div class="form-group">
          <label for="role">Search</label>
          <select class="form-control" onchange="myFunction()" name="search" id="search">
            <option value="0">Name</option> 
          </select>
      </div>
    </div>
    <div class="col-sm-2" style="margin-top: 30px">
      <a href="../welcome/?test=8"><button class="btn btn-primary">New Reservation</button></a>
    </div>
  </div>
</div>

<!-- ../welcome/?test=4&sub=1 -->

<div class="container">
<div class="col-sm-1"></div>
<div class="col-sm-12">
<table id="myTable">
  <tr class="header">
    <th style="width:25%;">Name</th>
    <th style="width:25%;">Seat</th>
    <th style="width:25%;">Table</th>
    <th style="width:25%;">Reserve Time</th>
  </tr>
  <?php  
    include'../connection.php';
    $sql = "SELECT reservationName AS name, reservationSeats AS seat, tableID, time FROM `reservation` WHERE orderID IS NULL;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["name"]. "</td><td> " . $row["seat"]. "</td><td> " . $row["tableID"]. "</td><td>".$row["time"]." </td>";
            echo "</tr>";
        }
    } 

    // SELECT bi.ingredientID ,MAX(bh.timeOfPurchase) FROM buyIngredient bi, buyHistory bh WHERE bi.purchaseID = bh.purchaseID GROUP BY ingredientID

//SELECT i.ingredientName, i.ingredientStock, i.ingredientCostPerUnit, tb.time FROM ingredient i LEFT JOIN (SELECT bi.ingredientID AS id ,MAX(bh.timeOfPurchase) AS time FROM buyIngredient bi, buyHistory bh WHERE bi.purchaseID = bh.purchaseID GROUP BY ingredientID) AS tb ON i.ingredientID = tb.id


    mysqli_close($conn);
  ?>
</table>
</div>
</div>




<script>
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


