
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-8" style="margin-top: 20px">
			<h2><br><i class="fa fa-cutlery fa-lg"></i> Menu Information</h2>
		</div>
		<div class="col-sm-2" style="margin-top: 20px" align="right">
			<a href="../welcome/?test=12"><button type="button" class="btn btn-success" style=" margin-top: 40px;"><i class="fa fa-plus"></i><b> Add New Menu</b></button></a>
		</div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1"></div>
		<div class="col-sm-8" style="margin-top: 20px">
			<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search menu...">
		</div>
		<div class="col-sm-2">
			<div class="form-group" style="margin-top: 20px" align="right">
				<label for="role">Search by:</label>
				<select class="btn btn-outline-primary dropdown-toggle" type="button" onchange="myFunction()" name="search" id="search">
					<option value="0">Name</option> 
					<option value="1">Type</option> 
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
					<th style="width:25%;">Name</th>
					<th style="width:15%;">Type</th>
					<th style="width:15%;">Price</th>
					<th style="width:25%;">Picture</th>
					<th style="width:20%;"><center>Edit / Delete</center></th>
				</tr>
				<?php  
				include'../connection.php';

				$sql = "SELECT ingredientID, ingredientStock FROM ingredient;";
				$result = mysqli_query($conn, $sql);
				$stock = array();
				$use = array();
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						$stock += [$row["ingredientID"] => $row["ingredientStock"]];
						$use +=  [$row["ingredientID"] => 0];
					}
				} 

		// $sql = "SELECT m.menuID AS ID, m.menuName AS name, m.typeName AS type, p.size AS size, p.price AS price FROM menu m ,price p WHERE m.menuID = p.menuID;" ;
				$sql = "SELECT * FROM menu_promotion";
				$result = mysqli_query($conn, $sql);


		// <input type="checkbox" id="'. $row["name"].'" name="'. $row["name"].'" value="'. $row["name"].'">
				$allIngre = array();
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo '<td> ';
						if ($row["size"] == 'NA') {
							echo ' ' . $row["name"]. "</td><td> " . $row["type"]. "</td><td> ";
						}
						else{
							echo ' ' . $row["name"]. " (".$row["size"].")</td><td> " . $row["type"]. "</td><td> ";
						}
						if ($row["promotion"] == NULL) {
							echo $row["price"];
						}
						else{
							echo '<a href="#" data-rel="popover" title="Promotion" data-content="'.$row["promotion"].'" data-html="true">';
							$price = $row["price"];
							if ($row["method"] == "Baht") {

								echo "<b style='color: #00af00'>".number_format($price - $row["amount"])."</b></a>";
							}
							else if ($row["method"] == "%") {
								echo "<b style='color: #00af00'>".number_format($price*(100 - $row["amount"])/100,2)."</b></a>";
							}{
							}
						}
						echo "</td><td> " . $row["menuPicture"];
						$picture = "<img src='".$row["pic"]."' width='250'>";
						echo '<a href="#" data-rel="popover" title="Picture" data-content="'.$picture.'" data-html="true" class="text-dark">Show Picture</a>';

						echo "</td> ";

						$param = $row["ID"].",'".$row["name"]."'";
						echo '<td><center><a href="../welcome/?test=12&id='.$row["ID"].'"><button type="button" class="btn btn-success" style="margin-right: 10px" >Edit</button></a><button type="button" class="btn btn-danger" onclick="deleteMenu('.$param.')">Delete</button></center></td>';
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




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>



	$(document).ready(function(){
		$('[data-rel=popover]').popover({
			html: true,
			trigger: "hover"
		});
	});



	function deleteMenu(id,name){
		console.log("hello");
		swal({
			title: "Delete "+name+"?",
			text: "Do you wish to remove "+name+" from menu list?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((resp) => {
			if (resp) {
				// console.log("hello");
				$.ajax({
					url : "../ajax/deleteMenu.php",
					type: "post",
					data :{
						id:id
					},
					success: function(resp){
						var data = JSON.parse(resp)
						console.log(data);
						if(data[0] == 1){
							swal('','Deleted from menu list','success').then((value) => {
								window.location = '../welcome/?test=15'
							})
						}else{
							swal('',data[1],'error')
						}
					}
				})
			}
		})
	}




	function update(){
		const allIngre = <?php echo json_encode($allIngre) ?>;
		var stock = <?php echo json_encode($stock) ?>;
		var use  = <?php echo json_encode($use) ?>;
	//const iterator = allIngre.keys();
	// console.log(allIngre);

	for (var key in allIngre) {
		var value = document.getElementById(key).value;
		if(value > 0){
			allIngre[key].forEach(element => {
				stock[element[0]] -= element[1]*value;
			});
		}
	}


	var disable = 0;
	for (var key in allIngre) {
		var min  = Math.floor(stock[allIngre[key][0][0]]/allIngre[key][0][1]);

		for (i = 1; i < allIngre[key].length; i++) { 
			var x = Math.floor(stock[allIngre[key][i][0]]/allIngre[key][i][1]);
			if(x < min){
				min = x
			}
		}
		if (min < 0) {
			min = 'Out of Stock';
			document.getElementById("dis"+key).style.color = "#ff0000";
			disable = 1;
				// document.getElementById("sub-button").disabled = true
			}
			else{
				document.getElementById("dis"+key).style.color = "#000000";
			}
			
			// console.log(key);
			document.getElementById("dis"+key).innerHTML = min;

		}
		if(disable == 1){
			document.getElementById("sub-button").disabled = true;
		// console.log("Disable");
	}
	else{
		document.getElementById("sub-button").disabled = false;
		// console.log("Enable");
	}

	

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


