<div class="container-fluid">
  <div>
    <div class="row">
      <div class="col-sm-1"></div>
        <div class="col-sm-5" style="margin-top: 20px">
          <h2><br><i class="fa fa-user"></i> Staff Information</h2>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-2" style="margin-top: 55px" align="right">
          <a href="../add/staff-add.php" class="btn btn-success"><b><i class="fa fa-user-plus"></i> Staff</b></a>
        </div>
        <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>
      <div class="col-sm-8" style="margin-top: 20px">
        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for names...">
      </div>
      <div class="col-sm-2" style="margin-top: 20px">
        <div class="form-group">
          <div class="dropdown" align="right">
            <label for="role">Search by:</label>
            <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" data-toggle="dropdown" id="search">
              <option value="1">Name</option> 
              <option value="0">Staff ID</option> 
              <option value="4">Position</option> 
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
    <div class="col-sm-10" style="margin-bottom: 50px">
      <table id="myTable" class="table-bordered table-striped">
        <tr class="header">
          <th style="width:10%;">Staff ID</th>
          <th style="width:25%;">Name</th>
          <th style="width:13%;">Phone</th>
          <th style="width:25%;">E-mail</th>
          <th style="width:17%;">Position</th>
          <th style="width:10%;"><center>Edit</center></th>
        </tr>
        <?php  
        include'../connection.php';
        $sql = "SELECT staffID, staffName, lname, staffPhone, staffEmail, staffPosition FROM staff;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['staffID']. "</td><td> " . $row["staffName"]." ".$row['lname']. "</td><td> " . $row["staffPhone"]. "</td><td>".$row["staffEmail"]." </td><td> " . $row["staffPosition"]. "</td>";
            echo '<td><center><a href="../add/staff-add.php?id='.$row['staffID'].'" class="btn btn-primary" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center></td>';
            echo "</tr>";
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