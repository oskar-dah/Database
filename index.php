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
<div class="search">
	<h1> Here we do some searching </h1>	
	<form action = "index.php" method = "POST">
		<input type="text" name="cat" placeholder="Category"><br><br>
		<button class = "button" name = "test" type="submit" value="Submit"> Submit </button>
	</form>
	<div class="dropdown">
  		<div class="dropbtn">Sort by</div>
			<div class="dropdown-content">
				<form action = "index.php" method = "POST">
				<button class = "dropperB" name = "pLf" type="submit" value="Submit"> Price (lowest first) </button>
				<button class = "dropperB" name = "pHf" type="submit" value="Submit"> Price (highest first) </button>
				<button class = "dropperB" name = "nAz" type="submit" value="Submit"> Name (A-Z) </button>
				<button class = "dropperB" name = "nZa" type="submit" value="Submit"> Name (Z-A) </button>
				<button class = "dropperB" name = "rating" type="submit" value="Submit"> Rating </button>
				</form>
				<!--<a href="#">Price (lowest first)</a>
				<a href="#">Price (highest first)</a>
				<a href="#">Name (A-Z)</a>
				<a href="#">Name (Z-A)</a>
				<a href="#">Rating</a>-->
			</div>
	</div>
</div>
<b>
<p>

<?php
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
	}

	function printer($sql, $conn){
		$result = mysqli_query($conn, $sql);
		$checkResult = mysqli_num_rows($result);

		if($checkResult > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['stock'] > 0){
					echo "<br>" . "ID: " . $row['idProduct'] . "<br>";
					echo "Name: " . $row['p_name'] . "<br>";
					echo "Category: " . $row['category'] . "<br>";
					echo "Price: " . $row['price'] . "<br>";
					echo "Stock: " . $row['stock'] . "<br>";
					echo "<form action='index.php' method='post'>";
					echo '<button name = "add" class = "button" type="submit" value ='. $row['idProduct'] .'>Add to cart</button>';
				}
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
	}

	if(isset($_POST["test"])){
		$cat = $_POST["cat"];
		$sql = "SELECT * FROM `products` WHERE category = '$cat';";
		echo "<h1> Viewing all " . $cat . "s </h1>";
		printer($sql, $conn);
	}elseif(isset($_POST["pLf"])){
		echo "<h1> Viewing products lowest to highest </h1>";
		$sql = "SELECT * FROM products ORDER BY price ASC;";
		printer($sql, $conn);
	}elseif(isset($_POST["pHf"])){
		echo "<h1> Viewing products highest to lowest </h1>";
		$sql = "SELECT * FROM products ORDER BY price DESC;";
		printer($sql, $conn);
	}elseif(isset($_POST["nAz"])){
		echo "<h1> Viewing products A-Z </h1>";
		$sql = "SELECT * FROM products ORDER BY p_name ASC;";
		printer($sql, $conn);
	}elseif(isset($_POST["nZa"])){
		echo "<h1> Viewing products Z-A </h1>";
		$sql = "SELECT * FROM products ORDER BY p_name DESC;";
		printer($sql, $conn);
	}elseif(isset($_POST["rating"])){
		echo "<h1> Viewing products highest to lowest rating</h1>";
		//$sql = "SELECT * FROM products;";
		//printer($sql, $conn);
	}else{
		echo "<h1> All products </h1>";
		$sql = "SELECT * FROM products;";
		printer($sql, $conn);
	}	
?>
<b>
<p>

</body>
</html>