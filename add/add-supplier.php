<?php
if (isset($_GET["id"])) {
	include '../connection.php';
	$sql = "SELECT * FROM supplier WHERE supplierID = '$_GET[id]'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
    // print_r( $row);
}
if (isset($_GET["id"])) { ?>
	<div align="center">
		<h2 style="margin-top: 20px; margin-bottom: 20px"><br>Edit Supplier Information</h2>
	</div> <?php
} else { ?>
	<div align="center">
		<h2 style="margin-top: 20px; margin-bottom: 20px"><br>Add New Supplier Information</h2>
	</div> <?php } ?>
	<div class="container-fluid" style="margin-top: 40px">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6"><hr>
						<?php
			if(isset($_GET['id'])) //edit
			echo '<form method="post" action="../add/add-supplier-request.php?id='.$_GET['id'].'">';
			else
				echo '<form method="post" action="../add/add-supplier-request.php">';
			?>
			<div class="form-row">
				<div class="form-group col-md-7">
					<label for="inputName"><i class="fa fa-id-card-o"></i> Supplier Name</label>
					<input type="text" class="form-control" name="inputName" required placeholder="Asian Seafood Co., Ltd." value="<?php echo $row['supplierName']; ?>">
				</div>
				<div class="form-group col-md-5">
					<label for="inputSale"><i class="fa fa-id-badge"></i> Contact Sale</label>
					<input type="text" class="form-control" name="inputSale" required placeholder="John wick" value="<?php echo $row['contactSale']; ?>">
				</div>

			</div>
			<div class="form-row">
				<div class="form-group col-md-7">
					<label for="inputEmail"><i class="fa fa-address-book-o"></i> Email</label>
					<input type="email" class="form-control" name="inputEmail" placeholder="john@asianfood.com" required value="<?php echo $row['supplierEmail']; ?>">
				</div> 
				<div class="form-group col-md-5">
					<label for="inputPhone"><i class="fa fa-phone"></i> Phone Number</label>
					<input type="tel" class="form-control" name="inputPhone" required placeholder="0812345678" value="<?php echo $row['phoneNumber']; ?>">
				</div> 
			</div>
			<div class="form-row">
				<div class="form-group col-sm-7">
					<label for="inputAddress"><i class="fa fa-book"></i> Address</label>
					<input type="text" class="form-control" name="inputAddress" placeholder="1234 Main St Apartment, studio, or floor" required value="<?php echo $row['supplierAddress']; ?>">
				</div>
				<div class="form-group col-md-5">
					<label for="inputDistrict">Subdistrict</label>
					<input type="text" class="form-control" name="inputSubdistrict" placeholder="Bangmod" required value="<?php echo $row['subdistrict']; ?>">
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputDistrict">District</label>
					<input type="text" class="form-control" name="inputDistrict" placeholder="Chomthong" required value="<?php echo $row['district']; ?>">
				</div>
				<div class="form-group col-md-4">
					<label for="inputProvince">Province</label>
					<input type="text" class="form-control" name="inputProvince" placeholder="Bangkok" required value="<?php echo $row['province']; ?>">
				</div>
				<div class="form-group col-md-2">
					<label for="inputZip">Zip Code</label>
					<input type="text" class="form-control" name="inputZip" placeholder="10140" required value="<?php echo $row['zip']; ?>">
				</div>
			</div>
			<hr style="margin-bottom: 40px">
			<center><input type="checkbox" id="addIngredient" name="addIngredients" onchange="addChange()" checked value="1" style="margin-right: 10px"><label for="addingredient"><b>Add Ingredient bought from this Supplier</b></label><br></center><center><p class="text-secondary">Click "Add More" if you will purchase more than one ingredient from this supplier.</p></center><br>
			<table id="myTable" class="table-striped table-bordered" style="margin-bottom: 20px">
				<tr class="header">
					<th style="width:50%;">Ingdient Name</th>
					<th style="width:30%;">Cost Per Unit</th>
					<th style="width:20%;"><center><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></center></th>
				</tr>
				<tr><td><input type="text" class="form-control" id="name" name="name[]" required></td>
					<td><input type="number" min="0" class="form-control" id="cost" name="cost[]" required></td>
					<td></td></tr>


				</table>
				<?php if (isset($_GET["id"])) { ?>
					<div class="row">
					<div class="col-sm-12" align="center" style="margin-bottom: 50px; margin-top: 20px">
						<button type="submit" class="btn btn-success btn-lg" style="width: 250px">Apply Changes</button>
				</div><?php
				} else { ?>
				<div class="row">
					<div class="col-sm-12" align="center" style="margin-bottom: 50px; margin-top: 20px">
						<button type="submit" class="btn btn-success btn-lg" style="width: 250px">Add Supplier</button>
				</div><?php } ?>
				
				</form> 
			</div>
		</div>
	</form>
</div>
<div class="col-sm-3"></div>
</div>

<script>

	function addChange(){
		if (document.getElementById('addIngredient').checked == true) {
			document.getElementById('myTable').style.visibility = 'visible';
			document.getElementById('cost').value = '';
			document.getElementById('name').value = '';
		}
		else{
			document.getElementById('myTable').style.visibility = 'hidden';
			document.getElementById('cost').value = '0';
			document.getElementById('name').value = '0';
		}

	}


	$(document).ready(function(){
		var i = 1;
		$('#add').click(function(){
			i++;
			$('#myTable').append('<tr id="row'+i+'"><td><input type="text" class="form-control" id="name[]" name="name[]" required></td><td><input type="number" min="0" class="form-control" id="cost[]" name="cost[]" required></td><td><center><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></center></td></tr>');
		});
		$(document).on('click', '.btn_remove', function(){
			var button_id = $(this).attr("id"); 
			$('#row'+button_id+'').remove();
		});
	});
</script>









