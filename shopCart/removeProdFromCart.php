<?php
	session_start();
	include_once '../includes/dbHandler.php';

	$productID = $_POST['productID'];

	$shopperID = $_SESSION['idCustomer'];

	$sql = "DELETE FROM shopping_cart WHERE customer_idCustomer = '$shopperID' AND product_idProduct = '$productID';";
  	mysqli_query($conn, $sql);

	header("Location: shoppingCart.php?submit=success");
?>
