<?php
	session_start();
	include_once '../includes/dbHandler.php';

	$productID = $_POST['productID'];

<<<<<<< HEAD
<h1>HÄR SKA PRODUKTER SLAKTAS FRÅN KORGEN!! >8D</h1>
<?php
	echo "kund: " . $_POST['shopper'];
	echo "id" . $_SESSION('idCustomer');
	
?>
=======
	$shopperID = $_SESSION['idCustomer'];
>>>>>>> 82ff22bc9cca632794e05dfb34787bd439a76bc0

	$sql = "DELETE FROM shopping_cart WHERE customer_idCustomer = '$shopperID' AND product_idProduct = '$productID';";
  	mysqli_query($conn, $sql);

	header("Location: shoppingCart.php?submit=success");
?>
