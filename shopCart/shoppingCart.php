<?php
	session_start();
	include_once '../includes/dbHandler.php';
	include_once '../includes/overlay.php';	
?>

<!DOCTYPE html>
<html>
<body>
<head> <link rel="stylesheet" href="../design/index.css?v=<?php echo time(); ?>"> 
</head>

<h1>Your shopping cart <?php  ?></h1>

<b>
<p>
<?php
	if(isset($_SESSION['idCustomer'])){

		buyCartButton();
		deleteCartButton();

		$shopper = $_SESSION['idCustomer'];
		$sql = "SELECT * FROM shopping_cart WHERE customer_idCustomer=$shopper;";
	
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
	} else {
		?>
		<meta http-equiv="refresh" content="0; url=../signUp.php" />
		<?php
	}

	function buyCartButton(){ ?>

		<form action="buyCart.php" method = "POST">

		<input type="text" name="shippingAddr" placeholder="shipping Address" required><br><br>

		<input type="submit" 
			value="Buy cart">
		</form>
	<?php
	}

	function deleteCartButton(){ ?>

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