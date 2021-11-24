<?php
	include_once 'includes/dbHandler.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="design/index.css?v=<?php echo time(); ?>">
</head>
<body>
	
<?php
if(isset($_SESSION["idCustomer"])){
	if($_SESSION["user_type"] == "A"){
		echo "<ul class=\"navbar\">";
		echo "<li> <a href = 'index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = 'manageProducts.php'> Manage products </a> </li>";
		echo "<li><a href = 'includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo '<ul class="navbar">';
		echo "<li> <a href = 'index.php'> Web-shoppen </a></li>";
		echo "<li><a href = 'shopCart/shoppingCart.php'> Shopping cart </a> </li>";
		echo "<li><a href = 'includes/logout.inc.php'> Log out </a></li>";
		echo "</ul>";	
	}
}
else{
	echo '<ul class="navbar">';
	echo "<li> <a href = 'index.php'> Web-shoppen </a></li>";
	echo "<li><a href = 'signIn.php'> Sign in </a> </li>";
	echo "<li><a href = 'signUp.php'> Sign up </a> </li>";
	echo "<li><a href = 'shopCart/shoppingCart.php'> Shopping cart </a> </li>";
	echo "</ul>";
}
?>
<b>
<p>

<?php
/*
$query = "SELECT * FROM products WHERE p_name = '$name' AND price = '$price';";
$queryResult = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($queryResult);


if(mysqli_num_rows($queryResult)>0){
  $idValue = $row['idProduct'];
  $sql = "UPDATE products SET stock = stock + $Amount WHERE idProduct = '$idValue';";
}else{
  $sql = "INSERT INTO products VALUES (null, '$name', '$price', '$Amount', '$category');";
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($conn, $sql);*/

	function addToCart($idProduct, $conn, $idCust){

		$query = "SELECT * FROM shopping_cart WHERE customer_idCustomer = '$idCust' AND product_idProduct = '$idProduct';";
		$queryResult = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($queryResult);

		if(mysqli_num_rows($queryResult)>0){
			$add = "UPDATE shopping_cart SET amount = amount + 1 WHERE customer_idCustomer = '$idCust' AND product_idProduct = '$idProduct';";
		}else{
			$add = "INSERT INTO shopping_cart VALUES (null, '$idCust', '$idProduct', 1);";
		}
		mysqli_query($conn, $add);




		/*$customer = "SELECT * FROM customer WHERE idCustomer = '$idCust';";
		$resC = mysqli_query($conn, $customer);

		if(mysqli_num_rows($resC)>0){
			$arr = mysqli_fetch_assoc($resC);
			
		}*/
	}

	$sql = "SELECT * FROM products;";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);

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
			if(isset($_SESSION["idCustomer"])){
				echo "Produkten" . $_POST["add"];
				$id = $_POST["add"];
				addToCart($id, $conn, $_SESSION["idCustomer"]);
			}else{
				echo '<meta http-equiv="refresh" content="0; url=signUp.php" />';
			}
		}
	}  
?>
<b>
<p>

</body>
</html>