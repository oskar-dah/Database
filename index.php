<?php
	include_once 'includes/dbHandler.php';
	session_start();
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
	echo "<p> Logged in </p>";
	echo "<li><a href = 'includes/logout.inc.php'> Log out </a> </li>";
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
<button class = "button" type="button" onclick="location.href = 'signIn.php';">Sign in</button>
<button class = "button" type="button" onclick="location.href = 'signUp.php';">Sign up</button>

<?php
	function addToCart($idProduct, $resC, $idCust){
		if(mysqli_num_rows($resC)>0){
			$arr = mysqli_fetch_assoc($resC);
			$shipping = $arr["address"];
			$add = "INSERT INTO shopping_cart VALUES (null, '$idCust', '$idProduct', '$shipping');";
			return $add;
		}
		
	}

	$sql = "SELECT * FROM products;";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	$idCust = $_SESSION["idCustomer"];

	$customer = "SELECT * FROM customer WHERE idCustomer = '$idCust';";
	$resC = mysqli_query($conn, $customer);

	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			
			echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
			echo "Name: " . $row['p_name'] . "<br>";
			echo "Category: " . $row['category'] . "<br>";
			echo "Price: " . $row['price'] . "<br>";
			echo "Stock: " . $row['stock'] . "<br>";
			echo "<form action='index.php' method='post'>";
			echo '<button name = "add" class = "button" type="submit" value ='. $row['idProduct'] .'>Add to cart</button>';
		}
		if(isset($_POST["add"])){
			echo "Produkten" . $_POST["add"];
			$id = $_POST["add"];
			$temp = addToCart($id, $resC, $idCust);
			mysqli_query($conn, $temp);
		}
		
	}  
?>

</body>
</html>