<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-4" style="margin-top: 20px">
      <h2><br><i class="fa fa-cube fa-lg"></i> Stock Information</h2>
    </div>
    <div class="col-sm-4"></div>
    <div class="col-sm-2" style="margin-top: 55px" align="right">
      <a href="../welcome/?test=6&sub=1"><button class="btn btn-success"><i class="fa fa-plus "></i><b> Ingredient</b></button></a>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-1"></div>
    <div class="col-sm-8" style="margin-top: 20px">
      <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for ingredients...">
    </div>
    <div class="col-sm-2" style="margin-top: 20px" align="right">
      <div class="form-group">
        <label for="role">Search by:</label>
        <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" id="search">
          <option value="0">Name</option> 
        </select>
      </div>
    </div>
    <div class="col-sm-1"></div>
  </div>
</div>

<!-- ../welcome/?test=4&sub=1 -->

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10" style="margin-bottom: 50px">
      <table id="myTable" class="table table-striped table-bordered">
        <tr class="header">
          <th style="width:25%;">Name</th>
          <th style="width:15%;">Stock</th>
          <th style="width:15%;">Cost Per Unit</th>
          <th style="width:25%;">Last Buy Date</th>
          <th style="width:20%;"><center>Status</center></th>
        </tr>
        <?php  


        include'../connection.php';
        $sql = "SELECT * FROM `ingredient_time`";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["ingredientName"]. "</td><td> " . $row["ingredientStock"]. "</td><td> " . $row["ingredientCostPerUnit"]. "</td><td>".$row["time"]." </td><td>";
            if ($row["isArrived"] == 0 && $row["isArrived"] != NULL) {
              echo "<font color='#f69a33'><center><b>Processing</b></center></font>";
            } else {
              echo "<font color='#5cb85c'><center><b>Restocked</b></center></font>";
            }
            echo "</td></tr>";
          }
        } 

    // SELECT bi.ingredientID ,MAX(bh.timeOfPurchase) FROM buyIngredient bi, buyHistory bh WHERE bi.purchaseID = bh.purchaseID GROUP BY ingredientID

//SELECT i.ingredientName, i.ingredientStock, i.ingredientCostPerUnit, tb.time FROM ingredient i LEFT JOIN (SELECT bi.ingredientID AS id ,MAX(bh.timeOfPurchase) AS time FROM buyIngredient bi, buyHistory bh WHERE bi.purchaseID = bh.purchaseID GROUP BY ingredientID) AS tb ON i.ingredientID = tb.id


        mysqli_close($conn);
        ?>
      </table>
    </div>
    <div class="col-sm-1"></div>
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


