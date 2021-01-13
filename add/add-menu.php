<?php 
$name = "";
$variety = 0;
$amountArr = array();
if (isset($_GET["id"])) {
  require_once("../connection.php");
  $sql = "SELECT menuName, typeName, menuPicture FROM menu WHERE '$_GET[id]' = menuID";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row["menuName"];
  $type = $row["typeName"];
  $pic = $row["menuPicture"];

  $sql = "SELECT ingredientID, amount FROM menuStock WHERE '$_GET[id]' = menuID";
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $amountArr += [$row["ingredientID"] => $row["amount"]];
    }
  } 

  $sql = "SELECT size, price FROM price WHERE '$_GET[id]' = menuID";
  $priceArr = array();
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $priceArr += [$row["size"] => $row["price"]];
    }
  } 
  if (!array_key_exists("NA",$priceArr))
    $variety = 1;

  // print_r($amountArr);
} ?>

<?php
if (isset($_GET['id'])) { ?>
  <div align="center">
  <h2 style="margin-top: 20px; margin-bottom: 20px"><br>Edit Menu</h2>
  </div> <?php
} else { ?>
  <div align="center">
  <h2 style="margin-top: 20px; margin-bottom: 20px"><br>Add New Menu</h2>
</div>
<?php } ?>
<div class="container-fluid" style="margin-top: 50px">
  <div class="row">
   <div class="col-sm-3"></div>
   <div class="col-sm-6"><hr>
    <form method="post" action="../add/add-menu-request.php<?php if (isset($_GET["id"])) echo "?id=".$_GET["id"]; ?>" enctype="multipart/form-data" onsubmit="return validate()">
      <div class="row">
        <div class="form-group col-sm-8">
          <label for="menuname"><b>Menu's Name</b></label>
          <input type="text" class="form-control" id="name" placeholder="Capellini Classic Carbonara" name="menu" value ="<?php echo $name;?>" required>
        </div>
        <div class="form-group col-sm-4" align="left">
          <label for="mtype"><b>Menu Type</b></label>
          <div class="dropdown" id="ddout">
            <select class="btn btn-outline-primary dropdown-toggle" id="dd" type="button" data-toggle="dropdown" name="mtype" style="width: 100%">
              <?php
              require_once("../connection.php");
              $sql = "SELECT DISTINCT typeName FROM menu";
              $result = mysqli_query($conn,$sql);
              $ingred = array();
              if (mysqli_num_rows($result) > 0) {
                while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                  array_push($ingred, array($row['typeName']));
                }
              }
              ?> 
              <script>
                var row = <?php echo(json_encode($ingred)); ?>;
                var type = <?php echo (json_encode($type)); ?>;
                var i;
                for (i = 0; i <= row.length ;i++) {
                  if(type == row[i][0] )
                    document.getElementById("dd").innerHTML += "<option value='" + row[i][0] + "' selected>" + row[i][0] + "</option>";
                  else
                    document.getElementById("dd").innerHTML += "<option value='" + row[i][0] + "'>" + row[i][0] + "</option>";
                }
              </script>
            </select>
          </div>
        </div>
        <div class="col-sm-12" style="margin-top: 10px; margin-bottom: 20px">
          <?php
          if (isset($_GET["id"])) {
            echo '<center><input type="checkbox" id="picture" name="pic" style="margin-right: 10px" value="1" onchange="hiddenbox(this.value)">';
            // echo '<img src="'.$pic.'">';
            $picScript = "<img src='".$pic."' width='250'>";
            echo '<a href="#" data-rel="popover" title="Picture" data-content="'.$picScript.'" data-html="true" class="text-dark"><b>Use Old Picture</b></a></center>';?>
            <div  id="addpic">
              <center><p style="margin-top: 20px"><b>Select picture for this menu</b></p></center>
              <div class="custom-file">
                <input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input">
                <label class="custom-file-label" for="fileToUpload">Choose file</label>
              </div>
              <hr style="margin-top: 40px; margin-bottom: 10px">
            </div>
          <?php }
          else{  ?>
            <div  id="addpic">
              <center><p style="margin-top: 20px"><b>Select picture for this menu</b></p></center>
              <div class="custom-file">
                <input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input">
                <label class="custom-file-label" for="fileToUpload">Choose file</label>
              </div>
              <hr style="margin-top: 40px; margin-bottom: 10px">
            </div>
            <div class="col-sm-12" align="center" style="margin-top: 30px">
              <input type="checkbox" id="haveSize" onchange="sizeInput('haveSize')" style="margin-right: 10px; margin-bottom: 20px" <?php if($variety == 1) echo "checked";
              ?> ><b>Have Size Variety</b>
            </div>
            <?php
            if($variety == 0){
              echo '<div class="col-sm-12" id="sizeHtml"><div class="row"><div class="col-sm-1" align="left" style="margin-top: 5px"><p><b>Price</b></p></div><div class="col-sm-11"><input type="number" min="0" class="form-control" id="price" name="price" required></div></div></div>';
            }
            else{
              echo '<div class="col-sm-12" id="sizeHtml"><div class="row"><div class="col-sm-3" align="left" style="margin-top: 5px"><p><b>Price for S</b></p></div><div class="col-sm-9"><input type="number" min="0" class="form-control" id="priceS" name="priceS" required></div><div class="col-sm-3" align="left" style="margin-top: 5px"><p><b>Price for M</b></p></div><div class="col-sm-9"><input type="number" min="0" class="form-control" id="priceM" name="priceM"></div><div class="col-sm-3" align="left" style="margin-top: 5px"><p><b>Price for L</b></p></div><div class="col-sm-9"><input type="number" min="0" class="form-control" id="priceL" name="priceL"></div></div></div>';
            }
            ?>
            <hr> 
          </div>
          <div class="col-sm-12" style="margin-top: -30px">
            <br><center><p><b>Add Ingredient for this Menu</b></p></center>
            <br><center><p class="text-secondary" style="margin-top: -35px">Check the box in front of the ingredient name to include in this menu.</p></center><br>
            <div class="row">
              <div class="col-sm-12" align="left" style="margin-bottom: 20px">
                <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Ingredient...">
              </div>
              <div class="col-sm-12">
                <table id="myTable" style="margin-top: -10px; margin-bottom: 30px" class="table-bordered table-striped">
                  <tr class="header">
                    <th style="width:10%;"><center><i class="fa fa-check" aria-hidden="true"></i></center></th>
                    <th style="width:60%;">Ingredient Name</th>
                    <th style="width:30%;"><center>Amount Used</center></th>
                  </tr>
                  <?php
                  include'../connection.php';

                  $sql = "SELECT ingredientID, ingredientName FROM ingredient;";
                  $result = mysqli_query($conn, $sql);
                  $ingredient  =  array();
                  if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                      if (array_key_exists($row["ingredientID"],$amountArr))
                      {
                        $amount = $amountArr[$row["ingredientID"]];
                        echo '<tr><td><center><input type="checkbox" onchange="updete('.$row[ingredientID].')" id="'.$row[ingredientID].'" name="'.$row[ingredientID].'" value="1" checked></center></td>';
                        echo '<td onclick="toggle('.$row[ingredientID].')">'.$row[ingredientName].'</td>';
                        echo '<td><input type="number" min="0" class="form-control" id="amount'.$row[ingredientID].'" name="amount'.$row[ingredientID].'"value="'.$amount.'"></td></tr>';
                      }
                      else{
                        echo '<tr><td><center><input type="checkbox" onchange="updete('.$row[ingredientID].')" id="'.$row[ingredientID].'" name="'.$row[ingredientID].'" value="1"></center></td>';
                        echo '<td onclick="toggle('.$row[ingredientID].')">'.$row[ingredientName].'</td>';
                        echo '<td><input type="number" min="0" class="form-control" id="amount'.$row[ingredientID].'" name="amount'.$row[ingredientID].'"></td></tr>';
                      }


                      array_push($ingredient, $row["ingredientID"]);
                    }
                  } 
                  ?>
                </table>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="col-sm-12" align="center" style="margin-top: 20px; margin-bottom: 50px">
          <button type="submit" class="btn btn-success btn-lg" style="width: 200px">Finish</button>
        </div>
      </form> 
    </div>
    <div class="col-sm-3"></div>
  </div>
</div>


<script>

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>




<script>

  function hiddenbox(value){
      // console.log(time);

      if (document.getElementById("picture").checked == true) {

        document.getElementById("addpic").value = "0";
        document.getElementById("addpic").style.visibility = "hidden";
      }
      else {
        // $.("#datepicker").disabled = false;
        // $.("#timepicker").disabled = false;
        document.getElementById("addpic").value = "";
        document.getElementById("addpic").style.visibility = "visible";
      }
      // console.log(document.getElementById("datepicker").value);
    }



    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


  $(document).ready(function(){
    $('[data-rel=popover]').popover({
      html: true,
      trigger: "hover"
    });
  });

  function validate(){
    var ingredient = <?php echo(json_encode($ingredient)); ?>;
    var valid = false;
      // console.log(ingredient);
      for (var i = ingredient.length - 1; i >= 0; i--) {
        console.log(document.getElementById(ingredient[i]).value);
        if(document.getElementById(ingredient[i]).checked){
          valid = true;
        }
      }
      
      if (!valid) {
        alert("Must select at least 1 ingredient");
        return false;
      }
    }


    function toggle(id){
      // console.log(document.getElementById(id).checked);
      if(document.getElementById(id).checked == true){
        document.getElementById(id).checked = false;
      }
      else{
        document.getElementById(id).checked = true;
      }
      document.getElementById("amount"+id).required =  document.getElementById(id).checked;
    };

    function sizeInput(id){
      if(document.getElementById(id).checked == false){
        document.getElementById("sizeHtml").innerHTML = '<div class="col-sm-12" id="sizeHtml"><div class="row"><div class="col-sm-1" align="left" style="margin-top: 5px"><p><b>Price</b></p></div><div class="col-sm-11"><input type="number" min="0" class="form-control" id="price" name="price" required></div></div></div>';
      }
      else{
        document.getElementById("sizeHtml").innerHTML = '<div class="col-sm-12" id="sizeHtml"><div class="row"><div class="col-sm-3" align="left" style="margin-top: 5px"><p><b>Price for S</b></p></div><div class="col-sm-9"><input type="number" min="0" class="form-control" id="priceS" name="priceS" required></div><div class="col-sm-3" align="left" style="margin-top: 5px"><p><b>Price for M</b></p></div><div class="col-sm-9"><input type="number" min="0" class="form-control" id="priceM" name="priceM"></div><div class="col-sm-3" align="left" style="margin-top: 5px"><p><b>Price for L</b></p></div><div class="col-sm-9"><input type="number" min="0" class="form-control" id="priceL" name="priceL"></div></div></div>';
      }
    };

    function updete(id){
      document.getElementById("amount"+id).required =  document.getElementById(id).checked;
    };

    function sortTable() {
     var table, rows, switching, i, x, y, shouldSwitch;
     table = document.getElementById("myTable");
     switching = true;
     /* Make a loop that will continue until
     no switching has been done: */
     while (switching) {
       // Start by saying: no switching is done:
       switching = false;
       rows = table.rows;
       /* Loop through all table rows (except the
       first, which contains table headers): */
       for (i = 1; i < (rows.length - 1); i++) {
         // Start by saying there should be no switching:
         shouldSwitch = false;
         /* Get the two elements you want to compare,
         one from current row and one from the next: */
         // Check if the two rows should switch place:
         if (document.getElementById(i).checked == false && document.getElementById(i+1).checked == true) {
           // If so, mark as a switch and break the loop:
           shouldSwitch = true;
           break;
         }
       }
       if (shouldSwitch) {
         /* If a switch has been marked, make the switch
         and mark that a switch has been done: */
         rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
         switching = true;
       }
     }
   }
   function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue ,col;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

