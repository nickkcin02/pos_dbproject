<div class="container">
   


<div align="center">
     <br> <b><i class="fa fa-cutlery fa-lg"></i> DISHES</b>
    </div>
<table id="myTable">
  <tr class="header">
    <br>
    <th style="width:25%;">Name</th>
    <th style="width:20%;">Type</th>
    <th style="width:30%;">Recently bought</th>
    <th style="width:10%;">Amount</th>
  </tr>
  <?php  
    include'../connection.php';
    $sql = "SELECT m.menuName AS name, m.menuID AS menuID, mo.size AS size, SUM(mo.amount)AS amount, m.typeName AS typeName , MAX(fod.orderTime)AS lasttime
    FROM menu m , menuOrder mo , foodOrder fod
    WHERE fod.orderID = mo.orderID AND m.menuID = mo.menuID AND m.typeName IN ('From the Grill' ,'Pastas','Rice','Appetizers','Salads')
    GROUP BY mo.menuID 
    ORDER BY amount DESC ;" ;
    $result = mysqli_query($conn, $sql);
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);

    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
            echo '<td> ';
            if ($row["size"] == 'NA') {
              echo ' ' . $row["name"]. "</td><td> " . $row["typeName"]. "</td><td> "  . $row["lasttime"]. "</td><td> "  . $row["amount"]. "</td>";
            }
            else{
              echo ' ' . $row["name"]. " (".$row["size"].")</td><td> " . $row["typeName"]. "</td><td> "  . $row["lasttime"]. "</td><td> " . $row["amount"]. "</td>";
            }
            echo "</td>";
            echo "</tr>";
        }
    } 

    mysqli_close($conn);
  ?>
</table>


<div align="center">
     <br> <b><i class="fa fa-coffee fa-lg"></i> DRINKS</b>
    </div>
   <table id="myTable">
  <tr class="header">
    <br>
    <th style="width:25%;">Name</th>
    <th style="width:20%;">Type</th>
    <th style="width:30%;">Recently bought</th>
    <th style="width:10%;">Amount</th>
  </tr>
  <?php  
    include'../connection.php';
    // $sql = "SELECT m.menuID AS mID, m.menuName AS 'name', m.typeName AS 'type', FLOOR(MIN(ingredientStock/amount)) AS 'stock', m.menuPicture AS 'picture' FROM menu m, ingredient i, menuStock ms WHERE m.menuID = ms.menuID AND ms.ingredientID = i.ingredientID GROUP BY m.menuID";
    $sql = "SELECT m.menuName AS name, m.menuID AS menuID, mo.size AS size, SUM(mo.amount)AS amount, m.typeName AS typeName , MAX(fod.orderTime)AS lasttime
    FROM menu m , menuOrder mo , foodOrder fod
    WHERE fod.orderID = mo.orderID AND m.menuID = mo.menuID AND m.typeName IN ('Coffee' ,'Refreshing Drinks','Tea & Chocolate')
    GROUP BY mo.menuID 
    ORDER BY amount DESC ;" ;
    $result = mysqli_query($conn, $sql);


    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
            echo '<td> ';
            if ($row["size"] == 'NA') {
              echo ' ' . $row["name"]. "</td><td> " . $row["typeName"]. "</td><td> "  . $row["lasttime"]. "</td><td> "  . $row["amount"]. "</td>";
              //date('l', strtotime($row["lasttime"]))
            }
            else{
              echo ' ' . $row["name"]. " (".$row["size"].")</td><td> " . $row["typeName"]. "</td><td> "  . $row["lasttime"]. "</td><td> " . $row["amount"]. "</td>";
            }
            echo "</td>";
            echo "</tr>";
        }
    } 
    mysqli_close($conn);
  ?>

</table>

<div align="center">
     <br> <b><i class="fa fa-birthday-cake fa-lg"></i> DESSERTS</b>
    </div>
<table id="myTable">
  <tr class="header">
    <br>
    <th style="width:25%;">Name</th>
    <th style="width:20%;">Type</th>
    <th style="width:30%;">Recently bought</th>
    <th style="width:10%;">Amount</th>
  </tr>
  <?php  
    include'../connection.php';
    $sql = "SELECT m.menuName AS name, m.menuID AS menuID, mo.size AS size, SUM(mo.amount)AS amount, m.typeName AS typeName , MAX(fod.orderTime)AS lasttime
    FROM menu m , menuOrder mo , foodOrder fod
    WHERE fod.orderID = mo.orderID AND m.menuID = mo.menuID AND m.typeName IN ('Cakes' ,'Donuts from France','Layer Cakes from France','Viennoiseries from France')
    GROUP BY mo.menuID 
    ORDER BY amount DESC ;" ;
    $result = mysqli_query($conn, $sql);


    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
            echo '<td> ';
            if ($row["size"] == 'NA') {
              echo ' ' . $row["name"]. "</td><td> " . $row["typeName"]. "</td><td> "  . $row["lasttime"]. "</td><td> "  . $row["amount"]. "</td>";
            }
            else{
              echo ' ' . $row["name"]. " (".$row["size"].")</td><td> " . $row["typeName"]. "</td><td> "  . $row["lasttime"]. "</td><td> " . $row["amount"]. "</td>";
            }
            echo "</td>";
            echo "</tr>";
        }
    } 

    mysqli_close($conn);
  ?>

</table>

<div align="center">
     <br> <b><i class="fa fa-line-chart fa-lg"></i> Statistic by Date</b>
    </div>
   <table id="myTable">
  <tr class="header">
    <br>
    <th style="width:20%;">Date</th>
    <th style="width:10%;">Orders</th>
    <th style="width:10%;">Menus</th>
    <th style="width:17%;">Total Sales</th>
    <th style="width:16%;">Income</th>
    <th style="width:16%;">Cost</th>
    <th style="width:10%;">Profit</th>
  </tr>
  <?php  
    include'../connection.php';
    //DAYNAME(DATE_FORMAT(fod.orderTime, '%Y-%m-%d'))

//***********************************************
    /*CREATE VIEW menucost
AS
SELECT m.menuID, menuName AS menu,SUM(i.ingredientCostPerUnit*ms.amount) AS costS,
SUM(i.ingredientCostPerUnit*ms.amount)*2 AS costM,
SUM(i.ingredientCostPerUnit*ms.amount)*3 AS costL
    FROM menu m , menustock ms, ingredient i
    WHERE m.menuID = ms.menuID AND ms.ingredientID = i.ingredientID
    GROUP BY menu
    ORDER By menuID*/
    /*CREATE VIEW promo_price AS
SELECT pr.menuID,pr.size,pr.price AS baseprice,
CASE
WHEN ph.promotionID IS NOT NULL AND CURRENT_DATE BETWEEN ph.startTime AND ph.endTime THEN 
CASE 
      WHEN p.method = 'Baht' THEN pr.price-p.amount
      WHEN p.method = '%' THEN pr.price*(100-p.amount)/100
END
ELSE pr.price
END AS price,p.promotionName
FROM price pr LEFT JOIN promotionhistory ph ON pr.menuID = ph.menuID AND pr.size = ph.size LEFT JOIN promotion p ON p.promotionID = ph.promotionID AND CURRENT_DATE BETWEEN ph.startTime AND ph.endTime, menu m
WHERE  m.menuID = pr.menuID*/

//**************************************************
    $sql = "
    SELECT DATE_FORMAT(fod.orderTime, '%Y-%m-%d') AS name , SUM(mo.amount) AS amount, SUM(mo.amount*mc.cost) AS cost,
    COUNT(DISTINCT mo.menuID) AS menucount,COUNT(DISTINCT fod.orderID) AS ordercount ,  
    SUM(CASE 
      WHEN dc.method = 'Baht' THEN mo.amount*(pr.price-dc.amount)
      WHEN dc.method = '%' THEN mo.amount*(pr.price*(100-dc.amount)/100)
      ELSE mo.amount*pr.price
    END)AS income
    FROM menu m , menuOrder mo  , promo_price pr ,cost_per_menu mc, foodOrder fod LEFT JOIN discount dc ON dc.discountID = fod.discountID
    WHERE fod.orderID = mo.orderID AND m.menuID = mo.menuID AND (mo.menuID,mo.size) = (pr.menuID,pr.size) AND (mo.menuID,mo.size) = (mc.menuID,mc.size)
    GROUP BY name
    ORDER BY name DESC
    ";
    $result = mysqli_query($conn, $sql);


// CREATE VIEW cost_per_menu AS (SELECT p.menuID, p.size, SUM(IF(p.size = "M",2*ms.amount*i.ingredientCostPerUnit,IF(p.size ="L",3*ms.amount*i.ingredientCostPerUnit,ms.amount*i.ingredientCostPerUnit))) AS cost FROM price p, ingredient i, menu m, menuStock ms WHERE p.menuID = m.menuID AND ms.menuID = p.menuID AND ms.ingredientID = i.ingredientID GROUP BY p.menuID,p.size)


    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">
$linedata = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          //$piedata += [$row["name"]=>$row["income"]];
          array_push($linedata, array($row["name"],$row["income"],$row["cost"],$row["income"]-$row["cost"]));
              echo "<tr>";
              echo '<td> ';
              echo ' ' . $row["name"]. "</td><td> " . $row["ordercount"]. "</td><td> " . $row["menucount"]. "</td><td> " .$row["amount"]. "</td><td> " . $row["income"]. "</td><td> " . number_format($row["cost"],2). "</td><td> " . number_format($row["income"]-$row["cost"],2). "</td>";
              //date('l', strtotime($row["lasttime"]))

            echo "</td>";
            echo "</tr>";
        }
         array_push($linedata, array('F','a','b','c'));
    } 
    mysqli_close($conn);
  ?>
</table>
<div id="linechart" align ="center"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);
var data = <?php echo json_encode($linedata)?> ;
console.log(data);
var array = Object.values(data);
console.log(array);
array = array.reverse();
console.log(array);
var arrint2 = array.map(function(e){ 
    return [e[0],Number(e[1]),Number(e[2]),Number(e[3])] 
});
 arrint2[0][1] = "income";
 arrint2[0][2] = "cost";
 arrint2[0][3] = "profit";
// Draw the chart and set the chart values
function drawBasic() {
  var data = google.visualization.arrayToDataTable(arrint2);
console.log(data);
  // Optional; add a title and set the width and height of the chart
 var options = {
        hAxis: {
          title: 'Date'
        },
        vAxis: {
          title: 'Thai Baht'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('linechart'));

      chart.draw(data, options);
}
</script>

<div align="center">
     <br> <b><i class="fa fa-line-chart fa-lg"></i> Statistic Piechart</b>
    </div>
   <table id="myTable">
  <?php  
    include'../connection.php';
    
    $sql = "
    SELECT DAYNAME(DATE_FORMAT(fod.orderTime, '%Y-%m-%d')) AS name , SUM(mo.amount) AS amount, SUM(mo.amount*mc.cost) AS cost,
    COUNT(DISTINCT mo.menuID) AS menucount,COUNT(DISTINCT fod.orderID) AS ordercount ,  
    SUM(CASE 
      WHEN dc.method = 'Baht' THEN mo.amount*(pr.price-dc.amount)
      WHEN dc.method = '%' THEN mo.amount*(pr.price*(100-dc.amount)/100)
      ELSE mo.amount*pr.price
    END)AS income
    FROM menu m , menuOrder mo  , promo_price pr ,cost_per_menu mc, foodOrder fod LEFT JOIN discount dc ON dc.discountID = fod.discountID
    WHERE fod.orderID = mo.orderID AND m.menuID = mo.menuID AND (mo.menuID,mo.size) = (pr.menuID,pr.size) AND (mo.menuID,mo.size) = (mc.menuID,mc.size)
    GROUP BY name
    ORDER BY name DESC
    ";
    $result = mysqli_query($conn, $sql);


// CREATE VIEW cost_per_menu AS (SELECT p.menuID, p.size, SUM(IF(p.size = "M",2*ms.amount*i.ingredientCostPerUnit,IF(p.size ="L",3*ms.amount*i.ingredientCostPerUnit,ms.amount*i.ingredientCostPerUnit))) AS cost FROM price p, ingredient i, menu m, menuStock ms WHERE p.menuID = m.menuID AND ms.menuID = p.menuID AND ms.ingredientID = i.ingredientID GROUP BY p.menuID,p.size)


    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">
$piedata = array(array('b','a'));
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          //$piedata += [$row["name"]=>$row["income"]];
          array_push($piedata, array($row["name"],$row["income"]));
            //   echo "<tr>";
            //   echo '<td> ';
            //   echo ' ' . $row["name"]. "</td><td> " . $row["ordercount"]. "</td><td> " . $row["menucount"]. "</td><td> " .$row["amount"]. "</td><td> " . $row["income"]. "</td><td> " . number_format($row["cost"],2). "</td><td> " . number_format($row["income"]-$row["cost"],2). "</td>";
            //   //date('l', strtotime($row["lasttime"]))

            // echo "</td>";
            // echo "</tr>";
        }
    } 
    mysqli_close($conn);
  ?>

<!DOCTYPE html>
<html lang="en-US">
<body>
<div id="piechart" align ="center"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
var data = <?php echo json_encode($piedata)?> ;
//console.log(data);
var array = Object.values(data);
//console.log(array);
var arrint = array.map(function(e){ 
    return [e[0],Number(e[1])] 
});
 arrint[0][1] = "Value";
// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable(arrint);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Day of week', 'width':600, 'height':440,'is3D': true};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

</body>
</html>

</table>

<div align="center">
     <br> <b><i class="fa fa-file-text-o fa-lg"></i> Order</b>
    </div>
   <table id="myTable">
  <tr class="header">
    <br>
    <th style="width:20%;">Date</th>
    <th style="width:30%;">Menu</th>
    <th style="width:10%;">Size</th>
    <th style="width:10%;">Quantity</th>
    <th style="width:10%;">Price</th>
    <th style="width:10%;">Cost</th>
    <th style="width:10%;">Profit</th>
  </tr>
  <?php  
    include'../connection.php';
    //DAYNAME(DATE_FORMAT(fod.orderTime, '%Y-%m-%d'))

//***********************************************
    /*CREATE VIEW menucost
AS
SELECT m.menuID, menuName AS menu,SUM(i.ingredientCostPerUnit*ms.amount) AS costS,
SUM(i.ingredientCostPerUnit*ms.amount)*2 AS costM,
SUM(i.ingredientCostPerUnit*ms.amount)*3 AS costL
    FROM menu m , menustock ms, ingredient i
    WHERE m.menuID = ms.menuID AND ms.ingredientID = i.ingredientID
    GROUP BY menu
    ORDER By menuID*/

//**************************************************
    /*SELECT DISTINCT m.menuName,pr.price,p.promotionName
FROM promotion p, price pr LEFT JOIN promotionhistory ph ON pr.menuID = ph.menuID , menu m
WHERE CURRENT_DATE BETWEEN ph.startTime AND ph.endTime AND m.menuID = pr.menuID AND pr.menuID = ph.menuID AND ph.size = pr.size*/
    $sql = "
    SELECT fod.orderTime AS dates , mo.amount AS amount , m.menuname AS name,mo.size AS size,
    CASE 
      WHEN mo.size IN ('S','NA') THEN mc.costS*mo.amount
      WHEN mo.size = 'M'  THEN mc.costM*mo.amount
      WHEN mo.size = 'L'  THEN mc.costL*mo.amount 
    END AS cost,
    CASE 
      WHEN mo.size IN ('S','NA') THEN (pr.price-mc.costS)*mo.amount
      WHEN mo.size = 'M'  THEN (pr.price-mc.costM)*mo.amount
      WHEN mo.size = 'L'  THEN (pr.price-mc.costL)*mo.amount 
    END AS interest,
    CASE 
      WHEN dc.method = 'Baht' THEN mo.amount*(pr.price-dc.amount)
      WHEN dc.method = '%' THEN mo.amount*(pr.price*(100-dc.amount)/100)
      ELSE mo.amount*pr.price
    END AS income
    FROM menu m , menuOrder mo , foodOrder fod LEFT JOIN discount dc ON dc.discountID = fod.discountID ,menucost mc , promo_price pr 
    WHERE fod.orderID = mo.orderID AND m.menuID = mo.menuID AND (mo.menuID,mo.size) = (pr.menuID,pr.size) AND mo.menuID = mc.menuID
    ORDER BY dates DESC

    ";
    $result = mysqli_query($conn, $sql);


    // <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
            echo '<td> ';
           
              echo ' ' . $row["dates"]. "</td><td> " . $row["name"]. "</td><td> ". $row["size"]. "</td><td> ". $row["amount"]. "</td><td> "  . $row["income"]. "</td><td> " . round($row["cost"],2). "</td><td> ". round($row["interest"] ,2). "</td>";
              //date('l', strtotime($row["lasttime"]))
           
            echo "</td>";
            echo "</tr>";
        }
    } 
    mysqli_close($conn);
  ?>

</table>

<br><br><br>
</div>