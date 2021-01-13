<form method="post" action="../order-submit.php">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-8" style="margin-top: 20px;">
        <h2><br><i class="fa fa-percent fa-lg"></i> Total Discounts</h2>
      </div>
      <div class="col-sm-2" style="margin-top: 55px" align="right">
        <a href="../add/add-discount.php" class="btn btn-success" ><b><i class="fa fa-plus "></i> Discount</b></a>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-8" style="margin-top: 20px">
        <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for discounts...">
      </div>
      <div class="col-sm-2">
        <div class="form-group" style="margin-top: 20px" align="right">
          <label for="role">Search by:</label>
          <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" id="search">
            <option value="0">Name</option> 
            <option value="1">Total Price</option>
            <option value="2">Discount</option>  
          </select>
        </div>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-10" style="margin-bottom: 50px">
        <table id="myTable" class="table-striped table-bordered">
          <tr class="header">
            <th style="width:25%;">Name</th>
            <th style="width:18%;">Total Price Per Bill</th>
            <th style="width:10%;">Discount</th>
            <th style="width:12%;">Start</th>
            <th style="width:12%;">End</th>
            <th style="width:13%;"><center>Status</center></th>
            <th style="width:10%;"><center>Remove</center></th>
          </tr>
          <?php  
          include'../connection.php';
    // $sql = "SELECT m.menuID AS mID, m.menuName AS 'name', m.typeName AS 'type', FLOOR(MIN(ingredientStock/amount)) AS 'stock', m.menuPicture AS 'picture' FROM menu m, ingredient i, menuStock ms WHERE m.menuID = ms.menuID AND ms.ingredientID = i.ingredientID GROUP BY m.menuID";
          $time = date("Y-m-d");

          $sql = "SELECT discountID, discountName, totalPrice, amount, method, startTime, endTime, IF(CURDATE()>=startTime AND CURDATE()<=endTime,0,IF(CURDATE()<startTime,1,2)) AS isEnd FROM discount ORDER BY  isEnd;" ;
          $result = mysqli_query($conn, $sql);


    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">

          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              if ($row["isEnd"] == 1 || $row["isEnd"] == 2) {
                echo "<tr bgcolor='#EEEEEE'>";
              }
              else{
                echo "<tr>";
              }

              echo '<td>' . $row["discountName"]. "</td><td> " . $row["totalPrice"]. "</td><td> " . $row["amount"]." ".$row["method"]. "</td><td> " . $row["startTime"]. "</td><td>".$row["endTime"]."</td>";
              if ($row["isEnd"] == 2) {
                echo '<td><center><b style="color: #999999;">End</b></center</td><td></td>';
              }
              else if ($row["isEnd"] == 1) {
                $param = $row["discountID"].",'".$row["discountName"]."','".$row["startTime"]."'";
                echo '<td><center><b style="color: #F1A503;">Coming Soon</b></center></td>';
                echo '<td><center><button type="button" class="btn btn-danger" style="margin-top: 4px" onclick="deleteDiscount('.$param.')"><i class="fa fa-times" aria-hidden="true"></i></button></center></td>';
              }
              else{
                echo '<td><center><b style="color: #00CC00;">Active</b></center></td><td></td>';
              }

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



  

</form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<script>

function deleteDiscount(ID,discountName,time){
    console.log("hello");
   swal({
     title: "Delete Discount#"+ID,
     text: "Delete Promotion"+discountName+" Start time : "+time,
     icon: "warning",
     buttons: true,
     dangerMode: true,
   }).then((resp) => {
      if (resp) {
        // console.log("hello");
        $.ajax({
          url : "../ajax/deleteDiscount.php",
          type: "post",
          data :{
            ID:ID
          },
          success: function(resp){
            var data = JSON.parse(resp)
            console.log(data);
            if(data[0] == 1){
              swal('','Success','success').then((value) => {
                window.location = '../welcome/?test=8'
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


