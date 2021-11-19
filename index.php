<?php
	include_once 'includes/dbHandler.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design/index.css">
</head>
<body>

<h1>Welcome to Web-shop</h1>

<button class = "button" type="button" onclick="location.href = 'manageProducts.php';">Manage products</button>
<button class = "button" type="button" onclick="location.href = 'shopCart/shoppingCart.php';">Shopping Cart</button>
<button class = "button" type="button" onclick="location.href = 'shopCart/shoppingCart.php';">Log in</button>

<?php
	$sql = "SELECT * FROM products;";
//	$sql = "INSERT INTO product VALUES (4, 'Phone', 145, 1)";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			
			echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
			echo "Name: " . $row['p_name'] . "<br>";
			echo "Price: " . $row['price'] . "<br>";
			echo "Stock: " . $row['stock'] . "<br>";
			echo '<div class = "button"> Add to cart </div>';
		}
	}  
?>

</body>
</html>