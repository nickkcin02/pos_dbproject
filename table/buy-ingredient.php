<form method="post" action="../ingredient-request.php?sub=<?php echo $_GET["sub"]; ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10" style="margin-top: 20px">
        <h2><br><i class="fa fa-file-text-o fa-lg"></i> Purchase Ingredient from Suppliers</h2>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-6" style="margin-top: 20px">
        <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names...">
      </div>
      <div class="col-sm-4" style="margin-top: 20px" align="right">
        <div class="form-group">
          <label for="role">Select Supplier:</label>
          <select class="btn btn-outline-primary dropdown-toggle" type="button" name="search" id="dynamic_select">
            <?php
            include'../connection.php';
            $sql = "SELECT supplierID, supplierName FROM supplier;" ;
            $result = mysqli_query($conn, $sql);
            $id = $_GET["sub"];
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="../welcome?test=6&sub='.$row["supplierID"];
                if ($id == $row["supplierID"]) {
                  echo '" selected>';
                }
                else{
                  echo '">';
                }
                echo $row["supplierName"].'</option>';
              }
            } 
            ?>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <table id="myTable" class="table-striped table-bordered">
          <tr class="header">
            <th style="width:40%;">Name</th>
            <th style="width:15%;">Stock</th>
            <th style="width:15%;">Cost</th>
            <th style="width:30%;"><center>Units to Purchase</center></th>
          </tr>
          <?php  
          $id = $_GET["sub"];
          $sql = "SELECT i.ingredientID AS ID, i.ingredientName AS name, i.ingredientStock AS stock, i.ingredientCostPerUnit AS cost FROM ingredient i, supplier s WHERE i.supplierID = s.supplierID AND s.supplierID = '$id';" ;
          $result = mysqli_query($conn, $sql);


    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">

          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo '<td> ';
              echo ' ' . $row["name"]. "</td><td> " . $row["stock"]. "</td><td> " . $row["cost"]. "</td>";
              echo '<td> <input type="number" class="form-control" value=0 id="'.$row["ID"].'" name="'.$row["ID"].'" min="0"> </td>';
              echo "</td>";
              echo "</tr>";
            }
          } 


// echo '<td> <input type="number" class="form-control" value=0 id="'. $row["mID"].'" name="'. $row["mID"].'" min="0" max="'. $row["stock"].'"> </td>';



          mysqli_close($conn);
          ?>
        </table>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>


  <div class="container">
   <div class="row">
     <div class="col-sm-3">

     </div>
     <div class="col-sm-6">
      <br>

      <div class="col-sm-12 " align="center">
       <button type="submit" class="btn btn-danger btn-lg" style="width: 200px; margin-bottom: 50px">Purchase</button>
     </div>
     <br>

   </div>
 </div>
</div>
</form>



<script>

  $(function(){
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
            }
            return false;
          });
    });



  function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue ;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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









































<!-- <div class="container">
  <div class="row">
    <div class="col-sm-10"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."></div>
    <div class="col-sm-2">
      <div class="form-group">
          <label for="role">Search</label>
          <select class="form-control" onchange="myFunction()" name="search" id="search">
            <option value="0">Name</option> 
          </select>
      </div>
    </div>
  </div>
</div>



<table id="myTable">
  <tr class="header">
    <th style="width:25%;">Name</th>
    <th style="width:25%;">Stock</th>
    <th style="width:25%;">Cost Per Unit</th>
    <th style="width:25%;">Last Buy Date</th>
  </tr>
  <?php  
    include'../connection.php';
    $sql = "SELECT ingredientName, ingredientStock, ingredientCostPerUnit FROM ingredient";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["ingredientName"]. "</td><td> " . $row["ingredientStock"]. "</td><td> " . $row["ingredientCostPerUnit"]. "</td><td> NULL </td>";
            echo "</tr>";
        }
    } 

    mysqli_close($conn);
  ?>
</table>

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


 -->