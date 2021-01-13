<?php  
	session_start();
	if ($_SESSION["username"] == NULL) {
		header("Location:../");
	}
	include"welcome.php";
	if (!$_GET) {
		include'../welcome/home.php' ;
	}
	else if ($_GET["test"] == 1) {
		if ($_SESSION["userRole"] == 'Manager') 
			include'../table/staff.php' ;
		else
			include'../welcome/home.php' ;
	}
	else if ($_GET["test"] == 2) {
		if ($_SESSION["userRole"] == 'Storage Manager' || $_SESSION["userRole"] == 'Manager')
			include'../table/history.php' ;
		else
			include'../welcome/home.php' ;
	}
	else if ($_GET["test"] == 3) {
		include'../table/menu.php' ;
	}
	else if ($_GET["test"] == 4) {
		include'../table/ingredient.php' ;
	}
	else if ($_GET["test"] == 5) {
		include '../table/order.php';
	}
	else if ($_GET["test"] == 6) {
		include '../table/buy-ingredient.php';
	}
	else if ($_GET["test"] == 7) {
		include '../table/summary.php';
	}
//not use
	else if ($_GET["test"] == 8) {
		include '../table/discount.php';
	}
	else if ($_GET["test"] == 9) {
		if ($_GET["orderid"] == NULL) {
			include '../table/bill.php';
		}
		else{
			include '../table/bill-each-order.php';
		}
	}
	else if ($_GET["test"] == 10) {
		include '../table/supplier.php';
	}
	else if ($_GET["test"] == 11) {
		include '../add/add-supplier.php';
	}
	else if ($_GET["test"] == 12) {
		include '../add/add-menu.php';
	}
	else if ($_GET["test"] == 14) {
		include'../table/promotion.php' ;
	}
	else if ($_GET["test"] == 15) {
		include'../edit/menu.php' ;
	}
	
?>
