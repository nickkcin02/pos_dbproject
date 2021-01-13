<?php
require_once("../connection.php");
$sql = "SELECT * FROM customerType";
$result = mysqli_query($conn,$sql);
$custype = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
		array_push($custype, array($row['customerTypeID'],$row['Name']));
	}
}
$sql = "SELECT * FROM table_available";
$result = mysqli_query($conn,$sql);
$tableid = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
		array_push($tableid, array($row['tableID'],$row['seats']));
		// echo $row['tableID']." ".$row['seats']." ";
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">

	<title>Koffie House </title>
	<link rel="icon" type = "pic"href="../pic/icon.ico">
</head>
<body>

	<?php  
	include '../nav-bar.php';
	?>
	<div align="center">
		<h2 style="margin-top: 20px; margin-bottom: 20px"><br>New Customer / Reservation</h2>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="margin-top: 20px" align="left"><hr>
				<form method="post" id="reserveinfo" action="reservation-request.php" onsubmit="return validate()"> 
					<div class="form-group">
						<label for="username"><b>Customer's Name</b></label>
						<input type="text" class="form-control" id="name" placeholder="William Jones" name="name" required>
					</div>
					<div class="form-group">
						<label for="seats"><b>Number of Seats</b></label>
						<input type="number" class="form-control" placeholder="How many people coming?" name="seats" min="1" max="4" id="seat" onchange="selectTable(this.value)" required>
						<script type="text/javascript">
							const s = {p: 0};
							let input = document.getElementById('seat');
							let timeout = null;
							input.addEventListener('keyup', function (e) {
								clearTimeout(timeout);
								timeout = setTimeout(function () {
									s.p = input.value;
								}, 400);
							});
						</script>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group" align="left">
								<label for="custype"><b>Customer Type</b></label>
								<div class="dropdown" id="ddout" >
									<select class="btn btn-outline-primary dropdown-toggle" id="dd" type="button" data-toggle="dropdown" name="cusType" style="width: 100%">
										<script>
											var row = <?php echo(json_encode($custype)); ?>;
											var i;
											for (i = 0; i <= row.length ;i++) {
												document.getElementById("dd").innerHTML += "<option value='" + row[i][0] + "'>" + row[i][1] + "</option>";
											}
										</script>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group" align="left">
								<label for="tableid"><b>Choose Table</b></label>
								<div class="dropdown" id="ddout" >
									<select class="btn btn-outline-primary dropdown-toggle" id="dd1" type="button" data-toggle="dropdown" name="tableid" style="width: 100%">
										<script>
											function selectTable(person){
												var row = <?php echo(json_encode($tableid)); ?>;
												var i;
												document.getElementById("dd1").innerHTML = "";
												for (i = 0; i < row.length ;i++) {
													if (person <= row[i][1]) 
														document.getElementById("dd1").innerHTML += "<option value='" + row[i][0] + "'>" + row[i][0] + "   (For "+ row[i][1] + " Person)</option>";
												}
											}
										</script>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-top: 10px" onsubmit="getvalue(isWalkin2)">
						<label for="isWalkin" style="margin-right: 20px"><b>Walk-in or Reservation?</b></label>
						<label for="isWalkin1" class="radio-inline">
							<input type="radio" id="isWalkin1" name="isWalkin" value="1" style="margin-right: 5px" onclick="hiddenbox(this.value)">Walk-in
						</label>
						<label for="isWalkin2" class="radio-inline" style="margin-left: 30px">
							<input type="radio" id="isWalkin2" name="isWalkin" value="0" style="margin-right: 5px" onclick="hiddenbox(this.value)">Reserve for a table
						</label>
						<hr>
					</div>
					<script type="text/javascript">
						$('#datepicker').datepicker({
							uiLibrary: 'bootstrap4'
						});

						$('#timepicker').timepicker({
							uiLibrary: 'bootstrap4'
						});
					</script>
					<div id="timehidden">
						<label for="reservedDate"><b>Reserved Date and Time</b><br></label>
						<div class="form-group" id='timeReserved' style="margin-top: 10px" >

							<div class="row">
								<div class="col-sm-6">
									<input id="datepicker" name="date" style="width: 100%" required>
								</div>
								<div class="col-sm-6">
									<input id="timepicker" name="time" style="width: 100%" required>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="col-sm-12 " align="center" style="margin-bottom: 50px">
						<button type="submit" class="btn btn-success btn-lg">Add new customer</button>
					</div>
				</form>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>


	<script type="text/javascript">
		$('#datepicker').datepicker({
			uiLibrary: 'bootstrap4'
		});

		$('#timepicker').timepicker({
			uiLibrary: 'bootstrap4'
		});



		$(function () {
			$('#datetimepicker1').datetimepicker();
		});

		function getValue (id) {
			var x = 1; 
			x = document.getElementById(id).value;
		}


		function validate(){
			var seat = document.getElementById("seat").value;
			var row = <?php echo(json_encode($tableid)); ?>;
			var i;
			var check = 0;
			for (i = 0; i < row.length ;i++) {

				if (seat <= row[i][1]) {
					// console.log(row[i][1]);
					check = 1;
				}
			}
			// alert("333");
			// return false;
			if (check == 0) {
				alert("Don't have Table");
				return false;
			}
			else{
				check = 1;
			}

		}


		var curday = function(sp){
			today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1;
			var yyyy = today.getFullYear();

			if(dd<10) dd='0'+dd;
			if(mm<10) mm='0'+mm;
			return (mm+sp+dd+sp+yyyy);
		};

		function hiddenbox(value){
			// console.log(time);
			if (value == 1) {
				document.getElementById("timehidden").style.visibility = "hidden";
				document.getElementById("datepicker").value = curday('/');
				document.getElementById("timepicker").value = '00:00';
			}
			else {
				// $.("#datepicker").disabled = false;
				// $.("#timepicker").disabled = false;
				document.getElementById("timehidden").style.visibility = "visible";
			}
			// console.log(document.getElementById("datepicker").value);
		}
	</script>



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

