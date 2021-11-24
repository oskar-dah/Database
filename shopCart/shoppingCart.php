<?php
	session_start();
	include_once '../includes/dbHandler.php';	
?>

<!DOCTYPE html>
<html>
<body>
<button type="button" onclick="location.href = '../index.php';">Home</button>
<h1>Your shopping cart <?php deleteCartButton(); ?></h1>

<b>
<p>
<?php

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
				removeProdFromCartButton($shopper, $productNr['product_idProduct']);

			}
		}  
	} catch (Exception $e) {
		?>
		<meta http-equiv="refresh" content="0; url=../signUp.php" />
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
			value="Ta Bort">
		</form>
	<?php
	}  
	
?>
</p>
</b>
</body>
</html>