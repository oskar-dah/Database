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
  
  <input type="text" name="products" placeholder="Product" required><br><br>
  
  <input type="number" min = "0" name="price" placeholder="Price" required><br><br>
  
  <input type="number" min = "0" name="amount" placeholder="Amount" required><br><br>

  <input type="text" name="category" placeholder="Category" required><br><br>

  <button class = "button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1>Remove product</h1>

<form action = "includes/removeProd.php" method = "POST">
  
  <input  type="number" min = "0" name="remProductID" placeholder="ProductID" required><br><br>

  <button name = "removeB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1>Change price</h1>

<form action = "includes/changePrice.php" method = "POST">
  
  <input type="number" min = "0" type="text" name="pProductID" placeholder="ProductID" required><br><br>

  <input type="number" min = "0" name="newPrice" placeholder="New Price" required><br><br>
  
  <button name = "priceB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1>Change stock</h1>

<form action = "includes/changeStock.php" method = "POST">
  
  <input type="number" min = "0" name="amProductID" placeholder="ProductID" required><br><br>

  <input type="number" min = "0" name="newAmount" placeholder="New amount" required><br><br>
  
  <button name = "stockB" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "menu2">
<h1>Delete review</h1>

<form action = "includes/review.inc.php" method = "POST">
  
  <input  type="number" min = "0" name="rID" placeholder="Review ID" required><br><br>
  
  <button name = "reviewID" class="button" type="submit" value="Submit"> Submit </button>
</form>
</div>

<div class = "printout">
<b>
<p>
<h3> Product information &nbsp; </h3> <br> 
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

<div class = "printout">
<b>
<p>
	<h3> Review information </h3>
<?php
	$sql = "SELECT * FROM reviews;";
	$result = mysqli_query($conn, $sql);
	$checkResult = mysqli_num_rows($result);
	
	if($checkResult > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo "<br>" . "<br>". "ID: " . $row['reviewID'] . "<br>";
			echo "Rating: " . $row['rating'] . "<br>";
			echo "Comment: " . $row['comment'] . "<br>";
		}
	}  
?>
</p>
</b>
</div>

</body>
</html>