<?php
	include_once 'includes/dbHandler.php';
	session_start();
	include_once 'includes/overlay.php';
?>

<!DOCTYPE html>
<html>
<head> <link rel="stylesheet" href="design/index.css?v=<?php echo time(); ?>"> </head>
<body>

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