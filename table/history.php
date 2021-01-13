<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10" style="margin-top: 20px">
      <h2><br><i class="fa fa-truck fa-lg"></i> Ingredient Purchase History</h2>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-1"></div>
    <div class="col-sm-8" style="margin-top: 20px">
      <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
    </div>
    <div class="col-sm-2" style="margin-top: 20px" align="right">
      <div class="form-group">
        <label for="role">Search by:</label>
        <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" id="search">
          <option value="0">Time</option> 
          <option value="1">Supplier</option> 
          <option value="2">Staff</option> 
        </select>
      </div>
    </div>
    <div class="col-sm-1"></div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10" style="margin-bottom: 50px">
      <table id="myTable" class="table-bordered">
        <tr class="header">
          <th style="width:10%;">ID</th>
          <th style="width:20%;">Time</th>
          <th style="width:35%;">Supplier</th>
          <th style="width:10%;">Total</th>
          <th style="width:15%;">Staff</th>
          <th style="width:10%;"><center>Status</center></th>
        </tr>
        <?php  
        include'../connection.php';
        $sql = "SELECT * FROM supply_request_status ORDER BY isArrived, purchaseID;";

    // SELECT b.timeOfPurchase AS 'time', st.staffName AS 'staff', bi.purchaseID AS 'purchaseID', sp.supplierName AS 'supplier', b.isArrived AS isArrived, SUM(bi.amount*i.ingredientCostPerUnit) AS total FROM buyHistory b, staff st, supplier sp, buyIngredient bi, ingredient i WHERE sp.supplierID = b.supplierID AND b.staffID = st.staffID AND bi.purchaseID = b.purchaseID AND i.ingredientID = bi.ingredientID GROUP BY bi.purchaseID
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if ($row["isArrived"] == 0) {
              echo "<tr>";
            }
            else{
              echo "<tr bgcolor='#EEEEEE'>";
            }

            echo "<td>".$row["purchaseID"]."</td><td>". $row["time"]. "</td><td> " . $row["supplier"]. "</td><td> ".number_format($row["total"],2)."</td><td> ". $row["staff"]. "</td>";
            if ($row["isArrived"] == 0) {
              $purchaseID = $row["purchaseID"].",'".$row["supplier"]."'";
              echo '<td><div><center>
              <a href="#" onclick="ingredientCome('.$purchaseID.')" class="btn btn-success"><i class="fa fa-check-circle fa-lg"></i></a></center></div>';
            }
            else{
              echo "<td><font color='#d9534f'><center><b>Paid</b></center></font></td>";
            }
            echo "</tr>";
          }
        } 


        mysqli_close($conn);
        ?>
      </table>
    </div>
    <div class="col-sm-1"></div>
  </div>
</div>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>


  
    function ingredientCome(purchaseID,supplier){
      // console.log("hello");
     swal({
       title: "PurchaseID #"+purchaseID,
       text: "Confirm Package Arrived #"+purchaseID+" From "+supplier+" ?",
       icon: "info",
       buttons: true,
       dangerMode: false,
     }).then((resp) => {
        if (resp) {
          // console.log("hello");
          $.ajax({
            url : "../ajax/ingredient-arrived.php",
            type: "post",
            data :{
              purchaseid:purchaseID
            },
            success: function(resp){
              var data = JSON.parse(resp)
              console.log(data);
              if(data[0] == 1){
                swal('','Package Arrived','success').then((value) => {
                  window.location = '../welcome/?test=2'
                })
              }else{
                swal('',data[1],'error')
              }
            }
          })
        }
    })
  }



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


