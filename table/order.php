<form method="post" action="../order-submit.php">

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-10" style="margin-top: 20px; margin-bottom: 30px">
        <h2><br><i class="fa fa-file-text-o fa-lg"></i> Queues</h2>
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
            <option value="0">Name</option>
            <option value="1">Order ID</option> 
          </select>
        </div>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-10" style="margin-bottom: 50px">
        <table id="myTable" class="table-bordered">
          <tr class="header">
            <th style="width:35%;">Name</th>
            <th style="width:15%;">Order ID</th>
            <th style="width:25%;">Order Time</th>
            <th style="width:10%;"><center>Amount</center></th>
            <th style="width:15%;"><center>Status</center></th>
          </tr>
          <?php  
          include'../connection.php';
    // $sql = "SELECT m.menuID AS mID, m.menuName AS 'name', m.typeName AS 'type', FLOOR(MIN(ingredientStock/amount)) AS 'stock', m.menuPicture AS 'picture' FROM menu m, ingredient i, menuStock ms WHERE m.menuID = ms.menuID AND ms.ingredientID = i.ingredientID GROUP BY m.menuID";
          $sql = "SELECT m.menuName AS name, m.menuID AS menuID, mo.isDone AS isDone, mo.size AS size, mo.orderID AS orderID, fo.orderTime AS orderTime, mo.amount AS amount FROM menu m , menuOrder mo, foodOrder fo WHERE m.menuID = mo.menuID AND fo.orderID = mo.orderID ORDER BY isDone,orderID DESC;" ;
          $result = mysqli_query($conn, $sql);
    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              if ($row["isDone"] == 1) {
                echo "<tr bgcolor='#EEEEEE'>";
              }
              else{
                echo "<tr>";
              }
              echo '<td> ';
              if ($row["size"] == 'NA') {
                echo ' ' . $row["name"]. "</td><td> " . $row["orderID"]. "</td><td> " . $row["orderTime"]. "</td><td><center> " . $row["amount"]. "</center></td>";
              }
              else{
                echo ' ' . $row["name"]. " (".$row["size"].")</td><td> " . $row["orderID"]. "</td><td> " . $row["orderTime"]. "</td><td><center> " . $row["amount"]. "<center></td>";
              }
              if ($row["isDone"] == 1) {
                echo "<td><font color='#5cb85c'><center><b>Served</b></center></font></td>";
              }
              else{
                $argu = $row["orderID"].",'".$row["name"]."','".$row["size"]."',".$row["menuID"];
                echo '<td>  <div>
                <center><a href="#" class="btn btn-success" onclick="orderDone('.$argu.')" style="margin-right: 20px"><i class="fa fa-check fa-lg"></i>
                </a><a href="#" class="btn btn-danger" onclick="orderCancel('.$argu.')"><i class="fa fa-times fa-lg"></i>
                </a></center></div>';
              }
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
</form>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>


  function orderDone(orderID,name,size,menuID){
      // console.log("hello");
      swal({
       title: "Order ID "+orderID,
       text: "Is "+name+" from Order ID "+orderID+" already served?",
       icon: "info",
       buttons: true,
       dangerMode: false,
     }).then((resp) => {
      if (resp) {
          // console.log("hello");
          $.ajax({
            url : "../ajax/order-done.php",
            type: "post",
            data :{
              orderid:orderID,
              menuid:menuID,
              size:size
            },
            success: function(resp){
              var data = JSON.parse(resp)
              console.log(data);
              if(data[0] == 1){
                swal('','served','success').then((value) => {
                  window.location = '../welcome/?test=5'
                })
              }else{
                swal('',data[1],'error')
              }
            }
          })
        }
      })
   }

   function orderCancel(orderID,name,size,menuID){
    console.log("hello");
    swal({
     title: "Order ID "+orderID+" Cancellation",
     text: "Do you wish to cancel "+name+" from Order ID "+orderID+"?",
     icon: "warning",
     buttons: true,
     dangerMode: true,
   }).then((resp) => {
    if (resp) {
          // console.log("hello");
          $.ajax({
            url : "../ajax/delete-each-menu-in-oreder.php",
            type: "post",
            data :{
              orderid:orderID,
              menuid:menuID,
              size:size
            },
            success: function(resp){
              var data = JSON.parse(resp)
              console.log(data);
              if(data[0] == 1){
                swal('','cancelled','success').then((value) => {
                  window.location = '../welcome/?test=5'
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


