<?php
	include_once '../includes/dbHandler.php';
?>

<!DOCTYPE html>
<html>
<body>

<h1>Your shopping cart (WIP)</h1>

<b>
<p>
<?php
    $shopper = 1; //to be changed when loginSystem is done
	$sql = "SELECT * FROM shopping_cart WHERE customer_idCustomer=$shopper;";
	
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($productNr = mysqli_fetch_assoc($result)){
			$sql2 = "SELECT p_name, price FROM products WHERE idProduct=$productNr[product_idProduct];";

			$result2 = mysqli_query($conn, $sql2);
			$checkResult2 = mysqli_num_rows($result2);

			if($checkResult2 > 0){
				while($rowProduct = mysqli_fetch_assoc($result2)){
					echo "<br>" . "Name: " . $rowProduct['p_name'] . "<br>";
					echo "Price: " . $rowProduct['price'] . "<br>";
					removeProdFromCartButton($shopper);
				}
			}
		}
	}  

	//https://stackoverflow.com/questions/30051961/how-can-i-make-an-html-button-that-passes-a-parameter
	function removeProdFromCartButton($shopper){ ?>

		<form action="removeProdFromCart.php" method = "POST">

     	<input type="hidden"
            name="shopper"
            value=<?php $shopper ?>> 

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