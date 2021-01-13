<?php
require_once("connection.php");
$sql = "SELECT DISTINCT typeName FROM menu";
$result = mysqli_query($conn,$sql);
$ingred = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
		array_push($ingred, array($row['typeName']));
	}
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="../css/index.css">

	<title>Hello, world!</title>
</head>
<body>

	<?php  
	include 'nav-bar.php';
	?>
	<div align="center">
		<h2><br>New Menu</h2>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="margin-top: 20px" align="left">
				<form method="post" id="reserveinfo" action="menu-addcont.php"> 
					<div class="form-group">
						<label for="menuname"><b>Menu's Name</b></label>
						<input type="text" class="form-control" id="name" placeholder="Capellini Classic Carbonara" name="menu">
					</div>
					<div class="form-group" align="left">
						<label for="mtype"><b>Menu Type</b></label>
						<div class="dropdown" id="ddout" >
							<select class="btn btn-outline-primary dropdown-toggle" id="dd" type="button" data-toggle="dropdown" name="mtype">
								<script>
									var row = <?php echo(json_encode($ingred)); ?>;
									var i;
									for (i = 0; i <= row.length ;i++) {
										document.getElementById("dd").innerHTML += "<option value='" + row[i][0] + "'>" + row[i][0] + "</option>";
									}
								</script>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="ingredno"><b>Number of Ingredients Used in the menu</b></label>
						<input type="number" class="form-control" placeholder="How many ingredients used in making this menu?" name="ingredno">
					</div>
					

					<div class="form-group" style="margin-top: 10px" onsubmit="getvalue(isWalkin2)">
						<label for="sizes" style="margin-right: 20px"><b>Size Variety</b></label>
						<label for="sizes" class="checkbox">
							<input type="checkbox" id="sizes" name="s" value="1" style="margin-right: 5px">Small
						</label>
						<label for="sizes1" class="checkbox" style="margin-left: 30px">
							<input type="checkbox" id="sizes1" name="m" value="1" style="margin-right: 5px">Medium
						</label>
						<label for="sizes2" class="checkbox" style="margin-left: 30px">
							<input type="checkbox" id="sizes2" name="l" value="1" style="margin-right: 5px">Large
						</label>
						<label for="sizes3" class="checkbox" style="margin-left: 30px">
							<input type="checkbox" id="sizes3" name="na" value="1" style="margin-right: 5px">Only offer in one size
						</label>
					</div>
					<br>
					<div class="col-sm-12 " align="center">
						<a href="./menu-addcont.php"><button type="submit" class="btn btn-primary">Add Price and Ingredients</button></a>
					</div>
				</div>
			</form>
			<div class="col-sm-3"></div>
		</div>
	</div>

			<!-- <script type="text/javascript">
				function showsubmit () {
					var text = document.getElementById('name').value;
					alert(text);
					return false;
				}
			</script> -->


			<!-- <script src="../snowball.js"></script> -->
			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		</body>
		</html>

