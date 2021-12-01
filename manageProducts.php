<?php
	include_once 'includes/dbHandler.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head> <link rel="stylesheet" href="design/index.css?v=<?php echo time(); ?>"> </head>
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
<div class = "menu1">
<h1>Add new product</h1>

<form action = "includes/addProd.php" method = "POST">
  
  <input type="text" name="products" placeholder="Product"><br><br>
  
  <input type="text" name="price" placeholder="Price"><br><br>
  
  <input type="text" name="amount" placeholder="Amount"><br><br>

  <input type="text" name="category" placeholder="Category"><br><br>

  <button class = "button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1>Remove product</h1>

<form action = "includes/removeProd.php" method = "POST">
  
  <input type="text" name="remProductID" placeholder="ProductID"><br><br>

  <button name = "removeB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1>Change price</h1>

<form action = "includes/changePrice.php" method = "POST">
  
  <input type="text" name="pProductID" placeholder="ProductID"><br><br>

  <input type="text" name="newPrice" placeholder="New Price"><br><br>
  
  <button name = "priceB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1>Change stock</h1>

<form action = "includes/changeStock.php" method = "POST">
  
  <input type="text" name="amProductID" placeholder="ProductID"><br><br>

  <input type="text" name="newAmount" placeholder="New amount"><br><br>
  
  <button name = "stockB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "printout">
<b>
<p>
<?php
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
		}
	}  
?>
</p>
</b>
</div>
</body>
</html>