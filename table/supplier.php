<form method="post" action="../order-submit.php">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-4" style="margin-top: 20px">
        <h2><br><i class="fa fa-cubes fa-lg"></i> Supplier Information</h2>
      </div>
      <div class="col-sm-4"></div>
      <div class="col-sm-2" style="margin-top: 55px" align="right">
        <a href="../welcome/?test=11" class="btn btn-success"><b><i class="fa fa-plus "></i> Supplier</b></a>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-1"></div>        
      <div class="col-sm-8" style="margin-top: 20px">
        <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for suppliers...">
      </div>
      <div class="col-sm-2" style="margin-top: 20px" align="right">
        <div class="form-group">
          <label for="role">Search by:</label>
          <select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" id="search">
            <option value="0">Suppliers</option> 
            <option value="1">Sale's Name</option> 
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
        <table id="myTable" class="table-striped table-bordered">
          <tr class="header">
            <th style="width:19%;">Supplier Name</th>
            <th style="width:16%;">Contact Sale</th>
            <th style="width:30%;">Address</th>
            <th style="width:19%;">Email</th>
            <th style="width:10%;">Phone</th>
            <th style="width:6%;"><center>Edit</center></th>
          </tr>
          <?php  
          include'../connection.php';
    // $sql = "SELECT m.menuID AS mID, m.menuName AS 'name', m.typeName AS 'type', FLOOR(MIN(ingredientStock/amount)) AS 'stock', m.menuPicture AS 'picture' FROM menu m, ingredient i, menuStock ms WHERE m.menuID = ms.menuID AND ms.ingredientID = i.ingredientID GROUP BY m.menuID";
          $sql = "SELECT * FROM supplier;" ;
          $result = mysqli_query($conn, $sql);
    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<tr><td>";
              echo $row[supplierName]."</td><td>".$row[contactSale]."</td><td>".$row[supplierAddress]." ".$row[sub_district]." ".$row[subdistrict]." ".$row[district]." ".$row[province]." ".$row[zip]."</td><td>";
              echo $row[supplierEmail]."</td><td>".$row[phoneNumber];
              echo '</td><td><center><a href="../welcome/?test=11&id='.$row['supplierID'].'" class="btn btn-primary" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center></td></td></tr>';
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


<?php
// $target_dir = "../img/";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// }
// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     $uploadOk = 0;
// }
// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }
?>

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


