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

<?php
if(isset($_SESSION["idCustomer"])){
	if($_SESSION["user_type"] == "A"){
		echo "<p> Logged in as admin </p>";
		echo "<li><a href = 'includes/logout.inc.php'> Log out </a> </li>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo "<p> Logged in </p>";
		echo "<li><a href = 'includes/logout.inc.php'> Log out </a> </li>";
	}
	
}
else{
	echo "<p> Sign in </p>";
	echo "<p> Sign up </p>";
}
?>
<b>
<p>
<button class = "button" type="button" onclick="location.href = 'manageProducts.php';">Manage products</button>
<button class = "button" type="button" onclick="location.href = 'shopCart/shoppingCart.php';">Shopping Cart</button>
<button class = "button" type="button" onclick="location.href = 'shopCart/shoppingCart.php';">Log in</button>
<button class = "button" type="button" onclick="location.href = 'signIn.php';">Sign in</button>
<button class = "button" type="button" onclick="location.href = 'signUp.php';">Sign up</button>
<?php
	$sql = "SELECT * FROM products;";
//	$sql = "INSERT INTO product VALUES (4, 'Phone', 145, 1)";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			
			echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
			echo "Name: " . $row['p_name'] . "<br>";
			echo "Category: " . $row['category'] . "<br>";
			echo "Price: " . $row['price'] . "<br>";
			echo "Stock: " . $row['stock'] . "<br>";
			echo '<div class = "button"> Add to cart </div>';
		}
	}  
?>

</body>
</html>