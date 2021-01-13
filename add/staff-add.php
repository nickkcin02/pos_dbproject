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


	<link rel="stylesheet" type="text/css" href="../css/table.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">

	<title>Koffie House </title>
	<link rel="icon" type = "pic"href="../pic/icon.ico">
</head>
<body>
	<?php  
	include '../nav-bar.php';
	if (isset($_GET["id"])) {
		include '../connection.php';
		$sql = "SELECT * FROM staff WHERE staffID = '$_GET[id]'";
		$result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        // print_r( $row);
	}
	if (isset($_GET['id'])) { ?>
		<div align="center">
		<h2 style="margin-top: 20px; margin-bottom: 20px"><br>Edit Staff Personal Information</h2>
	</div> <?php
	} else {
	?>
	<div align="center">
		<h2 style="margin-top: 20px; margin-bottom: 20px"><br>Add New Staff Personal Information</h2>
	</div> <?php } ?>
	<div class="container-fluid" style="margin-top: 40px">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6"><hr>
				<?php
					if(isset($_GET['id'])) 
						echo '<form method="post" action="staff-request.php?id='.$_GET['id'].'">';
					else
						echo '<form method="post" action="staff-request.php">';
				?>
				<!-- <form method="post" action="staff-request.php"> -->
					<div class="form-row">
						<div class="form-group col-md-5">
							<label for="inputfName">First Name</label>
							<input type="text" class="form-control" id="inputfName" placeholder="Timothy" name="fname" value="<?php echo $row['staffName']; ?>" required>
						</div>
						<div class="form-group col-md-5">
							<label for="inputlName">Last Name</label>
							<input type="text" class="form-control" id="inputlName" placeholder="Jones" name="lname" value="<?php echo $row['lName']; ?>" required>
						</div>
						<div class="form-group col-md-2">
							<label for="inputGender">Gender</label>
							<select id="inputGender" class="btn btn-outline-primary dropdown-toggle" type="button" style="width: 100%" name="gender">
								<option value="M" <?php if($row[gender] == "M") echo "selected";?> >Male</option>
								<option value="F" <?php if($row[gender] == "F") echo "selected";?> >Female</option>
								<option value="NS" <?php if($row[gender] == "NS") echo "selected";?> >Not Specified</option>
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-7">
							<label for="inputEmail">Email</label>
							<input type="email" class="form-control" id="inputEmail" placeholder="admin@koffiehouse.cafe" name="email" value="<?php echo $row['staffEmail']; ?>" required>
						</div> 
						<div class="form-group col-md-5">
							<label for="inputPhone">Phone Number</label>
							<input type="tel" class="form-control" id="inputPhone" placeholder="0812345678" name="phone" value="<?php echo $row['staffPhone']; ?>" required>
						</div> 
					</div>
					<div class="form-row">
						<div class="form-group col-md-7">
							<label for="inputAddress">Address</label>
							<input type="text" class="form-control" id="inputAddress" placeholder="163 Rama 2 Road" name="add1" value="<?php echo $row['staffAddress']; ?>" required>
						</div>
						<div class="form-group col-md-5">
							<label for="inputCity">Subdistrict</label>
							<input type="text" class="form-control" id="inputCity" placeholder="Bangmod"  name="add2_5" value="<?php echo $row['subdistrict']; ?>" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputCity">District</label>
							<input type="text" class="form-control" id="inputCity" placeholder="Chomthong"  name="add2" value="<?php echo $row['district']; ?>" required>
						</div>
						<div class="form-group col-md-4">
							<label for="inputState">Province</label>
							<input type="text" class="form-control" id="inputState" placeholder="Bangkok"  name="add3" value="<?php echo $row['province']; ?>" required>
						</div>
						<div class="form-group col-md-2">
							<label for="inputZip">Zip</label>
							<input type="text" class="form-control" id="inputZip" placeholder="10140"  name="zip" value="<?php echo $row['zip']; ?>" required>
						</div>
						<div class="col-md-12"><hr></div>
						<div class="form-group col-md-12" align="center">
							<label for="position">Position</label><br>
							<center>
								<select id="inputPosition" class="btn btn-outline-primary dropdown-toggle" type="button" style="width: 250px" name="position">
									<option value="Manager" <?php if($row[staffPosition] == "Manager") echo "selected";?>  >Manager</option>
									<option value="Storage Manager" <?php if($row[staffPosition] == "Storage Manager") echo "selected";?>> Storage Manager</option>
									<option value="Cashier" <?php if($row[staffPosition] == "Cashier") echo "selected";?>>Cashier</option>
									<option value="Waiter" <?php if($row[staffPosition] == "Waiter") echo "selected";?>>Waiter</option>
								</select>
							</center>
							<hr>
						</div>
					</div>
					<?php if (isset($_GET['id'])) { ?>
						<center><button type="submit" class="btn btn-success btn-lg" style="margin-bottom: 50px">Apply Changes</button></center>
					<?php } else { ?>
					<center><button type="submit" class="btn btn-success btn-lg" style="margin-bottom: 50px">Add Staff</button></center>
				<?php } ?>
				</form> 
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>
	

	<!-- <script src="../snowball.js"></script> -->
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>























