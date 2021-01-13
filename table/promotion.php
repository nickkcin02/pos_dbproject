<form method="post" action="../order-submit.php">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-8" style="margin-top: 20px;">
        <h2><br><i class="fa fa-cutlery fa-lg"></i> Promotions</h2>
      </div>
      <div class="col-sm-2" style="margin-top: 55px" align="right">
        <a href="../add/add-promotion.php" class="btn btn-success" ><b><i class="fa fa-plus "></i> Promotion</b></a>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-8" style="margin-top: 20px">
        <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for promotions...">
      </div>
      <div class="col-sm-2">
        <div class="form-group" style="margin-top: 20px" align="right">
          <label for="role">Search by:</label>
          <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" id="search">
            <option value="0">Name</option> 
            <option value="1">Menu</option>
            <option value="2">Discount</option>  
          </select>
        </div>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-10" style="margin-bottom: 50px">
        <table id="myTable" class="table-bordered">
          <tr class="header">
            <th style="width:20%;">Name</th>
            <th style="width:22%;">Menu</th>
            <th style="width:10%;">Discount</th>
            <th style="width:12%;">Start</th>
            <th style="width:12%;">End</th>
            <th style="width:12%;"><center>Status</center></th>
            <th style="width:10%;"><center>Remove</center></th>
          </tr>
          <?php  
          include'../connection.php';
    // $sql = "SELECT m.menuID AS mID, m.menuName AS 'name', m.typeName AS 'type', FLOOR(MIN(ingredientStock/amount)) AS 'stock', m.menuPicture AS 'picture' FROM menu m, ingredient i, menuStock ms WHERE m.menuID = ms.menuID AND ms.ingredientID = i.ingredientID GROUP BY m.menuID";
          $time = date("Y-m-d");

          $sql = "SELECT promotionName, menuName, m.menuID, p.promotionID, size, amount, method, startTime, endTime, IF(CURDATE()>=startTime AND CURDATE()<=endTime,0, IF(CURDATE() < startTime,1,2)) AS isEnd FROM promotion p,promotionHistory ph, menu m WHERE ph.promotionID = p.promotionID AND m.menuID = ph.menuID ORDER BY isEnd;" ;
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

              echo '<td>' . $row["promotionName"]. "</td><td> ";
              if ($row["size"] == 'NA') {
                echo $row["menuName"];
              }
              else{
                echo $row["menuName"]."(".$row["size"].")";
              }
              echo "</td><td> " . $row["amount"]." ".$row["method"]. "</td><td> " . $row["startTime"]. "</td><td>".$row["endTime"]."</td>";
              if ($row["isEnd"] == 2) {
                echo '<td><center><b style="color: #999999;">End</b></center></td><td></td>';
              }
              else if ($row["isEnd"] == 1) {
                $param = $row["menuID"].",'".$row["size"]."','".$row["menuName"]."','".$row["promotionName"]."',".$row["promotionID"].",'".$row["startTime"]."'";
                echo '<td><center><b style="color: #F1A503;">Coming Soon</b></center></td>';
                echo '<td><center><button type="button" class="btn btn-danger" style="margin-top: 4px" onclick="deleteMenu('.$param.')"><i class="fa fa-times" aria-hidden="true"></i</button></center></td>';
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

function deleteMenu(menuID,size,menuName,promotionName,promotionID,time){
    console.log("hello");
    var name = menuName;
    if (size != "NA") {
      var name = menuName+" ("+size+")";
    }
   swal({
     title: "Delete Promotion",
     text: "Delete Promotion"+promotionName+" of Menu "+name+" Start time : "+time,
     icon: "warning",
     buttons: true,
     dangerMode: true,
   }).then((resp) => {
      if (resp) {
        // console.log("hello");
        $.ajax({
          url : "../ajax/deletePromotion.php",
          type: "post",
          data :{
            menuID:menuID,
            size:size,
            promotionID:promotionID,
            startTime:time
          },
          success: function(resp){
            var data = JSON.parse(resp)
            console.log(data);
            if(data[0] == 1){
              swal('','Success','success').then((value) => {
                window.location = '../welcome/?test=14'
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


