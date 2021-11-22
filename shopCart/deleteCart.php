<?php
	session_start();
	include_once '../includes/dbHandler.php';

	$shopperID = $_SESSION['idCustomer'];

	$sql = "DELETE FROM shopping_cart WHERE customer_idCustomer = '$shopperID';";
  	mysqli_query($conn, $sql);

	header("Location: ../index.php?submit=success");
?>