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
	echo "<li><a href = 'includes/logout.inc.php'> Log out </a> </li>";
	echo "<li><a href = 'shopCart/shoppingCart.php'> Shopping cart </a> </li>";
	if($_SESSION["user_type"] == "A"){
		echo "<p> Logged in as admin </p>";
		
		echo "<li><a href = 'manageProducts.php'> Manage products </a> </li>";
	}
	else if($_SESSION["user_type"] == "U"){
		echo "<p> Logged in </p>";
		
	}
	
}
else{
	echo "<li><a href = 'signIn.php'> Sign in </a> </li>";
	echo "<li><a href = 'signUp.php'> Sign up </a> </li>";
}
?>
<b>
<p>

<?php
	function addToCart($idProduct, $conn, $idCust){

		$customer = "SELECT * FROM customer WHERE idCustomer = '$idCust';";
		$resC = mysqli_query($conn, $customer);

		if(mysqli_num_rows($resC)>0){
			$arr = mysqli_fetch_assoc($resC);
			$shipping = $arr["address"];
			$add = "INSERT INTO shopping_cart VALUES (null, '$idCust', '$idProduct', '$shipping');";
			mysqli_query($conn, $add);
		}
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

</body>
</html>