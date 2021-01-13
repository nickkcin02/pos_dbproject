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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<link rel="stylesheet" type="text/css" href="../css/table.css">
	<title>Koffie House </title>
	<link rel="icon" type = "pic"href="../pic/icon.ico">
</head>
<body>

	<?php  
	include '../nav-bar.php';
	?>
	<div align="center">
		<h2 style="margin-top: 20px; margin-bottom: 20px"><br>Add New Discount</h2>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="margin-top: 20px" align="left"><hr>
				<form method="post" action="add-discount-request.php" onsubmit="return validate()"> 
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="username"><b>Discount Name</b></label>
							<input type="text" class="form-control" id="name" placeholder="Discount 100% For Uncle Tu" name="name" required>
						</div>
						<div class="form-group col-sm-4">
							<label for="username"><b>Total Price</b></label>
							<input type="text" class="form-control" id="total" name="total" onchange="typeChange()" required>
						</div>
						<div class="form-group col-sm-4" id="amount">
							<label for="username"><b>Discount Amount</b></label>
							<input type="number" class="form-control" min="0" id="amountInput" name="amountInput" onchange="warnAmount()" required>
							<small id="amounthelp" class="form-text text-muted"><br><br></small>
						</div>
						<div class="col-sm-4">
							<label for="type"><b>Discount Method</b></label>
							<select class="btn btn-outline-primary dropdown-toggle" id="type" type="button" data-toggle="dropdown" name="type" onchange="typeChange()" style="width: 100%">
								<option value="Baht">Baht</option>
								<option value="%">Percent</option>
							</select>
						</div>
						<div id="timehidden" class="col-sm-12" style="margin-top: -40px">
							<hr>
							<label for="reservedDate" onclick="validate()"><b>Valid Through:</b><br></label>
							<div class="row" id='timeReserved'>
								<div class="col-sm-6">
								<div class="form-group">
									<input id="start" name="start" placeholder="Start Date" style="width: 100%" required>
									<small id="startHelp" class="form-text text-muted"></small>
								</div>
								</div>
								<script>
									$('#start').datepicker({
										uiLibrary: 'bootstrap4'
									});
								</script>
								<div class="col-sm-6">
								<div class="form-group">
									<input id="end" name="end" placeholder="End Date" style="width: 100%" required>
									<small id="endhelp" class="form-text text-muted"></small>
								</div>
								</div>
								<script>
									$('#end').datepicker({
										uiLibrary: 'bootstrap4'
									});
								</script>
							</div>
						</div>
					</div>
					<br>
					<div class="col-sm-12 " align="center">
						<button type="submit" class="btn btn-success btn-lg">Add New Discount</button>
					</div>
				</div>
			</form>
			<div class="col-sm-3"></div>
		</div>
	</div>


	<script type="text/javascript">
		$(function () {
			$('#datetimepicker1').datetimepicker();
		});


		function validate(){
			var start = document.getElementById("start").value;
			var end = document.getElementById("end").value;
			console.log(start);
			console.log(end);
			console.log(start > end);
			if (start > end) {
				alert("End date must after start date");
				return false;
			}
		}

		function typeChange () {
			var type = document.getElementById("type").value;
			var total = document.getElementById("total").value;
			if (type == "Baht") {
				document.getElementById("amount").innerHTML = '<label for="username"><b>Discount Amount</b></label><input type="number" class="form-control" min="0" max="'+total+'"id="amountInput" name="amountInput" onchange="warnAmount()" required><small id="amounthelp" class="form-text text-muted"><br><br></small>';
			}
			else{
				document.getElementById("amount").innerHTML = '<label for="username"><b>Discount Amount</b></label><input type="number" class="form-control" min="0" max="100" id="amountInput" name="amountInput" onchange="warnAmount()" required><small id="amounthelp" class="form-text text-muted"><br><br></small>';
			}
		}
		function warnAmount(){
			var type = document.getElementById("type").value;
			var amount = document.getElementById("amountInput").value;
			console.log(type);
			if (type=="%" && amount >= 90) {
				document.getElementById("amounthelp").innerHTML = "<font style='color: #EFA405;'>You have discount more than 90%</font>";
			}
			else{
				document.getElementById("amounthelp").innerHTML = "<br><br>";
			}
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

