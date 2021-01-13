<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="../css/index.css">


  <title>Customer Information</title>
</head>
<body>



  <?php  
  include 'nav-bar.php';
  ?>
  <div class="container-fluid">
    <div>
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-4" style="margin-top: 20px">
          <h2><br><i class="fa fa-user-o fa-lg"></i> Customer Information</h2>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-2" style="margin-top: 55px" align="right">
          <a href="../table/reservation-add.php" class="btn btn-success"><i class="fa fa-user-plus"></i><b> Customer</b></a>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-1"></div>
        <div class="col-sm-8" style="margin-top: 20px">
          <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for cutomers..."></div>
          <div class="col-sm-2" style="margin-top: 20px">
            <div class="form-group">
              <div class="dropdown" align="right">
                <label for="role">Search by:</label>
                <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" data-toggle="dropdown" id="search">
                  <option value="0">Name</option>
                  <option value="2">Table</option> 
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" align="left" style="margin-top: 20px">
          <h4>Reserved Customer</h4>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" id="tb1">
          <table id="myTable" class="table-striped">
            <tr class="header">
              <th style="width:30%;">Name</th>
              <th style="width:10%;">Seats</th>
              <th style="width:10%;">Table</th>
              <th style="width:25%;">Reserve Time</th>
              <th style="width:25%;" class="table-bordered"><center>Status Confirmation</center></th>
            </tr>
            <?php  
            include'../connection.php';
            $sql = "SELECT reservationID AS ID, reservationName AS name, reservationSeats AS seat, tableID, time, isWalkin FROM `reservation` WHERE orderID IS NULL AND tableID IS NOT NULL;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $datetime = date("Y-m-d H:i:s", strtotime($row['time']));
                $datetime15 = date("Y-m-d H:i:s", strtotime($row['time']) + 900);
                $datetime20 = date("Y-m-d H:i:s", strtotime($row['time']) + 1200);
                if ($row['isWalkin'] == 1) {
                  echo "<tr>";
                  echo "<td>" . $row["name"]. "</td><td> " . $row["seat"]. "</td><td> " . $row["tableID"]. "</td><td>".$row["time"]." </td><td class='table-bordered'><center><a href='../welcome/?test=3&isWalkin=".$row["isWalkin"]."&reservationID=".$row["ID"]."' role='button' class='btn btn-success' style='width: 150px'>Order Now</button></center></td>";
                  echo "</tr>";
                }
                elseif ($row['isWalkin'] == 0 && date("Y-m-d H:i:s") <= $datetime) {
                  echo "<tr>";
                  echo "<td>" . $row["name"]. "</td><td> " . $row["seat"]. "</td><td> " . $row["tableID"]. "</td><td>".$row["time"]." </td><td class='table-bordered'><center><a href='../welcome/?test=3&isWalkin=".$row["isWalkin"]."&reservationID=".$row["ID"]."' role='button' class='btn btn-success' style='width: 150px'>Arrived</button></center></td>";
                  echo "</tr>";
                }
                elseif ($row['isWalkin'] == 0 && date("Y-m-d H:i:s") > $datetime && date("Y-m-d H:i:s") < $datetime15) {
                  echo "<tr>";
                  echo "<td>" . $row["name"]. "</td><td> " . $row["seat"]. "</td><td> " . $row["tableID"]. "</td><td>".$row["time"]." </td><td class='table-bordered'><center><a href='../welcome/?test=3&isWalkin=".$row["isWalkin"]."&reservationID=".$row["ID"]."' role='button' class='btn btn-danger' style='width: 150px'>Late</button></center></td>";
                  echo "</tr>";
                }
                elseif ($row['isWalkin'] == 0 && date("Y-m-d H:i:s") >= $datetime15 && date("Y-m-d H:i:s") < $datetime20) {
                  echo "<tr>";
                  echo "<td>" . $row["name"]. "</td><td> " . $row["seat"]. "</td><td> " . $row["tableID"]. "</td><td>".$row["time"]." </td><td class='table-bordered'><center><a role='button' class='btn btn-light' style='width: 150px'>Cancelled</button></center></td>";
                  echo "</tr>";
                }
                elseif ($row['isWalkin'] == 0 && date("Y-m-d H:i:s") >= $datetime20) {
                  $sql = "DELETE FROM `reservation` WHERE `reservation`.`reservationID` = '$row[ID]';";
                  mysqli_query($conn, $sql);
                }
              }
            } 
            mysqli_close($conn);
            ?>
          </table>
        </div>
        <div class="col-sm-1"></div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top: 20px">
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" align="left" style="margin-top: 20px">
          <h4>Orders on Hold</h4>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" id="tb2">
          <table id="myTable" class="table-striped">
            <tr class="header">
              <th style="width:20%;">Name</th>
              <th style="width:10%;">Order ID</th>
              <th style="width:10%;">Table</th>
              <th style="width:10%;">Seats</th>
              <th style="width:25%;">Time Arrival</th>
              <th style="width:10%;">Status</th>
              <th style="width:15%;" class="table-bordered"><center>Add Orders</center></th>
            </tr>
            <?php  
            include'../connection.php';
            $sql = "SELECT f.orderID AS odID, f.orderTime AS ta, f.orderSeats AS seats, f.staffID AS staff, f.paidTime AS paid, r.reservationName AS name, r.tableID AS tableID FROM foodOrder f, reservation r WHERE f.orderID = r.orderID;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                $paidtime15 = date("Y-m-d H:i:s", strtotime($row['paid']) + 900);
                if ($row['paid'] != NULL) {
                  $status = "<b style = 'color: #d9534f'>PAID</b>";
                } else {
                  $status = "<b style = 'color: #f0ad4a'>working...</b>";
                }
                if ($row['paid'] == NULL || date("Y-m-d H:i:s") <= $paidtime15) {
                  echo "<tr>";
                  echo "<td>" . $row['name']. "</td><td> " . $row["odID"]. "</td><td> " . $row["tableID"]. "</td><td>".$row["seats"]." </td><td> " . $row["ta"]. "</td><td> " .$status. "</td><td class='table-bordered'><center>";
                  if ($row['paid'] == NULL) {
                    echo '<a href="../welcome/?test=3&addorderid='.$row["odID"].'" class="btn btn-primary">Add Order</a>';
                  }
                }
                echo "</center></td></tr>";
              }
              $result2 = mysqli_query($conn, $sql2);
            }
            mysqli_close($conn);
            ?>
          </table>
        </div>
        <div class="col-sm-1"></div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top: 20px"></div>


    <script>
      function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue ,col;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.querySelectorAll("tb1");
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


<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue ,col;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tb2");
    tr = table.getElementsByTagName("tr");
    col = document.getElementById("search").value;
    console.log(col);
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



<!-- <script src="../snowball.js"></script> -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>











