<?php
include'../connection.php';
$orderID = $_GET['orderid'];
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6" style="margin-top: 20px; margin-bottom: 30px">
      <center><h2><br>Bill for Order ID <?php echo $_GET['orderid']?></h2></center>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
      <table id="myTable">
        <tr class="header">
          <th style="width:45%;" class="table-bordered">Name</th>
          <th style="width:10%;" class="table-bordered">Amount</th>
          <th style="width:15%;">Price</th>
          <th style="width:15%;"></th>
          <th style="width:15%;" class="table-bordered">Subtotal</th>

        </tr>
        <?php  
        $sql = "SELECT orderID, SUM(price_dis*amount) AS total FROM `order_paid` WHERE orderID = '$orderID' GROUP BY orderID;";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
          $sum = $row["total"];
        }
        $sql = "SELECT menuOrderID, menuName, size, price, amount, price_dis, promotionName FROM order_paid WHERE orderID = '$orderID' ORDER BY menuOrderID, menuID;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $menuOrderID = 1;
          while($row = mysqli_fetch_assoc($result)) {
            if ($menuOrderID != $row["menuOrderID"]) {
              $menuOrderID = $row["menuOrderID"];
              echo "<tr bgcolor='#f1f1f1'><td></td><td></td><td></td><td></td><td></td></tr>";
            }
            echo "<tr>";
            echo '<td class="table-bordered"> ';
            if ($row["size"] == 'NA') {
              echo ' ' . $row["menuName"]. "</td><td class='table-bordered'> ";
            }
            else{
              echo ' ' . $row["menuName"]. " (".$row["size"].")</td><td class='table-bordered'>";
            }
            echo $row["amount"]."</td><td>";
            if ($row["price_dis"] != $row["price"] ){
              echo "<font style='text-decoration: line-through; color: #ff0000'>".$row["price"]."</font></td><td>".'<a href="#" data-rel="popover" title="! Promotion !" data-content="'.$row["promotionName"].'" data-html="true"><b style="color: #00af00">'.number_format($row["price_dis"],2).'</b></a></td>';
            }
            else{
              echo $row["price"]."</td><td></td>";
            }
            echo "<td class='table-bordered'>" .number_format($row["amount"]*$row["price_dis"],2). "</td> ";
            echo "</tr>";
          }
        } 
// echo '<td> <input type="number" class="form-control" value=0 id="'. $row["mID"].'" name="'. $row["mID"].'" min="0" max="'. $row["stock"].'"> </td>';
        ?>
      </table>
      
    </form>
  </div>
  <div class="col-sm-3"></div>
</div>
</div>


<div class="container-fluid">
  <?php if (!isset($_GET["paid"])) { ?>
    <form method="post" action="../submit-form/each-order-submit.php?order=<?php echo $orderID; ?>">
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <div class="form-group" align="center">
            <br>
            <label for="role">Please choose available promotion to apply</label><br>
            <select class="btn btn-outline-success dropdown-toggle" type="button" name="discount" id="discount" onchange="update()">
              <option value="0">Choose Available Discount</option>
              <?php
              $sql = "SELECT orderTime FROM `foodOrder` WHERE orderID = '$orderID';";
              $discountMethod = array();
              $result = mysqli_query($conn, $sql);
              if ($row = mysqli_fetch_assoc($result)) {
                $time = $row["orderTime"];
              }
              $sql = "SELECT discountID, discountName, method, amount FROM discount WHERE '$sum' >= totalPrice AND '$time' >= startTime AND '$time' <= endTime;";
              echo $sql;
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='".$row["discountID"]."'>".$row["discountName"]."</option>";
                  $discountMethod += [$row["discountID"] => array($row["method"],$row["amount"])];
                }
              }
              mysqli_close($conn);
              ?>
            </select>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-6"  style="margin-top: 10px" id="displaytotal">
              <h3 align="left">Total</h3>
            </div>
            <div class="col-sm-6">
              <h1 id="total" align="right"><?php echo number_format($sum,2);?></h1>
            </div>
          </div>
          <hr>
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"></div>
        <div class="col-sm-6 " align="center">
          <button type="button" id="sub-button" class="btn btn-danger btn-lg" onclick="checkBill(<?php echo $orderID; ?>)" style="width: 200px; margin-bottom: 50px">Paid</button>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </form>
    <?php 
  } else { 
    echo '<div class="row">';
    echo '<div class="col-sm-3"></div>';
    echo '<div class="col-sm-6" style="margin-bottom: 50px">';
    $sql = "SELECT discountName, method, amount FROM foodOrder LEFT JOIN discount ON foodOrder.discountID = discount.discountID WHERE orderID = '$orderID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["discountName"] != NULL) {
      if ($row["method"] == "%") {
        echo '<hr><div class="row"><div class="col-sm-6"  style="margin-top: 10px" id="displaytotal"><h3 align="left">Subtotal</h3></div><div class="col-sm-6"><h1 id="total" align="right">'.number_format($sum,2).'</h1></div></div><hr>';
        echo '<div class="row"><div class="col-sm-6"  style="margin-top: 15px" id="displaytotal"><h3 align="left">Net Total</h3></div><div class="col-sm-6"><h1 style="margin-top: 10px;" align="right" ><a href="#" data-rel="popover" title="Discount" data-content="'.$row["discountName"].'" data-html="true"><b style="color: #00af00">'.number_format($sum*((100-$row["amount"])/100),2).'</b></a></h1></div></div><hr>';
      }
      else{
        echo '<hr><div class="row"><div class="col-sm-6"  style="margin-top: 10px" id="displaytotal"><h3 align="left">Subtotal</h3></div><div class="col-sm-6"><h1 id="total" align="right">'.number_format($sum,2).'</h1></div></div><hr>';
        echo '<div class="row"><div class="col-sm-6"  style="margin-top: 15px" id="displaytotal"><h3 align="left">Net Total</h3></div><div class="col-sm-6"><h1 style="margin-top: 10px;" align="right" ><a href="#" data-rel="popover" title="Discount" data-content="'.$row["discountName"].'" data-html="true"><b style="color: #00af00">'.number_format($sum-$row["amount"],2).'</b></a></h1></div></div><hr>';
      }
    }
    else {
      echo '<hr><div class="row"><div class="col-sm-6"  style="margin-top: 10px" id="displaytotal"><h3 align="left">Net Total</h3></div><div class="col-sm-6"><h1 id="total" align="right">'.number_format($sum,2).'</h1></div></div><hr>';
    }
    echo "<center><button onclick='history.go(-1)' class='btn btn-info'>Back</button></center></div>";
    echo '<div class="col-sm-3"></div>';
    echo '</div>';
  }  
  ?>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>

  function checkBill(orderID){
    console.log("hello");
    var discount = document.getElementById("discount").value
    swal({
     title: "Paid #"+orderID,
     text: "Confirm Payment?",
     icon: "info",
     buttons: true,
     dangerMode: false,
   }).then((resp) => {
    if (resp) {
      console.log("hello");
      $.ajax({
        url : "../ajax/each-order-submit.php",
        type: "post",
        data :{
          order:orderID,
          discount:discount
        },
        success: function(resp){
          var data = JSON.parse(resp)
          console.log(data);
          if(data[0] == 1){
            swal('','Payment Confirmed. Thank You!','success').then((value) => {
              window.location = '../welcome/?test=9'
            })
          }else{
            swal('',data[1],'error')
          }
        }
      })
    }
  })
 }



 $(document).ready(function(){
  $('[data-rel=popover]').popover({
    html: true,
    trigger: "hover"
  });
});


 function update(){
  const discountMethod = <?php echo json_encode($discountMethod) ?>;
  const total = <?php echo json_encode($sum) ?>;
  var data = document.getElementById("discount").value
  var value = discountMethod[data];
  //console.log(value[0]);
  if(data == "0"){
   document.getElementById("total").innerHTML = formatCurrency((total*2/2).toFixed(2));
   document.getElementById("total").style.color = "#000000";
   document.getElementById("displaytotal").innerHTML = "<h3 align='left'>Total</h3>";
 }
 else if(value[0] == '%'){
  document.getElementById("total").innerHTML = formatCurrency(((100-value[1])*total/100).toFixed(2));
  document.getElementById("total").style.color = "#00af00";
  document.getElementById("displaytotal").innerHTML = "<h3 align='left'>Deducted Total</h3><p align='left'>" + (value[1]*total/100) + " Baht Deducted</p>";
}
else{
  document.getElementById("total").innerHTML = formatCurrency((total-value[1]).toFixed(2));
  document.getElementById("total").style.color = "#00af00";
  document.getElementById("displaytotal").innerHTML = "<h3 align='left'>Deducted Total</h3><p align='left'>" + value[1] + " Baht Deducted</p>";
}

}

function formatCurrency(number) {
  number = parseFloat(number);
  return number.toFixed(2).replace(/./g, function(c, i, a) {
    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
  });
}




</script>


