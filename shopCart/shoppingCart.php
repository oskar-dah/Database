<?php
	session_start();
	include_once '../includes/dbHandler.php';	
?>

<!DOCTYPE html>
<html>
<body>
<head> <link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>"> 
</head>

<?php
if(isset($_SESSION["idCustomer"])){
	if($_SESSION["user_type"] == "A"){
		echo "<ul class=\"navbar\">";
		echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '../manageProducts.php'> Manage products </a> </li>";
		echo "<li><a href = '../purchaseHistory/viewOrders.php'> Order History </a> </li>";
		echo "<li><a href = '../includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo '<ul class="navbar">';
		echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = '../includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";	
	}
}
else{
	echo '<ul class="navbar">';
	echo "<li> <a href = '../index.php'> Web-shoppen </a></li>";
	echo "<li><a href = '../signIn.php'> Sign in </a> </li>";
	echo "<li><a href = '../signUp.php'> Sign up </a> </li>";
	echo "<li><a href = 'shoppingCart.php'> Shopping cart </a> </li>";
	echo "</ul>";
}
?>
<h1>Your shopping cart <?php  ?></h1>

<b>
<p>
<?php
	buyCartButton();
	deleteCartButton(); 
	try {
		$shopper = $_SESSION['idCustomer'];
		$sql = "SELECT * FROM shopping_cart WHERE customer_idCustomer=$shopper;";
	
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
		$result = mysqli_query($conn, $sql);
		$checkResult = mysqli_num_rows($result);
	
		if($checkResult > 0){
			while($productNr = mysqli_fetch_assoc($result)){
				$sql2 = "SELECT p_name, price FROM products WHERE idProduct=$productNr[product_idProduct];";

				$result2 = mysqli_query($conn, $sql2);
				$checkResult2 = mysqli_num_rows($result2);

				$rowProduct = mysqli_fetch_assoc($result2);
				echo "<br>" . "Name: " . $rowProduct['p_name'] . "<br>";
				echo "Price: " . $rowProduct['price'] . "<br>";
				echo "Amount: " . $productNr['amount'] . "<br>";
				removeProdFromCartButton($shopper, $productNr['product_idProduct']);

			}
		}  
	} catch (Exception $e) {
		?>
		<meta http-equiv="refresh" content="0; url=../signUp.php" />
		<?php
	}

	function buyCartButton(){ ?>

		<form action="buyCart.php" method = "POST">

		<input type="text" name="shippingAddr" placeholder="shipping Address" required><br>

		<input type="submit" 
			value="Buy cart">
		</form>
	<?php
	}

	function deleteCartButton(){ ?><br>

		<form action="deleteCart.php" method = "POST">
		 <input type="submit" 
			value="Delete cart">
		</form>
	<?php
	}

	function removeProdFromCartButton($shopper, $productID){ ?>

		<form action="removeProdFromCart.php" method = "POST">

		<input type="hidden"
			name="productID"
			value=<?php echo $productID; ?>>

		 <input type="submit" 
			value="Remove">
		</form>
	<?php
	}  
	
?>
</p>
</b>
</body>
</html>