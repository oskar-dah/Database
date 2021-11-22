<?php
	session_start();
	include_once 'includes/dbHandler.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design/index.css">
</head>
<body>

<h1>Welcome to Web-shop</h1>

<<<<<<< HEAD:index.php
<?php
if(isset($_SESSION["idCustomer"])){
	echo "<p> Logged in </p>";
	echo "<li><a href = 'includes/logout.inc.php'> Log out </a> </li>";
}
else{
	echo "<p> Sign in </p>";
	echo "<p> Sign up </p>";
}
?>
<button type="button" onclick="location.href = 'addProduct.php';">Manage products</button>
<button type="button" onclick="location.href = 'signIn.php';">Sign in</button>
<button type="button" onclick="location.href = 'signUp.php';">Sign up</button>
<b>
<p>
=======
<button class = "button" type="button" onclick="location.href = 'manageProducts.php';">Manage products</button>
<button class = "button" type="button" onclick="location.href = 'shopCart/shoppingCart.php';">Shopping Cart</button>
<button class = "button" type="button" onclick="location.href = 'shopCart/shoppingCart.php';">Log in</button>

>>>>>>> db0bd20bdbfad9b5fe4a36edef693a6304f79dca:test.php
<?php
	$sql = "SELECT * FROM products;";
//	$sql = "INSERT INTO product VALUES (4, 'Phone', 145, 1)";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			
			echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
			echo "Name: " . $row['p_name'] . "<br>";
<<<<<<< HEAD:index.php
			echo "Category: " . $row['category'] . "<br>";
=======
>>>>>>> db0bd20bdbfad9b5fe4a36edef693a6304f79dca:test.php
			echo "Price: " . $row['price'] . "<br>";
			echo "Stock: " . $row['stock'] . "<br>";
			echo '<div class = "button"> Add to cart </div>';
		}
	}  
?>

</body>
</html>